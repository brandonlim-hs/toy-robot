<?php

namespace ToyRobot\Robot;

use ToyRobot\Coordinate\Coordinate2DInterface;
use ToyRobot\Face\DirectionNSEW;
use ToyRobot\Field\FieldBoundaryInterface;

interface RobotInterface
{
    /**
     * Place the robot on the field given coordinate and direction, if the given coordinate is within the field boundary.
     * If field is not given, use the existing field instead.
     *
     * @param Coordinate2DInterface $coordinate2D The coordinate on the field.
     * @param DirectionNSEW $direction The direction that the robot is facing.
     * @param FieldBoundaryInterface $field The field to place the robot on.
     */
    public function place(
        Coordinate2DInterface $coordinate2D,
        DirectionNSEW $direction,
        FieldBoundaryInterface $field = null
    ): void;

    /**
     * Move the robot. Robot does nothing if not in field.
     */
    public function move(): void;

    /**
     * Rotate the robot clockwise by the given degrees. Robot does nothing if not in field.
     *
     * @param int $degrees
     */
    public function rotate(int $degrees): void;

    /**
     * Get the coordinate of the robot on the field.
     *
     * @return Coordinate2DInterface|null The coordinate of the robot on the field.
     */
    public function getCoordinate2D(): ?Coordinate2DInterface;

    /**
     * Get the direction that the robot is facing.
     *
     * @return DirectionNSEW|null The direction that the robot is facing.
     */
    public function getDirection(): ?DirectionNSEW;

    /**
     * Get the field that the robot is at.
     *
     * @return FieldBoundaryInterface|null The field that the robot is on.
     */
    public function getField(): ?FieldBoundaryInterface;
}