<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        $product = Product::findOrFail($productId);

        $comment = new Comment();
        $comment->id_sp = $product->id;
        $comment->id_nd = Auth::id();
        $comment->id_ctsp = $request->id_ctsp ?? null; // Nếu có chi tiết sản phẩm
        $comment->sosao = $request->rating;
        $comment->danhgia = 'Đánh giá từ người dùng'; // Có thể tùy chỉnh
        $comment->noidungbinhluan = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Bình luận của bạn đã được gửi.');
    }

    public function like($commentId)
    {
        // Bảng binhluan không có cột likes, nên cần thêm nếu muốn hỗ trợ
        // Hoặc bạn có thể tạo bảng riêng để lưu lượt thích
        return redirect()->back();
    }

    public function dislike($commentId)
    {
        // Bảng binhluan không có cột dislikes, nên cần thêm nếu muốn hỗ trợ
        // Hoặc bạn có thể tạo bảng riêng để lưu lượt không thích
        return redirect()->back();
    }

    public function login()
    {
        return view('login'); // Chuyển hướng đến trang đăng nhập
    }
    public function register()
    {
        return view('register'); // Chuyển hướng đến trang đăng ký
    }
}