<?php
namespace Pluto\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Eloquent, Hash;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Registration\Events\UserRegistered;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator, Messagable;

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


     /**
      * [setPasswordAttribute description]
      * @param [type] $password [description]
      */
     
       public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    public function info()
    {
        return $this->hasOne('UserInfo');
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

        $path = public_path();
        $parentDir = $path.'/img/users/'.$email.'/'; 

         if (!file_exists($parentDir)) {
                    mkdir($parentDir, 0777, true);
                }
                
         $user->raise(new UserRegistered($user));
        
         return $user;

    }


    /**
     * Has Many Statuses
     * @return [type] [description]
     */
    public function statuses(){
        return $this->hasMany('Pluto\Statuses\Status');
    }

    public function messages(){
         return $this->hasMany('Pluto\Messenger\Models\Message');
    }

    /**
     * [Has One User info]
     * @return [type] [description]
     */
    public function userinfo(){
        return $this->hasOne('Pluto\Users\UserInfo');
    }

     public function favourites(){
         return $this->belongsToMany('Favourites', 'favourite_user', 'user_id', 'favourite_id');
    }


    

}
