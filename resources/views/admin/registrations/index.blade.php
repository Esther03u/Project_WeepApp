@extends('layouts.app')

@section('title', 'รายชื่อผู้ลงทะเบียน | ระบบลงทะเบียนกิจกรรม')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <a href="{{ route('admin.activities.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left me-1"></i>กลับไปหน้ารายการ
        </a>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">ข้อมูลกิจกรรม: {{ $activity->title }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2 mb-md-0">
                        <strong class="text-muted d-block small">วันที่และเวลา</strong>
                        {{ $activity->activity_date->format('d M Y, H:i') }} น.
                    </div>
                    <div class="col-md-4 mb-2 mb-md-0">
                        <strong class="text-muted d-block small">สถานที่</strong>
                        {{ $activity->location }}
                    </div>
                    <div class="col-md-4">
                        <strong class="text-muted d-block small">สถานะโควต้า</strong>
                        <span class="fs-5">{{ $registrations->count() }}</span> / {{ $activity->max_participants }} คน 
                        @if($activity->isFullyBooked())
                            <span class="badge bg-danger ms-2">เต็ม</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mb-3"><i class="bi bi-card-checklist text-primary me-2"></i>รายชื่อผู้ลงทะเบียน</h4>
        
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" width="10%">ลำดับ</th>
                                <th>ชื่อ - นามสกุล</th>
                                <th>อีเมล</th>
                                <th>วันที่ลงทะเบียน</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrations as $index => $registration)
                                <tr>
                                    <td class="ps-4">{{ $index + 1 }}</td>
                                    <td class="fw-medium">{{ $registration->user->name }}</td>
                                    <td>{{ $registration->user->email }}</td>
                                    <td class="text-muted">{{ $registration->registered_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        ยังไม่มีผู้ลงทะเบียนกิจกรรมนี้
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($registrations->count() > 0)
            <div class="card-footer bg-white text-end py-3">
                <button class="btn btn-outline-success btn-sm" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i>พิมพ์รายชื่อ
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
