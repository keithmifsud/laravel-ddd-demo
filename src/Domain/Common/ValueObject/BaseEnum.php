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

use MabeEnum\Enum;
use KeithMifsud\Demo\Domain\Common\ValueObject\Enum as Enumerator;


/**
 * An Adaptor for an Enum Value Object.
 *
 */
abstract class BaseEnum extends Enum
{

    /**
     * Gets the enumerator by value.
     *
     * @param $value
     * @return static
     */
    public static function getByValue($value)
    {
        return self::byValue($value);
    }

}
