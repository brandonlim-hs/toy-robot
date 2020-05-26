<?php

namespace ToyRobot\Simulator;

use ToyRobot\Coordinate\Coordinate2D;
use ToyRobot\Face\DirectionNSEW;
use ToyRobot\Field\FieldBoundaryInterface;
use ToyRobot\Robot\RobotInterface;

/**
 * Class Simulator simulates the {@link RobotInterface} movements on {@link FieldBoundaryInterface}.
 * @package ToyRobot\Simulator
 */
class Simulator implements SimulatorInterface
{
    /**
     * @var RobotInterface The robot that the simulator is controlling.
     */
    private $robot;
    /**
     * @var FieldBoundaryInterface The field to put the robot on upon a place command.
     */
    private $field;

    /**
     * Simulator constructor.
     * @param RobotInterface $robot
     * @param FieldBoundaryInterface $field
     */
    public function __construct(RobotInterface $robot, FieldBoundaryInterface $field)
    {
        $this->robot = $robot;
        $this->field = $field;
    }

    /**
     * Attempt to place robot on the field given x and y coordinate, and direction. If the direction is unknown, ignore
     * this command.
     *
     * @param int $x The x coordinate on the field.
     * @param int $y The y coordinate on the field.
     * @param string $direction The direction that the robot should face.
     */
    public function place(int $x, int $y, string $direction): void
    {
        if (!DirectionNSEW::isValid($direction)) {
            return;
        }
        $this->robot->place(new Coordinate2D($x, $y), new DirectionNSEW($direction), $this->field);
    }

    /**
     * @inheritDoc
     */
    public function move(): void
    {
        $this->robot->move();
    }

    /**
     * @inheritDoc
     */
    public function left(): void
    {
        $this->robot->rotate(-90);
    }

    /**
     * @inheritDoc
     */
    public function right(): void
    {
        $this->robot->rotate(90);
    }

    /**
     * @inheritDoc
     */
    public function report(): string
    {
        if (!$this->robot->getCoordinate2D() || !$this->robot->getDirection()) {
            return '';
        }
        $xCoord = $this->robot->getCoordinate2D()->getX();
        $yCoord = $this->robot->getCoordinate2D()->getY();
        $direction = $this->robot->getDirection()->getValue();
        return implode(',', [$xCoord, $yCoord, $direction]);
    }
}