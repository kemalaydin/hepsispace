<?php
namespace App\Helper;

trait PositionHelper{

    protected $positions = ['N','E','S','W'];
    protected $coordinates = [
        'x' => null,
        'y' => null
    ];
    protected $coordinate_map = [
        'W' => 'x',
        'E' => 'x',
        'N' => 'y',
        'S' => 'y'
    ];

    public function turn($position,$turn)
    {
        $position_search = array_search($position,$this->positions);
        if($turn == "L"){
            if($position_search == 0) $position_search = 4;
            return $this->positions[$position_search - 1];
        }else if($turn == "R"){
            if($position_search == 3) $position_search = -1;
            return $this->positions[$position_search + 1];
        }
    }

    public function coordinate($position,$coordinate)
    {
        $this->coordinates["x"] = $coordinate["x"];
        $this->coordinates["y"] = $coordinate["y"];
        $this->setNewCoordinate($position);

        return $this->coordinates;
    }

    public function setNewCoordinate($position)
    {
        $this->coordinates[$this->coordinate_map[$position]] += 1;
    }
}