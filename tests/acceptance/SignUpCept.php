<?php

$I = new WebGuy($scenario);
$I->wantTo('sign up and see it in the database');
$I->amOnPage('/sign-up');
$I->fillField('name','John Doe');
$I->fillField('email','user@example.com');
$I->fillField('password','password');
$I->click('Sign Up');

// This isn't working properly because the Db module
// isn't working for pgsql
//
$I->seeInDatabase('users', ['email' => 'user@example.com' ]);

$I->seeCurrentUrlEquals('/');
$I->see('Users:', 'h1');
$I->see('John Doe', 'tbody');
