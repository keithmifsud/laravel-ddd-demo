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
use KeithMifsud\Demo\Domain\Member\MemberRepository;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\BaseUniqueIdentifier;
use KeithMifsud\Demo\Application\Repositories\Membership\MemberRepository as MemberApplicationRepository;

/**
 * Application service for updating a member's profile.
 *
 */
final class UpdateProfile
{

    /**
     * @var MemberRepository
     */
    protected $memberDomainRepository;


    /**
     * @var MemberApplicationRepository
     */
    protected $memberApplicationRepository;


    /**
     * UpdateProfile constructor.
     *
     * @param MemberRepository            $memberDomainRepository
     * @param MemberApplicationRepository $memberApplicationRepository
     */
    public function __construct(
        MemberRepository $memberDomainRepository,
        MemberApplicationRepository $memberApplicationRepository
    ) {
        $this->memberDomainRepository = $memberDomainRepository;
        $this->memberApplicationRepository = $memberApplicationRepository;
    }


    /**
     * Executes the service.
     *
     * Updates the member's profile and stores
     * in repository.
     *
     * @param string $memberIdentifier
     * @param array  $profileData
     * @return void
     */
    public function execute(
        string $memberIdentifier,
        array $profileData
    ): void {

        $member = Member::existingMember(
            $this->memberDomainRepository,
            BaseUniqueIdentifier::fromString($memberIdentifier)
        );

        // Updates the member's phone number if one is supplied.
        if (($this->notEmptyOrNull($profileData['international_dialling_code'])) &&
            ($this->notEmptyOrNull($profileData['domestic_phone_number']))
        ) {
            if (is_null($member->getPhoneNumber())) {
                $member->addPhoneNumber(
                    $profileData['international_dialling_code'],
                    $profileData['domestic_phone_number']
                );
            } else {
                $member->changePhoneNumber(
                    $profileData['international_dialling_code'],
                    $profileData['domestic_phone_number']
                );
            }
        }

        // Updates the member's address if supplied.
        if (($this->notEmptyOrNull($profileData['street_address'])) &&
            ($this->notEmptyOrNull($profileData['city'])) &&
            ($this->notEmptyOrNull($profileData['region'])) &&
            ($this->notEmptyOrNull($profileData['country_code']))
        ) {
            if (is_null($member->getAddress())) {
                $member->addAddress(
                    $profileData['street_address'],
                    $profileData['city'],
                    $profileData['region'],
                    $profileData['country_code']
                );
            } else {
                $member->moveAddress(
                    $profileData['street_address'],
                    $profileData['city'],
                    $profileData['region'],
                    $profileData['country_code']
                );
            }
        }

        $this->memberApplicationRepository->updateProfile($member);
    }


    /**
     * Checks if the value is empty.
     *
     * @param null $value
     * @return bool
     */
    private function notEmptyOrNull($value = null)
    {
        return (!is_null($value) && ($value !== ''));
    }
}
