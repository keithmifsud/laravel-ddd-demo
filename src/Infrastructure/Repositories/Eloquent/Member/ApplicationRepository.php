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

namespace KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\Member;

use KeithMifsud\Demo\Domain\Member\Member;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;
use KeithMifsud\Demo\Application\Repositories\Membership\MemberRepository;

/**
 * Eloquent implementation of the member's
 * application repository.
 *
 */
final class ApplicationRepository extends Repository implements MemberRepository
{

    /**
     * Gets the member.
     *
     * @param UniqueIdentifier $memberIdentifier
     * @return mixed
     */
    public function getMember(UniqueIdentifier $memberIdentifier): ?\stdClass
    {
        return $this->model->where([
            'user_identifier',
            $memberIdentifier->toString()
        ])->get();
    }


    /**
     * Stores the new member.
     *
     * @param Member $member
     * @return mixed
     */
    public function storeNewMember(Member $member)
    {
        return $this->model->create([
            'user_identifier' => $member->getIdentifier()->toString(),
            'first_name'      => $member->getFirstName()->toString(),
            'last_name'       => $member->getLastName()->toString()
        ]);
    }


    /**
     * Updates the member's profile in repository.
     *
     * @param Member $member
     * @return mixed
     */
    public function updateProfile(Member $member)
    {
        $profile = $this->getMember($member->getIdentifier());

        $profile->international_dialling_code = $member->getPhoneNumber()
            ->getInternationalDialingCode()->toString();

        $profile->domestic_phone_number = $member->getPhoneNumber()
            ->getDomesticNumber()->toString();

        $profile->street_address = $member->getAddress()->getStreetAddress()
            ->toString();

        $profile->city = $member->getAddress()->getCity()->toString();
        $profile->region = $member->getAddress()->getRegion()->toString();
        $profile->country_code = $member->getAddress()->getCountry()->getCode();
        $profile->country = $member->getAddress()->getCountry()->toString();

        return $profile->save();
    }
}
