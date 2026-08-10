<?php

declare(strict_types=1);

namespace Laminas\ApiTools\OAuth2\Provider\UserId;

use Psr\Container\ContainerInterface;

class AuthenticationServiceFactory
{
    /**
     * @return AuthenticationService
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        if ($container->has(\Laminas\Authentication\AuthenticationService::class)) {
            return new AuthenticationService(
                $container->get(\Laminas\Authentication\AuthenticationService::class),
                $config
            );
        }

        return new AuthenticationService(null, $config);
    }
}
