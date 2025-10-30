<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusRequest;
use App\Models\Bus;
use App\Models\CarBrand;
use App\Models\Driver;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::with(['carBrand', 'driver'])
            ->paginate(20);
        return view('buses.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carBrands = CarBrand::orderBy('name')->get();
        $drivers = Driver::orderBy('first_name')->limit(50)->get();

        return view('buses.create', compact('carBrands', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusRequest $request)
    {
        Bus::create($request->validated());

        return redirect()->route('buses.index')
            ->with('success', 'Автобус успешно добавлен');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
        $carBrands = CarBrand::orderBy('name')->get();
        $drivers = Driver::orderBy('first_name')->get();

        return view('buses.edit', compact('bus', 'carBrands', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BusRequest $request, Bus $bus)
    {
        $bus->update($request->validated());
        return redirect()->route('buses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return back();
    }
}
