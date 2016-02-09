<?php
namespace HOB\TokenBundle\Storage;

use HOB\TokenBundle\Model\Token;

/**
 * Class TokenStorage
 * @package HOB\TokenBundle\Storage
 */
class TokenStorage
{
    /**
     * @var Token|null
     */
    private $token;

    /**
     * @return Token|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param Token|null $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return $this->token instanceof Token;
    }
}
