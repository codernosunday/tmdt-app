<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hóa đơn mua hàng</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header img { width: 80px; }
        .header h1 { margin: 5px 0; font-size: 24px; }
        .info, .signatures { margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background: #f2f2f2; }
        .totals { margin-top: 10px; text-align: right; }
        .totals p { font-weight: bold; }
        .note { font-style: italic; font-size: 12px; margin-top: 30px; text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('logo.png') }}" alt="Logo">
        <h1>CỬA HÀNG SHOPEN</h1>
        <p>Địa chỉ: 123 Đường Lê Lợi, TP.HCM | Hotline: 0909 999 999</p>
    </div>

    <div class="info">
        <p><strong>Mã hóa đơn:</strong> {{ $data["donhang"]["madonhang"] }}</p>
        <p><strong>Ngày lập:</strong> {{ $data["donhang"]["created_at"] }}</p>
        <p><strong>Khách hàng:</strong> {{ $data["donhang"]["hoten"] }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá (VNĐ)</th>
                <th>Thành tiền (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data["chitietdonhang"] as $index => $item)
            <tr>
                <td>{{ $index+1 }}</td>
                <td style="text-align: left;">{{ $item['thongtinsp']['tensp'] }}</td>
                <td>{{ $item['soluong'] }}</td>
                <td>{{ number_format($item['thanhtien']) }}</td>
                <td>{{ number_format($item['soluong'] * $item['thanhtien']) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Tổng tiền: {{ number_format($data["tongtien"]) }} VNĐ</p>
    </div>

    <div class="note">
        <p>Cảm ơn quý khách và hẹn gặp lại!</p>
    </div>

</body>
</html>
