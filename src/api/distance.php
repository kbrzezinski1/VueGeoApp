<?
require __DIR__ . '/vendor/autoload.php';

use MyClass\Coordinate;
use MyClass\DistanceCalculator;

$lat1 = $_GET['lat1'] ?? null;
$lon1 = $_GET['lon1'] ?? null;
$lat2 = $_GET['lat2'] ?? null;
$lon2 = $_GET['lon2'] ?? null;


header('Content-Type: application/json');

try {
    $location1 = new Coordinate($lat1, $lon1);
    $location2 = new Coordinate($lat2, $lon2);
} catch (Exception $ex) {
    http_response_code(400);
    $response = [
        'error' => $ex->getMessage()
    ];
    echo json_encode($response);
    die();
}


$distanceCalculator = new DistanceCalculator();
$distanceMeters = $distanceCalculator->calculateDistanceInMeters($location1, $location2);

http_response_code(200);
$response = [
    'distance_meters' => $distanceMeters,
    'distance_kilometers' => round($distanceMeters / 1000)
];
echo json_encode($response);
