<?php namespace Pluto\Forms;

use Laracasts\Validation\FormValidator;

class EmailValidate extends FormValidator {

	protected $rules = [
		'email' => 'required|email',
		
	];

} 