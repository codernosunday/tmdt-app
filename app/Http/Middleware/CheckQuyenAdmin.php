<?php

namespace App\Http\Middleware;

use App\Models\NguoidungModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckQuyenAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = session('id'); // Lấy id người dùng từ session
        if (!$userId) {
            return redirect('/login')->with('error', 'Bạn cần đăng nhập.');
        }

        $user = NguoidungModel::where('id_nd', $userId)->first();
        $quyen = $user->quyentruycap;

        if ($quyen != 'staff' && $quyen != 'admin') {
            abort(404, 'Not Found');
        }

        // Nếu hợp lệ thì cho đi tiếp
        return $next($request);
    }
}
