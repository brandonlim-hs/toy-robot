<?php

namespace ToyRobot;

use ToyRobot\Command\Command;
use ToyRobot\Field\SquareTable;
use ToyRobot\Robot\Robot;
use ToyRobot\Simulator\Simulator;
use ToyRobot\Simulator\SimulatorInterface;

/**
 * Class FileInputSimulator relays commands from a file to simulate a robot movement on a square 5 x 5 table.
 * @package ToyRobot
 */
class FileInputSimulator
{
    /**
     * @var SimulatorInterface The toy robot simulator.
     */
    private $simulator;

    /**
     * @var string[] Array of reports/output when running the commands.
     */
    private $reportLog = [];

    /**
     * FileInputSimulator constructor.
     */
    public function __construct()
    {
        $this->simulator = new Simulator(new Robot(), new SquareTable(5));
    }

    /**
     * Read the file contents and process each line.
     *
     * @param string $filename The filename with commands to simulate the robot movement.
     * @return string The output from the simulations.
     */
    public function readFile(string $filename): string
    {
        $commandText = file_get_contents($filename);
        foreach (explode("\n", $commandText) as $line) {
            $this->processLine($line);
        }
        return implode("\n", $this->reportLog);
    }

    /**
     * Process the command line, relay to respective action.
     *
     * @param string $line The line with a command to simulate the robot movement.
     */
    private function processLine(string $line): void
    {
        [$command, $argument] = explode(' ', $line);
        switch ($command) {
            case Command::PLACE()->getValue():
                $this->place($argument);
                break;
            case Command::MOVE()->getValue():
                $this->move();
                break;
            case Command::LEFT()->getValue():
                $this->left();
                break;
            case Command::RIGHT()->getValue():
                $this->right();
                break;
            case Command::REPORT()->getValue():
                $this->report();
                break;
            default:
                break;
        }
    }

    /**
     * Relay place command to the simulator.
     *
     * @param string $arguments Additional arguments associated with the place command.
     */
    private function place(string $arguments): void
    {
        [$x, $y, $direction] = explode(',', $arguments);
        if (!is_numeric($x) || !is_numeric($y) || !is_string($direction)) {
            // Ignore command if arguments are invalid
            return;
        }
        $this->simulator->place($x, $y, $direction);
    }

    /**
     * Relay move command to the simulator.
     */
    private function move(): void
    {
        $this->simulator->move();
    }

    /**
     * Relay left command to the simulator.
     */
    private function left(): void
    {
        $this->simulator->left();
    }

    /**
     * Relay right command to the simulator.
     */
    private function right(): void
    {
        $this->simulator->right();
    }

    /**
     * Relay report command to the simulator and store the output as logs.
     */
    private function report(): void
    {
        $this->reportLog[] = $this->simulator->report();
    }
}