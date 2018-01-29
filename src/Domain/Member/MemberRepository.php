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

/**
 * The members' repository.
 *
 */
interface MemberRepository
{

    /**
     * Gets an existing member's profile by its
     * identifier.
     *
     * @param UniqueIdentifier $memberIdentifier
     * @return \stdClass|null
     */
    public function getExistingMemberProfile(
        UniqueIdentifier $memberIdentifier
    );
}
