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
use Ramsey\Uuid\Uuid;


/**
 * Unit tests for the Member Aggregate.
 *
 */
class MemberTest extends TestCase
{


    /**
     * Tests that a member profile can be registered.
     *
     * @test
     */
    public function it_can_register_member_profile()
    {
        $identifier = Uuid::uuid4();
        $streetAddress = '30, Fastolff House, Regent Street';
        $city = 'Norwich';
        $region = 'Norfolk';
        $country = 'United Kingdom';

        $member = Member::register(
            $identifier,
            $streetAddress,
            $city,
            $region,
            $country
        );

        $this->assertInstanceOf(
            Member::class,
            $member
        );

        $this->assertEquals(
            $identifier,
            $member->getIdentifier()
        );
        $this->assertEquals(
            $streetAddress,
            $member->getAddress()->getStreetAddress()->toString()
        );
        $this->assertEquals(
            $city,
            $member->getAddress()->getCity()->toString()
        );
        $this->assertEquals(
            $region,
            $member->getAddress()->getRegion()->toString()
        );
        $this->assertEquals(
            $country,
            $member->getAddress()->getCountry()->toString()
        );
    }


    // phone

    // avatar

    // update each property
}

