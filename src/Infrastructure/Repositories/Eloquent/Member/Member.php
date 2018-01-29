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

use Illuminate\Database\Eloquent\Model;
use KeithMifsud\Demo\Infrastructure\Repositories\Eloquent\User\User;

/**
 * The Member Eloquent data model.
 *
 */
class Member extends Model
{

    /**
     * @var string
     */
    protected $table = 'members';


    /**
     * @var array
     */
    protected $fillable = [
        'user_identifier',
        'first_name',
        'last_name',
        'international_dialling_code',
        'domestic_phone_number',
        'street_address',
        'city',
        'region',
        'country_code',
        'city',
    ];


    /**
     * Member belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_identifier');
    }
}
