@extends('layouts.main')
 
@section('content')
 
<!-- BACKGROUND WRAPPER -->
<div class="login-wrapper">
 
    <!-- OVERLAY -->
    <div class="overlay"></div>
 
    <!-- LOGIN FORM -->
    <div class="login-card shadow">
 
        <h2 class="fw-bold text-center text-white">
            Login
        </h2>
 
        <p class="text-center text-white mb-4">
            Sign in to your MedPatient account
        </p>
 
        <form action="/login" method="POST">
            @csrf
 
            <!-- EMAIL -->
            <div class="mb-3">
 
                <label class="text-white">
                    Email
                </label>
 
                <input type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    placeholder="Enter email">
 
                @error('email')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                @enderror
 
            </div>
 
            <!-- PASSWORD -->
            <div class="mb-3">
 
                <label class="text-white">
                    Password
                </label>
 
                <input type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    id="password"
                    placeholder="Enter password">
 
                @error('password')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                @enderror
 
            </div>
 
            <!-- BUTTON -->
            <button type="submit"
                class="btn login-btn w-100 mt-2">
 
                Login
 
            </button>
 
            <!-- REGISTER LINK -->
            <p class="text-center text-white mt-3 mb-0">
 
                Don't have an account?
 
                <a href="{{ route('register') }}" class="register-link">
                    Register here
                </a>
 
            </p>
 
        </form>
 
    </div>
 
</div>
 
<!-- TOAST — invalid credentials -->
@if(session('error'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="loginToast" class="toast align-items-center text-white bg-danger border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-x-circle-fill me-2"></i>
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var toastEl = document.getElementById('loginToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, { delay: 4000 });
            toast.show();
        }
    });
</script>
@endif
 
<!-- STYLE -->
<style>
    * {
        font-family: "Segoe UI", Arial, sans-serif;
    }
 
    body {
        margin: 0;
        padding: 0;
    }
 
    /* BACKGROUND */
    .login-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
 
        padding-top: 110px;
 
        position: relative;
 
        background: url('/images/hospital-bg.jpg') no-repeat center center;
        background-size: cover;
    }
 
    /* OVERLAY */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
 
        width: 100%;
        height: 100%;
 
        background: rgba(255, 255, 255, 0.35);
    }
 
    /* LOGIN CARD */
    .login-card {
        position: relative;
        z-index: 2;
 
        width: 500px;
 
        background: rgba(58, 170, 214, 0.92);
 
        padding: 40px;
 
        border-radius: 18px;
 
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
 
    h2 {
        font-size: 42px;
    }
 
    p {
        font-size: 15px;
    }
 
    label {
        font-weight: 600;
        margin-bottom: 6px;
        font-size: 15px;
    }
 
    .form-control {
        border-radius: 6px;
        padding: 10px;
        border: none;
        box-shadow: none;
        font-size: 14px;
    }
 
    .form-control:focus {
        box-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
    }
 
    /* BUTTON */
    .login-btn {
        background-color: white;
        color: #3AAAD6;
 
        font-weight: bold;
 
        padding: 11px;
 
        border-radius: 6px;
 
        border: none;
 
        transition: 0.3s;
    }
 
    .login-btn:hover {
        opacity: 0.9;
    }
 
    /* REGISTER LINK */
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
 