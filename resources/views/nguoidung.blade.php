@vite(['resources/scss/nguoidung.scss'])
@vite(['resources/js/nguoidung.js'])
@extends('layouts.app')
@section('content')
@section('title', 'Trang người dùng')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="profile-name" id="display-name">{{ $data["hoten"] ?? 'Nhập họ tên' }}</div>
        </div>

        <div class="profile-details">
            <div class="detail-item">
                <span class="detail-label">Họ và tên:</span>
                <span class="detail-value" id="name-value">{{ $data["hoten"] ?? '' }}</span>
                <button class="btn btn-primary btn-sm" onclick="toggleEditForm('name')"><i class="bi bi-pen"></i></button>
            </div>
            <div class="edit-form" id="name-form">
                <div class="form-group">
                    <input type="text" id="name-input" value="{{ $data["hoten"] ?? '' }}">
                </div>
                <button class="btn btn-primary btn-sm" onclick="saveChanges('name')"><i class="bi bi-floppy"></i>
                    Lưu</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Ngày sinh:</span>
                <span class="detail-value"
                    id="dob-value">{{ $data["ngaysinh"] ? date('d/m/Y', strtotime($data["ngaysinh"])) : '' }}</span>
                <button class="btn btn-primary btn-sm" onclick="toggleEditForm('dob')"><i class="bi bi-pen"></i></button>
            </div>
            <div class="edit-form" id="dob-form">
                <div class="form-group">
                    <input type="date" id="dob-input" value="{{ $data["ngaysinh"] ?? '1990-05-15' }}">
                </div>
                <button class="btn btn-primary btn-sm" onclick="saveChanges('dob')"><i class="bi bi-floppy"></i>
                    Lưu</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Email:</span>
                <span class="detail-value" id="email-value">{{ $data["email"] ?? '' }}</span>
                {{-- <button class="btn btn-primary btn-sm" onclick="toggleEditForm('email')"><i
                        class="bi bi-pen"></i></button> --}}
            </div>
            <div class="edit-form" id="email-form">
                <div class="form-group">
                    <input type="tel" id="email-input" value="{{ $data["email"] ?? '' }}">
                </div>
                <button class="btn btn-primary btn-sm" onclick="saveChanges('email')"><i class="bi bi-floppy"></i>
                    Lưu</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Số điện thoại:</span>
                <span class="detail-value" id="phone-value">{{ $data["sodt"] ?? '' }}</span>
                <button class="btn btn-primary btn-sm" onclick="toggleEditForm('phone')"><i class="bi bi-pen"></i></button>
            </div>
            <div class="edit-form" id="phone-form">
                <div class="form-group">
                    <input type="tel" id="phone-input" value="{{ $data["sodt"] ?? '' }}">
                </div>
                <button class="btn btn-primary btn-sm" onclick="saveChanges('phone')"><i class="bi bi-floppy"></i>
                    Lưu</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Địa chỉ:</span>
                <span class="detail-value" id="address-value">{{ $data["diachi"] ?? '' }}</span>
                <button class="btn btn-primary btn-sm" onclick="toggleEditForm('address')"><i
                        class="bi bi-pen"></i></button>
            </div>
            <div class="edit-form" id="address-form">
                <div class="input-group mb-3">
                    <div class="input-group mb-2">
                        <label class="w-100 text-dark" for="province">Tỉnh/Thành phố</label>
                        <select class="form-control" id="province" required></select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group mb-2">
                        <label class="w-100 text-dark" for="district">Quận/Huyện</label>
                        <select class="form-control" id="district" required></select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="input-group mb-3">
                        <label class="w-100 text-dark" for="ward">Phường/Xã</label>
                        <select class="form-control" id="ward" required></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="" for="address-input">Địa chỉ nhà</label>
                    <input type="hidden" id="full_address" name="full_address">
                    <textarea id="address-input" rows="3">{{ $data["diachi"] ?? 'Nhập số nhà' }}</textarea>
                </div>
                <button class="btn btn-primary btn-sm" onclick="saveChanges('address')"><i class="bi bi-floppy"></i>
                    Lưu</button>
            </div>
        </div>
    </div>
@endsection