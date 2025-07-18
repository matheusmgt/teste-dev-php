<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplyRequest;
use App\Repositories\SupplyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SupplyController extends Controller
{
    protected $supplyRepo;

    public function __construct(SupplyRepositoryInterface $supplyRepo)
    {
        $this->supplyRepo = $supplyRepo;
    }

    public function index(Request $request)
    {
        return response()->json($this->supplyRepo->index($request));
    }

    public function store(SupplyRequest $request)
    {
        $data = $request->validated();

        $supply = $this->supplyRepo->create($data);

        return response()->json($supply, 201);
    }

    public function update(SupplyRequest $request, $id)
    {
        $data = $request->validated();

        $updated = $this->supplyRepo->update($id, $data);

        if (!$updated) {
            return response()->json(['message' => 'Fornecedor não localizado'], 404);
        }

        return response()->json(['message' => 'Fornecedor atualizado com sucesso']);
    }

    public function find($id)
    {
        return response()->json($this->supplyRepo->find($id));
    }

    public function destroy($id)
    {
        $deleted = $this->supplyRepo->delete($id);

        if (!$deleted) {
            return response()->json(['message' => 'Fornecedor não localizado'], 404);
        }

        return response()->json(['message' => 'Fornecedor deletado com sucesso']);
    }
}