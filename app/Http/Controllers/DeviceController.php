<?php

namespace App\Http\Controllers;

use App\Models\BloodPressure;
use App\Models\Device;
use App\Models\Diabetes;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = Device::all();

        foreach ($devices as $device) {
            // Renomeia os nomes
            $device->type = [
                'diabetes' => 'Glicemia',
                'blood_pressures' => 'Pressão Arterial',

                // Adiciona outras dispositivos se necessário
            ][$device->type] ?? $device->type;
        }

        return view('device.index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Device::pluck('type')->unique();
        return view('device.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'brand' => 'required',
            'model' => 'required',
        ]);

        $device = new Device([
            'type' => $request->get('type'),
            'brand' => $request->get('brand'),
            'model' => $request->get('model'),
        ]);

        $device->save();

        return redirect()->route('device.index')->with('success', 'Dispositivo criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('device.edit', compact('device'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:diabetes,blood_pressures', 
            'brand' => 'required|string',
            'model' => 'required|string',
        ]);

        $device = Device::findOrFail($id);
        $device->update($request->all());

        return redirect()->route('device.index')->with('success', 'Dispositivo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $device = Device::findOrFail($id);

    $device->delete();

    return redirect()->route('device.index')->with('success', 'Dispositivo excluído com sucesso!');
}
}
