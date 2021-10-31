<?php
/**
 * Bu controller dosyası cihazı simüle etme amaçlı oluşturulmuştur.
 */
require_once(CORE . "controller.php");

use App\Helper\{VehicleHelper,PositionHelper};
class VehicleCoreController extends Controller
{

    use VehicleHelper, PositionHelper;
    public function index()
    {

    }

    public function getCommand()
    {
        $commands = (json_decode(key($this->methodParams()))->commands);
        for($i = 0; $i < strlen($commands); $i++){
            $command = substr($commands,$i,1);
            if($command != "M"){
                $new_position = $this->turn($this->getVehiclePosition(),$command);
                $this->setVehiclePosition($new_position);
            }else{
                $new_coordinate = $this->coordinate($this->getVehiclePosition(),$this->getVehicleCoordinate());
                $this->setVehicleCoordinate($new_coordinate);
            }
        }
        $response = [
            'vehicle' =>[
                'name' => $this->getVehicleName(),
                'position' => [
                    $this->getVehicleCoordinate(),
                    'position' => $this->getVehiclePosition()
                ],
            ]
        ];

        echo json_encode($response);
    }
}