@extends('layouts.main')

@section('content')

<!-- BACKGROUND WRAPPER -->
<div class="register-wrapper">

    <!-- OVERLAY -->
    <div class="overlay"></div>

    <!-- REGISTER FORM -->
    <div class="register-card shadow">

        <h2 class="fw-bold text-center text-white">
            Register
        </h2>

        <p class="text-center text-white mb-4">
            Create your MedPatient account
        </p>

        <form action="/register" method="POST">
            @csrf

            <!-- ROW 1 -->
            <div class="row">

                <!-- FULL NAME -->
                <div class="col-md-6 mb-3">

                    <label class="text-white">
                        Full Name
                    </label>

                    <input type="text"
                        class="form-control @error('fullname') is-invalid @enderror"
                        name="fullname"
                        id="fullname"
                        value="{{ old('fullname') }}"
                        placeholder="Enter full name">

                    @error('fullname')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror

                </div>

                <!-- EMAIL -->
                <div class="col-md-6 mb-3">

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

            </div>

            <!-- ROW 2 -->
            <div class="row">

                <!-- PASSWORD -->
                <div class="col-md-6 mb-3">

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

                <!-- CONFIRM PASSWORD -->
                <div class="col-md-6 mb-3">

                    <label class="text-white">
                        Confirm Password
                    </label>

                    <input type="password"
                        class="form-control @error('confirmPassword') is-invalid @enderror"
                        name="confirmPassword"
                        id="confirmPassword"
                        placeholder="Confirm password">

                    @error('confirmPassword')
                    <div class="text-warning small mt-1">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                class="btn register-btn w-100 mt-2">

                Register

            </button>

            <!-- LOGIN -->
            <p class="text-center text-white mt-3 mb-0">

                Already have an account?

                <a href="{{ route('login') }}" class="login-link">
                    Login here
                </a>

            </p>

        </form>

    </div>

</div>

<!-- TOAST NOTIFICATION -->
@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="registerToast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('registerToast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl, {
                delay: 4000
            });
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
    .register-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;

        padding-top: 110px;

        position: relative;

        /* BACKGROUND IMAGE */
        background: url('/images/hospital-bg.jpg') no-repeat center center;
        background-size: cover;
    }

    /* LIGHT OVERLAY */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;

        width: 100%;
        height: 100%;

        background: rgba(255, 255, 255, 0.35);
    }

    /* REGISTER FORM */
    .register-card {
        position: relative;
        z-index: 2;

        width: 600px;

        /* SAME STYLE SA PIC */
        background: rgba(58, 170, 214, 0.92);

        padding: 35px;

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
    .register-btn {
        background-color: white;
        color: #3AAAD6;

        font-weight: bold;

        padding: 11px;

        border-radius: 6px;

        border: none;

        transition: 0.3s;
    }

    .register-btn:hover {
        opacity: 0.9;
    }

    /* LOGIN LINK */
    .login-link {
        color: white;

        font-weight: 700;

        text-decoration: none;
    }

    
</style>

@endsection