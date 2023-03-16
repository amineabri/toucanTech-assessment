<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserRefID', 'Firstname', 'Surname', 'Deceased',
    ];

    /**
     * Get the emails for the profile.
     */
    public function emails(): HasMany
    {
        return $this->hasMany(Email::class, 'UserRefID', 'UserRefID');
    }
}
