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


use KeithMifsud\Demo\Domain\Common\ValueObject\BaseEnum;
use KeithMifsud\Demo\Domain\Common\ValueObject\BaseValueObject;
use KeithMifsud\Demo\Domain\Common\ValueObject\CountryEnum;
use KeithMifsud\Demo\Domain\Common\ValueObject\Enum;
use KeithMifsud\Demo\Domain\Common\ValueObject\ValueObject;
use KeithMifsud\Demo\Domain\Member\Exception\InvalidCountry;

/**
 * The country enumerator.
 *
 */
final class Country extends BaseValueObject implements ValueObject
{

    /**
     * Country constructor.
     *
     * @param string $countryCode
     * @throws InvalidCountry
     */
    public function __construct(string $countryCode)
    {
        try {
            $enumeratedCountry = CountryEnum::__callStatic($countryCode, []);
        } catch (\Exception $exception) {
            throw new InvalidCountry(
                "Invalid country code supplied " . (string)$countryCode
            );
        }

        $this->value = $enumeratedCountry;
    }
}
