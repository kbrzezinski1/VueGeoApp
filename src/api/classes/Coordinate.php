<?

namespace MyClass;

class Coordinate
{
    private float $lat;
    private float $lon;

    public function __construct($lat, $lon)
    {

        if (!is_numeric($lat)) {
            throw new \InvalidArgumentException("Latitude must be float");
        }
        if (!is_numeric($lon)) {
            throw new \InvalidArgumentException("Longitude must be float");
        }
        if ($lat > 90 || $lat < -90) {
            throw new \RangeException("Latitude must be between -90 and 90");
        }
        if ($lat > 90 || $lat < -90) {
            throw new \RangeException("Longitude must be between -90 and 90");
        }
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }
}
