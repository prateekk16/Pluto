<?php 
namespace Pluto\Messenger\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Pluto\Messenger\Events\GlobalMessagePublished;
use Laracasts\Commander\Events\EventGenerator;
use Crypt;

class Message extends \Eloquent
{
    use EventGenerator;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['thread'];

    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['thread_id', 'user_id', 'body', 'global'];

    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'body' => 'required',
    ];

   


    /**
     * Thread relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo('Pluto\Messenger\Models\Thread');
    }

    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Pluto\Users\User');
       // return $this->belongsTo(Config::get('messenger::user_model'));
    }

    /**
     * Participants relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('Pluto\Messenger\Models\Participant', 'thread_id', 'thread_id');
    }

    /**
     * Recipients of this message
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recipients()
    {
        return $this->participants()->where('user_id', '!=', $this->user_id);
    }

    /**
     * Returns all of the latest threads by updated_at date
     *
     * @return mixed
     */
    public static function getAllLatestGlobal()
    {
        $rows =  self::latest('updated_at')->where('global','1')->take(10)->get();
        return $rows->reverse();
    }

    /**
     * Publish a new status
     * @param  [type] $body [description]
     * @return [type]       [description]
     */
    public static function publish($user_id,$body,$global){
         

          $body = Crypt::encrypt($body);

          $message = new static(compact('user_id','body','global'));

          $message->raise(new GlobalMessagePublished($user_id,$body));
        
          return $message;
    }

   /**
    * Decrypt Messages
    * @param  [type] $msg [Encrypted Message]
    * @return [type]      [Decrypted Message]
    */
   public static function decryptMain($msg){
     return Crypt::decrypt($msg);
   }
}
