<?php

namespace App\Auth;
use Framework\Auth\SessionAuthenticator;
use Framework\Core\IIdentity;
use App\Models\User;

class Authenticator extends SessionAuthenticator
{
    #[Override]
    protected function authenticate(string $username, string $password): ?IIdentity
    {
        $users = User::getAll('`username` = ?', [$username]);
        if (!$users) {
            return null;
        }

        $user = $users[0];
        if (password_verify($password, $user->getPassword())) {
            return $user;
        }

        return null;
    }
}
