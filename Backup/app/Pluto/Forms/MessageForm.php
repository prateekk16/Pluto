<?php namespace Pluto\Forms;

use Laracasts\Validation\FormValidator;

class MessageForm extends FormValidator {

	protected $rules = [
		'message' => 'required'
		
	];

} 