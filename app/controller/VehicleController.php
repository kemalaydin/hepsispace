<?php
require_once(CORE . "controller.php");

use App\Helper\VehicleHelper;
class VehicleController extends Controller
{
    use VehicleHelper;

    public function start()
    {
        if($this->isMethod('POST')){
            $this->setVehiclePosition($this->methodParams()["start_position"]);
            $this->setVehicleCoordinate(['x' => $this->methodParams()["x_coordinate"], 'y' => $this->methodParams()["y_coordinate"]]);
            $_SESSION['vehicle_name'] = $this->getVehicleName();
            $_SESSION['vehicle_coordinate'] = $this->getVehicleCoordinate();
            $_SESSION['vehicle_position'] = $this->getVehiclePosition();
            $_SESSION['last_vehicle_coordinate'] = $this->getVehicleCoordinate();
            $_SESSION['last_vehicle_position'] = $this->getVehiclePosition();
            $_SESSION['start_vehicle'] = 1;
            $this->redirect('/');
        }else{
            echo "404";
        }
    }

    public function reset()
    {
        unset($_SESSION['start_vehicle']);
        unset($_SESSION['vehicle_coordinate']);
        unset($_SESSION['vehicle_position']);
        unset($_SESSION['vehicle_name']);
        $this->redirect('/');
    }

    public function sendCommand()
    {
        if($this->isMethod('POST')){
            if (extension_loaded("curl")) {
                $send_command = json_encode(["commands" => $this->methodParams()["command_input"]]);
                $ch = curl_init("http://$_SERVER[HTTP_HOST]/vehicleCore/getCommand");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $send_command);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                print_r ($result);
                $_SESSION['last_vehicle_coordinate'] = $this->getVehicleCoordinate();
                $_SESSION['last_vehicle_position'] = $this->getVehiclePosition();
            } else {
                echo "Curl kurulu değil.";
            }
        }else{
            echo "404";
        }
    }

}
