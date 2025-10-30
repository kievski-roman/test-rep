<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendFarewellEmail;
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
        CRUD::column('salary')->type('number')->label('Salary');
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
        CRUD::setValidation(\App\Http\Requests\DriverRequest::class);

        CRUD::field('first_name')->label('First Name');
        CRUD::field('last_name')->label('Last Name');
        CRUD::field('birth_date')->type('date')->label('Birth Date');
        CRUD::field('salary')->type('number')->attributes(['step'=>'0.01'])->label('Salary');
        CRUD::field('email')->type('email')->label('Email');

        CRUD::addField([
            'name'   => 'images',
            'label'  => 'Images',
            'type'  => 'textarea',
            'entity_singular' => 'row',
            'columns' => [
                'text' => 'Text',
                'src'  => 'Src (URL)',
            ],
            'max' => 0,
            'min' => 0,
        ]);
    }
    public function formerDrivers()
    {
        CRUD::setModel(\App\Models\Driver::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/former-drivers');
        CRUD::setEntityNameStrings('Former driver', 'Former drivers');


        $this->crud->addClause('onlyTrashed');

        $this->crud->setColumns([
            ['name'=>'first_name','label'=>'First Name'],
            ['name'=>'last_name','label'=>'Last Name'],
            ['name'=>'birth_date','label'=>'Birth Date'],
            ['name'=>'email','label'=>'Email'],
        ]);

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
