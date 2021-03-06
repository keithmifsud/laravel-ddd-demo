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

/**
 * An extensible Member Repository.
 *
 */
abstract class Repository
{

    /**
     * @var Member
     */
    protected $model;


    /**
     * Repository constructor.
     *
     * @param Member $model
     */
    public function __construct(Member $model)
    {
        $this->model = $model;
    }
}
