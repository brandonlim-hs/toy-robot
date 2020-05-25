<?php

namespace ToyRobot\Coordinate;

interface CoordinateYInterface
{
    /**
     * Get the y coordinate.
     *
     * @return int The y coordinate.
     */
    public function getY(): int;

    /**
     * Set the y coordinate.
     *
     * @param int $y The y coordinate.
     */
    public function setY(int $y): void;

    /**
     * Translate along the y axis by the given amount.
     *
     * @param int $amount The amount to translate along the y axis.
     */
    public function translateY(int $amount): void;
}