@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Tambah User</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="/users/store">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        placeholder="Nama"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Password"
                        required>
                </div>

                {{-- Kolom konfirmasi password --}}
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi Password"
                        required>
                    <div id="password-mismatch" class="text-danger small mt-1" style="display: none;">
                        Password tidak cocok.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="kepala_lab">Kepala Lab</option>
                        <option value="kaprodi">Kaprodi</option>
                        <option value="staf_admin">Staf Admin</option>
                        <option value="staf_lab">Staf Lab</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

            </form>

        </div>
    </div>

</div>

<script>
    const password = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');
    const mismatchMsg = document.getElementById('password-mismatch');

    function checkPasswordMatch() {
        if (confirmation.value && password.value !== confirmation.value) {
            mismatchMsg.style.display = 'block';
            confirmation.classList.add('is-invalid');
        } else {
            mismatchMsg.style.display = 'none';
            confirmation.classList.remove('is-invalid');
        }
    }

    password.addEventListener('input', checkPasswordMatch);
    confirmation.addEventListener('input', checkPasswordMatch);
</script>

@endsection