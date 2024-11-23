<?php
use App\Models\Vehicle;
include_once '../models/Veiculo.php';
include_once '../models/Imagem.php';
include_once '../app/config.php';

class VehicleController {
    private $vehicleModel;
    private $imageModel;

    public function __construct($conn) {
        $this->vehicleModel = new Vehicle($conn);
        $this->imageModel = new Image($conn);
    }

    // Método que chama a View com informações do veículo
    public function showVehicle($id_veiculo) {
        $vehicleInfo = $this->vehicleModel->getVehicleInfo($id_veiculo);
        $vehicleImages = $this->imageModel->getVehicleImages($id_veiculo);

        if ($vehicleInfo && $vehicleImages) {
            include '../views/vehicle_info.php';
        } else {
            include '../views/vehicle_error.php';
        }
    }
}
?>
