<?php 

namespace Users;
use Users\AbstractUser;

class Admin extends AbstractUser
{
    public function getPermissions()
    {
        return parent::P_ADMIN;
    }

    public function getType()
    {
        return 'A';
    }
}