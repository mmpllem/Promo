<?php

namespace App\Domain\Dto;

class NewUserDto
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $email;
    public ?string $password;
    public ?string $confirmPassword;
    public array $roles;
}
