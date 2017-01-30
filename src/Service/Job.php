<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 11:22
 */

namespace S3\Zf3Resque\Service;

use Interop\Container\ContainerInterface;
use Resque;
use Resque_Job;
use S3\Zf3Resque\Exceptions\NotReserveJobException;
use S3\Zf3Resque\Job\ResqueJobInterface;

class Job extends Resque_Job
{

    protected $container;

    protected $instance;

    public function __construct(string $queue, array $payload, ContainerInterface $container)
    {

        $this->container = $container;

        parent::__construct($queue, $payload);
    }

    public static function reserve(string $queue, ContainerInterface $container) : Job
    {

        $payload = Resque::pop($queue);

        if (!is_array($payload)) {
            throw new NotReserveJobException();
        }

        return new Job($queue, $payload, $container);
    }

    public static function reserveBlocking(array $queues, int $timeout, ContainerInterface $container) : Job
    {
        $item = Resque::blpop($queues, $timeout);

        if(!is_array($item)) {
            throw new NotReserveJobException();
        }

        return new Job($item['queue'], $item['payload'], $container);
    }

    public function getInstance() : ResqueJobInterface
    {
        if (!is_null($this->instance)) {
            return $this->instance;
        }

        try {
            $this->instance = $this->container->get($this->payload['class']);
            $this->instance->job = $this;
            $this->instance->args = $this->getArguments();
            $this->instance->queue = $this->queue;
        } catch (\Exception $e) {
            throw new \Resque_Exception($e->getMessage());
        }
        return $this->instance;
    }
}