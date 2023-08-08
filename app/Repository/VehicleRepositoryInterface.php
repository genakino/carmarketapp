<?php

namespace App\Repository;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

interface VehicleRepositoryInterface {

    public function getAllVehicles(): Collection;

    public function createVehicle(array $data);

    public function getVehicleById($id): Vehicle;

    public function updateVehicle($id, array $data);

}

?>