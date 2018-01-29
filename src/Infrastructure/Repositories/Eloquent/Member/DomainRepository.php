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

namespace KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\Member;

use KeithMifsud\Demo\Domain\Member\MemberRepository;
use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;

/**
 * Eloquent implementation of the member domain
 * repository.
 *
 */
final class DomainRepository extends Repository implements MemberRepository
{


    /**
     * Gets the member's profile.
     *
     * @param UniqueIdentifier $identifier
     * @return mixed
     */
    public function getExistingMemberProfile(UniqueIdentifier $identifier)
    {
        return $this->model->where([
            'user_identifier',
            $identifier->toString()
        ])->get();
    }
}
