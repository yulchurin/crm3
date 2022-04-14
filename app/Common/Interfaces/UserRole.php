<?php

namespace App\Common\Interfaces;

interface UserRole
{
    public const OWNER = -100;
    public const ADMIN = -50;
    public const TEACHER = -20;
    public const INSTRUCTOR = -10;
}
