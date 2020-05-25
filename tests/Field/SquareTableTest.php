<?php

namespace ToyRobot\Tests\Field;

use PHPUnit\Framework\TestCase;
use ToyRobot\Coordinate\Coordinate2D;
use ToyRobot\Coordinate\Coordinate2DInterface;
use ToyRobot\Field\SquareTable;

class SquareTableTest extends TestCase
{
    /**
     * Return a data provider array of expected within boundary results.
     *
     * @return array Return a data provider array of expected within boundary results.
     */
    public function expectedWithinBoundaryResults()
    {
        return [
            'withinBoundary1' => [
                5,
                new Coordinate2D(0, 0),
                true,
            ],
            'withinBoundary2' => [
                5,
                new Coordinate2D(4, 4),
                true,
            ],
            'outsideBoundary1' => [
                5,
                new Coordinate2D(-1, 0),
                false,
            ],
            'outsideBoundary2' => [
                5,
                new Coordinate2D(0, -1),
                false,
            ],
            'outsideBoundary3' => [
                5,
                new Coordinate2D(5, 4),
                false,
            ],
            'outsideBoundary4' => [
                5,
                new Coordinate2D(4, 5),
                false,
            ],
        ];
    }

    /**
     * @dataProvider expectedWithinBoundaryResults
     * @param int $dimension The dimension units.
     * @param Coordinate2DInterface $coordinate2D The coordinate to test.
     * @param bool $expectedResult Whether the coordinate is within boundary.
     */
    public function testRotate(int $dimension, Coordinate2DInterface $coordinate2D, bool $expectedResult)
    {
        $squareTable = new SquareTable($dimension);
        $this->assertEquals($expectedResult, $squareTable->withinBoundary($coordinate2D));
    }
}