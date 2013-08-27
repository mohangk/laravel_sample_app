<?php

use Woodling\Woodling;

class UserTest extends \Codeception\TestCase\Test {

  use Codeception\Specify;

  public function testFactory() {
    $user = Woodling::retrieve('User');

    $this->specify("should be valid", function() use($user) {
      $this->assertTrue($user->isValid());
    });
  }

  public function testValidations() {

    $this->specify("name is required", function() {
      $user = Woodling::retrieve('User', ['name' => null]);
      $this->assertFalse($user->isValid());
      $this->assertRegExp('/required/',
                          $user->errors()->first('name'));
    });

    $this->specify("email is required", function() {
      $user = Woodling::retrieve('User', ['email' => null]);
      $this->assertFalse($user->isValid());
      $this->assertRegExp('/required/',
                          $user->errors()->first('email'));
    });

    $this->specify("email must be well formatted", function() {
      $user = Woodling::retrieve('User', ['email' => 'foobar']);
      $this->assertFalse($user->isValid());
      $this->assertRegExp('/invalid/',
                          $user->errors()->first('email'));
    });

    $this->specify("email must be unique", function() {
      $user = Woodling::saved('User');

      $duplicateUser = Woodling::retrieve('User', ['email' => $user->email]);
      $this->assertFalse($duplicateUser->save());
      $this->assertRegExp('/been taken/',
                          $duplicateUser->errors()->first('email'));
    });

  }
  /**
   * These update tests are more orientated to testing the integration of the Validatable trait with the update method
   */
   public function testUpdate() {
     $user = Woodling::saved('User');
     $this->specify("returns false when there is a validation error", function() use($user){
       $this->assertFalse($user->update(['email' => null]));
     });

     $this->specify("returns false when there is a validation error", function() use($user){
       $this->assertCount(0, User::where('email','test@yahoo.com')->get());
       $this->assertTrue($user->update(['email' => 'test@yahoo.com']));
       $this->assertCount(1, User::where('email','test@yahoo.com')->get());
     });
   }
}


