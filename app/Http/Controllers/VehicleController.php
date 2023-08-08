<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Repository\VehicleRepositoryInterface;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    private $vehicleRepository;

    public function __construct(VehicleRepositoryInterface $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = $this->vehicleRepository->getAllVehicles();
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
            'name' => 'required|string',
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'gearbox' => 'required|string',
            'fuel_type' => 'required|string',
            'price' => 'required|integer',
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

        $vehicle = $this->vehicleRepository->createVehicle($data);

        return response()->json([
            'message' => 'Vehicle added successfully.',
            'vehicle' => $vehicle
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
        $vehicle = $this->vehicleRepository->getVehicleById($id);
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
            'name' => 'required|string',
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'gearbox' => 'required|string',
            'fuel_type' => 'required|string',
            'price' => 'required|integer',
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

        $vehicle = $this->vehicleRepository->updateVehicle($data['id'], $data);

        return response()->json([
            'message' => 'Vehicle updated successfully.',
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
            'message' => 'Vehicle deleted successfully.'
        ]);
    }
}
