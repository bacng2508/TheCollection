<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request) {
        $this->authorize('list-coupon');
        $coupons = Coupon::query()
            ->searchCoupon($request)
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create() {
        $this->authorize('add-coupon');
        return view('admin.coupons.create');
    }

    public function store(Request $request) {
        $this->authorize('add-coupon');
        $request->validate(
            [
                'name' => 'required|unique:coupons,name',
                'value' => 'required|numeric',
                'expire_date' => 'required|date',
            ],
            [
                'name.required' => 'Không được để trống tên coupon',
                'name.unique' => 'Tên coupon đã tồn tại',
                'value.required' => 'Không được để trống giá trị',
                'value.numeric' => 'Giá trị phải là số',
                'expire_date.required' => 'Phải lựa chọn ngày hết hạn',
                'expire_date.date' => 'Ngày hết hạng phải có định dạng ngày',
            ]
        );

        Coupon::create([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
            'expire_date' => $request->input('expire_date'),
        ]);

        return redirect()->route('admin.coupons.index')->with('msg', 'Thêm coupon thành công');
    }

    public function edit(Coupon $coupon) {
        $this->authorize('edit-coupon');
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon) {
        $this->authorize('edit-coupon');
        $request->validate(
            [
                'name' => "required|unique:coupons,name,$coupon->id",
                'value' => 'required|numeric',
                'expire_date' => 'required|date',
            ],
            [
                'name.required' => 'Không được để trống tên coupon',
                'name.unique' => 'Tên coupon đã tồn tại',
                'value.required' => 'Không được để trống giá trị',
                'value.numeric' => 'Giá trị phải là số',
                'expire_date.required' => 'Phải lựa chọn ngày hết hạn',
                'expire_date.date' => 'Ngày hết hạng phải có định dạng ngày',
            ]
        );

        $coupon->update([
            'name' => $request->input('name'),
            'value' => $request->input('value'),
            'expire_date' => $request->input('expire_date'),
        ]);

        return back()->with('msg', 'Cập nhật coupon thành công');
    }

    public function destroy(Coupon $coupon) {
        $this->authorize('delete-coupon');
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('msg', 'Xóa coupon thành công');
    }
}
