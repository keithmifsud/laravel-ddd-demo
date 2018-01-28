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

use KeithMifsud\Demo\Domain\Common\ValueObject\BaseValueObject;
use KeithMifsud\Demo\Domain\Common\ValueObject\ValueObject;


/**
 * Street address.
 *
 */
final class Street extends BaseValueObject implements ValueObject
{


    /**
     * Street constructor.
     *
     * @param string $streetAddress
     */
    public function __construct(string $streetAddress)
    {
        $this->value = $streetAddress;
    }
}
