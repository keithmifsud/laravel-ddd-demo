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

abstract class BaseUniqueIdentifier extends Uuid
{

    /**
     * Generates a unique identifier.
     *
     * @return \Ramsey\Uuid\UuidInterface
     */
    public function generate()
    {
        return Uuid::uuid4();
    }


    /**
     * Gets the identifier as a string.
     *
     * @return string
     */
    public function toString(): string
    {
        return parent::toString();
    }
}
