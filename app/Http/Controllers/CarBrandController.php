<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = CarBrand::paginate(20);
        return view('car-brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car-brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate(['name' => 'required|string|max:20|unique:car_brands']);
        CarBrand::create($request->only('name'));
        return redirect()->route('car-brands.index');
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
    public function edit(CarBrand $carBrand)
    {
        return view('car-brands.edit', compact('carBrand'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CarBrand $carBrand) {
        $request->validate(['name' => 'required|string|max:20|unique:car_brands']);
        $carBrand->update($request->only('name'));
        return redirect()->route('car-brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarBrand $carBrand) {
        $carBrand->delete();
        return back();
    }
}
