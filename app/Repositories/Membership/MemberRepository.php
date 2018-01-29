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


namespace KeithMifsud\Demo\Application\Repositories\Membership;

use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;
use KeithMifsud\Demo\Domain\Member\Member;

/**
 * The application's member repository.
 *
 */
interface MemberRepository
{

    /**
     * Stores new member.
     *
     * @param Member $member
     * @return int|null
     */
    public function storeNewMember(Member $member) : ?int ;


    /**
     * Updates a member's profile in storage.
     *
     * @param Member $member
     * @return mixed
     */
    public function updateProfile(
        Member $member
    );


    /**
     * Gets the member from storage.
     *
     * @param UniqueIdentifier $memberIdentifier
     * @return null|\stdClass
     */
    public function getMember(UniqueIdentifier $memberIdentifier) : ?\stdClass ;
}
