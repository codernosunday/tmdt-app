<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\SanphamModel;
use App\Models\ChitietsanphamModel;
use App\Models\giabanModel;
use App\Models\gianhapModel;
use App\Models\DanhmucconModel;
use App\Models\nhacungcapModel;
use App\Models\ThuoctinhspModel;
use Illuminate\Support\Facades\Storage;

class QLsanphamController extends Controller
{
    function pagesQLsanpham()
    {
        $sp = SanphamModel::all();
        $danhmucs = DanhmucconModel::all();
        // $ncc = nhacungcapModel::all();
        return view('admin.quanlysanpham', compact('sp', 'danhmucs'));
    }
    function bangsanpham($id)
    {
        $ncc = nhacungcapModel::all();
        if ($id == 'all') {
            $sp = SanphamModel::paginate(20);
        } else {
            $sp = SanphamModel::where('id_ctdm', $id)->paginate(20);
        }
        return view('admin.bangsanpham', compact('sp', 'ncc'));
    }
    //loc san pham
    function loctrangthai(Request $request)
    {
        $id_ctdm = $request->input('danhmuc');
        $trangthai = $request->input('trangthai');
        if ($id_ctdm  == 'all' && $trangthai != 'all') {
            $sp = SanphamModel::where('trangthai', $trangthai)->paginate(20);
        } else {
            $sp = SanphamModel::where('id_ctdm', $id_ctdm)
                ->when($trangthai !== 'all', function ($query) use ($trangthai) {
                    return $query->where('trangthai', $trangthai);
                })
                ->paginate(20);
        }
        return view('admin.bangsanpham', compact('sp'));
    }
    function loctheoten(Request $request)
    {
        $ten = $request->input('timkiem');
        $id_ctdm = $request->input('danhmuc');
        $trangthai = $request->input('trangthai');

        if ($id_ctdm === 'all' && $trangthai !== 'all') {
            $sp = SanphamModel::where('trangthai', $trangthai)
                ->when($ten, function ($query) use ($ten) {
                    return $query->where('tensp', 'like', '%' . $ten . '%');
                })
                ->paginate(20);
        } else {
            $sp = SanphamModel::when($id_ctdm !== 'all', function ($query) use ($id_ctdm) {
                return $query->where('id_ctdm', $id_ctdm);
            })
                ->when($trangthai !== 'all', function ($query) use ($trangthai) {
                    return $query->where('trangthai', $trangthai);
                })
                ->when($ten, function ($query) use ($ten) {
                    return $query->where('tensp', 'like', '%' . $ten . '%');
                })
                ->paginate(20);
        }

        return view('admin.bangsanpham', compact('sp'));
    }
    function pagesQLchitietsanpham($id_sp)
    {
        $danhmuccon = DanhmucconModel::all();
        $sp = SanphamModel::where('id_sp', $id_sp)->first();
        $ctsp = ChitietsanphamModel::where('id_sp', $id_sp)->get();
        $thuoctinh = ThuoctinhspModel::all();
        $firstCtsp = $ctsp->first();
        $ban = giabanModel::where('id_ctsp', $firstCtsp->id_ctsp)->first();
        $nhap = gianhapModel::where('id_ctsp', $firstCtsp->id_ctsp)->first();
        $data = [
            "id_sp" => $sp->id_sp,
            "tensp" => $sp->tensp,
            "danhmuc" => $sp->id_ctdm,
            "anhsp" => $sp->anhbase64,
            "linkanh" => $sp->anh,
            "tomtat" => $sp->tomtatsp,
            "tinhtrang" => $sp->tinhtrang,
            "trangthai" => $sp->trangthai,
            "thuonghieu" => $firstCtsp->thuonghieu,
            "xuatxu" => $firstCtsp->xuatsu,
            "sanxuat" => $firstCtsp->sanxuat,
            "khuyencao" => $firstCtsp->dattinh,
            "tinhnangnoibat" => $firstCtsp->tinhnangnoibat,
            "loiich" => $firstCtsp->loiich,
            "kichthuoc" => $firstCtsp->kichthuoc,
            "doday" => $firstCtsp->doday,
            "trongluong" => $firstCtsp->trongluong,
            "tieuchuan" => $firstCtsp->tieuchuan,
            "sotrang" => $firstCtsp->sotrang,
            "ttinh" => $firstCtsp->id_thuoctinh,
            "giaban" => $ban->giaban,
            "gianhap" => $nhap ? $nhap->gianhap : null,
            "soluong" => $firstCtsp->soluong,
        ];
        return view('admin.chitietsanpham', compact('data', 'ctsp', 'danhmuccon', 'thuoctinh'));
    }

