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
                <button class="btn btn-primary btn-sm" onclick="toggleEditForm('email')"><i class="bi bi-pen"></i></button>
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
                <div class="form-group">
                    <textarea id="address-input"
                        rows="3">{{ $data["diachi"] ?? '123 Đường ABC, Quận XYZ, TP.HCM' }}</textarea>
                </div>
                <button class="btn btn-primary btn-sm" onclick="saveChanges('address')"><i class="bi bi-floppy"></i>
                    Lưu</button>
            </div>
        </div>
    </div>
@endsection