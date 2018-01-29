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

namespace KeithMifsud\Demo\Tests\Unit\Domain\Member\PhoneNumber;

use KeithMifsud\Demo\Domain\Member\Exception\InvalidPhoneNumber;
use KeithMifsud\Demo\Tests\TestCase;
use KeithMifsud\Demo\Domain\Member\PhoneNumber\PhoneNumber;

/**
 * Test for the phone number.
 */
class PhoneNumberTest extends TestCase
{


    /**
     * Tests that it can be created from a valid
     * pattern.
     *
     * @test
     */
    public function it_can_be_instantiated_from_number()
    {
        $countryCode = 'GBR';
        $localNumber = '1493334010';

        $phoneNumber = new PhoneNumber($countryCode, $localNumber);

        $this->assertEquals(
            '44',
            $phoneNumber->getInternationalDialingCode()->getValue()
        );

        $this->assertEquals(
            '44',
            $phoneNumber->getInternationalDialingCode()->toString()
        );

        $this->assertEquals(
            'GBR',
            $phoneNumber->getInternationalDialingCode()->getCountryCode()
        );

        $this->assertEquals(
            $localNumber,
            $phoneNumber->getDomesticNumber()->getValue()
        );

        $this->assertEquals(
            '+44 1493334010',
            $phoneNumber->toString()
        );
    }


    /**
     * Tests that an exception is thrown when
     * given an invalid country code.
     *
     * @todo
     * @expectedException \KeithMifsud\Demo\Domain\Member\Exception\InvalidPhoneNumber
     */
    public function it_throws_exception_with_invalid_country_code()
    {
        $countryCode = 'XXX';
        $localNumber = '1493334010';

        $phoneNumber = new PhoneNumber($countryCode, $localNumber);
    }


    /**
     * Tests that an exception is thrown when domestic number
     * includes alphabetic characters.
     *
     * @todo
     * @expectedException \KeithMifsud\Demo\Domain\Member\Exception\InvalidPhoneNumber
     */
    public function it_throws_exception_with_alpha_characters()
    {
        $countryCode = 'GBR';
        $localNumber = '14933b4010';

        $phoneNumber = new PhoneNumber($countryCode, $localNumber);
    }
}

