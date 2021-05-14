<?php

namespace App\Models;

use App\Exceptions\MapException;

class Map
{
    protected $x;
    protected $y;

    public function __construct()
    {
        //
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setData(string $mapData)
    {
        $coordinates = explode(' ', $mapData, 2);

        if (count($coordinates) != 2) {
            throw MapException::dataCountDoesNotMatch();
        }

        if (!is_numeric($coordinates[0]) || !is_numeric($coordinates[1])) {
            throw MapException::invalidDataEntered($coordinates);
        }

        $this->x = $coordinates[0];
        $this->y = $coordinates[1];
    }
}
