<?php

$I = new TestGuy($scenario);
$I->wantTo('sign in and see the home page');
$I->lookForwardTo('viewing the latest metrics');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/sign-in');
$I->fillField('input[name="email"]','mohan@example.com');
$I->fillField('input[name="password"]','password');
$I->click('Sign In');
$I->seeCurrentUrlEquals('');
$I->see('Users:', 'h1');
$I->see('Mohan Krishnan', 'ul li');
