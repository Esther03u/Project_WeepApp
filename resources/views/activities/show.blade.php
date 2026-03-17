@extends('layouts.app')

@section('title', $activity->title . ' | ระบบลงทะเบียนกิจกรรม')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <a href="{{ route('activities.index') }}" class="btn btn-sm btn-outline-dark mb-3">
            <i class="bi bi-arrow-left me-1"></i>กลับไปหน้ารายการ
        </a>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white py-3">
                <h3 class="card-title mb-0">{{ $activity->title }}</h3>
            </div>
            
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <h6 class="text-muted mb-1"><i class="bi bi-clock me-1"></i>วันที่และเวลา</h6>
                        <p class="mb-0 fw-semibold">{{ $activity->activity_date->format('d F Y, H:i') }} น.</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-1"><i class="bi bi-geo-alt-fill me-1 text-danger"></i>สถานที่</h6>
                        <p class="mb-0 fw-semibold">{{ $activity->location }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-muted mb-2"><i class="bi bi-info-circle me-1 text-info"></i>รายละเอียดกิจกรรม</h6>
                    <div class="p-3 bg-light rounded text-break">
                        {!! nl2br(e($activity->description ?: 'ไม่มีรายละเอียดระบุไว้')) !!}
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between p-3 border rounded mb-4 bg-light">
                    <div>
                        <span class="fs-5 fw-bold text-dark">{{ $activity->registrations()->count() }}</span>
                        <span class="text-muted">/ {{ $activity->max_participants }} คน</span>
                    </div>
                    <div>
                        @if($activity->isFullyBooked())
                            <span class="badge bg-danger fs-6 py-2 px-3">ที่นั่งเต็มแล้ว</span>
                        @else
                            <span class="badge bg-success fs-6 py-2 px-3">ว่าง {{ $activity->availableSlots() }} ที่นั่ง</span>
                        @endif
                    </div>
                </div>

                {{-- Action Area --}}
                <div class="text-center mt-2">
                    @guest
                        <div class="alert alert-warning mb-0">
                            กรุณา <a href="{{ route('login') }}" class="alert-link">เข้าสู่ระบบ</a> หรือ 
                            <a href="{{ route('register') }}" class="alert-link">สมัครสมาชิก</a> เพื่อลงทะเบียน
                        </div>
                    @else
                        @if($isRegistered)
                            <div class="alert alert-success mb-3">
                                <i class="bi bi-check-circle-fill me-2"></i>คุณได้ลงทะเบียนเข้าร่วมกิจกรรมนี้แล้ว
                            </div>
                            <form action="{{ route('activities.cancel', $activity) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการยกเลิกการลงทะเบียน?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-x-circle me-1"></i>ยกเลิกการลงทะเบียน
                                </button>
                            </form>
                        @elseif($activity->isFullyBooked())
                            <button class="btn btn-secondary btn-lg w-100" disabled>
                                โควต้าเต็มแล้ว ไม่สามารถลงทะเบียนได้
                            </button>
                        @else
                            <form action="{{ route('activities.register', $activity) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark btn-lg w-100 shadow-sm" onclick="return confirm('ยืนยันการลงทะเบียนกิจกรรมนี้?');">
                                    <i class="bi bi-bookmark-check-fill me-2"></i>ลงทะเบียนเข้าร่วมกิจกรรม
                                </button>
                            </form>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
