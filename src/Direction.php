<?php
namespace KZ;

class Direction
{

    protected $x;

    protected $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function setX(float $x) {
        $this->x = $x;
    }

    public function setY(float $y) {
        $this->y = $y;
    }

    public function getX() {
        return $this->x;
    }

    public function getY() {
        return $this->y;
    }
}