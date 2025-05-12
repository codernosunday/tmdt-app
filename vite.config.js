import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS files
                'resources/css/admin/layout-admin.css',
                'resources/css/auth/auth.css',
                'resources/css/home/partials-home/shopping-cart.css',
                'resources/css/home/home.css',
                'resources/css/navigation/navigation.css',
                'resources/css/app.css',
                'resources/css/custom.css',
                'resources/css/listsp.css',
                // SCSS files
                'resources/scss/admin.scss',
                'resources/scss/app.scss',
                'resources/scss/style.scss',
                'resources/scss/shop.scss',
                'resources/scss/danhgia.scss',
                'resources/scss/listsp.scss',
                'resources/scss/nguoidung.scss',
                'resources/scss/qlphivanchuyen.scss',
                'resources/scss/quanlydanhmuc.scss',
                'resources/scss/quanlysanpham.scss',
                'resources/scss/themsanphamadmin.scss',
                'resources/scss/theodoidonhang.scss',
                'resources/scss/thongke.scss',
                'resources/scss/trangsanpham.scss',
                'resources/scss/dathang.scss',
                'resources/scss/giohang.scss',
                'resources/scss/swiper-style.scss',

                // SCSS files in thongke directory
                'resources/scss/thongke/thongkenguoidung.scss',
                'resources/scss/thongke/thongkesanpham.scss',

                // JS files
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/plugins.js',
                'resources/js/script.js',
                'resources/js/shop.js',
                'resources/js/search.js',
                'resources/js/swiper-init.js',
                'resources/js/theodoiDH.js',
                'resources/js/nguoidung.js',

                // Admin JS files
                'resources/js/adminscript/adminpage.js',
                'resources/js/adminscript/mainQLDMC.js',
                'resources/js/adminscript/mainQLDMcon.js',
                'resources/js/adminscript/mainQLSP.js',
                'resources/js/adminscript/QLgianhap.js',
                'resources/js/adminscript/QLgiasale.js',
                'resources/js/adminscript/QLnhacungcap.js',
                'resources/js/adminscript/QLphivanchuyen.js',
                'resources/js/adminscript/qlsanpham.js',
                'resources/js/adminscript/themCTSPmoi.js',
                'resources/js/adminscript/thuoctinhSP.js',
                'resources/js/adminscript/updateSanpham.js',

                // Admin JS files in subdirectories
                'resources/js/adminscript/quanlydonhang/capnhattrangthaidonhang.js',
                'resources/js/adminscript/quanlynguoidung/capnhatnguoidung.js',
                'resources/js/adminscript/thongke/thongkedoanhthu.js',
                'resources/js/adminscript/thongke/thongkekhachhang.js',
                'resources/js/adminscript/thongke/thongkesanpham.js',

                // Cart JS files
                'resources/js/giohangscript/dathang.js',
                'resources/js/giohangscript/giohang.js',

                // Product list JS files
                'resources/js/listspscript/listsp.js',
                'resources/js/listspscript/sanpham.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': 'bootstrap',
        }
    },
    server: {
        cors: {
            origin: '*', // Hoặc chỉ định cụ thể origin nếu muốn bảo mật hơn
            methods: ['GET', 'POST', 'PUT', 'DELETE'],
        },
    },
}); 