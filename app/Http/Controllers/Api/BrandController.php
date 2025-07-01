<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
    }

    public function topList(Request $request)
    {
        $country = $request->header('CF-IPCountry', 'XX');
        $threshold = (int) env('BRAND_MIN_RATING');

        $list = Brand::byCountryCode($country)
                 ->defaultBrandsList($threshold)
                 ->get();

        if ($list->isEmpty()) {
            $list = Brand::defaultBrandsList($threshold)->get();
        }
        //return view('test', ['brands' => $list, 'country' => $country, 'threshold' => $threshold]);
        return response()->json($list);
    }
}
