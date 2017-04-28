<?php

namespace App\Http\Controllers\Admin\Api;

use App\Exceptions\LoginFailed;
use Auth;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Predis\Connection\ConnectionException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Validator;

class LoginController extends ApiController
{
    use ThrottlesLogins;


    /**
     * 处理登录请求
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $credentials = $this->credentials($request);
        $validator = $this->validateLogin($credentials);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }

        try {
            // If the class is using the ThrottlesLogins trait, we can automatically throttle
            // the login attempts for this application. We'll key this by the username and
            // the IP address of the client making these requests into this application.
            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                return $this->sendLockoutResponse($request);
            }

            $this->attemptLogin($credentials, $request->has('remember'));
            //该用户是否被锁定
            $user = Auth::user();
            if ($user->is_locked) { //用户是否已经被锁定
                $this->logout($request);
                return $this->response->error(trans('auth.user_locked'), 423);
            }
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return $this->response->noContent();
        } catch (LoginFailed $e) {
            $this->incrementLoginAttempts($request);
            throw new ValidationHttpException($e->getError());
        }
    }

    /**
     * 验证登录请求
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateLogin($credentials)
    {
        $validator = Validator::make($credentials, [
            $this->username() => ['bail', 'required', 'regex:/^[a-zA-Z0-9_]+$/'],
            'password' => ['required']
        ]);
        return $validator;
    }

    /**
     * Attempt to log the user into the application.
     *
     * @return bool
     */
    protected function attemptLogin($credentials, $remember)
    {
        $loginSuccess = false;
        try {
            $loginSuccess = $this->guard()->attempt($credentials, $remember);
        } catch (ModelNotFoundException $e) {
            throw new LoginFailed([$this->username() => trans('auth.user_name_not_fount')]);
        }
        if (!$loginSuccess) {
            throw new LoginFailed(['password' => trans('auth.password_error')]);
        }
        return true;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }


    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = trans('auth.throttle', ['seconds' => $seconds]);
        $this->response->error($message, 423);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'user_name';
    }

}
