<?php

namespace ToyRobot\Tests\Face;

use PHPUnit\Framework\TestCase;
use ToyRobot\Face\DirectionNSEW;
use ToyRobot\Face\SimpleFace;

class SimpleFaceTest extends TestCase
{
    public function testGetDirection()
    {
        $expectedDirection = DirectionNSEW::NORTH();
        $simpleFace = new SimpleFace($expectedDirection);
        $this->assertEquals($expectedDirection, $simpleFace->getDirection());
    }

    public function testSetDirection()
    {
        $expectedDirection = DirectionNSEW::SOUTH();
        $simpleFace = new SimpleFace(DirectionNSEW::NORTH());
        $simpleFace->setDirection($expectedDirection);
        $this->assertEquals($expectedDirection, $simpleFace->getDirection());
    }

    /**
     * Return a data provider array of expected rotations.
     *
     * @return array Return a data provider array of expected rotations.
     */
    public function expectedRotations()
    {
        return [
            'positive90degreesShouldRotateClockwiseOnce' => [
                90,
                DirectionNSEW::NORTH(),
                DirectionNSEW::EAST(),
            ],
            'almost90DegreesShouldNotChangeDirection' => [
                89,
                DirectionNSEW::NORTH(),
                DirectionNSEW::NORTH(),
            ],
            'negative90degreesShouldRotateAntiClockwiseOnce' => [
                -90,
                DirectionNSEW::NORTH(),
                DirectionNSEW::WEST(),
            ],
            'moreThan90degreesShouldRotateManyTimes' => [
                540,
                DirectionNSEW::NORTH(),
                DirectionNSEW::SOUTH(),
            ],
        ];
    }

    /**
     * @dataProvider expectedRotations
     * @param int $degrees The number of degrees to rotate.
     * @param DirectionNSEW $initialDirection The initial direction before rotation.
     * @param DirectionNSEW $expectedDirection The expected direction after rotation.
     */
    public function testRotate(int $degrees, DirectionNSEW $initialDirection, DirectionNSEW $expectedDirection)
    {
        $simpleFace = new SimpleFace($initialDirection);
        $simpleFace->rotate($degrees);
        $this->assertEquals($expectedDirection, $simpleFace->getDirection());
    }
}