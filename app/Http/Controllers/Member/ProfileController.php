<?php declare(strict_types=1);

/**
 * This file is part of Laravel DDD Demo
 *
 * @licence   Please view the Licence file supplied with this source code.
 *
 * @author    Keith Mifsud <http://www.keith-mifsud.me>
 *
 * @copyright Keith Mifsud 2018 <mifsud.k@gmail.com>
 *
 * @since     1.0
 * @version   1.0 Initial Release
 */

namespace KeithMifsud\Demo\Application\Http\Controllers\Member;

use Illuminate\Support\Facades\Auth;
use KeithMifsud\Demo\Application\Http\Controllers\Controller;
use KeithMifsud\Demo\Application\Http\Requests\Membership\UpdateProfile;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\BaseUniqueIdentifier;
use KeithMifsud\Demo\Application\Repositories\Membership\MemberRepository;
use KeithMifsud\Demo\Application\Services\Membership\UpdateProfile as UpdateProfileService;
use KeithMifsud\Demo\Domain\Member\PhoneNumber\CountryCallingCode;

/**
 * Http controller for Member's profile.
 *
 */
class ProfileController extends Controller
{

    /**
     * ProfileController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Shows the member's profile form.
     *
     * @param MemberRepository $memberRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfileForm(MemberRepository $memberRepository)
    {
        $member = $memberRepository->getMember(
            BaseUniqueIdentifier::fromString(Auth::user()->user_identifier)
        );

        $internationalDiallingCodes = CountryCallingCode::getNames();

        return view(
            'member.profile',
            compact('member', 'internationalDiallingCodes')
        );
    }


    /**
     * Updates the profile.
     *
     * @param UpdateProfile        $request
     * @param UpdateProfileService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateProfile(
        UpdateProfile $request,
        UpdateProfileService $service
    ) {

        $service->execute(
            $request->get('user_identifier'),
            $request->all()
        );
        return redirect('home');
    }
}
