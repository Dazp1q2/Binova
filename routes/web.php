<?php

return [
    '' => 'HomeController@index',
    'propiedades' => 'PropiedadController@index',
    'login' => 'AuthController@showLoginForm',
    'login/submit' => 'AuthController@login',
    'register' => 'AuthController@showRegisterForm',
    'register/submit' => 'AuthController@register',
    'recover-password' => 'AuthController@showRecoverPasswordForm',
    'recover-password/submit' => 'AuthController@recoverPassword',
    'logout' => 'AuthController@logout',
];
