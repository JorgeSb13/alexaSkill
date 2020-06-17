<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Http\Requests\EmpresasRequest;
use Illuminate\Support\Facades\Log;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $campos = [
            'id',
            'nombre'
        ];

        $empresas = Empresa::select($campos)->get();

        return response()->json(compact('empresas'), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EmpresasRequest $request)
    {
        $data = $request->all();

        Log::info($data);

        Empresa::create($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $campos = [
            'nombre'
        ];

        $user = Empresa::select($campos)->findOrFail($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EmpresasRequest $request, $id)
    {
        $user = Empresa::where('id', $id)->firstOrFail();
        $data = $request->all();

        $user->update($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Empresa::findOrFail($id)->delete();

        return response()->json(['result' => 'ok'], 200);
    }
}
