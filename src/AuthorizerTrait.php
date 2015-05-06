<?php namespace Berg\Authorizer;

trait AuthorizerTrait
{
    public function is($role)
    {
        return $this->authorizer->is($role);
    }

    public function hasAccessTo($model)
    {
        return $this->authorizer->hasAccessTo($this, $model);
    }
}