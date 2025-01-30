<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private UrlGeneratorInterface $router;
    private AuthorizationCheckerInterface $authChecker;

    public function __construct(UrlGeneratorInterface $router, AuthorizationCheckerInterface $authChecker)
    {
        $this->router = $router;
        $this->authChecker = $authChecker;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        if ($this->authChecker->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($this->router->generate('admin_dashboard'));
        } elseif ($this->authChecker->isGranted('ROLE_TECHNICIAN')) {
            return new RedirectResponse($this->router->generate('technician_dashboard'));
        } else {
            return new RedirectResponse($this->router->generate('user_dashboard'));
        }
    }
}
