<?php

use Carbon\Carbon;
use Pluto\Messenger\Models\Thread;
use Pluto\Messenger\Models\Message;
use Pluto\Messenger\Models\Participant;
use Pluto\Forms\MessageForm;
use Laracasts\Commander\CommanderTrait;
use Pluto\Messenger\MessageRepository;
use Pluto\Messenger\PublishGlobalMessageCommand;

class MessagesController extends BaseController
{
    use CommanderTrait;


    /**
     * [$messageRepository description]
     * @var [type]
     */
    private $messageRepository;
    /**
     * [$messageForm description]
     * @var [type]
     */
    private $messageForm;
    /**
     * Just for testing - the user should be logged in. In a real
     * app, please use standard authentication practices
     */
   function __construct(MessageForm $messageForm,MessageRepository $messageRepository)
    {
        
        $this->messageRepository = $messageRepository;
        $this->messageForm = $messageForm;
        $this->beforeFilter('auth', ['only' => ['store','storeGlobal']]);
    
    }

    /**
     * Show all of the message threads to the user
     *
     * @return mixed
     */
    public function index()
    {
       
        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        $threads = Thread::getAllLatest()->get();
        return $threads;
        // All threads that user is participating in
        // $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();
        //return View::make('messenger.index', compact('threads', 'currentUserId'));
    }

    /**
     * Shows a message thread
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return Redirect::to('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return View::make('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread
     *
     * @return mixed
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return View::make('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants($input['recipients']);
        }

        return Redirect::to('messages');
    }

    /**
     * Stores a new message thread
     *
     * @return mixed
     */
    public function storeGlobal(){

        $input = Input::only('message');
        $this->messageForm->validate($input);
        $input = array_merge($input, ['user_id' => Auth::user()->id, 'global' => '1']);
        $message = $this->execute(PublishGlobalMessageCommand::class, $input);
        return $message->body;
            

    }

    /**
     * Adds a new message to a current thread
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return Redirect::to('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants(Input::get('recipients'));
        }

        return Redirect::to('messages/' . $id);
    }
}