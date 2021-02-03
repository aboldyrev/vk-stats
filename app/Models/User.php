<?php

namespace App\Models;

use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'has_access',
		'deactivated',
		'is_closed',
		'can_access_closed',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'is_closed'         => 'boolean',
		'can_access_closed' => 'boolean',
	];


	public function getAuthIdentifierName() {
		return 'email';
	}


	public function setPasswordAttribute($value) {
		$this->attributes[ 'password' ] = Hash::make($value);
	}
}
