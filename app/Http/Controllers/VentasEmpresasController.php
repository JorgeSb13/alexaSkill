<?php

namespace App\Http\Controllers;

use App\Http\Requests\VentasEmpresasRequest;
use App\VentaEmpresa;
use Illuminate\Support\Facades\Log;

class VentasEmpresasController extends Controller
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
            'empresa_id',
            'venta',
            'mes'
        ];

        $users = VentaEmpresa::select($campos)->get();

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VentasEmpresasRequest $request)
    {
        $data = $request->all();

        Log::info($data);

        VentaEmpresa::create($data);

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
            'empresa_id',
            'venta',
            'mes'
        ];

        $user = VentaEmpresa::select($campos)->findOrFail($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VentasEmpresasRequest $request, $id)
    {
        $user = VentaEmpresa::where('id', $id)->firstOrFail();
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
        VentaEmpresa::findOrFail($id)->delete();

        return response()->json(['result' => 'ok'], 200);
    }

    public function totalSold($empresa_id)
    {
        $campos = [
            'venta',
            'mes'
        ];

        $sells = VentaEmpresa::select($campos)
            ->where('empresa_id', $empresa_id)
            ->get();

        $total = 0;
        foreach ($sells as $sell) {
            $total += $sell->venta;
            $sell->venta = "$" . number_format($sell->venta, 2, '.', ',');;
        }

        $totalFormat = number_format($total, 2, '.', ',');

        $total_sell = "$" . $totalFormat;

        //Log::info($sells);

        //return response()->json("$".$totalFormat, 200);
        return response()->json(compact('sells','total_sell'), 200);

    }
}
