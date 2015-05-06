[![Build Status](https://travis-ci.org/mrberggg/authorizer.svg)](https://travis-ci.org/mrberggg/authorizer)
Laravel Authorizer
==================

A super simple role-based authorization package. Includes a Service Provider for use with Laravel 5.


Installation
------------
`composer require berg/authorizer`

Usage
-----

In the User model, insert the following code:

    use AuthorizerTrait;
    protected $authorizer;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $roles = Role::lists('name'); // Just need an array of the user's role names
        $this->authorizer = App::make('Authorizer', $roles);
    }

Optionally, add the use statement for the trait:

    use Berg\Authorizer\AuthorizerTrait;
    
This allows you to directly access the `is` and `hasAccessTo` methods. Usage:

    $user->is('admin');
    
    $id = 1;
    $model = new ModelName();
    $user->hasAccessTo($model, $id);

Laravel Config
--------------
If using Laravel, add the following line to the providers array:

    'Berg\Authorizer\AuthorizerServiceProvider',


Check User's Role
-----------------

Example checking role:

    if($user->is('admin')) {}


Authorizing Models
------------------

To authorize models, include an authorize method in the model you wish to have authorized. The method should accept the user to be authorized and the model ID and should return a boolean value. For example:

    $modelInstance = new ModelName(1);
    if($user->hasAccessTo($modelInstance)) {}
    
Example model authorize implementation

    public function authorize(User $user)
    {
        return $this->userId === $user->id;
    }
    