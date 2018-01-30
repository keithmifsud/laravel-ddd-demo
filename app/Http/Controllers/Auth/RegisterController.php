<?php

namespace KeithMifsud\Demo\Application\Http\Controllers\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use KeithMifsud\Demo\Application\Http\Controllers\Controller;
use KeithMifsud\Demo\Application\Http\Requests\Membership\RegisterMember;
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
        $this->guard()->login($authUser);
        return redirect($this->redirectPath());
    }
}
