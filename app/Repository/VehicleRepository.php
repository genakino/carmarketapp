<?php

namespace App\Repository;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository implements VehicleRepositoryInterface {

    public function getAllVehicles(): Collection
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

    public function getVehicleById($id): Vehicle
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