<?php


namespace App\services;

use App\DTO\MovieDTO;

interface IMoviesService
{
    public function all(): array;
    public function find($id): MovieDTO;
    public function allPaginated(int $pag): array;
    public static function insert(MovieDTO $movie): bool;
    public static function delete(int $id): bool;
    public static function update(int $id, MovieDTO $movie): bool;
}