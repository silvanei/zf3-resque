<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 15:59
 */

namespace S3\Zf3Resque\Job;


use S3\Zf3Resque\Service\Job;

abstract class ResqueJobAbstract implements ResqueJobInterface
{

    /** @var  Job */
    public $job;

    public $args;

    public $queue;

    public function setUp()  : void
    {

    }

    abstract function perform()  : void;

    public function tearDown()  : void
    {

    }
}