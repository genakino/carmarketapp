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
        $vehicles = $this->vehicle->getAllVehicles();
        return response()->json($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'gearbox' => 'required',
            'fuel_type' => 'required',
            'price' => 'required',
            'image' => 'required|file|image'
        ]);

        $data = $request->all();

        //image upload
        if(request()->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            $data['image'] = $name;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'make' => 'required',
            'model' => 'required',
            'year' => 'required',
            'gearbox' => 'required',
            'fuel_type' => 'required',
            'price' => 'required',
            'image' => 'required'
        ]);

        $data = $request->all();

        //image upload
        if(request()->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images'), $name);
            $data['image'] = $name;
        }

        $this->vehicle->updateVehicle($data['id'], $data);

        return response()->json([
            'message' => 'Vehicle updated successfully!!!',
            'vehicle' => $this->vehicle
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
