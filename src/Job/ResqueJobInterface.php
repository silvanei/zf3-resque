<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 15:57
 */

namespace S3\Zf3Resque\Job;


interface ResqueJobInterface
{

    public function setUp() : void;

    public function perform() : void;

    public function tearDown() : void;
}