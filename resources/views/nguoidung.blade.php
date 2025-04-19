@vite(['resources/scss/nguoidung.scss'])
@extends('layouts.app')
@section('content')
@section('title', 'Trang người dùng')
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <div class="profile-name" id="display-name">{{ $user->name ?? 'Nguyễn Văn A' }}</div>
        </div>

        <div class="profile-details">
            <div class="detail-item">
                <span class="detail-label">Họ và tên:</span>
                <span class="detail-value" id="name-value">{{ $user->name ?? 'Nguyễn Văn A' }}</span>
                <button class="edit-btn" onclick="toggleEditForm('name')">Chỉnh sửa</button>
            </div>
            <div class="edit-form" id="name-form">
                <div class="form-group">
                    <label for="name-input">Họ và tên:</label>
                    <input type="text" id="name-input" value="{{ $user->name ?? 'Nguyễn Văn A' }}">
                </div>
                <button class="save-btn" onclick="saveChanges('name')">Lưu thay đổi</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Ngày sinh:</span>
                <span class="detail-value"
                    id="dob-value">{{ $user->dob ? date('d/m/Y', strtotime($user->dob)) : '15/05/1990' }}</span>
                <button class="edit-btn" onclick="toggleEditForm('dob')">Chỉnh sửa</button>
            </div>
            <div class="edit-form" id="dob-form">
                <div class="form-group">
                    <label for="dob-input">Ngày sinh:</label>
                    <input type="date" id="dob-input" value="{{ $user->dob ?? '1990-05-15' }}">
                </div>
                <button class="save-btn" onclick="saveChanges('dob')">Lưu thay đổi</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Số điện thoại:</span>
                <span class="detail-value" id="phone-value">{{ $user->phone ?? '0987654321' }}</span>
                <button class="edit-btn" onclick="toggleEditForm('phone')">Chỉnh sửa</button>
            </div>
            <div class="edit-form" id="phone-form">
                <div class="form-group">
                    <label for="phone-input">Số điện thoại:</label>
                    <input type="tel" id="phone-input" value="{{ $user->phone ?? '0987654321' }}">
                </div>
                <button class="save-btn" onclick="saveChanges('phone')">Lưu thay đổi</button>
            </div>

            <div class="detail-item">
                <span class="detail-label">Địa chỉ:</span>
                <span class="detail-value"
                    id="address-value">{{ $user->address ?? '123 Đường ABC, Quận XYZ, TP.HCM' }}</span>
                <button class="edit-btn" onclick="toggleEditForm('address')">Chỉnh sửa</button>
            </div>
            <div class="edit-form" id="address-form">
                <div class="form-group">
                    <label for="address-input">Địa chỉ:</label>
                    <textarea id="address-input"
                        rows="3">{{ $user->address ?? '123 Đường ABC, Quận XYZ, TP.HCM' }}</textarea>
                </div>
                <button class="save-btn" onclick="saveChanges('address')">Lưu thay đổi</button>
            </div>
        </div>
    </div>
@endsection