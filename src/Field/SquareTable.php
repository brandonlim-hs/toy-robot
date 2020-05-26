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
     * Create a square table with given dimension. The dimension is converted to absolute value since dimension must be
     * positive.
     * @param int $dimension The dimension units.
     */
    public function __construct($dimension)
    {
        $this->dimension = abs($dimension);
    }

    /**
     * @inheritDoc
     */
    public function getXDimension(): int
    {
        return $this->dimension;
    }

    /**
     * @inheritDoc
     */
    public function getYDimension(): int
    {
        return $this->getXDimension();
    }

    /**
     * @inheritDoc
     */
    public function withinBoundary(Coordinate2DInterface $coordinate2D): bool
    {
        $xCoord = $coordinate2D->getX();
        $yCoord = $coordinate2D->getY();
        return $xCoord >= 0 && $xCoord < $this->getXDimension() && $yCoord >= 0 && $yCoord < $this->getYDimension();
    }
}