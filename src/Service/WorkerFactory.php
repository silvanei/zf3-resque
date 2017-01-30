<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 14:03
 */

namespace S3\Zf3Resque\Service;


use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class WorkerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Worker
    {

        $QUEUE = getenv('QUEUE');
        $queues = explode(',', $QUEUE);

        return new Worker($queues, $container);
    }
}