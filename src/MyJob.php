<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 15:19
 */

namespace S3\Zf3Resque;


use S3\Zf3Resque\Job\ResqueJobAbstract;

class MyJob extends ResqueJobAbstract
{

    public function perform()  : void
    {
        //sleep(10);

        // Work work work
        //echo $this->args['name'] . PHP_EOL;
    }
}