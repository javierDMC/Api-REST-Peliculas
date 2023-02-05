<?php

namespace App\validator;

interface IValidator {

    public static function validadorCamposCreate(array $movie);

    public static function validadorCamposUpdate(int $id, array $movie);

    public static function validadorCamposUsuarioNuevo(array $user);

    public static function validadorCamposUsuario(array $user);

    }