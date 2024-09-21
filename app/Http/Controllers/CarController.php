<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CarRepository;
use App\Http\Requests\CarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carRepository = new CarRepository(new Car());

        if($request->has('attributes_car_model')) {
            $attributes_car_model = explode(',', $request->get('attributes_car_model'));
            $attributes_car_model = 'carModel:id,brand_id,' . implode(',', $attributes_car_model);
            $carRepository->selectAttributesRelatedRecords($attributes_car_model);
        }else {
            $carRepository->selectAttributesRelatedRecords('carModel');
        }

        if($request->has('attributes_rental')) {
            $attributes_rental = explode(',', $request->get('attributes_rental'));
            $attributes_rental = 'rental:id,client_id,car_id,' . implode(',', $attributes_rental);
            $carRepository->selectAttributesRelatedRecords($attributes_rental);
        }else {
            $carRepository->selectAttributesRelatedRecords('rental');
        }

        if($request->has('filter')) {
            $carRepository->filter($request->filter);          
        }

        if($request->has('attributes')) {
            $attributes = explode(',', $request->get('attributes'));
            $carRepository->selectAttributes($attributes);
        }

        return response()->json($carRepository->getResult(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        $car = Car::create([
            'rental_id' => $request->rental_id,
            'car_model_id' => $request->car_model_id,
            'car_plate' => $request->car_plate,
            'available' => $request->available,
            'km' => $request->km
        ]);

        return response()->json($car, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::with('carModel', 'rental')->find($id);

        if($car === null) {
            return response()->json([
                'message' => 'The requested resource does not exist.'
            ], 404);
        }

        return response()->json($car, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, $id)
    {
        $car = Car::find($id);

        if($car === null) {
            return response()->json([
                'message' => 'Unable to update. The requested resource does not exist.'
            ], 404);
        }

        if($request->has('rental_id')) {
            $car->rental_id = $request->rental_id;
        }

        if($request->has('car_model_id')) {
            $car->car_model_id = $request->car_model_id;
        }

        if($request->has('car_plate')) {
            $car->car_plate = $request->car_plate;
        }

        if($request->has('available')) {
            $car->available = $request->available;
        }

        if($request->has('km')) {
            $car->km = $request->km;
        }

        $car->save();

        return response()->json($car, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car = Car::find($id);

        if($car === null) {
            return response()->json([
                'message' => 'Unable to delete. The requested resource does not exist.'
            ], 404);
        }

        $car->delete();

        return response()->json([
            'message' => 'Car deleted.'
        ], 200);
    }
}
