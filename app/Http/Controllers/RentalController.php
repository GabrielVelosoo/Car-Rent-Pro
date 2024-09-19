<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RentalRepository;
use App\Http\Requests\RentalRequest;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rentalRepository = new rentalRepository(new Rental());

        if($request->has('attributes_client')) {
            $attributes_client = explode(',', $request->get('attributes_client'));
            $attributes_client = 'client:id,' . implode(',', $attributes_client);
            $rentalRepository->selectAttributesRelatedRecords($attributes_client);
        }else {
            $rentalRepository->selectAttributesRelatedRecords(['client']);
        }

        if($request->has('attributes_car')) {
            $attributes_car = explode(',', $request->get('attributes_car'));
            $attributes_car = 'car:id,' . implode(',', $attributes_car);
            $rentalRepository->selectAttributesRelatedRecords($attributes_car);
        }else {
            $rentalRepository->selectAttributesRelatedRecords(['car']);
        }

        if($request->has('filter')) {
            $rentalRepository->filter($request->filter);          
        }

        if($request->has('attributes')) {
            $attributes = explode(',', $request->get('attributes'));
            $rentalRepository->selectAttributes($attributes);
        }

        return response()->json($rentalRepository->getResult(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RentalRequest $request)
    {
        $rental = Rental::create([
            'client_id' => $request->client_id,
            'car_id' => $request->car_id,
            'start_date_period' => $request->start_date_period,
            'expected_end_date_period' => $request->expected_end_date_period,
            'actual_end_date_period' => $request->actual_end_date_period,
            'daily_rate' => $request->daily_rate,
            'initial_km' => $request->initial_km,
            'final_km' => $request->final_km
        ]);

        return response()->json($rental, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rental = Rental::with('client', 'car')->find($id);

        if($rental === null) {
            return response()->json([
                'message' => 'The requested resource does not exist.'
            ], 404);
        }

        return response()->json($rental, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RentalRequest $request, $id)
    {
        $rental = Rental::find($id);

        if($rental === null) {
            return response()->json([
                'message' => 'Unable to update. The requested resource does not exist.'
            ], 404);
        }

        if($request->has('client_id')) {
            $rental->client_id = $request->client_id;
        }

        if($request->has('car_id')) {
            $rental->car_id = $request->car_id;
        }

        if($request->has('start_date_period')) {
            $rental->start_date_period = $request->start_date_period;
        }

        if($request->has('expected_end_date_period')) {
            $rental->expected_end_date_period = $request->expected_end_date_period;
        }

        if($request->has('actual_end_date_period')) {
            $rental->actual_end_date_period = $request->actual_end_date_period;
        }

        if($request->has('daily_rate')) {
            $rental->daily_rate = $request->daily_rate;
        }

        if($request->has('initial_km')) {
            $rental->initial_km = $request->initial_km;
        }

        if($request->has('final_km')) {
            $rental->final_km = $request->final_km;
        }

        $rental->save();

        return response()->json($rental, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rental = Rental::find($id);

        if($rental === null) {
            return response()->json([
                'message' => 'Unable to delete. The requested resource does not exist.'
            ], 404);
        }

        $rental->delete();

        return response()->json([
            'message' => 'Rental deleted.'
        ], 200);
    }
}
