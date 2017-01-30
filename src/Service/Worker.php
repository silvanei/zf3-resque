<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 13:16
 */


namespace S3\Zf3Resque\Service;

use Interop\Container\ContainerInterface;
use Psr\Log\LogLevel;
use Resque_Worker;
use S3\Zf3Resque\Exceptions\NotReserveJobException;

class Worker extends Resque_Worker
{

    /** @var  ContainerInterface */
    protected $container;

    /**
     * Worker constructor.
     * @param array|string $queues
     * @param ContainerInterface $container
     */
    public function __construct($queues, ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct($queues);
    }

    /**
     * @param bool $blocking
     * @param int|null $timeout
     * @return bool
     */
    public function reserve(bool $blocking = false, int $timeout = null)
    {
        $queues = $this->queues();

        if (!is_array($queues)) {
            return false;
        }

        if ($blocking) {
            try {
                $job = Job::reserveBlocking($queues, $timeout, $this->container);
                if ($job) {
                    $job->logger = $this->logger;
                    $this->logger->log(
                        LogLevel::INFO,
                        'Found job on {queue}',
                        ['queue' => $job->queue]
                    );

                    return $job;
                }
            } catch (NotReserveJobException $e) {

            }
        }

        foreach ($queues as $queue) {
            $this->logger->log(
                LogLevel::INFO,
                'Checking {queue} for jobs',
                ['queue' => $queue]
            );
            
            try {

                $job = Job::reserve($queue, $this->container);

                $job->logger = $this->logger;
                $this->logger->log(
                    LogLevel::INFO,
                    'Found job on {queue}',
                    ['queue' => $job->queue]
                );

                return $job;
            } catch (NotReserveJobException $e) {

            }
        }

        return false;
    }


}