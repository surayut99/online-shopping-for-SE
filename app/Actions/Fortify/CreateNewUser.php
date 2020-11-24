<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ],
        [
            'name.required' => "กรุณากรอก display name",
            "email.required" => "กรุรากรอกอีเมล์",
            "email.email" => "กรุรากรอกข้อมูลในรูปแบบของอีเมล์",
            "email.unique" => "อีเมล์นี้ถูกลงทะเบียนไว้แล้ว",
            "password.requied" => "กรุณากรอกรหัสผ่าน",
            "password.min" => "กรุรากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร"
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
