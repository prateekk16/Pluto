<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password'
    ];

       public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    public function info()
    {
        return $this->hasOne('UserInfo');
    }

    public function BrowsingInfo()
    {
        return $this->hasOne('UserBrowsingInfo');
    }


    public function isCurrent()
    {
        if (Auth::guest()) return false;
        return Auth::user()->id == $this->id;
    }

    /**
     * [register description]
     * @param  [type] $username [description]
     * @param  [type] $email    [description]
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public static function register($username,$email,$password){

        $user = new static(compact('username','email','password'));

        //raise an event

    }

}
