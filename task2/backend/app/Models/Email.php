<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserRefID', 'emailID', 'emailaddress', 'Default',
    ];

    /**
     * Get the profile that owns the email.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'UserRefID', 'UserRefID');
    }
}
