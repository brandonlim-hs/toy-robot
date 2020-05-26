<?php

namespace ToyRobot\Tests\Simulator;

use PHPUnit\Framework\TestCase;
use ToyRobot\Face\DirectionNSEW;
use ToyRobot\Field\SquareTable;
use ToyRobot\Robot\Robot;
use ToyRobot\Simulator\Simulator;

class SimulatorTest extends TestCase
{
    /**
     * Return a data provider array of expected results for place command.
     *
     * @return array Return a data provider array of expected results for place command.
     */
    public function expectedPlaceResults()
    {
        return [
            'placeWithinField' => [
                'x' => 0,
                'y' => 0,
                'direction' => DirectionNSEW::NORTH()->getValue(),
                'expectedReport' => '0,0,NORTH',
            ],
            'placeOutsideField' => [
                'x' => 0,
                'y' => -1,
                'direction' => DirectionNSEW::NORTH()->getValue(),
                'expectedReport' => '',
            ],
            'placeIncorrectDirection' => [
                'x' => 0,
                'y' => 0,
                'direction' => DirectionNSEW::NORTH()->getValue() . 'X',
                'expectedReport' => '',
            ],
        ];
    }

    /**
     * @dataProvider expectedPlaceResults
     * @param int $x The x coordinate on the field.
     * @param int $y The y coordinate on the field.
     * @param string $direction The direction that the robot should face.
     * @param string $expectedReport
     */
    public function testPlace(int $x, int $y, string $direction, string $expectedReport)
    {
        $simulator = new Simulator(new Robot(), new SquareTable(5));
        $simulator->place($x, $y, $direction);

        $this->assertEquals($expectedReport, $simulator->report());
    }

    public function testMove()
    {
        $simulator = new Simulator(new Robot(), new SquareTable(5));
        $simulator->place(0, 0, DirectionNSEW::NORTH()->getValue());
        $this->assertEquals('0,0,NORTH', $simulator->report());

        $simulator->move();
        $this->assertEquals('0,1,NORTH', $simulator->report());
    }

    public function testLeft()
    {
        $simulator = new Simulator(new Robot(), new SquareTable(5));
        $simulator->place(0, 0, DirectionNSEW::NORTH()->getValue());
        $this->assertEquals('0,0,NORTH', $simulator->report());

        $simulator->left();
        $this->assertEquals('0,0,WEST', $simulator->report());
    }

    public function testRight()
    {
        $simulator = new Simulator(new Robot(), new SquareTable(5));
        $simulator->place(0, 0, DirectionNSEW::NORTH()->getValue());
        $this->assertEquals('0,0,NORTH', $simulator->report());

        $simulator->right();
        $this->assertEquals('0,0,EAST', $simulator->report());
    }
}