@extends('layouts.app')

@section('title', 'กิจกรรมทั้งหมด | ระบบลงทะเบียนกิจกรรม')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 class="mb-0"><i class="bi bi-calendar3 text-primary me-2"></i>กิจกรรมที่เปิดลงทะเบียน</h2>
    </div>
</div>

<div class="row g-4">
    @forelse($activities as $activity)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-white border-bottom pt-3 pb-2">
                    <h5 class="card-title text-primary mb-1">{{ $activity->title }}</h5>
                    <p class="text-muted mb-0 small">
                        <i class="bi bi-clock me-1"></i>{{ $activity->activity_date->format('d M Y, H:i') }} น.
                    </p>
                </div>
                <div class="card-body">
                    <p class="card-text text-truncate">{{ $activity->description ?: 'ไม่มีรายละเอียด' }}</p>
                    <div class="d-flex flex-column gap-2 mb-3 text-muted small">
                        <div><i class="bi bi-geo-alt-fill me-2 text-danger"></i>{{ $activity->location }}</div>
                        <div>
                            <i class="bi bi-people-fill me-2 text-info"></i>
                            รับ {{ $activity->max_participants }} คน 
                            (เหลือ {{ $activity->availableSlots() }} ที่นั่ง)
                        </div>
                    </div>

                    @if($activity->isFullyBooked())
                        <div class="alert alert-danger py-2 mb-0 text-center small">
                            <i class="bi bi-x-circle me-1"></i>กิจกรรมเต็มแล้ว
                        </div>
                    @else
                        <div class="progress" style="height: 6px;">
                            @php 
                                $percent = ($activity->registrations_count / $activity->max_participants) * 100;
                                $color = $percent >= 80 ? 'bg-warning' : 'bg-success';
                            @endphp
                            <div class="progress-bar {{ $color }}" style="width: {{ $percent }}%"></div>
                        </div>
                    @endif
                </div>
                <div class="card-footer bg-white border-top-0 pb-3">
                    <a href="{{ route('activities.show', $activity) }}" class="btn btn-outline-primary w-100">
                        ดูรายละเอียด <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="bi bi-info-circle display-4 d-block mb-3"></i>
                <h5>ยังไม่มีกิจกรรมในขณะนี้</h5>
                <p class="mb-0">โปรดกลับมาตรวจสอบใหม่ในภายหลัง</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
