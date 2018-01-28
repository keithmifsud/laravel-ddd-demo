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
 * An extensible value object.
 *
 */
abstract class BaseValueObject
{

    /**
     * @var mixed
     */
    protected $value;


    /**
     * Gets the value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Gets the value as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return (string)$this->getValue();
    }


    /**
     * Determines whether this and the other value objects
     * have the same value.
     *
     * @param ValueObject $other
     * @return bool
     */
    public function sameValueAs(ValueObject $other) : bool
    {
        return $this->getValue() == $other->getValue();
    }
}
