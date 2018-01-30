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
use KeithMifsud\Demo\Domain\Member\MemberRepository;
use KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\Member\Member;
use KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\Member\DomainRepository;

/**
 * Service provider for domain repositories.
 *
 * Handles repository implementation bindings.
 */
class DomainRepositoryServiceProvider extends ServiceProvider
{

    /**
     * Registers the bindings.
     *
     */
    public function register()
    {
        $this->app->bind(
            MemberRepository::class,
            DomainRepository::class
        );
    }
}
