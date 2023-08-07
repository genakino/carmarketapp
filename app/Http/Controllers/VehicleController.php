<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Repository\VehicleRepositoryInterface;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public $vehicle;

    public function __construct(VehicleRepositoryInterface $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vehicles = Vehicle::all(['id','name']);
        $vehicles = $this->vehicle->getAllVehicles();
        return response()->json($vehicles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $vehicle = Vehicle::create($request->post());
        // return response()->json([
        //     'message' => 'Vehicle added successfully!!!',
        //     'vehicle' => $vehicle
        // ]);
        $request->validate([
            'name' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'gearbox' => 'required',
            'fuel_type' => 'required',
            'image' => 'string',
            'price' => 'required'
        ]);

        $data = $request->all();

        //image upload
        if($image = $request->file('image')) {
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            $data['image'] = "$name";
        }

        $this->vehicle->createVehicle($data);

        return response()->json([
            'message' => 'Vehicle added successfully!!!',
            'vehicle' => $this->vehicle
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = $this->vehicle->getVehicleById($id);

        return response()->json($vehicle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $vehicle->fill($request->post())->save();
        return response()->json([
            'message' => 'Vehicle pdated successfully!!!',
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->json([
            'message' => 'Vehicle deleted successfully!!!'
        ]);
    }
}
