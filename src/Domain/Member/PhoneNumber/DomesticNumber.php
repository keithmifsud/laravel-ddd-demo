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
 * The local part of a phone number.
 *
 * Includes the area code, the prefix and the line number combined
 * and without validation.
 *
 */
final class DomesticNumber extends BaseValueObject implements ValueObject
{

    /**
     * @var int
     */
    protected static $minLength = 5;


    /**
     * DomesticNumber constructor.
     *
     * @param string $localPhoneNumber
     * @throws InvalidPhoneNumber
     */
    public function __construct(string $localPhoneNumber)
    {
        if (!self::isValid($localPhoneNumber)) {
            throw new InvalidPhoneNumber(
                "Invalid phone number: " . (string)$localPhoneNumber
            );
        }
        $this->value = $localPhoneNumber;
    }


    /**
     * Determines if the given phone number
     * meets the specification.
     *
     * @param string $phoneNumber
     * @return bool
     */
    public static function isValid(string $phoneNumber): bool
    {
        $meetsLengthRequirements = (strlen($phoneNumber) >= static::$minLength);
        $allNumeric = ctype_digit($phoneNumber);

        return $meetsLengthRequirements && $allNumeric;
    }
}
