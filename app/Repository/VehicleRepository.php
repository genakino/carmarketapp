<?php

namespace App\Repository;

use App\Models\Vehicle;

class VehicleRepository implements VehicleRepositoryInterface {

    public function getAllVehicles()
    {
        return Vehicle::all();
    }

    public function createVehicle(array $data)
    {
        Vehicle::create([
            'name' => $data['name'],
            'make' => $data['make'],
            'model' => $data['model'],
            'year' => $data['year'],
            'gearbox' => $data['gearbox'],
            'fuel_type' => $data['fuel_type'],
            'image' => $data['image'],
            'price' => $data['price']
        ]);
    }

    public function getVehicleById($id)
    {
        return Vehicle::find($id);
    }

    public function updateVehicle($id, array $data)
    {
        Vehicle::find($id)->update([
            'name' => $data['name'],
            'make' => $data['make'],
            'model' => $data['model'],
            'year' => $data['year'],
            'gearbox' => $data['gearbox'],
            'fuel_type' => $data['fuel_type'],
            'image' => $data['image'],
            'price' => $data['price']
        ]);
    }

}

?>