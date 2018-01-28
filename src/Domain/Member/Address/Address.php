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

namespace KeithMifsud\Demo\Domain\Member\Address;

/**
 * The member's address.
 *
 */
final class Address
{


    /**
     * @var Street
     */
    protected $streetAddress;


    /**
     * @var City
     */
    protected $city;


    /**
     * @var Region
     */
    protected $region;


    /**
     * @var Country
     */
    protected $country;


    /**
     * Address constructor.
     *
     * @param string $streetAddress
     * @param string $city
     * @param string $region
     * @param string $country
     */
    public function __construct(
        string $streetAddress,
        string $city,
        string $region,
        string $country
    ) {
        $this->streetAddress = new Street($streetAddress);
        $this->city = new City($city);
        $this->region = new Region($region);
        $this->country = new Country($country);
    }


    /**
     * Gets the StreetAddress.
     *
     * @return Street
     */
    public function getStreetAddress(): Street
    {
        return $this->streetAddress;
    }


    /**
     * Gets the City.
     *
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }


    /**
     * Gets the Region.
     *
     * @return Region
     */
    public function getRegion(): Region
    {
        return $this->region;
    }


    /**
     * Gets the Country.
     *
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

}
