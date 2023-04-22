<?

namespace MyClass;

use MyClass\Coordinate;

class DistanceCalculator
{

    //used code: https://www.geodatasource.com/resources/tutorials/how-to-calculate-the-distance-between-2-locations-using-php/
    public function calculateDistanceInMeters(Coordinate $location1, Coordinate $location2, int $precision = 0): float
    {
        if (($location1->getLat() == $location2->getLat()) && ($location1->getLon() == $location2->getLon())) {
            return 0;
        } else {
            $theta = $location1->getLon() - $location2->getLon();
            $dist = sin(deg2rad($location1->getLat())) * sin(deg2rad($location2->getLat()))
                +  cos(deg2rad($location1->getLat())) * cos(deg2rad($location2->getLat())) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);

            $distance_miles = $dist * 60 * 1.1515;
            $distance_km = $distance_miles * 1.609344;
            $distance_m = $distance_km * 1000;
            return round($distance_m, $precision);
        }
    }
}
