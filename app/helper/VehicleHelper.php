<?php
namespace App\Helper;

trait VehicleHelper{
    protected $vehicleName;
    protected $vehicleCoordinate;
    protected $vehiclePosition;

    public function __construct()
    {
        $vehicle_database = json_decode(file_get_contents(HOME.'data.json'),true);

        $this->vehicleName = $vehicle_database["vehicle"]["name"];
        $this->vehicleCoordinate = ["x" => $vehicle_database["vehicle"]["coordinate"]["x"], "y" => $vehicle_database["vehicle"]["coordinate"]["y"]];
        $this->vehiclePosition = $vehicle_database["vehicle"]["coordinate"]["direction"];
    }

    public function setDatabase()
    {
        $vehicle_data = [
            'vehicle' => [
                'name' => $this->vehicleName,
                'coordinate' => [
                    'x' => $this->vehicleCoordinate["x"],
                    'y' => $this->vehicleCoordinate["y"],
                    'direction' => $this->vehiclePosition
                ]
            ]
        ];

        file_put_contents(HOME.'data.json', "");
        $vehicle_json = json_encode($vehicle_data);
        $vehicle_db_doc = fopen(HOME.'data.json','a');
        $send_data_to_db = fwrite($vehicle_db_doc,$vehicle_json);
        fclose($vehicle_db_doc);
    }

    public function getVehicleName()
    {
        return $this->vehicleName;
    }

    public function getVehicleCoordinate()
    {
        return $this->vehicleCoordinate;
    }

    public function getVehiclePosition()
    {
        return $this->vehiclePosition;
    }

    public function setVehicleName($name)
    {
        $this->vehicleName = $name;
        $this->setDatabase();
    }

    public function setVehicleCoordinate($coordinate)
    {
        $this->vehicleCoordinate = $coordinate;
        $this->setDatabase();
    }

    public function setVehiclePosition($position)
    {
        $this->vehiclePosition = $position;
        $this->setDatabase();
    }
}