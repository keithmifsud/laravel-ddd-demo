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

namespace KeithMifsud\Demo\Tests\Unit\Domain\Member\Address;

use KeithMifsud\Demo\Tests\TestCase;
use KeithMifsud\Demo\Domain\Member\Address\Country;
use KeithMifsud\Demo\Domain\Member\Exception\InvalidCountry;

/**
 * Unit tests for the Country value object.
 *
 */
class CountryTest extends TestCase
{

    /**
     * Tests that a country can be initialised from a valid
     * iso 3 code.
     *
     * @test
     */
    public function it_can_be_instantiated_from_valid_code()
    {
        $isoCountryCode = 'GBR';
        $countryName = 'United Kingdom';

        $country = new Country($isoCountryCode);
        $this->assertInstanceOf(
            Country::class,
            $country
        );
        $this->assertEquals(
            $countryName,
            $country->getValue()
        );
        $this->assertEquals(
            $countryName,
            $country->toString()
        );
    }


    /**
     * Tests that an exception is thrown when
     * initiated with an invalid country code.
     *
     * @test
     * @expectedException \KeithMifsud\Demo\Domain\Member\Exception\InvalidCountry
     */
    public function it_throws_exception_with_an_invalid_country_code()
    {
        $invalidCountryCode = 'XXX';
        $country = new Country($invalidCountryCode);
    }
}

