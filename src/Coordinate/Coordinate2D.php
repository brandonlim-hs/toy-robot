<?php

namespace ToyRobot\Coordinate;

/**
 * Class Coordinate2D represents a 2D position (X,Y) on a given space.
 * @package ToyRobot\Coordinate
 */
class Coordinate2D implements CoordinateXInterface, CoordinateYInterface
{
    /**
     * @var int $x The x coordinate.
     */
    private $x;
    /**
     * @var int $y The y coordinate.
     */
    private $y;

    /**
     * Coordinate2D constructor.
     * @param int $x The x coordinate.
     * @param int $y The y coordinate.
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @inheritDoc
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @inheritDoc
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @inheritDoc
     */
    public function translateX(int $amount): void
    {
        $this->x += $amount;
    }

    /**
     * @inheritDoc
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @inheritDoc
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @inheritDoc
     */
    public function translateY(int $amount): void
    {
        $this->y += $amount;
    }
}