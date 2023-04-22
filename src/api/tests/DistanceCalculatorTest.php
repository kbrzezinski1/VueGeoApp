<?

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use MyClass\DistanceCalculator;
use MyClass\Coordinate;

final class DistanceCalculatorTest extends TestCase
{

    public function testDistanceBetweenWarsawAndBerlin(): void
    {

        $warsawCoord = new Coordinate(52.237049, 21.017532);
        $berlinCoord = new Coordinate(52.520008, 13.404954);

        $DistanceCalculator = new DistanceCalculator();
        $distance = $DistanceCalculator->calculateDistanceInMeters($warsawCoord, $berlinCoord, 0);

        $this->assertEquals(517418, $distance);
    }

    public function testDistanceSameLocation(): void
    {
        $warsawCoord = new Coordinate(52.237049, 21.017532);

        $DistanceCalculator = new DistanceCalculator();
        $distance = $DistanceCalculator->calculateDistanceInMeters($warsawCoord, $warsawCoord, 0);

        $this->assertEquals(0, $distance);
    }
}
