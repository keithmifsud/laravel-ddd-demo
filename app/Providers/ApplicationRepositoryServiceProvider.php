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

namespace KeithMifsud\Demo\Application\Providers;

use Illuminate\Support\ServiceProvider;
use KeithMifsud\Demo\Application\Repositories\Membership\MemberRepository;
use KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\Member\ApplicationRepository;
use KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\Member\Member;

/**
 * A service provider for the application repositories
 * implementation bindings.
 *
 */
class ApplicationRepositoryServiceProvider extends ServiceProvider
{


    /**
     * Registers the bindings.
     *
     */
    public function register()
    {
        $this->app->bind(
            MemberRepository::class,
            new ApplicationRepository(new Member())
        );
    }
}
