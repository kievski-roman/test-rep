<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BusCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(\App\Models\Bus::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bus');
        CRUD::setEntityNameStrings('bus', 'buses');
    }

    protected function setupListOperation(): void
    {
        CRUD::column('number_bus')->label('License Plate');

        CRUD::addColumn([
            'name'      => 'car_brand_id',
            'label'     => 'Brand',
            'type'      => 'select',
            'entity'    => 'carBrand',
            'attribute' => 'name',
            'model'     => 'App\Models\CarBrand',
        ]);

        CRUD::addColumn([
            'name'      => 'driver_id',
            'label'     => 'Driver',
            'type'      => 'select',
            'entity'    => 'driver',
            'attribute' => 'first_name',
            'model'     => 'App\Models\Driver',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(\App\Http\Requests\BusRequest::class);

        CRUD::field('number_bus')->label('License Plate');

        CRUD::addField([
            'name'      => 'car_brand_id',
            'label'     => 'Brand',
            'type'      => 'select',
            'entity'    => 'carBrand',
            'attribute' => 'name',
            'model'     => 'App\Models\CarBrand',
        ]);

        CRUD::addField([
            'name'      => 'driver_id',
            'label'     => 'Driver',
            'type'      => 'select',
            'entity'    => 'driver',
            'attribute' => 'first_name',
            'model'     => 'App\Models\Driver',
            'allows_null' => true,
        ]);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
