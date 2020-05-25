<?php

namespace ToyRobot\Coordinate;

interface CoordinateXInterface
{
    /**
     * Get the x coordinate.
     *
     * @return int The x coordinate.
     */
    public function getX(): int;

    /**
     * Set the x coordinate.
     *
     * @param int $x The x coordinate.
     */
    public function setX(int $x): void;

    /**
     * Translate along the x axis by the given amount.
     *
     * @param int $amount The amount to translate along the x axis.
     */
    public function translateX(int $amount): void;
}