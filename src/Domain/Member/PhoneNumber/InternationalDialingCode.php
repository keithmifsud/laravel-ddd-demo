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
     * @var CountryCallingCode
     */
    protected $countryCode;


    /**
     * InternationalDialingCode constructor.
     *
     * @param string $countryCode
     * @throws
     */
    public function __construct(string $countryCode)
    {

        $testEnum = new CountryCallingCode(CountryCallingCode::GBR);
        var_dump($testEnum->getKey());

        try {
/*            $enumeratedCode = CountryCallingCode::__callStatic(
                $countryCode,
                []
            );*/

            //$enumeratedCode = new CountryCallingCode($countryCode);
            $enumeratedCode = CountryCallingCode::values();
            var_dump($enumeratedCode->getKey());
        } catch (\Exception $exception) {
            throw new InvalidPhoneNumber(
                "Invalid international dialing code: " . (string)$countryCode
            );
        }
        $this->countryCode = $enumeratedCode->getKey();
        //var_dump($this->countryCode);
        $this->value = $enumeratedCode->getValue();
    }


    /**
     * Gets the country's code in ISO Alpha 3 format
     * corresponding to the international dialing code.
     *
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->getValue()->getKey();
    }
}
