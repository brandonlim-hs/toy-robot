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
                'dimension' => 5,
                'coordinate2D' => new Coordinate2D(0, 0),
                'expectedResult' => true,
            ],
            'withinBoundary2' => [
                'dimension' => 5,
                'coordinate2D' => new Coordinate2D(4, 4),
                'expectedResult' => true,
            ],
            'outsideBoundary1' => [
                'dimension' => 5,
                'coordinate2D' => new Coordinate2D(-1, 0),
                'expectedResult' => false,
            ],
            'outsideBoundary2' => [
                'dimension' => 5,
                'coordinate2D' => new Coordinate2D(0, -1),
                'expectedResult' => false,
            ],
            'outsideBoundary3' => [
                'dimension' => 5,
                'coordinate2D' => new Coordinate2D(5, 4),
                'expectedResult' => false,
            ],
            'outsideBoundary4' => [
                'dimension' => 5,
                'coordinate2D' => new Coordinate2D(4, 5),
                'expectedResult' => false,
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