    public function postcapnhatsanpham(Request $request)
    {
        try {
            // Validate dữ liệu đầu vào
            $validated = $request->validate([
                'danhmuc' => 'required|integer',
                'id_sp' => 'required|exists:sanpham,id_sp',
                'id_ctsp' => 'required|exists:chitietsanpham,id_ctsp',
                'tensp' => 'required|string|max:255',
                'anh' => 'nullable|string|max:255',
                'tomtatsp' => 'nullable|string',
                'tinhtrang' => 'nullable|boolean',
                'gianhap' => 'nullable|numeric|min:0',
                'soluong' => 'nullable|integer|min:0',
                'giaban' => 'nullable|numeric|min:0',
                'tieuchuan' => 'nullable|string',
                'loiich' => 'nullable|string',
                'sanxuat' => 'nullable|string',
                'xuatsu' => 'nullable|string',
                'tinhnang' => 'nullable|string',
                'kichthuoc' => 'nullable|string',
                'fileanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'trangthai' => 'nullable|string'
            ]);

            DB::beginTransaction();

            // Tìm sản phẩm
            $sanpham = SanphamModel::find($validated['id_sp']);

            if (!$sanpham) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại!',
                    'errors' => ['id_sp' => 'ID sản phẩm không hợp lệ.']
                ], 404);
            }

            // Xử lý ảnh nếu có
            if ($request->file('fileanh')) {
                $image = $request->file('fileanh');
                $path = $image->store('uploads', 'public');
            } else {
                $path = $sanpham->anhbase64; // giữ ảnh cũ
            }

            // Cập nhật sản phẩm chính
            $sanpham->update([
                'id_ctdm' => $validated['danhmuc'],
                'tensp' => $validated['tensp'],
                'anh' => $validated['anh'] ?? $sanpham->anh,
                'tomtatsp' => $validated['tomtatsp'],
                'trangthai' => $validated['trangthai'],
                'tinhtrang' => $validated['tinhtrang'],
                'anhbase64' => $path
            ]);

            // Cập nhật chi tiết sản phẩm
            $chitiet = ChitietsanphamModel::find($validated['id_ctsp']);
            if ($chitiet) {
                $chitiet->update([
                    'id_thuoctinh' => $request->input('thuoctinh'),
                    'doday' => $request->input('doday'),
                    'soluong' => $validated['soluong'] ?? 0,
                    'sotrang' => $request->input('sotrang'),
                    'thuonghieu' => $request->input('thuonghieu'),
                    'anhsp' => $path,
                    'mausac' => $request->input('mausac'),
                    'mamau' => $request->input('mamau'),
                    'dattinh' => $request->input('dattinh'),
                    'tieuchuan' => $validated['tieuchuan'],
                    'loiich' => $validated['loiich'],
                    'xuatsu' => $validated['xuatsu'],
                    'sanxuat' => $validated['sanxuat'],
                    'tinhnangnoibat' => $validated['tinhnang'],
                    'kichthuoc' => $validated['kichthuoc'],
                ]);
            }
            // gianhapModel::updateOrCreate(
            //     ['id_ctsp' => $validated['id_ctsp']],
            //     [
            //         'gianhap' => $validated['gianhap'] ?? null,
            //         'soluong' => $validated['soluong'] ?? null
            //     ]
            // );
            giabanModel::updateOrCreate(
                ['id_ctsp' => $validated['id_ctsp']],
                ['giaban' => $validated['giaban'] ?? null]
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm được cập nhật thành công!',
                'data' => $sanpham
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi xác thực dữ liệu!',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi truy vấn database!',
                'errors' => ['database' => $e->getMessage()]
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống!',
                'errors' => ['system' => config('app.debug') ? $e->getMessage() : 'Có lỗi xảy ra, vui lòng thử lại.']
            ], 500);
        }
    }


    function pagesthemsanpham()
    {
        $danhmuccon = DanhmucconModel::all();
        $thuoctinh = ThuoctinhspModel::all();
        return view('admin.themsanpham', compact('danhmuccon', 'thuoctinh'));
    }
    function postthemsanpham(Request $request)
    {
        $validated = $request->validate([
            'danhmuc' => 'required|integer',
            'tensp' => 'required|string|max:255',
            'anh' => 'nullable|string|max:255',
            'tomtatsp' => 'nullable|string',
            'tinhtrang' => 'nullable|boolean',
            'gianhap' => 'nullable|numeric|min:0',
            'soluong' => 'nullable|integer|min:0',
            'giaban' => 'nullable|numeric|min:0',
            'kichthuoc' => 'nullable|string',
            'sanxuat' => 'nullable|string',
            'tieuchuan' => 'nullable|string',
            'loiich' => 'nullable|string',
            'xuatsu' => 'nullable|string',
            'tinhnang' => 'nullable|string',
            'fileanh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        DB::beginTransaction();
        try {
            if ($request->file('fileanh')) {
                $image = $request->file('fileanh');
                $path = $image->store('uploads', 'public');
            } else {
                $path = '';
            }
            $sanpham = SanphamModel::create([
                'id_ctdm' => $validated['danhmuc'],
                'tensp' => $validated['tensp'],
                'anh' => $validated['anh'],
                'anhbase64' => $path,
                'tomtatsp' => $validated['tomtatsp'],
                'tinhtrang' => $validated['tinhtrang'],
                'trangthai' => "conhang"
            ]);
            $id_sp = $sanpham->id_sp;
            $ctsp = ChitietsanphamModel::create([
                'id_sp' => $id_sp,
                'id_thuoctinh' => $request->input('thuoctinh'),
                'doday' => $request->input('doday'),
                // 'soluong' => $request->input('soluong'),
                'sotrang' => $request->input('sotrang'),
                'thuonghieu' => $request->input('thuonghieu'),
                'anhsp' => $request->input('anh'),
                'dattinh' => $request->input('mamau'),
                'sanxuat' => $validated['sanxuat'],
                'tieuchuan' => $validated['tieuchuan'],
                'loiich' => $validated['loiich'],
                'kichthuoc' => $validated['kichthuoc'],
                'xuatsu' => $validated['xuatsu'],
                'tinhnangnoibat' => $validated['tinhnang']
            ]);
            $id_ctsp = $ctsp->id_ctsp;
            // gianhapModel::create([
            //     'id_ctsp' => $id_ctsp,
            //     'id_sp' => $id_sp,
            //     'gianhap' => $request->input('gianhap'),
            //     'soluong' => $request->input('soluong')
            // ]);
            giabanModel::create([
                'id_ctsp' => $id_ctsp,
                'id_sp' => $id_sp,
                'giaban' => $request->input('giaban')
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Sản phẩm được thêm thành công!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    function deleteSP($id)
    {
        try {
            $sanpham = SanphamModel::find($id);
            if ($sanpham) {
                if ($sanpham->anhbase64 && Storage::exists('public/' . $sanpham->anhbase64)) {
                    Storage::delete('public/' . $sanpham->anhbase64);
                }
                $sanpham->delete();
            }
            return response()->json([
                'message' => 'Sản phẩm đã được xoá',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e,
            ], 500);
        }
    }
    //thêm chi tiết sản phẩm
    function chiTietSanPham($id_sp)
    {
        $sp = sanphamModel::where('id_sp', $id_sp)->first();
        $thuoctinh = ThuoctinhspModel::all();
        $danhmuccon = DanhmucconModel::all();
        $sp = SanphamModel::where('id_sp', $id_sp)->first();
        $ctsp = ChitietsanphamModel::where('id_sp', $id_sp)->get();
        $thuoctinh = ThuoctinhspModel::all();
        $firstCtsp = $ctsp->first();
        $ban = giabanModel::where('id_ctsp', $firstCtsp->id_ctsp)->first();
        $nhap = gianhapModel::where('id_ctsp', $firstCtsp->id_ctsp)->first();
        $data = [
            "id_sp" => $sp->id_sp,
            "tensp" => $sp->tensp,
            "danhmuc" => $sp->id_ctdm,
            "anhsp" => $sp->anhbase64,
            "linkanh" => $sp->anh,
            "tomtat" => $sp->tomtatsp,
            "tinhtrang" => $sp->tinhtrang,
            "trangthai" => $sp->trangthai,
            "thuonghieu" => $firstCtsp->thuonghieu,
            "xuatxu" => $firstCtsp->xuatsu,
            "sanxuat" => $firstCtsp->sanxuat,
            "khuyencao" => $firstCtsp->dattinh,
            "tinhnangnoibat" => $firstCtsp->tinhnangnoibat,
            "loiich" => $firstCtsp->loiich,
            "kichthuoc" => $firstCtsp->kichthuoc,
            "doday" => $firstCtsp->doday,
            "trongluong" => $firstCtsp->trongluong,
            "tieuchuan" => $firstCtsp->tieuchuan,
            "sotrang" => $firstCtsp->sotrang,
            "ttinh" => $firstCtsp->id_thuoctinh,
            "giaban" => $ban->giaban,
            "gianhap" => $nhap->gianhap,
            "soluong" => $nhap->soluong,
        ];
        return view('admin.themchitietsanpham', compact('data', 'ctsp', 'danhmuccon', 'thuoctinh'));
    }
    function PostThemchiTietSanPham(Request $request)
    {
        DB::beginTransaction();
        try {
            $ctsp = ChitietsanphamModel::create([
                'id_sp' => $request->input('id_sp'),
                'id_thuoctinh' => $request->input('thuoctinh'),
                'doday' => $request->input('doday'),
                'soluong' => $request->input('soluong'),
                'sotrang' => $request->input('sotrang'),
                'thuonghieu' => $request->input('thuonghieu'),
                'sanxuat' => $request->input('sanxuat'),
                'tieuchuan' => $request->input('tieuchuan'),
                'loiich' => $request->input('loiich'),
                'kichthuoc' => $request->input('kichthuoc'),
                'xuatsu' => $request->input('xuatsu'),
                'tinhnangnoibat' => $request->input('tinhnang'),
                'dattinh' => $request->input('dattinh')
            ]);
            $id_ctsp = $ctsp->id_ctsp;
            // gianhapModel::create([
            //     'id_ctsp' => $id_ctsp,
            //     'gianhap' => $request->input('gianhap'),
            //     'soluong' => $request->input('soluong')
            // ]);
            giabanModel::create([
                'id_ctsp' => $id_ctsp,
                'giaban' => $request->input('giaban')
            ]);
            DB::commit();
            return response()->json([
                'message' => 'Sản phẩm được thêm thành công!',
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getchietSP($id)
    {
        $ctsp = ChitietsanphamModel::find($id);
        if (!$ctsp) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy chi tiết sản phẩm'
            ], 404);
        }

        $giaban = giabanModel::where('id_ctsp', $id)->first();
        $gianhap = gianhapModel::where('id_ctsp', $id)->first();
        $mau = ThuoctinhspModel::find($ctsp->id_thuoctinh);

        return response()->json([
            'status' => true,
            'giaban' => $giaban->giaban ?? null,
            'gianhap' => $gianhap->gianhap ?? null,
            'soluong' => $ctsp->soluong ?? null,
            'mau' => $mau->giatri ?? $ctsp->id_thuoctinh
        ], 200);
    }
}
