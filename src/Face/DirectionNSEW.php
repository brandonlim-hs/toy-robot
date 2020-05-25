<?php

namespace ToyRobot\Face;

use MyCLabs\Enum\Enum;

/**
 * Class DirectionNSEW is an enum for NORTH, SOUTH, EAST or WEST directions.
 * @package ToyRobot\Face
 * @method static DirectionNSEW NORTH()
 * @method static DirectionNSEW SOUTH()
 * @method static DirectionNSEW EAST()
 * @method static DirectionNSEW WEST()
 */
class DirectionNSEW extends Enum
{
    private const NORTH = 'NORTH';
    private const SOUTH = 'SOUTH';
    private const EAST = 'EAST';
    private const WEST = 'WEST';
}