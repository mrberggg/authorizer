[![Build Status](https://travis-ci.org/mrberggg/authorizer.svg)](https://travis-ci.org/mrberggg/authorizer)
# Authorizer
A super simple role-based authorization package. The examples here use Eloquent but the library is framework-agnostic.

# Installation
`composer require berg/authorizer`

## Usage
Add the use statement for the trait to your user model:

    use Berg\Authorizer\AuthorizerTrait;
    
This trait requires that the user class has a method named `getRoles()` that will return an array of your role names. You can then access the `is` and `hasAccessTo` methods. Usage:

    $user->is('admin');
    
    $model = new ModelName($id);
    $user->hasAccessTo($model);

`is` and `hasAccessTo` both return a boolean value. `hasAccessTo` requires that the model you pass as an argument contains a method `authorize(User $user);`.

### `is(string $roleName)`
Example checking role:

    if($user->is('admin')) {}

### `hasAccessTo(User $user)`
To make a model authorizable, add the `Authorizable` interface to your model. This interface requires you add a single method, `authorize($user)` to your model. Add any required authorization logic in that method and return a boolean value.

    class Car 
    {
        public function authorize(User $user)
        {
            return $this->userId === $user->id;
        }
    }
    
    $carId = 1;
    $car = new Car($carId);
    if($user->hasAccessTo($car)) {}
