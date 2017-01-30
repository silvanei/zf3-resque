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

class ResqueProxyFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ResqueProxy
    {
        /** @var array $config */
        $config = $container->get('Configuration');
        if (!isset($config['zf3_resque'])) {
            $config = [];
        } else {
            $config = $config['zf3_resque'];
        }

        $resque_proxy = new ResqueProxy($config);
        $resque_proxy->connect();

        return $resque_proxy;
    }
}