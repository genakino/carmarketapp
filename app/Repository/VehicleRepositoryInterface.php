<?php

namespace App\Repository;

interface VehicleRepositoryInterface {

    public function getAllVehicles();

    public function createVehicle(array $data);

    public function getVehicleById($id);

}

?>