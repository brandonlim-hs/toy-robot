<?php

namespace ToyRobot\Field;

use ToyRobot\Coordinate\Coordinate2DInterface;

/**
 * Class SquareTable represents a square field that an entity can move around in.
 * @package ToyRobot\Field
 */
class SquareTable implements FieldBoundaryInterface
{
    /**
     * @var int The dimension units in either x or y axis.
     */
    private $dimension;

    /**
     * Create a square table with given dimension.
     * @param int $dimension The dimension units.
     */
    public function __construct($dimension)
    {
        $this->dimension = $dimension;
    }

    /**
     * @inheritDoc
     */
    public function withinBoundary(Coordinate2DInterface $coordinate2D): bool
    {
        $xCoord = $coordinate2D->getX();
        $yCoord = $coordinate2D->getY();
        return $xCoord >= 0 && $xCoord < $this->dimension && $yCoord >= 0 && $yCoord < $this->dimension;
    }
}