<?php

namespace ToyRobot\Simulator;

interface SimulatorInterface
{
    /**
     * Attempt to place robot on the field given x and y coordinate, and direction.
     *
     * @param int $x The x coordinate on the field.
     * @param int $y The y coordinate on the field.
     * @param string $direction The direction that the robot should face.
     */
    public function place(int $x, int $y, string $direction): void;

    /**
     * Command the robot to move.
     */
    public function move(): void;

    /**
     * Command the robot to turn left.
     */
    public function left(): void;

    /**
     * Command the robot to turn right.
     */
    public function right(): void;

    /**
     * Return the status of the robot.
     *
     * @return string The status of the robot.
     */
    public function report(): string;
}