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

use Ramsey\Uuid\Uuid;

/**
 * An extensible unique identifier.
 *
 * Serves as an adaptor to the Uuid package.
 */
class BaseUniqueIdentifier implements UniqueIdentifier
{

    /**
     * @var mixed
     */
    protected $identifier;


    /**
     * Generates a unique identifier.
     *
     * @return UniqueIdentifier
     */
    public static function generate(): UniqueIdentifier
    {
        return new self(Uuid::uuid4());
    }


    /**
     * Gets the identifier from a string.
     *
     * @param string $identifier
     * @return UniqueIdentifier
     */
    public static function fromString(string $identifier): UniqueIdentifier
    {
        return new self(Uuid::fromString($identifier));
    }


    /**
     * BaseUniqueIdentifier constructor.
     *
     * @param $identifier
     */
    protected function __construct($identifier)
    {
        $this->identifier = $identifier;
    }


    /**
     * Gets the identifier as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->identifier->toString();
    }


    /**
     * Determines if both identifiers
     * have the same value.
     *
     * @param UniqueIdentifier $otherIdentifier
     * @return bool
     */
    public function sameValueAs(UniqueIdentifier $otherIdentifier): bool
    {
        return $this->toString() == $otherIdentifier->toString();
    }
}
