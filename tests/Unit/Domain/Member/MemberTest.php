<?php
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

namespace KeithMifsud\Demo\Tests\Unit\Domain\Member;

use KeithMifsud\Demo\Tests\TestCase;
use KeithMifsud\Demo\Domain\Member\Member;
use KeithMifsud\Demo\Domain\Member\LastName;
use KeithMifsud\Demo\Domain\Member\FirstName;
use KeithMifsud\Demo\Domain\Member\Address\Address;
use KeithMifsud\Demo\Domain\Member\MemberRepository;
use KeithMifsud\Demo\Domain\Member\PhoneNumber\PhoneNumber;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\BaseUniqueIdentifier;

/**
 * Unit tests for the Member Aggregate.
 *
 */
class MemberTest extends TestCase
{

    /**
     * @var Member
     */
    protected $member;


    /**
     * Sets up the tests.
     *
     */
    public function setUp()
    {
        parent::setUp();
        $identifier = BaseUniqueIdentifier::generate();
        $firstName = 'Keith';
        $lastName = 'Mifsud';

        $member = Member::register(
            $identifier,
            $firstName,
            $lastName
        );

        $this->member = $member;
    }


    /**
     * Tests that a member profile can be registered.
     *
     * @test
     */
    public function it_can_register_member_profile()
    {
        $member = $this->member;

        $this->assertInstanceOf(
            Member::class,
            $member
        );

        $this->assertTrue(
            $this->member->getIdentifier()->sameValueAs(
                $member->getIdentifier()
            )
        );

        $this->assertTrue(
            $this->member->getFirstName()->sameValueAs(
                $member->getFirstName()
            )
        );

        $this->assertTrue(
            $this->member->getLastName()->sameValueAs(
                $member->getLastName()
            )
        );
    }


    /**
     * Tests that a phone number can be added to the
     * profile.
     *
     * @test
     */
    public function it_can_add_phone_number()
    {
        $member = $this->member;
        $countryDiallingCode = '44';
        $phoneNumber = '1493334010';

        $member->addPhoneNumber($countryDiallingCode, $phoneNumber);

        $this->assertEquals(
            '+44 1493334010',
            $member->getPhoneNumber()->toString()
        );
    }


    /**
     * Tests that an address can be added to the profile.
     *
     * @test
     */
    public function it_can_add_new_address()
    {
        $streetAddress = '30, Fastolff House, Regent Street';
        $city = 'Norwich';
        $region = 'Norfolk';
        $country = 'GBR';

        $member = $this->member;
        $member->addAddress(
            $streetAddress,
            $city,
            $region,
            $country
        );

        $this->assertTrue(
            $member->getAddress()->sameValueAs(
                $this->member->getAddress()
            )
        );
    }


    /**
     * Test that it can be instantiated from
     * a stored profile.
     *
     * @test
     */
    public function it_can_setup_an_existing_member_profile()
    {
        $repository = $this->getMemberRepositoryMock();
        $profileData = $this->getProfileData();

        $repository->expects($this->once())
            ->method('getExistingMemberProfile')
            ->will($this->returnValue($profileData));

        $member = Member::existingMember(
            $repository,
            $this->member->getIdentifier()
        );

        $this->assertInstanceOf(
            Member::class,
            $member
        );

        $this->assertTrue(
            $member->getIdentifier()->sameValueAs(
                BaseUniqueIdentifier::fromString(
                    $profileData->user_identifier
                )
            )
        );

        $this->assertTrue(
            $member->getFirstName()->sameValueAs(new FirstName(
                $profileData->first_name
            ))
        );

        $this->assertTrue(
            $member->getLastName()->sameValueAs(
                new LastName($profileData->last_name)
            )
        );

        $this->assertTrue(
            $member->getPhoneNumber()->sameValueAs(
                new PhoneNumber(
                    $profileData->international_dialling_code,
                    $profileData->domestic_phone_number
                )
            )
        );

        $this->assertTrue(
            $member->getAddress()->sameValueAs(
                new Address(
                    $profileData->street_address,
                    $profileData->city,
                    $profileData->region,
                    $profileData->country_code
                )
            )
        );
    }


    /**
     * Tests that it can properly set up an existing
     * member with a missing address.
     *
     * @test
     */
    public function it_can_setup_an_existing_member_with_missing_address()
    {

        $repository = $this->getMemberRepositoryMock();
        $profileData = (object)[
            'user_identifier'   => $this->member->getIdentifier()->toString(),
            'first_name'        => $this->member->getFirstName()->toString(),
            'last_name'         => $this->member->getLastName()->toString(),
            'international_dialling_code' => '44',
            'domestic_phone_number'       => '1493334010',
            'street_address'              => null,
            'city'                        => null,
            'region'                      => null,
            'country'                     => null,
            'country_code'                => null
        ];

        $repository->expects($this->once())
            ->method('getExistingMemberProfile')
            ->will($this->returnValue($profileData));

        $member = Member::existingMember(
            $repository,
            $this->member->getIdentifier()
        );

        $this->assertInstanceOf(
            Member::class,
            $member
        );

        $this->assertEquals(
            $profileData->first_name,
            $member->getFirstName()->toString()
        );
        $this->assertEquals(
            $profileData->last_name,
            $member->getLastName()->toString()
        );
        $this->assertTrue(
            $member->getPhoneNumber()->sameValueAs(
                new PhoneNumber(
                    $profileData->international_dialling_code,
                    $profileData->domestic_phone_number
                )
            )
        );

        $this->assertNull($member->getAddress());
    }


