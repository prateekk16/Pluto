<?php

use Pluto\Forms\MessageForm;
use Pluto\Messenger\MessageRepository;
use Laracasts\Commander\CommanderTrait;
use Pluto\Messenger\PublishGlobalMessageCommand;


class MessagesController extends BaseController
 {
 	use CommanderTrait;

 	 private $messageRepository;
 	 private $messageForm;


 	 function __construct(MessageForm $messageForm,MessageRepository $messageRepository)
    {
        
        $this->messageRepository = $messageRepository;
        $this->messageForm = $messageForm;
        $this->beforeFilter('auth', ['only' => ['store','storeGlobal']]);
    
    }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('messages.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('messages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	public function storeGlobal()
	{
		$input = Input::only('message'); 
		$this->messageForm->validate($input);
		$input = array_merge($input, ['user_id' => Auth::user()->id, 'global' => '1']);
		$message = $this->execute(PublishGlobalMessageCommand::class, $input);
		return $message->body;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('messages.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('messages.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	

}
