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
use KeithMifsud\Demo\Domain\Member\PhoneNumber\PhoneNumber;
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
     * @var PhoneNumber
     */
    protected $phoneNumber;


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
        $member = new self(
            $memberIdentifier,
            new FirstName($firstName),
            new LastName($lastName)
        );
        return $member;
    }


    /**
     * Existing member factory.
     *
     * @param MemberRepository $memberRepository
     * @param UniqueIdentifier $memberIdentifier
     * @return Member
     */
    public static function existingMember(
        MemberRepository $memberRepository,
        UniqueIdentifier $memberIdentifier
    ) {
        $profile = $memberRepository->getExistingMemberProfile(
            $memberIdentifier
        );

        $firstName = new FirstName($profile->first_name);
        $lastName = new LastName($profile->last_name);
        $phoneNumber = null;
        $address = null;

        if ((!is_null($profile->international_dialling_code)) &&
            (!is_null($profile->domestic_phone_number))
        ) {
            $phoneNumber = new PhoneNumber(
                $profile->international_dialling_code,
                $profile->domestic_phone_number
            );
        }

        if ((!is_null($profile->street_address)) &&
            (!is_null($profile->city)) &&
            (!is_null($profile->region)) &&
            (!is_null($profile->country_code))
        ) {
            $address = new Address(
                $profile->street_address,
                $profile->city,
                $profile->region,
                $profile->country_code
            );
        }

        return new self(
            $memberIdentifier,
            $firstName,
            $lastName,
            $phoneNumber,
            $address
        );
    }


    /**
     * Member constructor.
     *
     * @param UniqueIdentifier $identifier
     * @param FirstName        $firstName
     * @param LastName         $lastName
     * @param PhoneNumber|null $phoneNumber
     * @param Address|null     $address
     */
    protected function __construct(
        UniqueIdentifier $identifier,
        FirstName $firstName,
        LastName $lastName,
        PhoneNumber $phoneNumber = null,
        Address $address = null
    ) {
        $this->setIdentifier($identifier);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);

        if (!is_null($phoneNumber)) {
            $this->setPhoneNumber($phoneNumber);
        }
        if (!is_null($address)) {
            $this->setAddress($address);
        }
    }


    /**
     * Adds a phone number to the profile
     * if there isn't one already attached.
     *
     * @param string $internationalDialingCode
     * @param string $domesticNumber
     */
    public function addPhoneNumber(
        string $internationalDialingCode,
        string $domesticNumber
    ) {
        if (!isset($this->phoneNumber)) {
            $this->setPhoneNumber(
                new PhoneNumber($internationalDialingCode, $domesticNumber)
            );
        }
    }


    /**
     * Adds the address to the profile
     * if one is not present.
     *
     * @param string $streetAddress
     * @param string $city
     * @param string $regionOrState
     * @param string $countryCode
     */
    public function addAddress(
        string $streetAddress,
        string $city,
        string $regionOrState,
        string $countryCode
    ) {

        if (!isset($this->address)) {
            $this->setAddress(new Address(
                $streetAddress,
                $city,
                $regionOrState,
                $countryCode
            ));
        }
    }


    /**
     * Changes the phone number if one exists already
     * and if it different from the original number.
     *
     * @param string $newInternationalDiallingCode
     * @param string $newDomesticPhoneNumber
     */
    public function changePhoneNumber(
        string $newInternationalDiallingCode,
        string $newDomesticPhoneNumber
    ) {

        if (isset($this->phoneNumber)) {
            $newPhoneNumber = new PhoneNumber(
                $newInternationalDiallingCode,
                $newDomesticPhoneNumber
            );

            if (!$this->getPhoneNumber()->sameValueAs($newPhoneNumber)) {
                $this->setPhoneNumber($newPhoneNumber);
            }
        }
    }


    /**
     * Moves address.
     *
     * @param string $newStreetAddress
     * @param string $newCity
     * @param string $newRegionOrState
     * @param string $newCountryCode
     */
    public function moveAddress(
        string $newStreetAddress,
        string $newCity,
        string $newRegionOrState,
        string $newCountryCode
    ) {

        if (isset($this->address)) {
            $newAddress = new Address(
                $newStreetAddress,
                $newCity,
                $newRegionOrState,
                $newCountryCode
            );

            if (!$this->getAddress()->sameValueAs($newAddress)) {
                $this->setAddress($newAddress);
            }
        }
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
    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }


    /**
     * Gets the LastName.
     *
     * @return LastName
     */
    public function getLastName(): LastName
    {
        return $this->lastName;
    }


    /**
     * Gets the PhoneNumber.
     *
     * @return PhoneNumber|null
     */
    public function getPhoneNumber(): ?PhoneNumber
    {
        return $this->phoneNumber;
    }


    /**
     * Gets the Address.
     *
     * @return Address|null
     */
    public function getAddress(): ?Address
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
     * Sets the PhoneNumber.
     *
     * @param PhoneNumber $phoneNumber
     */
    protected function setPhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
