<?php

namespace App\Http\Controllers;

use App\Models\Csoki;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CsokiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        \Log::info('Authenticated User:', ['user' => $user]);

        return Csoki::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nev' => 'required',
            'ara' => 'required',
            'raktaron' => 'required',
        ]);

        return Csoki::create($request->except('id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Csoki::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nev' => 'required',
            'ara' => 'required',
            'raktaron' => 'required',
        ]);

        return Csoki::findOrFail($id)->update($request->except('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Csoki::findOrFail($id)->delete();
    }
    
}
