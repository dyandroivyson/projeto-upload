<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;


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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login pela API
     */
    public function loginApi(Request $request)
    {
        $this->validateLogin($request);

        $user = User::query()->where('email', '=', $request->email)->first();
        if (!is_null($user)) {
            if (Hash::check($request->password, $user->password)) {
                $user->generateToken();

                return response()->json([
                    'api_token' => $user->api_token,
                ]);
            }
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Logout pela API
     */
    public function logoutApi(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();

            return response()->json(['msg' => 'Usuário desconectado.'], 200);
        }
    
        return response()->json(['msg' => 'Usuário não encontrado.'], 200);
    }
}
