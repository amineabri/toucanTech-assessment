<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'school_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'name' => 'string',
        'email' => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, "school_id")->addSelect("id", "uuid", "school_name");
    }
}
