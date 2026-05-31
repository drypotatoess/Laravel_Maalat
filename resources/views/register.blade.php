@extends('layouts.main')

@section('content')

<div class="register-wrapper">
    <div class="overlay"></div>

    <div class="register-card shadow">

        <h2 class="fw-bold text-center text-white">Register</h2>
        <p class="text-center text-white mb-3">Create your MedPatient account</p>

        <form action="/register" method="POST">
            @csrf

            <div class="row g-2">
                <div class="col-6">
                    <label class="text-white">Full Name</label>
                    <input type="text"
                        class="form-control form-control-sm @error('fullname') is-invalid @enderror"
                        name="fullname"
                        value="{{ old('fullname') }}"
                        placeholder="Full name">
                    @error('fullname')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="text-white">Email</label>
                    <input type="email"
                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email">
                    @error('email')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="text-white">Password</label>
                    <input type="password"
                        class="form-control form-control-sm @error('password') is-invalid @enderror"
                        name="password"
                        placeholder="Password">
                    @error('password')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="text-white">Confirm Password</label>
                    <input type="password"
                        class="form-control form-control-sm @error('confirmPassword') is-invalid @enderror"
                        name="confirmPassword"
                        placeholder="Confirm password">
                    @error('confirmPassword')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn register-btn w-100 mt-3">Register</button>

            <p class="text-center text-white mt-3 mb-0" style="font-size:13px;">
                Already have an account?
                <a href="{{ route('login') }}" class="login-link">Login here</a>
            </p>
        </form>
    </div>
</div>

@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="registerToast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('registerToast');
        if (toastEl) new bootstrap.Toast(toastEl, {
            delay: 4000
        }).show();
    });
</script>
@endif

<style>
    * {
        font-family: "Segoe UI", Arial, sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background: url('/images/hospital-bg.jpg') no-repeat center center;
        background-size: cover;
    }

    .overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.35);
    }

    .register-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 440px;
        background: rgba(58, 170, 214, 0.92);
        padding: 28px 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        margin: 16px;
    }

    h2 {
        font-size: 28px;
    }

    p {
        font-size: 13px;
    }

    label {
        font-weight: 600;
        margin-bottom: 4px;
        font-size: 13px;
        display: block;
    }

    .form-control {
        border-radius: 6px;
        border: none;
        box-shadow: none;
        font-size: 13px;
    }

    .form-control:focus {
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }

    .register-btn {
        background-color: white;
        color: #3AAAD6;
        font-weight: bold;
        font-size: 14px;
        padding: 8px;
        border-radius: 6px;
        border: none;
        transition: 0.3s;
    }

    .register-btn:hover {
        opacity: 0.9;
    }

    .login-link {
        color: white;
        font-weight: 700;
        text-decoration: none;
    }

    .login-link:hover {
        text-decoration: underline;
    }
</style>

@endsection