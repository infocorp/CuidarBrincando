<?php

namespace Users;

abstract class AbstractUser
{
    const P_ADMIN = 1;
    const P_PROFESSOR = 2;
    const P_EDUCADOR = 3;
    const P_EDUCADOR_BOLSISTA = 4;

    abstract public function getPermissions();

    abstract public function getType();
}