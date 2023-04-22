<?

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use MyClass\Coordinate;

final class CoordinateTest extends TestCase
{

    public function testValidCoordinate(): void
    {

        $warsawCoord = new Coordinate(52.237049, 21.017532);

        $this->assertEquals(52.237049, $warsawCoord->getLat());
        $this->assertEquals(21.017532, $warsawCoord->getLon());
    }

    public function testInvalidDataTypeCoordinate(): void
    {

        $this->expectException(InvalidArgumentException::class);
        $warsawCoord = new Coordinate("InvalidType", "InvalidType");
    }

    public function testInvalidDataRangeCoordinate(): void
    {

        $this->expectException(RangeException::class);
        $warsawCoord = new Coordinate(91.456, 23.11);
    }
}
