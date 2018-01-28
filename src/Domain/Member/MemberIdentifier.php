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

/**
 * A member's unique identifier.
 *
 */
final class MemberIdentifier extends BaseUniqueIdentifier implements
    UniqueIdentifier
{

    protected $value;


    public static function generate()
    {
        return new self(
            parent::generate()
        );
    }


    public function __construct($identifier)
    {
        $this->value = $identifier;
    }
}
