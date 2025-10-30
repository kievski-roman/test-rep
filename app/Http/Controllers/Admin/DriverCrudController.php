<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class DriverCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

   
    protected function isFormer(): bool
    {
        return request()->boolean('former');
    }

    public function setup(): void
    {
        CRUD::setModel(Driver::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/driver');
        CRUD::setEntityNameStrings('водій', 'Водії');


        $this->crud->setOperationSetting('persistentTable', false);
        $this->crud->setOperationSetting('persistFilters', false);

        if ($this->isFormer()) {
            if ($user = backpack_auth()->user() ?? auth()->user()) {
                if (!in_array($user->role, ['admin','manager'], true)) {
                    abort(403);
                }
            }

            $this->crud->query->onlyTrashed();

            $this->crud->addClause('withTrashed');

            CRUD::denyAccess(['create','update','delete']);
            CRUD::allowAccess('show');

            $this->crud->setHeading('Колишні водії');
            $this->crud->setSubheading('Список звільнених (soft-deleted)', 'list');
        } else {
            $this->crud->query->withoutTrashed();
        }
    }

    protected function setupListOperation()
    {
        $columns = [
            ['name' => 'first_name', 'label' => 'Ім’я'],
            ['name' => 'last_name',  'label' => 'Прізвище'],
            ['name' => 'email',      'label' => 'Email'],
            ['name' => 'birth_date', 'label' => 'Дата нар.', 'type' => 'date'],
        ];
        if ($this->isFormer()) {
            $columns[] = ['name' => 'deleted_at', 'label' => 'Дата звільнення', 'type' => 'datetime'];
        }
        CRUD::addColumns($columns);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(\App\Http\Requests\DriverRequest::class);

        CRUD::field('first_name')->label('First Name');
        CRUD::field('last_name')->label('Last Name');
        CRUD::field('birth_date')->type('date')->label('Birth Date');
        CRUD::field('salary')->type('number')->attributes(['step' => '0.01'])->label('Salary');
        CRUD::field('email')->type('email')->label('Email');


        CRUD::addField([
            'name'    => 'images',
            'label'   => 'Images',
            'type'    => 'table', 
            'columns' => [
                'text' => 'Text',
                'src'  => 'Src (URL)',
            ],
            'min' => 0,
            'max' => 0,
        ]);


        $this->crud->setOperationSetting('redirectAfterSave', backpack_url('driver'));
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        if ($this->isFormer()) {
            $this->crud->query->withTrashed();
        }
    }
}
