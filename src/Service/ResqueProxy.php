<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 13:49
 */

namespace S3\Zf3Resque\Service;


use S3\Zf3Resque\Options\ResqueOptions;
use Resque;
use Resque_Redis;

class ResqueProxy
{
    const KEY_FAILED = 'failed';
    const KEY_STAT_FAILED = 'stat:failed';
    const KEY_STAT_PROCESSED = 'stat:processed';
    const KEY_WORKERS = 'workers';

    const PATTERN_WORKER = 'worker:%s';
    const PATTERN_WORKER_PROCESSED = 'stat:processed:%s';
    const PATTERN_WORKER_STARTED = 'worker:%s:started';


    /** @var  ResqueOptions */
    protected $options;

    public function __construct(array $options)
    {

        $this->setOptions($options);
    }

    public function setOptions(array $options) : ResqueProxy
    {
        if (!$options instanceof ResqueOptions) {
            $options = new ResqueOptions($options);
        }
        $this->options = $options;

        return $this;
    }


    /**
     * setBackend
     */
    public function connect() : void
    {
        Resque::setBackend(
            $this->options->getServer(),
            $this->options->getDatabase()
        );
    }

    /**
     * enqueue
     *
     * @param $queue
     * @param $class
     * @param null $args
     * @param bool|false $trackStatus
     *
     * @return string
     */
    public function enqueue($queue, $class, $args = null, $trackStatus = false)
    {
        return Resque::enqueue($queue, $class, $args, $trackStatus);
    }

    /**
     * getFailed
     *
     * @return int
     */
    public function getFailed() : int
    {
        return (int)$this->redis()->get(self::KEY_STAT_FAILED);
    }

    /**
     * @return Resque_Redis
     */
    public function redis() : Resque_Redis
    {
        return Resque::redis();
    }

    /**
     * getProcessed
     *
     * @return int
     */
    public function getProcessed() : int
    {
        return (int)$this->redis()->get(self::KEY_STAT_PROCESSED);
    }

    /**
     * queues
     *
     * @return array
     */
    public function queues() : array
    {
        return Resque::queues();
    }

    /**
     * size
     *
     * @param $queue
     *
     * @return int
     */
    public function size($queue) : int
    {
        return Resque::size($queue);
    }

    /**
     * getFailuresPerQueue
     *
     * @return array
     */
    public function getFailuresPerQueue() : array
    {
        $failure_count = $this->redis()->llen(self::KEY_FAILED);
        $failures = [];
        $failures_json = $this->redis()
            ->lRange(
                self::KEY_FAILED,
                0,
                $failure_count - 1
            );
        foreach ($failures_json as $id => $failure) {
            $failure = json_decode($failure, true);
            $queue = $failure['queue'];
            $failures[$queue][] = [
                'id'      => $id,
                'failure' => $failure,
            ];
        }
        return $failures;
    }

}