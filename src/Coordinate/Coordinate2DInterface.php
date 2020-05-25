<?php

namespace ToyRobot\Coordinate;

interface Coordinate2DInterface
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