<?php

namespace KeithMifsud\Demo\Application\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use KeithMifsud\Demo\Application\Http\Controllers\Controller;
use KeithMifsud\Demo\Application\Http\Requests\RegisterMember;
use KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\User\User;
use KeithMifsud\Demo\Application\Services\Membership\RegisterMember as RegisterMemberService;

/**
 * The user and member registration controller.
 *
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }


    /**
     * Registers and authenticates the new member.
     *
     * @param RegisterMember        $request
     * @param RegisterMemberService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registerMember(
        RegisterMember $request,
        RegisterMemberService $service
    ) {
        $authUser = $service->execute(
            $request->get('email'),
            $request->get('password'),
            $request->get('first_name'),
            $request->get('last_name')
        );
        return redirect($this->redirectPath());
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\User\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
