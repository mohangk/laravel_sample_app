<?php

$I = new WebGuy($scenario);
$I->wantTo('sign up and see it in the database');
$I->amOnPage('/sign-up');
$I->fillField('name','John Doe');
$I->fillField('email','user@example.com');
$I->fillField('password','password');
$I->fillField('password_confirmation','password');
$I->click('Sign Up');

// This isn't working properly because the DB isn't being seeded and
// rolled back.  Right now it's running against the 'production' database!?
//
// $I->seeInDatabase('users', ['email' => 'user@example.com' ]);

// $I->seeCurrentUrlEquals('/');
// $I->see('Users:', 'h1');
// $I->see('John Doe', 'ul li');
