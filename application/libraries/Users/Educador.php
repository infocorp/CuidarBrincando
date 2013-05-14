<?php

namespace Users;
use Users\AbstractUser;

class Educador extends AbstractUser
{
    public function getPermissions()
    {
        return parent::P_EDUCADOR;
    }

    public function getType()
    {
        return 'E';
    }
}