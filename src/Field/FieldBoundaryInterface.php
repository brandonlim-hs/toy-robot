<?php

namespace ToyRobot\Field;

use ToyRobot\Coordinate\Coordinate2DInterface;

interface FieldBoundaryInterface
{
    /**
     * Return true if given coordinate is within the boundary.
     *
     * @param Coordinate2DInterface $coordinate2D
     * @return bool True if given coordinate is within the boundary.
     */
    public function withinBoundary(Coordinate2DInterface $coordinate2D): bool;
}