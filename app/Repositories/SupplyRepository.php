<?php

namespace App\Repositories;

use App\Models\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SupplyRepository implements SupplyRepositoryInterface
{
    public function index(Request $request): array
    {
        $searchName = Arr::get($request, 'filter.search');
        $typeSupply = Arr::get($request, 'filter.category');
        $state      = Arr::get($request, 'filter.uf');

        return Supply::when($typeSupply, function ($query) use ($typeSupply) {
            $query->where('type', $typeSupply);
        })->when($state, function ($query) use ($state) {
            $query->where('state', $state);
        })->when($searchName, function ($query) use ($searchName) {
            $query->where('name', 'like', "%{$searchName}%")
              ->orWhere('social_name', 'like', "%{$searchName}%")
              ->orWhere('cpf', 'like', "%{$searchName}%")
              ->orWhere('cnpj', 'like', "%{$searchName}%")
              ->orWhere('address', 'like', "%{$searchName}%")
              ->orWhere('city', 'like', "%{$searchName}%");
        })->get()->toArray();
    }

    public function create(array $data): Supply
    {
        return Supply::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $supply = $this->find($id);

        if (!$supply) {
            return false;
        }

        return $supply->update($data);
    }

    public function delete(int $id): bool
    {
        $supply = $this->find($id);

        if (!$supply) {
            return false;
        }

        return $supply->delete();
    }

    public function find(int $id): ?Supply
    {
        return Supply::find($id);
    }
}