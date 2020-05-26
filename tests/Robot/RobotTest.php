<?php

namespace ToyRobot\Tests\Robot;

use PHPUnit\Framework\TestCase;
use ToyRobot\Coordinate\Coordinate2D;
use ToyRobot\Coordinate\Coordinate2DInterface;
use ToyRobot\Face\DirectionNSEW;
use ToyRobot\Field\FieldBoundaryInterface;
use ToyRobot\Field\SquareTable;
use ToyRobot\Robot\Robot;

class RobotTest extends TestCase
{
    /**
     * Return a data provider array of expected robot place results.
     *
     * @return array Return a data provider array of expected robot place results.
     */
    public function expectedPlaceResults()
    {
        return [
            'placeWithinField' => [
                'coordinate2D' => new Coordinate2D(0, 0),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => new Coordinate2D(0, 0),
                'expectedDirection' => DirectionNSEW::NORTH(),
                'expectedField' => new SquareTable(5),
            ],
            'placeOutsideField' => [
                'coordinate2D' => new Coordinate2D(0, -1),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => null,
                'expectedDirection' => null,
                'expectedField' => null,
            ],
            'placeWithoutField' => [
                'coordinate2D' => new Coordinate2D(0, -1),
                'direction' => DirectionNSEW::NORTH(),
                'field' => null,
                'expectedCoordinate2D' => null,
                'expectedDirection' => null,
                'expectedField' => null,
            ],
        ];
    }

    /**
     * @dataProvider expectedPlaceResults
     * @param Coordinate2DInterface $coordinate2D The coordinate on the field.
     * @param DirectionNSEW $direction The direction that the robot is facing.
     * @param FieldBoundaryInterface|null $field The field to place the robot on.
     * @param Coordinate2DInterface|null $expectedCoordinate2D The expected coordinate of the robot on the field after placement.
     * @param DirectionNSEW|null $expectedDirection The expected direction of the robot after placement.
     * @param FieldBoundaryInterface|null $expectedField The expected field that the robot is on after placement.
     */
    public function testPlace(
        Coordinate2DInterface $coordinate2D,
        DirectionNSEW $direction,
        ?FieldBoundaryInterface $field,
        ?Coordinate2DInterface $expectedCoordinate2D,
        ?DirectionNSEW $expectedDirection,
        ?FieldBoundaryInterface $expectedField
    ) {
        $robot = new Robot();
        $robot->place($coordinate2D, $direction, $field);

        $this->assertEquals($expectedCoordinate2D, $robot->getCoordinate2D());
        $this->assertEquals($expectedDirection, $robot->getDirection());
        $this->assertEquals($expectedField, $robot->getField());
    }

    public function testPlaceOnNewField()
    {
        $oldField = new SquareTable(5);
        $newField = new SquareTable(10);

        $robot = new Robot();
        $robot->place(new Coordinate2D(0, 0), DirectionNSEW::NORTH(), $oldField);
        $robot->place(new Coordinate2D(0, 0), DirectionNSEW::NORTH(), $newField);

        $this->assertNotEquals($oldField, $robot->getField());
        $this->assertEquals($newField, $robot->getField());
    }

    public function testPlaceOnExistingField()
    {
        $field = new SquareTable(5);

        $robot = new Robot();
        $robot->place(new Coordinate2D(0, 0), DirectionNSEW::NORTH(), $field);

        $expectedCoordinate2D = new Coordinate2D(4, 4);
        $expectedDirection = DirectionNSEW::NORTH();
        $robot->place($expectedCoordinate2D, $expectedDirection, null);

        $this->assertEquals($expectedCoordinate2D, $robot->getCoordinate2D());
        $this->assertEquals($expectedDirection, $robot->getDirection());
        $this->assertEquals($field, $robot->getField());
    }

