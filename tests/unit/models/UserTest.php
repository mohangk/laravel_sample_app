<?php

class UserTest extends \Codeception\TestCase\Test {

  use Codeception\Specify;

  protected $user;

  protected function _before() {
    $this->user = new User(['name' => 'John Doe',
                            'email' => 'user@example.com',
                            'password' => 'password']);
  }

  public function testValidations() {
    $this->assertTrue($this->user->isValid());

    $this->specify("name is required", function() {
      $this->user->name = null;
      $this->assertFalse($this->user->isValid());
      $this->assertRegExp('/required/',
                          $this->user->errors()->first('name'));
    });  

    $this->specify("email is required", function() {
      $this->user->email = null;
      $this->assertFalse($this->user->isValid());
      $this->assertRegExp('/required/',
                          $this->user->errors()->first('email'));
    });

    $this->specify("email must be well formatted", function() {
      $this->user->email = 'foobar';
      $this->assertFalse($this->user->isValid());
      $this->assertRegExp('/invalid/',
                          $this->user->errors()->first('email'));
    });

    $this->specify("email must be unique", function() {
      $this->user->save();

      $user = new User(array_only($this->user->getAttributes(), ['email', 'name', 'password']));
      $this->assertFalse($user->save());

      $this->assertRegExp('/been taken/',
                          $user->errors()->first('email'));
    });
  }

}
