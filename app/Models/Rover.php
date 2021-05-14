<?php

namespace App\Models;

use App\Exceptions\RoverException;

class Rover
{
    protected $x;
    protected $y;
    protected $direction;
    protected $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getCoordinates()
    {
        return $this->x . ' ' . $this->y;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function getLocation()
    {
        return $this->x . ' ' . $this->y . ' ' . $this->direction;
    }

    public function setData(string $roverData)
    {
        $data = explode(' ', $roverData, 3);

        if (count($data) != 3) {
            throw RoverException::dataCountDoesNotMatch();
        }

        if (!is_numeric($data[0]) || !is_numeric($data[1])) {
            throw RoverException::invalidDataEntered($data);
        }

        if (!in_array($data[2], ['N', 'E', 'S', 'W'])) {
            throw RoverException::invalidDirection($data[2]);
        }

        if ($data[0] > $this->map->getX() || $data[1] > $this->map->getY() || $data[0] < 0 || $data[1] < 0) {
            throw RoverException::invalidLocation($data);
        }

        $this->x = $data[0];
        $this->y = $data[1];
        $this->direction = $data[2];
    }

    public function doActions($command, $simulation = false)
    {
        $actions = str_split($command);

        foreach ($actions as $action) {
            if (!in_array($action, ['M', 'L', 'R'])) {
                throw RoverException::invalidAction($action);
            }

            if ($action == 'M') {
                if (!$this->move($simulation)) {
                    throw RoverException::invalidPath($actions);
                }
            } else {
                $this->rotate($action);
            }
        }
    }

    public function simolate($command)
    {
        $simulator = clone $this;
        $simulator->doActions($command, true);
    }

    public function move($simulation = false)
    {
        if ($this->direction == 'N') {
            $this->y++;
        }

        if ($this->direction == 'E') {
            $this->x++;
        }

        if ($this->direction == 'S') {
            $this->y--;
        }

        if ($this->direction == 'W') {
            $this->x--;
        }

        if ($simulation) {
            if ($this->x < 0 || $this->x > $this->map->getX()) {
                return false;
            }

            if ($this->y < 0 || $this->y > $this->map->getY()) {
                return false;
            }
        }

        return true;
    }

    public function rotate($direction)
    {
        $direction == 'L' ? $this->turnLeft() : $this->turnRight();
    }

    public function turnLeft()
    {
        if ($this->direction == 'N') {
            $this->direction = 'W';
        } elseif ($this->direction == 'W') {
            $this->direction = 'S';
        } elseif ($this->direction == 'S') {
            $this->direction = 'E';
        } elseif ($this->direction == 'E') {
            $this->direction = 'N';
        } else {
            throw RoverException::somethingWentWrong();
        }
    }

    public function turnRight()
    {
        if ($this->direction == 'N') {
            $this->direction = 'E';
        } elseif ($this->direction == 'E') {
            $this->direction = 'S';
        } elseif ($this->direction == 'S') {
            $this->direction = 'W';
        } elseif ($this->direction == 'W') {
            $this->direction = 'N';
        } else {
            throw RoverException::somethingWentWrong();
        }
    }
}
