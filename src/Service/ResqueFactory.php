<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 14:03
 */

namespace S3\Zf3Resque\Service;

use Interop\Container\ContainerInterface;
use S3\Zf3Resque\Options\ResqueOptions;
use Zend\ServiceManager\Factory\FactoryInterface;

class ResqueFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : \Resque
    {
        /** @var array $config */
        $config = $container->get('Configuration');
        if (!isset($config['zf3_resque'])) {
            $config = [];
        } else {
            $config = $config['zf3_resque'];
        }

        $options = new ResqueOptions($config);

        $resque = new \Resque();
        $resque->setBackend(
            $options->getServer(),
            $options->getDatabase()
        );

        return $resque;
    }
}