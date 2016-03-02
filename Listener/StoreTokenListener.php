<?php
namespace HOB\TokenBundle\Listener;

use HOB\TokenBundle\Model\TokenManager;
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
     * @var TokenManager
     */
    private $tokenManager;


    /**
     * StoreTokenListener constructor.
     * @param $tokenRequired
     * @param TokenManager $tokenManager
     */
    public function __construct($tokenRequired, TokenManager $tokenManager)
    {
        $this->tokenRequired  = $tokenRequired;
        $this->tokenManager   = $tokenManager;
    }

    /**
     * @param GetResponseEvent $event
     * @return GetResponseEvent|void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Check master request
        if (!$event->isMasterRequest()) { return; }

        $token = $this->tokenManager->extractFromRequest($event->getRequest());

        // Check if token if required
        if($this->tokenRequired && $token === false) {
            throw new UnauthorizedHttpException("Invalid access token");
        }
    }
}
