<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use App\User;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
         * Get the needed authorization credentials from the request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array
         */
        protected function credentials(Request $request) {
            $field = $this->field($request);

            return [
                $field => $request->get($this->username()),
                'password' => $request->get('password')
            ];
        }


        /**
     * Determine if the request field is email or username.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function field(Request $request){
        $email = $this->username();
        return filter_var($request->get($email), FILTER_VALIDATE_EMAIL) ? $email : 'username';
    }


        /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request){
        $field = $this->field($request);
        $rules = [
            $this->username() => "required|exists:users,{$field}",
            'password' => 'required',
        ];
        $messages = [
            "{$this->username()}.exists" => 'The account you are trying to login is not activated or it has been disabled.',
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
        ];
        // Only add captcha validation if in production environment
        if (config('app.env') === 'production') {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }
        $this->validate($request, $rules, $messages);
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    protected $username = 'username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    protected function authenticated(Request $request, $user){
        $request->session()->flash('success', 'You are logged in!');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    
}
