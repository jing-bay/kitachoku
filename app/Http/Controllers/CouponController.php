<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;

class CouponController extends Controller
{
    public function store(CouponRequest $request)
    {
        $form = $request->all();
        Coupon::create($form);

        return back();
    }

    public function destroy($coupon_id)
    {
        Coupon::find($coupon_id)->delete();

        return back();
    }
}
