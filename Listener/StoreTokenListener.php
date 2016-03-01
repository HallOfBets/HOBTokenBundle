<?php
namespace HOB\TokenBundle\Listener;

use HOB\TokenBundle\Builder\TokenBuilder;
use HOB\TokenBundle\Storage\TokenStorage;
use HOB\TokenBundle\TokenExtractor\TokenExtractorInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class StoreTokenListener
 * @package HOB\TokenBundle\Listener
 */
class StoreTokenListener
{
    /**
     * @var boolean
     */
    private $tokenRequired;

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
     * StoreTokenListener constructor.
     * @param $tokenRequired
     * @param TokenStorage $tokenStorage
     * @param TokenExtractorInterface $tokenExtractor
     * @param TokenBuilder $tokenBuilder
     */
    public function __construct($tokenRequired, TokenStorage $tokenStorage, TokenExtractorInterface $tokenExtractor, TokenBuilder $tokenBuilder)
    {
        $this->tokenRequired  = $tokenRequired;
        $this->tokenStorage   = $tokenStorage;
        $this->tokenExtractor = $tokenExtractor;
        $this->tokenBuilder   = $tokenBuilder;
    }

    /**
     * @param GetResponseEvent $event
     * @return GetResponseEvent|void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Check master request
        if (!$event->isMasterRequest()) { return; }

        // Extract token from request
        $tokenString = $this->tokenExtractor->extract($event->getRequest());

        // Check if token if required
        if($this->tokenRequired && $tokenString === false) {
            throw new UnauthorizedHttpException("Invalid access token");
        }

        // Build token
        $token = $this->tokenBuilder->buildFromString($tokenString);

        // Store token
        $this->tokenStorage->setToken($token);
    }
}
