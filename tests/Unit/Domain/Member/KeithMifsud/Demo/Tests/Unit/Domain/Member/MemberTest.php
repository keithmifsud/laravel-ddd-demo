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

use KeithMifsud\Demo\Domain\Member\Address\Address;
use KeithMifsud\Demo\Domain\Member\MemberIdentifier;
use stdClass;
use KeithMifsud\Demo\Tests\TestCase;
use KeithMifsud\Demo\Domain\Member\Member;
use KeithMifsud\Demo\Domain\Member\MemberRepository;
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
        $identifier = BaseUniqueIdentifier::generate();
        $streetAddress = '30, Fastolff House, Regent Street';
        $city = 'Norwich';
        $region = 'Norfolk';
        $country = 'GBR';

        $member = Member::register(
            $identifier,
            $streetAddress,
            $city,
            $region,
            $country
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
            $this->member->getAddress()->getStreetAddress()->sameValueAs(
                $member->getAddress()->getStreetAddress()
            )
        );

        $this->assertTrue(
            $this->member->getAddress()->getCity()->sameValueAs(
                $member->getAddress()->getCity()
            )
        );

        $this->assertTrue(
            $this->member->getAddress()->getRegion()->sameValueAs(
                $member->getAddress()->getRegion()
            )
        );

        $this->assertTrue(
            $this->member->getAddress()->getCountry()->sameValueAs(
                $member->getAddress()->getCountry()
            )
        );
    }


    /**
     * Tests that a phone number can be added to the
     * profile.
     *
     * @todo
     */
    public function it_can_add_phone_number()
    {
        $member = $this->member;
        $phoneNumber = '1234567890';

        $member->addPhoneNumber($phoneNumber);

        $this->assertEquals(
            $phoneNumber,
            $member->getPhoneNumber()->toString()
        );
    }



    // first name, last name - trafctor register.

    // phone

    // avatar

    // update each property



    /**
     * Test that it can be instantiated from
     * a stored profile.
     *
     * @todo
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
            $member->getAddress()->sameValueAs(
                new Address(
                    $profileData->street_address,
                    $profileData->city,
                    $profileData->region,
                    $profileData->country_code
                )
            )
        );

        // test for other new props
        // @TODO
    }


    /**
     * Gets an stdClass of a member's profile.
     *
     * @return object
     */
    private function getProfileData()
    {

        $profileData = (object)[
            'user_identifier' => $this->member->getIdentifier()->toString(),
            'street_address'  => $this->member->getAddress()
                ->getStreetAddress()->toString(),

            'city'         => $this->member->getAddress()->getCity()->toString(),
            'region'       => $this->member->getAddress()->getRegion()->toString(),
            'country'      => $this->member->getAddress()->getCountry()->toString(),
            'country_code' => $this->member->getAddress()->getCountry()->getCode()
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

