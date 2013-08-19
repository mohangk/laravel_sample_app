<?php

$I = new TestGuy($scenario);
$I->wantTo('sign in and see the home page');
$I->lookForwardTo('viewing the latest metrics');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');
$I->see('Users:', 'h1');
$I->see('Mohan Krishnan', 'tbody tr td');
