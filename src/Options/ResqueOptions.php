<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: silvanei
 * Date: 27/01/2017
 * Time: 13:51
 */

namespace S3\Zf3Resque\Options;


use Zend\Stdlib\AbstractOptions;

class ResqueOptions extends AbstractOptions
{

    /**
     * @var string
     */
    protected $server = '';

    /**
     * @var int
     */
    protected $database = 0;

    /**
     * @return mixed
     */
    public function getServer() : string
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer(string $server)
    {
        $this->server = $server;
    }

    /**
     * @return int
     */
    public function getDatabase() : int
    {
        return $this->database;
    }

    /**
     * @param int $database
     */
    public function setDatabase(int $database)
    {
        $this->database = $database;
    }


}