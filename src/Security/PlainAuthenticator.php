<?php

namespace Mt\RestBundle\Security;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class PlainAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    protected function getLoginUrl()
    {
        return '';
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(['error' => 'Authentication failure'], 403);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        if ($request->getSession() instanceof SessionInterface) {
            $targetPath = $this->getTargetPath($request->getSession(), $providerKey);
        }

        return isset($targetPath) && !empty($targetPath)
            ? new RedirectResponse($targetPath) : null;
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getCredentials(Request $request)
    {
        if (is_null($request->get('username'))) {
            return null;
        }

        return [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     * @return null|UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (!isset($credentials['username'])) {
            return null;
        } else if (empty($credentials['username'])) {
            throw new AuthenticationException('Invalid credentials');
        }

        $user = $userProvider->loadUserByUsername($credentials['username']);

        if (empty($user)) {
            throw new AuthenticationException('Authentication failed');
        }

        return $user;
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if (!isset($credentials['password']) || empty($credentials['password'])) {
            throw new AuthenticationException('Invalid creadentials');
        }

        if ($user->getPassword() !== $credentials['password']) {
            throw new AuthenticationException('Authentication failed');
        }

        return true;
    }
}