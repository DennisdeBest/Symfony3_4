<?php

namespace RC\CoreBundle\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;

class JwtListener
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var JWTManagerInterface
     */
    private $jwtManager;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        JWTManagerInterface $jwtManager,
        EventDispatcherInterface $dispatcher,
        ContainerInterface $container
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->jwtManager   = $jwtManager;
        $this->dispatcher   = $dispatcher;
        $this->container    = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        $token = $this->tokenStorage->getToken();

        if ($token) {
            $user = $token->getUser();

            if ($user instanceof \FOS\UserBundle\Model\User) {
                $response = new Response();

                $jwt     = $this->jwtManager->create($user);

                $event = new AuthenticationSuccessEvent(
                    ['token' => $jwt],
                    $user,
                    $response
                );

                $this->dispatcher->dispatch(Events::AUTHENTICATION_SUCCESS, $event);
                $data = $event->getData();

                $session = $this->container->get('session');
                $session->set('jwt', $data['token']);
            }
        }
    }
}
