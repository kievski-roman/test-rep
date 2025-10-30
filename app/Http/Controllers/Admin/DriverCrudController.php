<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DriverCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class DriverCrudController extends CrudController
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
        CRUD::setModel(Driver::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/driver');
        CRUD::setEntityNameStrings('driver', 'drivers');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('first_name')->label('First Name');
        CRUD::column('last_name')->label('Last Name');
        CRUD::column('birth_date')->label('Birth Date');
        CRUD::column('salary')->label('Salary')->type('number');
        CRUD::column('email')->label('Email');
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
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'birth_date' => 'required|date|after:-65 years',
            'salary' => 'required|numeric|min:0',
            'email' => 'required|email',
        ]);

        CRUD::field('first_name')->label('First Name');
        CRUD::field('last_name')->label('Last Name');
        CRUD::field('birth_date')->label('Birth Date')->type('date');
        CRUD::field('salary')->label('Salary')->type('number')
            ->attributes(['step' => '0.01']);
        CRUD::field('email')->label('Email')->type('email');
    }
    public function formerDrivers()
    {
        CRUD::setModel(Driver::class);
        CRUD::setRoute('admin/former-drivers');
        CRUD::setEntityNameStrings('бывший водитель', 'бывшие водители');

        CRUD::addClause('where', 'is_active', false);

        CRUD::column('first_name')->label('First Name');
        CRUD::column('last_name')->label('Last Name');
        CRUD::column('birth_date')->label('Birth Date');
        CRUD::column('email')->label('Email');

        return view('crud::list', ['crud' => $this->crud]);
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
