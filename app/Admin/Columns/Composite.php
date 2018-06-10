<?php

namespace App\Admin\Columns;

use Illuminate\Database\Eloquent\Model;
use SleepingOwl\Admin\Contracts\Initializable;
use SleepingOwl\Admin\Contracts\WithModelInterface;
use SleepingOwl\Admin\Display\TableColumn;

class Composite extends TableColumn
{
    public function getView()
    {
        return view('admin.display.column.composite');
    }

    /**
     * @var TableColumn[]
     */
    protected $columns;

    /**
     * @param TableColumn[] $columns
     */
    public function __construct(array $columns)
    {
        parent::__construct();

        $this->columns = $columns;
    }

    /**
     * Initialize column.
     */
    public function initialize()
    {
        parent::initialize();

        foreach ($this->columns as $column) {
            if ($column instanceof Initializable) {
                $column->initialize();
            }
        }
    }

    /**
     * @param Model $model
     *
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
        foreach ($this->columns as $column) {
            if ($column instanceof WithModelInterface) {
                $column->setModel($model);
            }
        }

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return parent::toArray() + [
            'columns' => collect($this->columns)
        ];
    }
}