    /**
     * Tests that it can be set up without a phone number.
     *
     * @test
     */
    public function it_can_setup_an_existing_member_with_missing_phone_number()
    {

        $repository = $this->getMemberRepositoryMock();
        $profileData = (object)[
        'user_identifier'   => $this->member->getIdentifier()->toString(),
        'first_name'        => $this->member->getFirstName()->toString(),
        'last_name'         => $this->member->getLastName()->toString(),

        'international_dialling_code' => null,
        'domestic_phone_number'       => null,
            'street_address'              => '30, Fastolff House, Regent Street',

            'city'         => 'Norwich',
            'region'       => 'Norfolk',
            'country'      => 'United Kingdom',
            'country_code' => 'GBR'
        ];

        $repository->expects($this->once())
            ->method('getExistingMemberProfile')
            ->will($this->returnValue($profileData));

        $member = Member::existingMember(
            $repository,
            $this->member->getIdentifier()
        );

        $this->assertInstanceOf(Member::class, $member);
        $this->assertEquals(
            $profileData->first_name,
            $member->getFirstName()->toString()
        );
        $this->assertEquals(
            $profileData->last_name,
            $member->getLastName()->toString()
        );

        $this->assertTrue(
            $member->getAddress()->sameValueAs(
                new Address(
                    $profileData->street_address,
                    $profileData->city,
                    $profileData->region,
                    $profileData->country_code
                )
            )
        );

        $this->assertNull($member->getPhoneNumber());
    }


    /**
     * Tests that the phone number can be changes.
     *
     * @test
     */
    public function it_can_change_phone_number()
    {
        $repository = $this->getMemberRepositoryMock();
        $profileData = $this->getProfileData();

        $repository->expects($this->once())
            ->method('getExistingMemberProfile')
            ->will($this->returnValue($profileData));

        $member = Member::existingMember(
            $repository,
            $this->member->getIdentifier()
        );

        $newInternationalDiallingCode = '356';
        $newDomesticPhoneNumber = '21580117';
        $member->changePhoneNumber($newInternationalDiallingCode,
            $newDomesticPhoneNumber
        );

        $this->assertEquals(
            '+356 21580117',
            $member->getPhoneNumber()->toString()
        );
    }


    /**
     * Test that member can move address.
     *
     * @test
     */
    public function it_can_move_address()
    {
        $repository = $this->getMemberRepositoryMock();
        $profileData = $this->getProfileData();

        $repository->expects($this->once())
            ->method('getExistingMemberProfile')
            ->will($this->returnValue($profileData));

        $member = Member::existingMember(
            $repository,
            $this->member->getIdentifier()
        );

        $newStreetAddress = 'New Street';
        $newCity = 'New City';
        $newRegion = 'New Region';
        $newCountry = 'USA';

        $member->moveAddress(
            $newStreetAddress,
            $newCity,
            $newRegion,
            $newCountry
        );

        $this->assertEquals(
            $newStreetAddress,
            $member->getAddress()->getStreetAddress()->toString()
        );
        $this->assertEquals(
            $newCity,
            $member->getAddress()->getCity()->toString()
        );
        $this->assertEquals(
            $newRegion,
            $member->getAddress()->getRegion()->toString()
        );
        $this->assertEquals(
            $newCountry,
            $member->getAddress()->getCountry()->getCode()
        );
        $this->assertEquals(
            'United States',
            $member->getAddress()->getCountry()->toString()
        );
    }


    /**
     * Gets an stdClass of a member's profile.
     *
     * @return object
     */
    private function getProfileData()
    {

        $profileData = (object)[
            'user_identifier'   => $this->member->getIdentifier()->toString(),
            'first_name'        => $this->member->getFirstName()->toString(),
            'last_name'         => $this->member->getLastName()->toString(),
            
            'international_dialling_code' => '44',
            'domestic_phone_number'       => '1493334010',
            'street_address'              => '30, Fastolff House, Regent Street',

            'city'         => 'Norwich',
            'region'       => 'Norfolk',
            'country'      => 'United Kingdom',
            'country_code' => 'GBR'
        ];

        return $profileData;
    }


    /**
     * Gets a mock of the member repository.
     *
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function getMemberRepositoryMock()
    {
        $mockedRepository = $this->getMockBuilder(
            MemberRepository::class
        )->getMock();

        return $mockedRepository;
    }
}

