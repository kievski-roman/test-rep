<?php

namespace App\Http\Controllers;

use App\Http\Requests\DriverRequest;
use App\Models\Driver;
use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{


    protected $driverService;
    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::paginate(20);
        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DriverRequest $request)
    {
        $this->driverService->createDriver($request->validated());
        return redirect()->route('drivers.index');
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
    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DriverRequest $request, Driver $driver)
    {
        $this->driverService->updateDriver($driver, $request->validated());
        return redirect()->route('drivers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return back();
    }
}
