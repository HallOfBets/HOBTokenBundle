<?php
namespace HOB\TokenBundle\Model;

/**
 * Class Token
 * @package HOB\TokenBundle\Model
 */
class Token
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var integer
     */
    private $ip;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return int
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param int $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }
}
