@extends('layouts.main')

@section('content')

<div class="login-wrapper">
    <div class="overlay"></div>

    <div class="login-card shadow">

        <h2 class="fw-bold text-center text-white">Login</h2>
        <p class="text-center text-white mb-3">Sign in to your MedPatient account</p>

        <form action="/login" method="POST">
            @csrf

            <div class="mb-2">
                <label class="text-white">Email</label>
                <input type="email"
                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter email">
                @error('email')
                <div class="text-warning small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label class="text-white">Password</label>
                <input type="password"
                    class="form-control form-control-sm @error('password') is-invalid @enderror"
                    name="password"
                    placeholder="Enter password">
                @error('password')
                <div class="text-warning small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn login-btn w-100 mt-2">Login</button>

            <p class="text-center text-white mt-3 mb-0" style="font-size:13px;">
                Don't have an account?
                <a href="{{ route('register') }}" class="register-link">Register here</a>
            </p>
        </form>
    </div>
</div>

@if(session('error'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:9999;">
    <div id="loginToast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('loginToast');
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

    .login-wrapper {
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

    .login-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 380px;
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

    .login-btn {
        background-color: white;
        color: #3AAAD6;
        font-weight: bold;
        font-size: 14px;
        padding: 8px;
        border-radius: 6px;
        border: none;
        transition: 0.3s;
    }

    .login-btn:hover {
        opacity: 0.9;
    }

    .register-link {
        color: white;
        font-weight: 700;
        text-decoration: none;
    }

    .register-link:hover {
        text-decoration: underline;
    }
</style>

@endsection