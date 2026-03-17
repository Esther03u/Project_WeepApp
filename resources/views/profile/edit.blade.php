@extends('layouts.app')

@section('title', 'จัดการโปรไฟล์ | ระบบลงทะเบียนกิจกรรม')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-4"><i class="bi bi-person-gear me-2 text-dark"></i>จัดการโปรไฟล์</h2>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
