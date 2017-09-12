<?php 

namespace Berg\Authorizer;

interface Authorizable
{
    /**
     * Model you want to authorize user for must implement an authorize method.
     *
     * @param $user
     * @return bool
     */
    public function authorize($user);
}