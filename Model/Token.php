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
     * @var array
     */
    private $context;

    /**
     * @var null|array
     */
    private $user;


    /**
     * Token constructor.
     */
    public function __construct()
    {
        $this->context = [];
    }

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
     * @return array|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $user
     */
    public function setUser(array $user)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function isLogged()
    {
        return !is_null($this->user);
    }

    /**
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasContext($key)
    {
        return isset($this->context[$key]);
    }

    /**
     * @param $key
     * @param $value
     * @param bool $overwrite
     */
    public function addContext($key, $value, $overwrite = false)
    {
        if($this->hasContext($key) && $overwrite === false) {
            throw new \RuntimeException(sprintf("Token context '%s' already exists", $key));
        }

        $this->context[$key] = $value;
    }
}
