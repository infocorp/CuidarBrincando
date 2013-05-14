<?php

namespace Users;
use Users\AbstractUser;

class Professor extends AbstractUser
{
    public function getPermissions()
    {
        return parent::P_PROFESSOR;
    }

    public function getType()
    {
        return 'P';
    }
}