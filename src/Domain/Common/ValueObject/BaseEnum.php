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

namespace KeithMifsud\Demo\Domain\Common\ValueObject;

use MyCLabs\Enum\Enum;


/**
 * An Adaptor for an Enum Value Object.
 *
 */
abstract class BaseEnum extends Enum
{


    /**
     * Gets the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return parent::getValue();
    }


    /**
     * Gets the string representation of the Enum.
     *
     * @return string
     */
    public function toString(): string
    {
        return (string)$this->getValue();
    }
}
