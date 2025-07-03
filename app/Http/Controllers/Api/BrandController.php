<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BrandService $service)
    {
        // test http://localhost:8088/api/brands?search=and&per_page=15
        $filters = $request->only(['search']);
        $perPage = (int) $request->query('per_page', 10);

        return response()->json(
            $service->listBrandsWithFilters($filters, $perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request, BrandService $service)
    {
        try {
        $brand = $service->createBrand($request->validated());
            return response()->json([
                'message' => 'Brand created successfully.',
                'data' => $brand
            ], 201);
        } catch (\Throwable $e) {
            \Log::error('Failed to create brand', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Failed to create brand.',
                'error' => app()->environment('production') ? null : $e->getMessage(),
            ], 500);
        }
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
    public function update(UpdateBrandRequest $request, Brand $brand, BrandService $service)
    {
        try {
            $updated = $service->updateBrand($brand, $request->validated());

            if (!$updated) {
                return response()->json(['message' => 'Brand update failed'], 400);
            }

            return response()->json([
                'message' => 'Brand updated successfully',
                'data' => $updated
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $brandId, BrandService $service)
    {
        try {
            $deleted = $service->deleteBrand($brandId);

            if (!$deleted) {
                return response()->json(['message' => 'Brand not found or already deleted'], 404);
            }

            return response()->json(['message' => 'Brand soft deleted']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Deletion failed', 'error' => $e->getMessage()], 500);
        }
    }


    public function topList(Request $request, BrandService $service)
    {
        $country = $request->header('CF-IPCountry', 'XX');
        $threshold = (int) env('BRAND_MIN_RATING');

        $list = $service->topList($country, $threshold);
        return response()->json($list);
    }
}
