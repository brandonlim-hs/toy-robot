#!/usr/bin/env php
<?php

// Composer provides a convenient, automatically generated class loader for our application.
require __DIR__ . '/../vendor/autoload.php';

$fileInputSimulator = new \ToyRobot\FileInputSimulator();
$fileName = $argv[1];

if (empty($fileName)) {
    echo "Usage:\n";
    echo "    ./FileInputSimulatorCLI.php <file>\n";
} else {
    echo $fileInputSimulator->readFile($fileName);
}
