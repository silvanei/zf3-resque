<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 11:08
 */

namespace S3\Zf3Resque;


use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use S3\Zf3Resque\Service\ResqueFactory;
use S3\Zf3Resque\Service\WorkerFactory;

class Module implements ConfigProviderInterface, ServiceProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                'Resque' => ResqueFactory::class,
                'Worker' => WorkerFactory::class
            ],
        ];
    }
}