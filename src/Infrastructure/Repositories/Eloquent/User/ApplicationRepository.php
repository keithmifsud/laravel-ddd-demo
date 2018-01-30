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

namespace KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\User;

use KeithMifsud\Demo\Domain\Common\UniqueIdentifier\UniqueIdentifier;
use KeithMifsud\Demo\Application\Repositories\Authentication\UserRepository;

/**
 * Eloquent implementation of the application's user repository.
 *
 */
final class ApplicationRepository implements UserRepository
{

    /**
     * @var User
     */
    protected $model;


    /**
     * ApplicationRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }


    /**
     * Creates a new user in repository.
     *
     * @param UniqueIdentifier $identifier
     * @param string           $emailAddress
     * @param string           $password
     * @return mixed
     */
    public function createNewUser(
        UniqueIdentifier $identifier,
        string $emailAddress,
        string $password
    ) {

        return $this->model->create([
            'user_identifier' => $identifier->toString(),
            'email' => $emailAddress,
            'password' => $password
        ]);
    }


    /**
     * Gets a user by its unique identifier.
     *
     * @param UniqueIdentifier $identifier
     * @return mixed
     */
    public function getUserByIdentifier(UniqueIdentifier $identifier)
    {
        return $this->model->where([
            'user_identifier' => $identifier->toString()
        ])->get();
    }
}
