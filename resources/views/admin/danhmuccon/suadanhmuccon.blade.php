<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h4 {
        text-align: center;
        color: #333;
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-weight: bold;
        margin-bottom: 6px;
        color: #333;
    }

    .form-control,
    .form-select,
    textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 15px;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus {
        border-color: #007bff;
        outline: none;
    }

    .btn-primary {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>


<div class="container mt-4">
    <h4 class="fw-bold">Thêm Mới Danh Mục Con</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm p-4 rounded border-0">
                <form id="addDanhmucConForm">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục con:</label>
                        <input type="text" class="form-control" id="themtendmc" name="tendmc" value="{{$dmcon->ten}}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Danh mục cha:</label>
                        <select class="form-select" id="themdmcha" name="dmcha" required>
                            @foreach ($dmcha as $cha)
                                @if($dmcon->id_dm == $cha->id_dm)
                                    <option value="{{ $cha->id_dm }}" selected>{{ $cha->tendanhmuc }}</option>
                                @else
                                    <option value="{{ $cha->id_dm }}">{{ $cha->tendanhmuc }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi chú:</label>
                        <textarea class="form-control" id="themghichu" name="ghichu"
                            rows="3">{{$dmcon->ghichu}}</textarea>
                    </div>

                    <button type="button" onclick="postThemDMC({{$dmcon->id_ctdm}})" class="btn btn-primary w-100">Chỉnh
                        sửa</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.postThemDMC = function (id) {
        const tendmc = document.getElementById("themtendmc").value.trim();
        const dmcha = document.getElementById("themdmcha").value;
        const ghichu = document.getElementById("themghichu").value.trim();

        if (!tendmc || !dmcha) {
            alert("Vui lòng nhập đầy đủ Tên danh mục con và chọn Danh mục cha.");
            return;
        }
        fetch(`/administrator/updatedmcon`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content"),
            },
            body: JSON.stringify({
                id_ctdm: id,
                ten: tendmc,
                id_dm: dmcha,
                ghichu: ghichu
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Chỉnh sửa danh mục con thành công!");
                    location.reload();
                } else {
                    alert("Lỗi: " + (data.message || "Không xác định"));
                }
            })
            .catch(error => {
                console.error("Lỗi gửi dữ liệu:", error);
                alert("Đã xảy ra lỗi khi gửi dữ liệu.");
            });
    }
</script>