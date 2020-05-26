<?php

namespace ToyRobot\Robot;

use ToyRobot\Coordinate\Coordinate2D;
use ToyRobot\Coordinate\Coordinate2DInterface;
use ToyRobot\Face\DirectionNSEW;
use ToyRobot\Face\FaceInterface;
use ToyRobot\Face\SimpleFace;
use ToyRobot\Field\FieldBoundaryInterface;

/**
 * Class Robot represents a robot can can roam freely around a {@link FieldBoundaryInterface}.
 *
 * This robot class is smart enough to not move beyond the field boundary and fall to its destruction.
 * This robot class, however, can rotate by multiple of 90 degrees only.
 * @package ToyRobot\Robot
 */
class Robot implements RobotInterface
{
    /**
     * @var Coordinate2DInterface The coordinate of the robot on the field.
     */
    private $coordinate2D;
    /**
     * @var FaceInterface The direction that the robot is facing.
     */
    private $face;
    /**
     * @var FieldBoundaryInterface The field that the robot is on.
     */
    private $field;

    /**
     * @inheritDoc
     */
    public function place(
        Coordinate2DInterface $coordinate2D,
        DirectionNSEW $direction,
        FieldBoundaryInterface $field = null
    ): void {
        $field = $field ?: $this->field;
        if ($field && $field->withinBoundary($coordinate2D)) {
            // Place the robot if it is within the field boundary
            $this->coordinate2D = $coordinate2D;
            $this->face = new SimpleFace($direction);
            $this->field = $field;
        }
    }

    /**
     * Move the robot. Robot does nothing if not in field. Robot does not move if the new coordinate is invalid.
     */
    public function move(): void
    {
        if (!$this->field) {
            // Robot is not in a field, ignore action
            return;
        }
        $newCoordinate2D = new Coordinate2D($this->coordinate2D->getX(), $this->coordinate2D->getY());
        switch ($this->getDirection()) {
            case DirectionNSEW::NORTH():
                $newCoordinate2D->translateY(1);
                break;
            case DirectionNSEW::SOUTH():
                $newCoordinate2D->translateY(-1);
                break;
            case DirectionNSEW::EAST():
                $newCoordinate2D->translateX(1);
                break;
            case DirectionNSEW::WEST():
                $newCoordinate2D->translateX(-1);
                break;
            default:
                break;
        }
        if ($this->field->withinBoundary($newCoordinate2D)) {
            // Move to the new coordinate if within boundary
            $this->coordinate2D = $newCoordinate2D;
        }
    }

    /**
     * @inheritDoc
     */
    public function rotate(int $degrees): void
    {
        if (!$this->field) {
            // Robot is not in a field, ignore action
            return;
        }
        $this->face->rotate($degrees);
    }

    /**
     * @inheritDoc
     */
    public function getCoordinate2D(): ?Coordinate2DInterface
    {
        return $this->coordinate2D;
    }

    /**
     * @inheritDoc
     */
    public function getDirection(): ?DirectionNSEW
    {
        return $this->face ? $this->face->getDirection() : null;
    }

    /**
     * @inheritDoc
     */
    public function getField(): ?FieldBoundaryInterface
    {
        return $this->field;
    }
}