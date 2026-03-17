<section>
    <header class="mb-4">
        <h4 class="text-danger fw-bold">ลบบัญชีผู้ใช้</h4>
        <p class="text-muted small">
            เมื่อบัญชีของคุณถูกลบ ข้อมูลทั้งหมดจะถูกลบอย่างถาวร โปรดดาวน์โหลดข้อมูลที่คุณต้องการเก็บไว้ก่อนทำรายการ
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        <i class="bi bi-trash3 me-1"></i>ลบบัญชีผู้ใช้ถาวร
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header bg-danger text-white pb-3">
                        <h5 class="modal-title" id="confirmUserDeletionModalLabel">คุณแน่ใจหรือไม่ว่าต้องการลบบัญชี?</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-4">
                            เมื่อบัญชีของคุณถูกลบ ข้อมูลและทรัพยากรทั้งหมดจะถูกลบอย่างถาวร กรุณากรอกรหัสผ่านเพื่อยืนยันว่าคุณต้องการปิดบัญชีนี้
                        </p>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">รหัสผ่านเพื่อยืนยัน <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="password" name="password" placeholder="รหัสผ่านปัจจุบัน" required>
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-danger">ยืนยันลบบัญชี</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
