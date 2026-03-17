<section>
    <header class="mb-4">
        <h4 class="text-dark fw-bold">ข้อมูลบัญชีผู้ใช้</h4>
        <p class="text-muted small">อัปเดตข้อมูลส่วนตัวและที่อยู่อีเมลของคุณ</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">ชื่อ - นามสกุล</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">อีเมล</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-muted small mb-1">
                        อีเมลของคุณยังไม่ได้รับการยืนยัน
                        <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-none">
                            คลิกที่นี่เพื่อส่งลิงก์ยืนยันอีกครั้ง
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success small mb-0 fw-medium">
                            ลิงก์ยืนยันใหม่ถูกส่งไปยังอีเมลของคุณเรียบร้อยแล้ว
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-dark px-4">บันทึกข้อมูล</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success text-sm fw-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                    <i class="bi bi-check-circle me-1"></i>บันทึกสำเร็จ
                </span>
            @endif
        </div>
    </form>
</section>
