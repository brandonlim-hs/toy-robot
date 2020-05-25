<?php

namespace ToyRobot\Tests\Coordinate;

use PHPUnit\Framework\TestCase;
use ToyRobot\Coordinate\Coordinate2D;

class Coordinate2DTest extends TestCase
{
    public function testGetX()
    {
        $expectedX = 5;
        $coordinate2D = new Coordinate2D($expectedX, 0);
        $this->assertEquals($expectedX, $coordinate2D->getX());
    }

    public function testSetX()
    {
        $expectedX = 5;
        $coordinate2D = new Coordinate2D(0, 0);
        $coordinate2D->setX($expectedX);
        $this->assertEquals($expectedX, $coordinate2D->getX());
    }

    public function testTranslateX()
    {
        $coordinate2D = new Coordinate2D(0, 0);
        $coordinate2D->translateX(5);
        $this->assertEquals(5, $coordinate2D->getX());
        $coordinate2D->translateX(-5);
        $this->assertEquals(0, $coordinate2D->getX());
    }

    public function testGetY()
    {
        $expectedY = 5;
        $coordinate2D = new Coordinate2D(0, $expectedY);
        $this->assertEquals($expectedY, $coordinate2D->getY());
    }

    public function testSetY()
    {
        $expectedY = 5;
        $coordinate2D = new Coordinate2D(0, 0);
        $coordinate2D->setY($expectedY);
        $this->assertEquals($expectedY, $coordinate2D->getY());
    }

    public function testTranslateY()
    {
        $coordinate2D = new Coordinate2D(0, 0);
        $coordinate2D->translateY(5);
        $this->assertEquals(5, $coordinate2D->getY());
        $coordinate2D->translateY(-5);
        $this->assertEquals(0, $coordinate2D->getY());
    }
}