<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class CarBrandCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup(): void
    {
        CRUD::setModel(\App\Models\CarBrand::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/car-brand');
        CRUD::setEntityNameStrings('car brand', 'car brands');
    }

    protected function setupListOperation(): void
    {
        CRUD::column('name')->label('Brand Name');
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation([
            'name' => 'required|string|min:2|max:255|unique:car_brands,name,'.request()->id,
        ]);

        CRUD::field('name')->type('text')->label('Brand Name');
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }
}
