<?php namespace Berg\Authorizer;

use Berg\Authorizer\Exceptions\RolesException;

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
     * @return boolean
     */
    public function hasAccessTo($user, $model)
    {
        return $model->authorize($user);
    }

    /**
     * Checks to see if user has role
     *
     * @param mixed $role
     * @return boolean
     */
    public function is($role)
    {
        if (is_array($role)) {
            return $this->isUserRoleInArray($role);
        }
        $this->verifyRoleExists($role);

        return in_array($role, $this->userRoles);
    }

    /**
     * @param array $rolesArray
     * @return bool
     */
    private function isUserRoleInArray($rolesArray)
    {
        foreach ($rolesArray as $role) {
            if ($this->is($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verify role exists
     *
     * @param $type
     * @throws RolesException
     */
    private function verifyRoleExists($type)
    {
        if (!in_array($type, $this->userRoles)) {
            throw new RolesException('Role not found');
        }
    }
}