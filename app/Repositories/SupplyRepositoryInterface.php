<?php

namespace App\Repositories;

use App\Models\Supply;
use Illuminate\Http\Request;

interface SupplyRepositoryInterface
{
    public function index(Request $request): array;

    public function create(array $data): Supply;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function find(int $id): ?Supply;
}