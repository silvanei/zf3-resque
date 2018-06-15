<?php
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 13/02/17
 * Time: 16:40
 */

namespace S3\Zf3ResqueTest;


use PHPUnit\Framework\TestCase;
use S3\Zf3Resque\Options\ResqueOptions;
use Zend\Stdlib\AbstractOptions;

class ResqueOptionsTest extends TestCase
{

    public function testExtendsAbstractOptions()
    {
        $options = new ResqueOptions();
        $this->assertInstanceOf(AbstractOptions::class, $options);
    }

    public function testDefaultParameters()
    {
        $options = new ResqueOptions();
        $this->assertEquals('', $options->getServer());
        $this->assertEquals(0, $options->getDatabase());
        $this->assertEquals(0, $options->getDatabase());
    }

    public function testSetConstructParameters()
    {
        $options = new ResqueOptions([
            'server' => '127.0.0.1:6379',
            'database' => 0
        ]);

        $this->assertEquals('127.0.0.1:6379', $options->getServer());
        $this->assertEquals(0, $options->getDatabase());
    }

    public function testSetMethodParameters()
    {
        $options = new ResqueOptions();
        $options->setServer('127.0.0.1:6379');
        $options->setDatabase(0);

        $this->assertEquals('127.0.0.1:6379', $options->getServer());
        $this->assertEquals(0, $options->getDatabase());
    }
}