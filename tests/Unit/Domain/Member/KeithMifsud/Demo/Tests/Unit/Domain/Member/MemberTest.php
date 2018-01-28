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

use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\BaseUniqueIdentifier;
use KeithMifsud\Demo\Domain\Common\ValueObject\BaseValueObject;
use KeithMifsud\Demo\Tests\TestCase;
use KeithMifsud\Demo\Domain\Member\Member;
use KeithMifsud\Demo\Domain\Member\MemberIdentifier;

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


    public function it_can_add_phone_number_to_member()
    {

    }

    // phone

    // avatar

    // update each property
}

