function loadDanhMucCon(page) {
    $.ajax({
        url: "/admin/danhmuccon?page=" + page,
        type: "GET",
        success: function (data) {
            $("#dmcon-container").html(data);
        },
        error: function () {
            alert("Lỗi khi tải dữ liệu.");
        }
    });
}

$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    let page = $(this).attr('href').split('page=')[1];
    loadDanhMucCon(page);
});