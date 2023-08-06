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
            'mileage' => $data['mileage'],
            'gearbox' => $data['gearbox'],
            'fuel_type' => $data['fuel_type'],
            'color' => $data['color'],
            'image' => $data['image']
        ]);
    }

    public function getVehicleById($id)
    {
        return Vehicle::find($id);
    }

}

?>