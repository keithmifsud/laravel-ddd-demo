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

namespace KeithMifsud\Demo\Domain\Member;

use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\BaseUniqueIdentifier;
use KeithMifsud\Demo\Domain\Common\ValueObject\BaseValueObject;
use KeithMifsud\Demo\Domain\Common\ValueObject\ValueObject;

/**
 * A member's unique identifier.
 *
 */
final class MemberIdentifier extends BaseValueObject implements
    ValueObject
{

    /**
     * MemberIdentifier constructor.
     *
     * @param UniqueIdentifier $identifier
     */
    public function __construct(UniqueIdentifier $identifier)
    {
        $this->value = $identifier;
    }
}
