<?php
namespace KZ;

class DifferentDirections
{

    protected $directions;

    protected $file;

    protected $format = '%F %F %F';


    public function __construct( $file, $directionsCollection)
    {
        $this->file = $file;
        $this->directions = $directionsCollection;
    }

    public function setFormat( $format)
    {
        $this->format = $format;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function all()
    {
        // Results
        $result = [];
        $this->directions = new $this->directions;
        $i = 0;
        while (!$this->file->eof()) {

            $current_string = $this->file->fgets();

            if (strlen($current_string) <=5) {//the line is too short
                continue;
            }
            else {

                $this->directions->addDirection($current_string);

                // Average directions
                $avgDirection = $this->directions->getAvgDirection();
                // Max off
                $avgDestination = $this->directions->getAvgDestination($avgDirection);

                $result[$i][] = $avgDirection;
                // Set float
                $result[$i][] = $avgDestination;

                $i++;
            }

        }
        return $result;
    }

    public function __toString()
    {
        $arr = $this->all();
        $result = '';
        foreach ($arr as $a) {
            $result .= sprintf($this->getFormat(), $a[0]->getX(), $a[0]->getY(), $a[1]) . "\n";
        }

        return $result;
    }
}

