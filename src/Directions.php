<?php
namespace KZ;

use KZ\Exceptions\StartNotFoundException;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class Directions
{
    const WALK = 'walk';
    const TURN = 'turn';
    const START = 'start';


    protected $directions = [];

    private function createCoordinatesByWalk($angle, &$x, &$y, $walk) {
        // Cos (Radiant)
        $x += $walk * cos($angle * M_PI / 180);
        $y += $walk * sin($angle * M_PI / 180);
    }


    public function getDirections(){
        return $this->directions;
    }


    public function addDirection($directions)
    {
        $directions = explode(' ', $directions);

        $x = floatval($directions[0]); $y = floatval(next($directions));

        // It's start
        if ($this->nextElementIs($directions, self::START)) {
            next($directions); $angle = floatval(next($directions));

        } else {
            throw new StartNotFoundException("Undefined key - Start" );
        }

        // Turn and walk
        while($this->hasNext($directions)) {

            if ($this->nextElementIs($directions, self::TURN)) {
                next($directions);

                $angle += floatval(next($directions));
            } elseif ($this->nextElementIs($directions, self::WALK)) {
                next($directions);

                $walk = next($directions);
                $this->createCoordinatesByWalk($angle, $x, $y, floatval($walk));
            }
        }

        $this->directions[] = new Direction($x, $y);


    }

    public function getAvgDirection() {
        $avgDirection = new Direction(0, 0);

        $n = count($this->directions);
        foreach ($this->directions as $direction) {
            $avgDirection->setX($avgDirection->getX() + $direction->getX());
            $avgDirection->setY($avgDirection->getY() + $direction->getY());
        }
        $avgDirection->setX($avgDirection->getX() / $n);
        $avgDirection->setY($avgDirection->getY() / $n);

        return $avgDirection;
    }


    public function getAvgDestination($avgDirection) {
        $result = $destination = (float)0;

        foreach ($this->directions as $direction) {
            $result = (float) max($destination, hypot(
                    $avgDirection->getX() - $direction->getX(),
                    $avgDirection->getY() - $direction->getY()
                )
            );
        }

        return $result;
    }


    private function nextElementIs(array $array, $is) {
        return (next($array) === $is);
    }


    private function hasNext(array $array)
    {
        if (is_array($array)) {
            return (next($array) === false ? false : true);
        } else {
            return false;
        }
    }
}