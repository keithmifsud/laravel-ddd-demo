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

namespace KeithMifsud\Demo\Application\Services\Membership;


use KeithMifsud\Demo\Domain\Member\Member;
use KeithMifsud\Demo\Domain\Member\MemberIdentifier;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\BaseUniqueIdentifier;
use KeithMifsud\Demo\Application\Repositories\Membership\MemberRepository;
use KeithMifsud\Demo\Application\Repositories\Authentication\UserRepository;

/**
 * Application service for registering a new member.
 *
 * Sets up the member and user profile.
 *
 */
final class RegisterMember
{


    /**
     * @var MemberRepository
     */
    protected $memberRepository;


    /**
     * @var UserRepository
     */
    protected $userRepository;


    /**
     * RegisterMember constructor.
     *
     * @param MemberRepository $memberApplicationRepository
     * @param UserRepository   $userRepository
     */
    public function __construct(
        MemberRepository $memberApplicationRepository,
        UserRepository $userRepository
    ) {
        $this->memberRepository = $memberApplicationRepository;
        $this->userRepository = $userRepository;
    }


    public function execute(
        string $emailAddress,
        string $password,
        string $firstName,
        string $lastName
    ) {

        $identifier = BaseUniqueIdentifier::generate();

        $user = $this->userRepository->createNewUser(
            $identifier,
            $emailAddress,
            $password
        );

        $member = Member::register(
            $identifier,
            $firstName,
            $lastName
        );

        //llogin the user
        $this->memberRepository->storeNewMember($member);

    }


}
