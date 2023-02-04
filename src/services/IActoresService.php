<?php


namespace App\services;

interface IActoresService
{
    public function findActoresByIdPelicula($id): array;
}