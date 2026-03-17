@extends('layouts.app')

@section('title', 'จัดการกิจกรรม | ระบบลงทะเบียนกิจกรรม')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 class="mb-0"><i class="bi bi-shield-lock text-dark me-2"></i>จัดการกิจกรรม</h2>
    </div>
    <div class="col text-end">
        <a href="{{ route('admin.activities.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg me-1"></i>สร้างกิจกรรมใหม่
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ชื่อกิจกรรม</th>
                        <th>วันที่และเวลา</th>
                        <th>สถานที่</th>
                        <th class="text-center">ผู้สมัคร</th>
                        <th class="text-end pe-4">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td class="ps-4">
                                <a href="{{ route('activities.show', $activity) }}" class="text-decoration-none fw-semibold">
                                    {{ $activity->title }}
                                </a>
                            </td>
                            <td>{{ $activity->activity_date->format('d/m/Y H:i') }}</td>
                            <td>{{ Str::limit($activity->location, 30) }}</td>
                            <td class="text-center">
                                @if($activity->isFullyBooked())
                                    <span class="badge bg-danger">{{ $activity->registrations_count }} / {{ $activity->max_participants }}</span>
                                @else
                                    <span class="badge bg-success">{{ $activity->registrations_count }} / {{ $activity->max_participants }}</span>
                                @endif
                                
                                <br>
                                <a href="{{ route('admin.activities.registrations', $activity) }}" class="btn btn-sm btn-link text-decoration-none mt-1 p-0">
                                    <i class="bi bi-people"></i> ดูรายชื่อ
                                </a>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.activities.edit', $activity) }}" class="btn btn-sm btn-outline-dark" title="แก้ไข">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST" class="d-inline" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบกิจกรรม {{ $activity->title }}? ข้อมูลผู้ลงทะเบียนทั้งหมดจะถูกลบไปด้วย');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="ลบ">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                ยังไม่มีกิจกรรมในระบบ
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
