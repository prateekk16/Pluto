<?php 
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for a Pluto account');

$I->amOnPage('/');
$I->click('Sign Up');
$I->seeCurrentUrlEquals('/register');

$I->fillField('Username:', 'JohnDoe');
$I->fillField('Email:', 'john@example.com');
$I->fillField('Password:', 'demo');
$I->fillField('Password Confirmation:', 'demo');
$I->fillField('Firstname:', 'John');
$I->fillField('Lastname:', 'Doe');
$I->click('Sign Up');

$I->seeCurrentUrlEquals('');
$I->see('Welcome,');
