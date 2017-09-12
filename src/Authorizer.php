<?php 

namespace Berg\Authorizer;

class Authorizer
{

    protected $userRoles;

    public function __construct(array $userRoles)
    {
        $this->userRoles = $userRoles;
    }

    /**
     * Required that model has authorize method implemented
     * Check if user has access to model
     *
     * @param object $model
     * @param int $modelId
     * @return bool
     */
    public function hasAccessTo($user, $model)
    {
        return $model->authorize($user);
    }

    /**
     * Checks to see if user has role
     *
     * @param mixed $role
     * @return bool
     */
    public function is($role)
    {
        if (is_array($role)) {
            return $this->isUserRoleInArray($role);
        }

        return $this->hasRole($role);
    }

    /**
     * Check individual role
     *
     * @param $type
     * @return bool
     */
    private function hasRole($type)
    {
        return in_array($type, $this->userRoles);
    }

    /**
     * @param array $rolesArray
     * @return bool
     */
    private function isUserRoleInArray($rolesArray)
    {
        foreach ($rolesArray as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

}