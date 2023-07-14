<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
    ];

    /**
    * Get the users for the company.
    */

    public function users() {
        return $this->hasMany( User::class );
    }

    /**
    * Get the invitations for the company.
    */

    public function invitations() {
        return $this->hasMany( Invitation::class );
    }

}
