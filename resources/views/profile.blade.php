@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<h5 class="fw-bold mb-3" style="color:#1a3c40">My Profile</h5>

<div class="d-flex justify-content-center">
    <div class="card border-0 shadow-sm" style="border-radius:12px;width:720px;">
        <div class="card-body p-4">

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">

                    {{-- LEFT SIDE - Upload --}}
                    <div class="col-4 text-center border-end">
                        @if(auth()->user()->profile_picture)
                        <img src="{{ asset('images/'.auth()->user()->profile_picture) }}"
                            alt="Profile Picture"
                            style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #2aacbb;">
                        @else
                        <img src="{{ asset('images/default-avatar.png') }}"
                            alt="Default Avatar"
                            style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid #d8eef0;">
                        @endif

                        <div class="mt-2 fw-semibold" style="color:#1a3c40;font-size:14px">{{ auth()->user()->name }}</div>
                        <div style="font-size:12px;color:#6a9ea3">{{ auth()->user()->email }}</div>

                        <div class="mt-3 text-start">
                            <label class="form-label mb-1" style="font-size:12px;color:#6c757d">Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control" accept="image/*"
                                style="font-size:11px;padding:3px 6px;">
                            <div style="font-size:10px;color:#adb5bd;margin-top:3px">JPG or PNG (max 2MB)</div>
                        </div>
                    </div>

                    {{-- RIGHT SIDE - Details --}}
                    <div class="col-8">
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label mb-1" style="font-size:12px;color:#6c757d">Full Name</label>
                                <input type="text" name="name" class="form-control" style="font-size:13px;padding:5px 10px;"
                                    value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1" style="font-size:12px;color:#6c757d">Email</label>
                                <input type="email" name="email" class="form-control" style="font-size:13px;padding:5px 10px;"
                                    value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1" style="font-size:12px;color:#6c757d">Gender</label>
                                <select name="gender" class="form-select" style="font-size:13px;padding:5px 10px;">
                                    <option value="">Select</option>
                                    <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label mb-1" style="font-size:12px;color:#6c757d">Contact Number</label>
                                <input type="text" name="contact" class="form-control" style="font-size:13px;padding:5px 10px;"
                                    value="{{ auth()->user()->contact }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1" style="font-size:12px;color:#6c757d">Address</label>
                                <input type="text" name="address" class="form-control" style="font-size:13px;padding:5px 10px;"
                                    value="{{ auth()->user()->address }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label mb-1" style="font-size:12px;color:#6c757d">New Password
                                    <span style="color:#adb5bd;font-weight:400"></span>
                                </label>
                                <input type="password" name="password" class="form-control" style="font-size:13px;padding:5px 10px;">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary btn-sm px-4">
                                Save Changes
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection