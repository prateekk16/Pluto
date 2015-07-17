<?php namespace Pluto\Forms;

use Laracasts\Validation\FormValidator;

class ProfileForm extends FormValidator {

	protected $rules = [
		'firstname'         => 'required',
		'lastname'              => 'required'
		
	];

} 