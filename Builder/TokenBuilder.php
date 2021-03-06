<?php
namespace HOB\TokenBundle\Builder;

use HOB\TokenBundle\Encoder\JWTEncoderInterface;
use HOB\TokenBundle\Model\Token;

/**
 * Class TokenBuilder
 * @package HOB\TokenBundle\Builder
 */
class TokenBuilder
{
    /**
     * @var JWTEncoderInterface
     */
    private $JWTEncoder;


    /**
     * TokenBuilder constructor.
     * @param JWTEncoderInterface $JWTEncoder
     */
    public function __construct(JWTEncoderInterface $JWTEncoder)
    {
        $this->JWTEncoder = $JWTEncoder;
    }

    /**
     * @param $tokenString
     * @return Token
     */
    public function buildFromString($tokenString)
    {
        $payload = $this->JWTEncoder->decode($tokenString);

        // Populate token
        $token = new Token();
        $token->setId($payload['id']);
        $token->setApiKey($payload['apiKey']);

        $token->addContext('clientIp', $payload['ip']);
        $token->addContext('clientAgent', $payload['agent']);

        return $token;
    }
}
