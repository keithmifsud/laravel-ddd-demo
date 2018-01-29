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
     * @var FirstName
     */
    protected $firstName;


    /**
     * @var LastName
     */
    protected $lastName;


    /**
     * @var Address
     */
    protected $address;


    /**
     * Registers a new member.
     *
     * @param UniqueIdentifier $memberIdentifier
     * @param string           $firstName
     * @param string           $lastName
     * @return static
     */
    public static function register(
        UniqueIdentifier $memberIdentifier,
        string $firstName,
        string $lastName
    ) {
        $member = new static(
            $memberIdentifier,
            new FirstName($firstName),
            new LastName($lastName)
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
        FirstName $firstName,
        LastName $lastName
    ) {
        $this->setIdentifier($identifier);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
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
     * Gets the FirstName.
     *
     * @return FirstName
     */
    public function getFirstName() : FirstName
    {
        return $this->firstName;
    }


    /**
     * Gets the LastName.
     *
     * @return LastName
     */
    public function getLastName() : LastName
    {
        return $this->lastName;
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
     * Sets the FirstName.
     *
     * @param FirstName $firstName
     */
    protected function setFirstName(FirstName $firstName)
    {
        $this->firstName = $firstName;
    }


    /**
     * Sets the LastName.
     *
     * @param LastName $lastName
     */
    protected function setLastName(LastName $lastName)
    {
        $this->lastName = $lastName;
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
