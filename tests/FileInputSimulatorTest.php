<?php

namespace ToyRobot\Tests;

use PHPUnit\Framework\TestCase;
use ToyRobot\FileInputSimulator;

class FileInputSimulatorTest extends TestCase
{
    /**
     * Return a data provider array of expected result for each file input.
     *
     * @return array Return a data provider array of expected result for each file input.
     */
    public function expectedFileOutput()
    {
        $testFileDir = __DIR__ . '/Fixtures/';
        return [
            'invalid_place_command.txt' => [
                'fileName' => $testFileDir . 'invalid_place_command.txt',
                'expectedOutput' => '',
            ],
            'many_commands_before_place.txt' => [
                'fileName' => $testFileDir . 'many_commands_before_place.txt',
                'expectedOutput' => '1,1,SOUTH',
            ],
            'move_outside_command.txt' => [
                'fileName' => $testFileDir . 'move_outside_command.txt',
                'expectedOutput' => '0,0,SOUTH',
            ],
            'multiple_commands.txt' => [
                'fileName' => $testFileDir . 'multiple_commands.txt',
                'expectedOutput' => '3,3,NORTH',
            ],
            'multiple_place_commands.txt' => [
                'fileName' => $testFileDir . 'multiple_place_commands.txt',
                'expectedOutput' => '2,2,EAST',
            ],
            'multiple_report_commands.txt' => [
                'fileName' => $testFileDir . 'multiple_report_commands.txt',
                'expectedOutput' => "3,2,NORTH\n2,2,EAST",
            ],
            'simple_move_command.txt' => [
                'fileName' => $testFileDir . 'simple_move_command.txt',
                'expectedOutput' => '0,1,NORTH',
            ],
            'simple_rotate_command.txt' => [
                'fileName' => $testFileDir . 'simple_rotate_command.txt',
                'expectedOutput' => '0,0,WEST',
            ],
        ];
    }

    /**
     * @dataProvider expectedFileOutput
     * @param string $fileName
     * @param string $expectedOutput
     */
    public function testReadFile(string $fileName, string $expectedOutput)
    {
        $fileInputSimulator = new FileInputSimulator();
        $this->assertEquals($expectedOutput, $fileInputSimulator->readFile($fileName));
    }
}