    /**
     * Return a data provider array of expected robot movement results.
     *
     * @return array Return a data provider array of expected robot movement results.
     */
    public function expectedMoveResults()
    {
        return [
            'moveNorthWithinField' => [
                'coordinate2D' => new Coordinate2D(2, 2),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => new Coordinate2D(2, 3),
            ],
            'moveSouthWithinField' => [
                'coordinate2D' => new Coordinate2D(2, 2),
                'direction' => DirectionNSEW::SOUTH(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => new Coordinate2D(2, 1),
            ],
            'moveEastWithinField' => [
                'coordinate2D' => new Coordinate2D(2, 2),
                'direction' => DirectionNSEW::EAST(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => new Coordinate2D(3, 2),
            ],
            'moveWestWithinField' => [
                'coordinate2D' => new Coordinate2D(2, 2),
                'direction' => DirectionNSEW::WEST(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => new Coordinate2D(1, 2),
            ],
            'moveToOutsideField' => [
                'coordinate2D' => new Coordinate2D(4, 4),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => new Coordinate2D(4, 4),
            ],
            'moveWhenPlacedOutsideField' => [
                'coordinate2D' => new Coordinate2D(0, -1),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'expectedCoordinate2D' => null,
            ],
            'moveWithoutAField' => [
                'coordinate2D' => new Coordinate2D(4, 4),
                'direction' => DirectionNSEW::NORTH(),
                'field' => null,
                'expectedCoordinate2D' => null,
            ],
        ];
    }

    /**
     * @dataProvider expectedMoveResults
     * @param Coordinate2DInterface $coordinate2D The coordinate on the field.
     * @param DirectionNSEW $direction The direction that the robot is facing.
     * @param FieldBoundaryInterface|null $field The field to place the robot on.
     * @param Coordinate2DInterface|null $expectedCoordinate2D The expected coordinate of the robot on the field after movement.
     */
    public function testMove(
        Coordinate2DInterface $coordinate2D,
        DirectionNSEW $direction,
        ?FieldBoundaryInterface $field,
        ?Coordinate2DInterface $expectedCoordinate2D
    ) {
        $robot = new Robot();
        $robot->place($coordinate2D, $direction, $field);
        $robot->move();

        $this->assertEquals($expectedCoordinate2D, $robot->getCoordinate2D());
    }

    /**
     * Return a data provider array of expected robot rotate results.
     *
     * @return array Return a data provider array of expected robot rotate results.
     */
    public function expectedRotateResults()
    {
        return [
            'rotate90WithinField' => [
                'coordinate2D' => new Coordinate2D(0, 0),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'degrees' => 90,
                'expectedDirection' => DirectionNSEW::EAST(),
            ],
            'rotate540WithinField' => [
                'coordinate2D' => new Coordinate2D(0, 0),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'degrees' => 540,
                'expectedDirection' => DirectionNSEW::SOUTH(),
            ],
            'rotate-90WithinField' => [
                'coordinate2D' => new Coordinate2D(0, 0),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'degrees' => -90,
                'expectedDirection' => DirectionNSEW::WEST(),
            ],
            'rotateWhenPlacedOutsideField' => [
                'coordinate2D' => new Coordinate2D(0, -1),
                'direction' => DirectionNSEW::NORTH(),
                'field' => new SquareTable(5),
                'degrees' => 90,
                'expectedDirection' => null,
            ],
            'rotateWithoutAField' => [
                'coordinate2D' => new Coordinate2D(0, 0),
                'direction' => DirectionNSEW::NORTH(),
                'field' => null,
                'degrees' => 90,
                'expectedDirection' => null,
            ],
        ];
    }

    /**
     * @dataProvider expectedRotateResults
     * @param Coordinate2DInterface $coordinate2D The coordinate on the field.
     * @param DirectionNSEW $direction The direction that the robot is facing.
     * @param FieldBoundaryInterface|null $field The field to place the robot on.
     * @param int $degrees The number of degrees to rotate.
     * @param DirectionNSEW|null $expectedDirection The expected direction of the robot after rotation.
     */
    public function testRotate(
        Coordinate2DInterface $coordinate2D,
        DirectionNSEW $direction,
        ?FieldBoundaryInterface $field,
        int $degrees,
        ?DirectionNSEW $expectedDirection
    ) {
        $robot = new Robot();
        $robot->place($coordinate2D, $direction, $field);
        $robot->rotate($degrees);

        $this->assertEquals($expectedDirection, $robot->getDirection());
    }
}