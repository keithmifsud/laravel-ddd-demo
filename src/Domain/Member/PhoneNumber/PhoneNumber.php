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

namespace KeithMifsud\Demo\Domain\Member\PhoneNumber;

use KeithMifsud\Demo\Domain\Common\ValueObject\ValueObject;
use KeithMifsud\Demo\Domain\Common\ValueObject\BaseValueObject;
use KeithMifsud\Demo\Domain\Member\Exception\InvalidPhoneNumber;

/**
 * The member's phone number.
 */
final class PhoneNumber
{
    /**
     * @var string
     */
    protected static $prefix = '+';


    /**
     * @var InternationalDialingCode
     */
    protected $internationalDialingCode;


    /**
     * @var DomesticNumber
     */
    protected $domesticNumber;


    /**
     * PhoneNumber constructor.
     *
     * @param string $internationalDialingCode
     * @param string $domesticPhoneNumber
     */
    public function __construct(
        string $internationalDialingCode,
        string $domesticPhoneNumber
    ) {

        $this->internationalDialingCode = new InternationalDialingCode(
            $internationalDialingCode
        );
        $this->domesticNumber = new DomesticNumber($domesticPhoneNumber);
    }


    /**
     * Gets the Prefix.
     *
     * @return string
     */
    public static function getPrefix(): string
    {
        return self::$prefix;
    }


    /**
     * Gets the InternationalDialingCode.
     *
     * @return InternationalDialingCode
     */
    public function getInternationalDialingCode(): InternationalDialingCode
    {
        return $this->internationalDialingCode;
    }


    /**
     * Gets the DomesticNumber.
     *
     * @return DomesticNumber
     */
    public function getDomesticNumber(): DomesticNumber
    {
        return $this->domesticNumber;
    }


    /**
     * Gets a string representation of the phone number.
     *
     * @return string
     */
    public function toString(): string
    {
        return self::getPrefix() .
            $this->getInternationalDialingCode()->toString() .
            ' ' . $this->getDomesticNumber()->toString();
    }

}
