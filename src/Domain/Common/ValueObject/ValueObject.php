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

/**
 * A contract for value objects.
 *
 */
interface ValueObject
{

    /**
     * Gets the value.
     *
     * @return mixed
     */
    public function getValue();


    /**
     * Gets the value as a string representation.
     *
     * @return string
     */
    public function toString() : string ;

    /**
     * Determines whether this and the other value objects
     * have the same value.
     *
     * @param ValueObject $other
     * @return bool
     */
    public function sameValueAs(ValueObject $other) : bool ;
}
