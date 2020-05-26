<?php

namespace ToyRobot\Field;

use ToyRobot\Coordinate\Coordinate2DInterface;

interface FieldBoundaryInterface
{
    /**
     * Get the dimension in x axis.
     *
     * @return int The dimension in x axis.
     */
    public function getXDimension(): int;

    /**
     * Get the dimension in y axis.
     *
     * @return int The dimension in y axis.
     */
    public function getYDimension(): int;

    /**
     * Return true if given coordinate is within the boundary.
     *
     * @param Coordinate2DInterface $coordinate2D
     * @return bool True if given coordinate is within the boundary.
     */
    public function withinBoundary(Coordinate2DInterface $coordinate2D): bool;
}