@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-9 col-lg-7">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">

            {{-- HEADER BANNER --}}
            <div style="height:120px; background: #d1d5db;"></div>

            <div class="card-body px-4 pb-4" style="margin-top:-65px;">

                {{-- AVATAR + NAME + EDIT BUTTON --}}
                <div class="d-flex align-items-end justify-content-between mb-4">
                    <div class="d-flex align-items-end gap-3">
                        @if(auth()->user()->profile_picture)
                        <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}"
                            alt="Profile Picture"
                            style="width:110px;height:110px;border-radius:50%;object-fit:cover;
                               border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,.15);">
                        @else
                        <img src="{{ asset('images/default-avatar.png') }}"
                            alt="Default Avatar"
                            style="width:110px;height:110px;border-radius:50%;object-fit:cover;
                               border:4px solid #fff;box-shadow:0 4px 12px rgba(0,0,0,.15);">
                        @endif
                        <div class="mb-1">
                            <div class="fw-semibold" style="font-size:16px;">{{ auth()->user()->name }}</div>
                            <div class="text-muted" style="font-size:13px;">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <button type="submit" form="profileForm" class="btn btn-primary btn-sm px-4" style="border-radius:8px;">
                        <i class="bi bi-check-lg me-1"></i> Save
                    </button>
                </div>

                <form id="profileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- PROFILE PICTURE UPLOAD --}}
                    <div class="mb-3">
                        <label class="form-label" style="font-size:11px;color:#6c757d;font-weight:500;">Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control form-control-sm" accept="image/*"
                            style="border-color:#e5e7eb;font-size:12px;border-radius:8px;padding:4px 8px;">
                        <div style="font-size:10px;color:#adb5bd;margin-top:3px;">Upload JPG or PNG (max 2MB)</div>
                    </div>

                    {{-- FIELDS --}}
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label mb-1" style="font-size:11px;color:#6c757d;font-weight:500;">Full Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ auth()->user()->name }}" required
                                style="border-color:#e5e7eb;font-size:12px;border-radius:8px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-1" style="font-size:11px;color:#6c757d;font-weight:500;">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" value="{{ auth()->user()->email }}" required
                                style="border-color:#e5e7eb;font-size:12px;border-radius:8px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-1" style="font-size:11px;color:#6c757d;font-weight:500;">Gender</label>
                            <select name="gender" class="form-select form-select-sm" style="border-color:#e5e7eb;font-size:12px;border-radius:8px;">
                                <option value="">Select</option>
                                <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mb-1" style="font-size:11px;color:#6c757d;font-weight:500;">Contact Number</label>
                            <input type="text" name="contact" class="form-control form-control-sm" value="{{ auth()->user()->contact }}"
                                style="border-color:#e5e7eb;font-size:12px;border-radius:8px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label mb-1" style="font-size:11px;color:#6c757d;font-weight:500;">Address</label>
                            <input type="text" name="address" class="form-control form-control-sm" value="{{ auth()->user()->address }}"
                                style="border-color:#e5e7eb;font-size:12px;border-radius:8px;">
                        </div>
                        <div class="col-12">
                            <label class="form-label mb-1" style="font-size:11px;color:#6c757d;font-weight:500;">
                                New Password <span style="color:#adb5bd;font-weight:400;">(leave blank to keep current)</span>
                            </label>
                            <input type="password" name="password" class="form-control form-control-sm"
                                style="border-color:#e5e7eb;font-size:12px;border-radius:8px;">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection