<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BusCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BusCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Bus::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bus');
        CRUD::setEntityNameStrings('bus', 'buses');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('number_bus')->label('License Plate');
        CRUD::column('car_brand_id')->label('Brand')
            ->type('select')
            ->entity('carBrand')
            ->attribute('name');
        CRUD::column('driver_id')->label('Driver')
            ->type('select')
            ->entity('driver')
            ->attribute('first_name');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'number_bus' => 'required|string|max:20|unique:buses,number_bus',
            'car_brand_id' => 'required|exists:car_brands,id',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        CRUD::field('number_bus')->label('License Plate');

        CRUD::field('car_brand_id')
            ->label('Brand')
            ->type('select')
            ->entity('carBrand')
            ->attribute('name')
            ->model('App\Models\CarBrand');

        CRUD::field('driver_id')
            ->label('Driver')
            ->type('select')
            ->entity('driver')
            ->attribute('first_name')
            ->model('App\Models\Driver');
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
