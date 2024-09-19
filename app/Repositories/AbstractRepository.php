<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectAttributesRelatedRecords($attributes)
    {
        $this->model = $this->model->with($attributes);
    }

    public function filter($filters)
    {
        $filters = explode(';', $filters);

        foreach($filters as $key => $filter){
            $f = explode(':', $filter);
            $this->model = $this->model->where($f[0], $f[1], $f[2]);
        }  
    }

    public function selectAttributes($attributes)
    {
        $this->model = $this->model->select($attributes);
    }

    public function getResult()
    {
        return $this->model->get();
    }

    public function getResultPaginate($paginateNumber)
    {
        return $this->model->paginate($paginateNumber);
    }
}