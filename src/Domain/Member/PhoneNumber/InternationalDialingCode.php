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

use KeithMifsud\Demo\Domain\Common\ValueObject\CountryCallingCode;
use KeithMifsud\Demo\Domain\Common\ValueObject\ValueObject;
use KeithMifsud\Demo\Domain\Common\ValueObject\BaseValueObject;
use KeithMifsud\Demo\Domain\Member\Exception\InvalidPhoneNumber;


/**
 * The phone number's international
 * dialing code.
 *
 */
final class InternationalDialingCode extends BaseValueObject implements ValueObject
{

    /**
     * InternationalDialingCode constructor.
     *
     * @param string $countryCode
     * @throws
     */
    public function __construct(string $countryCode)
    {
        try {
            $enumeratedCode = CountryCallingCode::getByValue($countryCode);

        } catch (\Exception $exception) {
            throw new InvalidPhoneNumber(
                "Invalid international dialing code: " . (string)$countryCode
            );
        }
        $this->value = $enumeratedCode;
    }


    /**
     * Gets the value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return parent::getValue()->getValue();
    }

}
