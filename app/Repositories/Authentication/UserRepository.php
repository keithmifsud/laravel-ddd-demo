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


namespace KeithMifsud\Demo\Application\Repositories\Authentication;

use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;
use stdClass;

/**
 * The application's user repository.
 *
 */
interface UserRepository
{

    /**
     * Creates a new user.
     *
     * @param UniqueIdentifier $userIdentifier
     * @param string           $emailAddress
     * @param string           $password
     * @return int|null
     */
    public function createNewUser(
        UniqueIdentifier $userIdentifier,
        string $emailAddress,
        string $password
    );


    /**
     * Gets a user by its identifier.
     *
     * @param UniqueIdentifier $identifier
     * @return null|stdClass
     */
    public function getUserByIdentifier(UniqueIdentifier $identifier);

}
