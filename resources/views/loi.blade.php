<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 text-danger">404</h1>
        <p class="lead">Xin lỗi, trang bạn tìm không tồn tại.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">
            <i class="bi bi-house-door"></i> Về trang chủ
        </a>
    </div>
</body>