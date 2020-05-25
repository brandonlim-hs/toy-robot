<?php

namespace ToyRobot\Face;

interface FaceInterface
{
    /**
     * Get the direction.
     *
     * @return DirectionNSEW The direction.
     */
    public function getDirection(): DirectionNSEW;

    /**
     * Set the direction.
     *
     * @param DirectionNSEW $direction The direction.
     */
    public function setDirection(DirectionNSEW $direction): void;

    /**
     * Rotate clockwise by the given degrees.
     *
     * @param int $degrees The number of degrees to rotate.
     */
    public function rotate(int $degrees): void;
}