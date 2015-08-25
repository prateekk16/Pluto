<?php namespace Pluto\Forms;

use Laracasts\Validation\FormValidator;

class StatusForm extends FormValidator {

	protected $rules = [
		'body' => 'required|max:65'
		
	];

} 