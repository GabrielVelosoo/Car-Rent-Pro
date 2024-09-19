<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Http\Requests\CarModelRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\CarModelRepository;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carModelRepository = new CarModelRepository(new CarModel());

        if($request->has('attributes_brand')) {
            $attributes_brand = explode(',', $request->get('attributes_brand'));
            $attributes_brand = 'brand:id,' . implode(',', $attributes_brand);
            $carModelRepository->selectAttributesRelatedRecords($attributes_brand);
        }else {
            $carModelRepository->selectAttributesRelatedRecords('brand');
        }

        if($request->has('filter')) {
            $carModelRepository->filter($request->filter);          
        }

        if($request->has('attributes')) {
            $attributes = explode(',', $request->get('attributes'));
            $carModelRepository->selectAttributes($attributes);
        }

        return response()->json($carModelRepository->getResult(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarModelRequest $request)
    {
        $carModelName = strtoupper($request->name);

        $carModelImage = $request->file('image');
        $carModelImageURN = $carModelImage->store('images/car_models', 'public');

        $carModel = CarModel::create([
            'brand_id' => $request->brand_id,
            'name' => $carModelName,
            'image' => $carModelImageURN,
            'number_ports' => $request->number_ports,
            'places' => $request->places,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs
        ]);

        return response()->json($carModel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $carModel = CarModel::with('brand')->find($id);

        if($carModel === null) {
            return response()->json([
                'message' => 'The requested resource does not exist.'
            ], 404);
        }

        return response()->json($carModel, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarModelRequest $request, $id)
    {
        $carModel = CarModel::find($id);

        if($carModel === null) {
            return response()->json([
                'message' => 'Unable to update. The requested resource does not exist.'
            ], 404);
        }

        if($request->has('brand_id')) {
            $carModel->brand_id = $request->brand_id;
        }

        if($request->has('name')) {
            $carModelName = strtoupper($request->name);
            $carModel->name = $carModelName;
        }

        if($request->hasFile('image')) {
            Storage::disk('public')->delete($carModel->image);

            $carModelImage = $request->file('image');
            $carModelImageURN = $carModelImage->store('images/car_models', 'public');
            
            $carModel->image = $carModelImageURN;
        }

        if($request->has('number_ports')) {
            $carModel->number_ports = $request->number_ports;
        }

        if($request->has('places')) {
            $carModel->places = $request->places;
        }

        if($request->has('air_bag')) {
            $carModel->air_bag = $request->air_bag;
        }

        if($request->has('abs')) {
            $carModel->abs = $request->abs;
        }

        $carModel->save();

        return response()->json($carModel, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carModel = CarModel::find($id);

        if($carModel === null) {
            return response()->json([
                'message' => 'Unable to delete. The requested resource does not exist.'
            ], 404);
        }

        Storage::disk('public')->delete($carModel->image);

        $carModel->delete();

        return response()->json([
            'message' => 'Car Model deleted.'
        ], 200);
    }
}
