<?php
namespace HOB\TokenBundle\Encoder;

use InvalidArgumentException;
use Namshi\JOSE\SimpleJWS;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;

/**
 * Class JWTEncoder
 * @package HOB\TokenBundle\Encoder
 */
class JWTEncoder implements JWTEncoderInterface
{
    const ALGORYTHM = 'RS256';

    /**
     * @var string
     */
    protected $privateKey;

    /**
     * @var string
     */
    protected $publicKey;

    /**
     * @var string
     */
    protected $passPhrase;

    /**
     * @param string $privateKey
     * @param string $publicKey
     * @param string $passPhrase
     */
    public function __construct($privateKey, $publicKey, $passPhrase)
    {
        $this->privateKey = $privateKey;
        $this->publicKey  = $publicKey;
        $this->passPhrase = $passPhrase;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(array $data)
    {
        $jws = new SimpleJWS(['alg' => self::ALGORYTHM]);
        $jws->setPayload($data);
        $jws->sign($this->getPrivateKey());

        return $jws->getTokenString();
    }

    /**
     * {@inheritdoc}
     */
    public function decode($token)
    {
        try {
            /** @var SimpleJWS $jws */
            $jws = SimpleJWS::load($token);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        if (!$jws->isValid($this->getPublicKey(), self::ALGORYTHM)) {
            return false;
        }

        return $jws->getPayload();
    }

    /**
     * @return bool|resource
     */
    protected function getPrivateKey()
    {
        if(is_null($this->privateKey)) {
            throw new ParameterNotFoundException("'privateKey' in JWTEncoder");
        }

        return openssl_pkey_get_private('file://' . $this->privateKey, $this->passPhrase);
    }

    /**
     * @return resource
     */
    protected function getPublicKey()
    {
        if(is_null($this->publicKey)) {
            throw new ParameterNotFoundException("'publicKey' in JWTEncoder");
        }

        return openssl_pkey_get_public('file://' . $this->publicKey);
    }
}
