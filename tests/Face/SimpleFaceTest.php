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
                'degrees' => 90,
                'initialDirection' => DirectionNSEW::NORTH(),
                'expectedDirection' => DirectionNSEW::EAST(),
            ],
            'almost90DegreesShouldNotChangeDirection' => [
                'degrees' => 89,
                'initialDirection' => DirectionNSEW::NORTH(),
                'expectedDirection' => DirectionNSEW::NORTH(),
            ],
            'negative90degreesShouldRotateAntiClockwiseOnce' => [
                'degrees' => -90,
                'initialDirection' => DirectionNSEW::NORTH(),
                'expectedDirection' => DirectionNSEW::WEST(),
            ],
            'moreThan90degreesShouldRotateManyTimes' => [
                'degrees' => 540,
                'initialDirection' => DirectionNSEW::NORTH(),
                'expectedDirection' => DirectionNSEW::SOUTH(),
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