<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brandRepository = new BrandRepository(new Brand());

        if($request->has('attributes_car_models')) {
            $attributes_car_models = explode(',', $request->get('attributes_car_models'));
            $attributes_car_models = 'carModels:id,brand_id,' . implode(',', $attributes_car_models);
            $brandRepository->selectAttributesRelatedRecords($attributes_car_models);
        }else {
            $brandRepository->selectAttributesRelatedRecords('carModels');
        }

        if($request->has('filter')) {
            $brandRepository->filter($request->filter);          
        }

        if($request->has('attributes')) {
            $attributes = explode(',', $request->get('attributes'));
            $brandRepository->selectAttributes($attributes);
        }

        return response()->json($brandRepository->getResult(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $brand_name = strtoupper($request->name);

        $brand_image = $request->file('image');
        $brand_image_urn = $brand_image->store('images', 'public');

        $brand = Brand::create([
            'name' => $brand_name,
            'image' => $brand_image_urn
        ]);

        return response()->json($brand, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Brand::with('carModels')->find($id);

        if($brand === null) {
            return response()->json([
                'message' => 'The requested resource does not exist.'
            ], 404);
        }

        return response()->json($brand, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);

        if($brand === null) {
            return response()->json([
                'message' => 'Unable to update. The requested resource does not exist.'
            ], 404);
        }

        if($request->has('name')) {
            $brand_name = strtoupper($request->name);
            $brand->name = $brand_name;
        }

        if($request->hasFile('image')) {
            Storage::disk('public')->delete($brand->image);

            $brand_image = $request->file('image');
            $brand_image_urn = $brand_image->store('images', 'public');
            
            $brand->image = $brand_image_urn;
        }

        $brand->save();

        return response()->json($brand, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if($brand === null) {
            return response()->json([
                'message' => 'Unable to delete. The requested resource does not exist.'
            ], 404);
        }

        Storage::disk('public')->delete($brand->image);

        $brand->delete();

        return response()->json([
            'message' => 'Brand deleted.'
        ], 200);
    }
}
