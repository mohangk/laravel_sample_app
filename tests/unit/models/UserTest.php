<?php
use Codeception\Util\Stub;
use AspectMock\Test;

class UserTest extends \Codeception\TestCase\Test {

    protected $user;

    protected function _before() {
      $this->user = new User(['name' => 'John Doe',
                              'email' => 'user@example.com',
                              'password' => 'password']);
    }
  
    protected function _after() {
      Test::clean();
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

    public function testRequiresUniqueEmail() {
      $this->user->save();

      $user = new User(['name' => 'Not John Doe',
                        'email' => 'user@example.com',
                        'password' => 'password']);

      $this->assertFalse($user->validate());
    }

    public function testMocking() {
      Test::double('User',['getAuthPassword' => '1234']);
      $user = new User;
      $this->assertEquals('1234', $user->getAuthPassword());
    }

}
