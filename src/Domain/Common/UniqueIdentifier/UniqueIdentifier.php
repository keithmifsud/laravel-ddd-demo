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


namespace KeithMifsud\Demo\Domain\Common\UniqueIdentifier;

/**
 * Unique identifier contract.
 *
 */
interface UniqueIdentifier
{

    /**
     * Generates a unique identifier.
     *
     * @return mixed
     */
    public static function generate(): UniqueIdentifier;


    /**
     * Gets an identifier from its string.
     *
     * @param string $identifier
     * @return UniqueIdentifier
     */
    public static function fromString(string $identifier): UniqueIdentifier;


    /**
     * Gets the identifier as a string.
     *
     * @return string
     */
    public function toString(): string;


    /**
     * Determines if both identifier have the
     * same value.
     *
     * @param UniqueIdentifier $otherIdentifier
     * @return bool
     */
    public function sameValueAs(UniqueIdentifier $otherIdentifier): bool;
}
