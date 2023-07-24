<?php

use yii\base\Security;

$security = new Security();

return [
    [
        'username' => 'mohit',
        'first_name' => 'mohit',
        'last_name' => 'kumar',
        'auth_key' => 'tUu1qHcde0diwUol3xeI-18MuHkkprQI',
        'role' => 'ADMIN',
        'password_hash' => $security->generatePasswordHash('mohitkumar'),
        'password_reset_token' => 'RkD_Jw0_8HEedzLk7MM-ZKEFfYR7VbMr_1392559490',
        'created_at' => '1392559490',
        'updated_at' => '1392559490',
        'email' => 'mohitkumar@gmail.com',
    ],
];
