<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
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
            'name',
            'email'
        ];

        $users = User::select($campos)->get();
        //->pluck();

        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Log::info($data);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $campos = [
            'name',
            'email'
        ];

        /*$user = User::select('name', 'email', 'telefono')
            ->where('id', $id)
            ->first();
        $user = User::select('name', 'email', 'telefono')
            ->where('id', $id)
            ->firstOrFail();
        $user = User::select('name', 'email', 'telefono')
            ->where('id', $id)
            ->find();*/
        $user = User::select($campos)->findOrFail($id);

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        $user->update($data);

        return response()->json(['result' => 'ok'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json(['result' => 'ok'], 200);
    }
}
