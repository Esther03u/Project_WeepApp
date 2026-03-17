@extends('layouts.app')

@section('title', 'แก้ไขกิจกรรม | ระบบลงทะเบียนกิจกรรม')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <a href="{{ route('admin.activities.index') }}" class="btn btn-sm btn-outline-dark mb-3">
            <i class="bi bi-arrow-left me-1"></i>กลับไปหน้ารายการ
        </a>

        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 text-dark fw-bold"><i class="bi bi-pencil-square me-2"></i>แก้ไขกิจกรรม</h4>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.activities.update', $activity) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">ชื่อกิจกรรม <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $activity->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="activity_date" class="form-label fw-semibold">วันที่และเวลาจัดกิจกรรม <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('activity_date') is-invalid @enderror" id="activity_date" name="activity_date" value="{{ old('activity_date', $activity->activity_date->format('Y-m-d\TH:i')) }}" required>
                            @error('activity_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="max_participants" class="form-label fw-semibold">จำนวนผู้เข้าร่วมสูงสุด (คน) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('max_participants') is-invalid @enderror" id="max_participants" name="max_participants" value="{{ old('max_participants', $activity->max_participants) }}" min="1" required>
                            @error('max_participants')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold">สถานที่จัดกิจกรรม <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $activity->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">รายละเอียดกิจกรรม</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description', $activity->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-dark px-4">
                            <i class="bi bi-save me-1"></i>บันทึกการเปลี่ยนแปลง
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
