<?php

namespace App\Http\Controllers\Admin\Api;

use App\Exceptions\LoginFailed;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Lang;
use Validator;
use Auth;

class LoginController extends ApiController
{
    use ThrottlesLogins;


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $this->credentials($request);
        $validator = $this->validateLogin($credentials);
        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors());
        }
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        try{
            $this->attemptLogin($credentials, $request->has('remember'));
            //该用户是否被锁定
            $user = Auth::user();
            if($user->is_locked){ //用户是否已经被锁定
                $this->logout($request);
                // todo 国际化
                return $this->response->error('该用户已经被锁定', 423);
            }
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
        }catch (LoginFailed $e){
            $this->incrementLoginAttempts($request);
            throw new ValidationHttpException($e->getError());
        }
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
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
        try{
            $loginSuccess = $this->guard()->attempt($credentials, $remember);
        }catch (ModelNotFoundException $e) {
            //todo 国际化
            throw new LoginFailed([$this->username() => '用户名不存在']);
        }
        if(!$loginSuccess){
            //todo 国际化
            throw new LoginFailed(['password' => '密码错误']);
        }
        return true;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }


    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = Lang::get('auth.throttle', ['seconds' => $seconds]);
        $this->response->error($message, 423);
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
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
