<?php

use Mockery as m;
use Berg\Authorizer\Authorizer;

class AuthorizerTest extends PHPUnit_Framework_TestCase {
    protected $authorizer;

    public function setUp()
    {
        $roles = ['employee'];
        $this->authorizer = new Authorizer($roles);
    }

    public function testIsUserRole()
    {
        $this->assertTrue($this->authorizer->is('employee'));
    }

    public function testUserHasRoleInArray()
    {
        $this->assertTrue($this->authorizer->is(['admin', 'employee']));
    }

    public function testUserDoesNotHaveRole()
    {
        $this->assertFalse($this->authorizer->is('admin'));
    }

    public function testUserDoesNotHaveRoleInArray()
    {
        $this->assertFalse($this->authorizer->is(['admin', 'student']));
    }

    public function testUserHasAccessToModel()
    {
        $model = m::mock('Model');
        $user = m::mock('User');
        $model->shouldReceive('authorize')->andReturn(true);
        $this->assertTrue($this->authorizer->hasAccessTo($user, $model));
    }

    public function testUserDoesNotHaveAccessToModel()
    {
        $model = m::mock('Model');
        $user = m::mock('User');
        $model->shouldReceive('authorize')->andReturn(false);
        $this->assertFalse($this->authorizer->hasAccessTo($user, $model));
    }

}