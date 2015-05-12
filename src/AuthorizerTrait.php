<?php namespace Berg\Authorizer;

trait AuthorizerTrait
{
    protected $authorizer;
    protected function initializeAuthorizer()
    {
        if(!$this->authorizer){
            $roles = $this->getRoles();
            $this->authorizer = new Authorizer($roles);
        }
    }

    public function is($role)
    {
        $this->initializeAuthorizer();
        return $this->authorizer->is($role);
    }

    public function hasAccessTo($model)
    {
        $this->initializeAuthorizer();
        $user = $this;
        return $this->authorizer->hasAccessTo($user, $model);
    }
}