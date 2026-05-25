<?php

namespace App\Controllers;

use App\Configuration;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;
use Framework\Http\Responses\ViewResponse;
use App\Models\User;

/**
 * Class AuthController
 *
 * This controller handles authentication actions such as login, logout, and redirection to the login page. It manages
 * user sessions and interactions with the authentication system.
 *
 * @package App\Controllers
 */
class AuthController extends BaseController
{

    /**
     * Redirects to the login page.
     *
     * This action serves as the default landing point for the authentication section of the application, directing
     * users to the login URL specified in the configuration.
     *
     * @return Response The response object for the redirection to the login page.
     */

    public function register(Request $request): Response
    {
        $errors = array();

        if ($request->isPost()) {
            $username = $request->value('username');
            $password = $request->value('password');
            $confirmPassword = $request->value('confirmPassword');

            if (strlen($username) < 3) {
                $errors[] = 'Username must be at least 3 characters long.';
            }

            if (strlen($username) > 15) {
                $errors[] = 'Username cannot be longer than 15 characters.';
            }

            if (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters long.';
            }

            if (strlen($password) > 15) {
                $errors[] = 'Password cannot be longer than 15 characters.';
            }

            if (str_contains($username, ' ')) {
                $errors[] = 'Username cannot contain spaces.';
            }

            if ($password !== $confirmPassword) {
                $errors[] = 'Passwords do not match.';
            }

            // nesmie existovat username chyba podmienka

            if (count($errors) > 0) {
                return $this->html(['errors' => $errors]);
            }

            $user = new User();
            $user->setUsername($username);
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $user->save();

            return $this->redirect($this->url('auth.login'));

        }

        return $this->html(['errors' => $errors]);
    }

    public function index(Request $request): Response
    {
        return $this->redirect(Configuration::LOGIN_URL);
    }

    /**
     * Authenticates a user and processes the login request.
     *
     * This action handles user login attempts. If the login form is submitted, it attempts to authenticate the user
     * with the provided credentials. Upon successful login, the user is redirected to the admin dashboard.
     * If authentication fails, an error message is displayed on the login page.
     *
     * @return Response The response object which can either redirect on success or render the login view with
     *                  an error message on failure.
     * @throws Exception If the parameter for the URL generator is invalid throws an exception.
     */
    public function login(Request $request): Response
    {
        if (!$request->isPost()) {
            return $this->html();
        }

        $username = $request->value('username');
        $password = $request->value('password');

        if ($this->app->getAuthenticator()->login($username, $password)) {
            return $this->redirect($this->url('admin.index'));
        } else {
            return $this->html(['message' => 'Invalid username or password.']);
        }
    }

    /**
     * Logs out the current user.
     *
     * This action terminates the user's session and redirects them to a view. It effectively clears any authentication
     * tokens or session data associated with the user.
     *
     * @return ViewResponse The response object that renders the logout view.
     */
    public function logout(Request $request): Response
    {
        $this->app->getAuthenticator()->logout();
        return $this->html();
    }
}
