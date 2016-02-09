<?php
namespace HOB\TokenBundle\Encoder;

/**
 * Interface JWTEncoderInterface
 * @package HOB\TokenBundle\Encoder
 */
interface JWTEncoderInterface
{
    /**
     * @param array $data
     *
     * @return string the encoded token string
     */
    public function encode(array $data);
    /**
     * @param string $token
     *
     * @return bool|array
     */
    public function decode($token);
}
