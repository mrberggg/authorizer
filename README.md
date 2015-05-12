[![Build Status](https://travis-ci.org/mrberggg/authorizer.svg)](https://travis-ci.org/mrberggg/authorizer)
# Laravel Authorizer
A super simple role-based authorization package.

# Installation
`composer require berg/authorizer`

## Usage
Add the use statement for the trait:

    use Berg\Authorizer\AuthorizerTrait;
    
This trait assumes you have a method named `getRoles()` that will return an array of your role names. You can then access the `is` and `hasAccessTo` methods. Usage:

    $user->is('admin');
    
    $model = new ModelName(1);
    $user->hasAccessTo($model);

All Methods return a boolean value.

### Check User's Role
Example checking role:

    if($user->is('admin')) {}

### Authorizing Models
To authorize models, include an authorize method in the model you wish to have authorized. The method should accept the user to be authorized and the model ID and should return a boolean value. For example:

    $modelInstance = new ModelName(1);
    if($user->hasAccessTo($modelInstance)) {}
    
Example model authorize implementation

    public function authorize(User $user)
    {
        return $this->userId === $user->id;
    }