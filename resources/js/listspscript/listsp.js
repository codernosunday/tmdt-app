// document.addEventListener("DOMContentLoaded", function () {
//     fetch(`/danhmuc/0`)
//         .then(response => response.text())
//         .then(html => {
//             document.getElementById('sanpham').innerHTML = html;
//         })
//         .catch(error => {
//             console.error('Lỗi:', error);
//         });
//     const selectBox = document.getElementById('Danhmuc');
//     selectBox.addEventListener('change', function () {
//         const selectedValue = selectBox.value;
//         fetch(`/danhmuc/${selectedValue}`)
//             .then(response => response.text())
//             .then(html => {
//                 document.getElementById('sanpham').innerHTML = html;
//             })
//             .catch(error => {
//                 console.error('Lỗi:', error);
//             });
//     });
// });
