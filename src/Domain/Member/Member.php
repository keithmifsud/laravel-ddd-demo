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

namespace KeithMifsud\Demo\Domain\Member;

use KeithMifsud\Demo\Domain\Member\Address\Address;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;

/**
 * A registered member.
 *
 */
final class Member
{

    /**
     * @var UniqueIdentifier
     */
    protected $identifier;


    /**
     * @var Address
     */
    protected $address;


    /**
     * Registers a new member.
     *
     * @param UniqueIdentifier $memberIdentifier
     * @param string           $streetAddress
     * @param string           $city
     * @param string           $region
     * @param string           $countryIsoAlpha3Code
     * @return Member
     */
    public static function register(
        UniqueIdentifier $memberIdentifier,
        string $streetAddress,
        string $city,
        string $region,
        string $countryIsoAlpha3Code
    ) {
        $member = new static(
            $memberIdentifier,
            new Address(
                $streetAddress,
                $city,
                $region,
                $countryIsoAlpha3Code
            )
        );
        return $member;
    }


    public static function existingMember(
        MemberRepository $memberRepository,
        UniqueIdentifier $memberIdentifier
    ) {
        $profile = $memberRepository->getExistingMemberProfile(
            $memberIdentifier
        );

        $member = new static(
            $memberIdentifier,
            new Address(
                $profile->street_address,
                $profile->city,
                $profile->region,
                $profile->country_code
            )
        );
        return $member;
    }


    protected function __construct(
        UniqueIdentifier $identifier,
        Address $address
    ) {
        $this->setIdentifier($identifier);
        $this->setAddress($address);
    }


    /**
     * Gets the Identifier.
     *
     * @return UniqueIdentifier
     */
    public function getIdentifier(): UniqueIdentifier
    {
        return $this->identifier;
    }


    /**
     * Gets the Address.
     *
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }


    /**
     * Sets the Identifier.
     *
     * @param UniqueIdentifier $identifier
     */
    protected function setIdentifier(UniqueIdentifier $identifier)
    {
        $this->identifier = $identifier;
    }


    /**
     * Sets the Address.
     *
     * @param Address $address
     */
    protected function setAddress(Address $address)
    {
        $this->address = $address;
    }

}
