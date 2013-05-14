<?php

namespace Users;
use Users\AbstractUsers;

class EducadorBolsista extends AbstractUsers
{
    public function getPermissions()
    {
        return parent::P_EDUCADOR_BOLSISTA;
    }

    public function getType()
    {
        return 'E_B';
    }
}