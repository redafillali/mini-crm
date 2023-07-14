<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model {
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    */
    protected $fillable = [
        'inviter_id',
        'company_id',
        'invitee_email',
        'status',
        'token',
        'accepted_at',
        'declined_at',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'accepted_at' => 'datetime',
        'declined_at' => 'datetime',
    ];

    /**
    * Get the inviter that owns the invitation.
    */

    public function inviter() {
        return $this->belongsTo( User::class );
    }

    /**
    * Get the company that owns the invitation.
    */

    public function company() {
        return $this->belongsTo( Company::class );
    }

    /**
    * Get the invitee that owns the invitation.
    */

    public function invitee() {
        return $this->belongsTo( User::class );
    }
}
