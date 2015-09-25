<?php

namespace Pluto\Uploads\Models;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Uploads\Events\FriendsUploadPublished;
use Pluto\Users\User;

class Upload extends \Eloquent {

    use EventGenerator;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'quick_uploads';
    
    /**
     * Fillable fields for a Profile
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'global','file'
    ];

    /**
     * A profile belongs to a user
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

     public static function publish($user_id,$global,$file){

        $upload = new static(compact('user_id','global','file'));
        $upload->raise(new FriendsUploadPublished($user_id,$global,$file));
        return $upload;

     }
}
