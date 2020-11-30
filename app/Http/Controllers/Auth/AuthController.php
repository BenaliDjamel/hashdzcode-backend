<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginUser;
use App\Http\Requests\SignupUser;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Validator;




class AuthController extends Controller
{

    protected $providers = [
        'github'
    ];
    
    public function login(LoginUser $request) {
       
        if (!auth()->attempt($request->validated())) {
            return response()->json(['errors' =>["user" => ['User not found']]], 404);
        }
        return auth()->user(); 
       
       
    }

    public function logout() {
        auth()->logout();
        return response('Successfully logged out');
    }

    public function signup(SignupUser $request) {

        $user =  User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]);
            
        return response($user, 201); 
    }

    public function user() {
        return auth()->user();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
         
    }

    protected function sendFailedResponse($msg = null)
    {
        return response(['msg' => $msg ?: 'Unable to login, try with another provider to login.'], 403);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if( $user ) {
            // update the avatar and provider that might have changed
            $user->update([
                'avatar' => $providerUser->avatar,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            // create a new user
            $user = User::create([
                'firstname' => $providerUser->getName(),
                'lastname' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'avatar' => $providerUser->getAvatar(),
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                // user can use reset password to create a password
                'password' => ''
            ]);
        }

        // login the user
        auth()->login($user, true);

       return auth()->user();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($driver)
    {
        $user = Socialite::driver('github')->stateless()->user();
         // check for email in returned user
         return empty( $user->email )
         ? $this->sendFailedResponse("No email id returned from github provider.")
         : $this->loginOrCreateAccount($user, 'github');

       
    }

    
}
