@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Edit User</h3>
        </div>

        <div class="card-body">

            <form id="edit-form">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ $user['nama'] }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ $user['email'] }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="kepala_lab" {{ $user['role']=='kepala_lab' ? 'selected' : '' }}>Kepala Lab</option>
                        <option value="kaprodi" {{ $user['role']=='kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                        <option value="staf_admin" {{ $user['role']=='staf_admin' ? 'selected' : '' }}>Staf Admin</option>
                        <option value="staf_lab" {{ $user['role']=='staf_lab' ? 'selected' : '' }}>Staf Lab</option>
                    </select>
                </div>

                <hr>
                <p class="text-muted small mb-3">
                    Kosongkan field password jika tidak ingin menggantinya.
                </p>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input
                        type="password"
                        id="password"
                        class="form-control"
                        placeholder="Kosongkan jika tidak diganti">
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password baru">
                    <div id="password-mismatch" class="text-danger small mt-1" style="display:none;">
                        Password tidak cocok.
                    </div>
                </div>

                <button type="button" id="btn-submit" class="btn btn-success">
                    Update
                </button>

            </form>

        </div>
    </div>

</div>

<script>
    const password     = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');
    const mismatchMsg  = document.getElementById('password-mismatch');
    const btnSubmit    = document.getElementById('btn-submit');

    function checkPasswordMatch() {
        if (password.value && confirmation.value) {
            if (password.value !== confirmation.value) {
                mismatchMsg.style.display = 'block';
                confirmation.classList.add('is-invalid');
                btnSubmit.disabled = true;
            } else {
                mismatchMsg.style.display = 'none';
                confirmation.classList.remove('is-invalid');
                btnSubmit.disabled = false;
            }
        } else {
            mismatchMsg.style.display = 'none';
            confirmation.classList.remove('is-invalid');
            btnSubmit.disabled = false;
        }
    }

    password.addEventListener('input', checkPasswordMatch);
    confirmation.addEventListener('input', checkPasswordMatch);

    btnSubmit.addEventListener('click', async function () {

    const nama  = document.querySelector('[name="nama"]').value;
    const email = document.querySelector('[name="email"]').value;
    const role  = document.querySelector('[name="role"]').value;
    const pass  = password.value;

    const body = { nama, email, role };

    if (pass.trim() !== '') {
        body.password = pass;
    }

    // Ambil token dari Laravel session
    const token = '{{ session('token') }}';

    try {

        const response = await fetch('http://127.0.0.1:5000/api/users/{{ $user['id'] }}', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(body)
        });

        const data = await response.json();

        if (response.ok) {
            window.location.href = '/users';
        } else {
            alert('Gagal update: ' + data.message);
        }

    } catch (err) {
        console.error('Fetch error:', err);
        alert('Terjadi kesalahan, cek console.');
    }

});
</script>

@endsection