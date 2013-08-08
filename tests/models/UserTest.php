<?php

class UserTest extends TestCase {

  protected $user;

  public function setUp() {
    parent::setUp();

    $this->user = new User(['name' => 'Tommy Sullivan',
                            'email' => 'tommy@example.com',
                            'password' => 'password']);
  }

  public function testRequiresName() {
    $this->assertTrue($this->user->validate());
    $this->user->name = null;
    $this->assertFalse($this->user->validate());
  }

  public function testRequiresValidEmail() {
    $this->assertTrue($this->user->validate());
    $this->user->email = 'foobar';
    $this->assertFalse($this->user->validate());
  }

}

