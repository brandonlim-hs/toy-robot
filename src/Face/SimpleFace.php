<?php

namespace ToyRobot\Face;

/**
 * Class SimpleFace represents the currently facing direction. SimpleFace rotates by multiple of 90 degrees only.
 * @package ToyRobot\Face
 */
class SimpleFace implements FaceInterface
{
    /**
     * @var DirectionNSEW The direction.
     */
    private $direction;

    /**
     * SimpleFace constructor.
     * @param DirectionNSEW $direction
     */
    public function __construct(DirectionNSEW $direction)
    {
        $this->direction = $direction;
    }

    /**
     * @inheritDoc
     */
    public function getDirection(): DirectionNSEW
    {
        return $this->direction;
    }

    /**
     * @inheritDoc
     */
    public function setDirection(DirectionNSEW $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * Rotate clockwise by the given degrees. Rotation must pass the 90 degrees threshold to rotate to a new direction.
     *
     * @param int $degrees The number of degrees to rotate.
     */
    public function rotate(int $degrees): void
    {
        $numberOf90DegreeRotations = intdiv($degrees, 90);
        $rotation = [DirectionNSEW::NORTH(), DirectionNSEW::EAST(), DirectionNSEW::SOUTH(), DirectionNSEW::WEST()];
        $currentRotation = array_search($this->direction, $rotation);
        // Find the new rotation index using modulus to "loop" over the rotations
        $newRotationIndex = ($currentRotation + $numberOf90DegreeRotations) % count($rotation);
        if ($newRotationIndex < 0) {
            // Correct the array index if negative
            $newRotationIndex = count($rotation) + $newRotationIndex;
        }
        $this->direction = $rotation[$newRotationIndex];
    }
}