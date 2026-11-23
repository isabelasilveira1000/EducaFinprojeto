<?php

namespace App\Validators;

class UserValidator
{
    /** @return array<string,string> campo => mensagem de erro */
    public function validate(array $input): array
    {
        $errors = [];

        $name = $input['name'] ?? '';
        if (!is_string($name) || trim($name) === '') {
            $errors['name'] = 'Informe o nome.';
        } elseif (mb_strlen($name) > 100) {
            $errors['name'] = 'O nome deve ter no máximo 100 caracteres.';
        }

        $email = $input['email'] ?? '';
        if (!is_string($email) || mb_strlen($email) > 150
            || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Informe um e-mail válido.';
        }

        $phone = $input['phone'] ?? '';
        $digits = is_string($phone) ? preg_replace('/\D+/', '', $phone) : '';
        if (!is_string($phone) || $digits === '' || strlen($digits) < 10 || strlen($digits) > 15) {
            $errors['phone'] = 'Informe um telefone válido, com DDD.';
        }

        $password = $input['password'] ?? '';
        if (!is_string($password) || strlen($password) < 8) {
            $errors['password'] = 'A senha deve ter pelo menos 8 caracteres.';
        } elseif (strlen($password) > 72) {
            $errors['password'] = 'A senha deve ter no máximo 72 bytes.';
        }

        return $errors;
    }
}
