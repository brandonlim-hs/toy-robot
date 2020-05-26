<?php

namespace ToyRobot\Command;

use MyCLabs\Enum\Enum;

/**
 * Class Command
 * @package ToyRobot\Command
 * @method static Command PLACE()
 * @method static Command MOVE()
 * @method static Command LEFT()
 * @method static Command RIGHT()
 * @method static Command REPORT()
 */
class Command extends Enum
{
    /**
     * Command to place robot on field.
     */
    private const PLACE = 'PLACE';
    /**
     * Command to move robot.
     */
    private const MOVE = 'MOVE';
    /**
     * Command to rotate robot to the left.
     */
    private const LEFT = 'LEFT';
    /**
     * Command to rotate robot to the right.
     */
    private const RIGHT = 'RIGHT';
    /**
     * Command to report on the status of robot.
     */
    private const REPORT = 'REPORT';
}