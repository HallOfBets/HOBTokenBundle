<?php
namespace HOB\TokenBundle\Model;
use HOB\TokenBundle\Builder\TokenBuilder;
use HOB\TokenBundle\Storage\TokenStorage;
use HOB\TokenBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TokenManager
 * @package HOB\TokenBundle\Model
 */
class TokenManager
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var TokenExtractorInterface
     */
    private $tokenExtractor;

    /**
     * @var TokenBuilder
     */
    private $tokenBuilder;


    /**
     * TokenManager constructor.
     * @param TokenStorage $tokenStorage
     * @param TokenExtractorInterface $tokenExtractor
     * @param TokenBuilder $tokenBuilder
     */
    public function __construct(TokenStorage $tokenStorage, TokenExtractorInterface $tokenExtractor, TokenBuilder $tokenBuilder)
    {
        $this->tokenStorage   = $tokenStorage;
        $this->tokenExtractor = $tokenExtractor;
        $this->tokenBuilder   = $tokenBuilder;
    }

    /**
     * @param Request $request
     * @return bool|Token
     */
    public function extractFromRequest(Request $request)
    {
        // Extract token from request
        $tokenString = $this->tokenExtractor->extract($request);

        if(false === $tokenString) {
            return false;
        }

        // Build token
        $token = $this->tokenBuilder->buildFromString($tokenString);

        // Store token
        $this->tokenStorage->setToken($token);

        return $token;
    }

    /**
     * @return Token|null
     */
    public function getToken()
    {
        return $this->tokenStorage->getToken();
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return $this->tokenStorage->hasToken();
    }
}
