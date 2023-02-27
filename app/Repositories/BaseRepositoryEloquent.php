<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as L5BaseRepository;

abstract class BaseRepositoryEloquent extends L5BaseRepository
{
    const PER_PAGE = 20;

    private $modelFilter;

    protected function getModelFilter(): ?string
    {
        return $this->modelFilter;
    }

    protected function setModelFilter(string $modelFilter): self
    {
        $this->modelFilter = $modelFilter;

        return $this;
    }

    public function find($id, $columns = ['*'], array $with = [])
    {
        $this->model = $this->model->with($with);

        return parent::find($id, $columns = ['*']);
    }

    public function all($columns = ['*'], array $relations = [])
    {
        $this->model = $this->model->with($relations);

        return parent::all($columns);
    }

    public function findWhereIn($field, array $values, $columns = ['*'], array $with = [])
    {
        $this->model = $this->model->with($with);

        return parent::findWhereIn($field, $values, $columns);
    }

    public function findWhere(array $where, $columns = ['*'], array $with = [])
    {
        $this->model = $this->model->with($with);

        return parent::findWhere($where, $columns);
    }

    public function getAllWithConditions(array $where = [], array $column = ['*'], string $order = 'DESC', string $orderBy = 'id', array $with = [], array $groupBy = [], string $doesntHave = '')
    {
        $this->applyCriteria();
        $this->applyScope();

        $query = $this->model;

        if (!empty($where)) {
            $query = $query->where($where);
        }

        if (!empty($column)) {
            $query = $query->select($column);
        }

        if (!empty($groupBy)) {
            $query = $query->groupBy($groupBy);
        }

        if (!empty($orderBy) && !empty($order)) {
            $query = $query->orderBy($orderBy, $order);
        }

        if (!empty($with)) {
            $query = $query->with($with);
        }

        if (!empty($doesntHave)) {
            $query = $query->doesntHave($doesntHave);
        }

        $query = $query->get();

        $this->resetModel();

        return $this->parserResult($query);
    }

    public function getAllPaginateWithConditions(array $where = [], array $column = ['*'], string $order = 'DESC', string $orderBy = 'id', array $with = [])
    {
        $this->applyCriteria();
        $this->applyScope();

        $query = $this->model;

        if (!empty($where)) {
            $query = $query->where($where);
        }

        if (!empty($column)) {
            $query = $query->select($column);
        }

        $perPage = $this->app['request']->input('per_page') ?? self::PER_PAGE;
        $query = $query->orderBy($orderBy, $order)->with($with)->paginate($perPage);
        $this->resetModel();

        return $this->parserResult($query);
    }

    public function getAllPaginateWithConditionsWithoutCriteria(array $where = [], array $column = ['*'], string $order = 'DESC', string $orderBy = 'id', array $with = [])
    {
        $this->applyScope();

        $query = $this->model;

        if (!empty($where)) {
            $query = $query->where($where);
        }

        if (!empty($column)) {
            $query = $query->select($column);
        }

        $perPage = $this->app['request']->input('per_page') ?? self::PER_PAGE;
        $query = $query->orderBy($orderBy, $order)->with($with)->paginate($perPage);
        $this->resetModel();

        return $this->parserResult($query);
    }

    public function getAllWithFilter(array $filters = [], array $with = [], string $order = 'DESC', string $orderBy = 'id', bool $paginate = true)
    {
        $query = $this->filter($filters, $this->getModelFilter());
        $query = $query->orderBy($orderBy, $order)->with($with);
        if ($paginate) {
            $perPage = $this->app['request']->input('per_page') ?? self::PER_PAGE;

            $query = $query->paginate($perPage);
        } else {
            $query = $query->get();
        }

        $this->resetModel();

        return $this->parserResult($query);
    }

    public function getAllWithFilterAndWhere(array $where = [], array $filters = [], array $with = [], string $order = 'DESC', string $orderBy = 'id', bool $paginate = true)
    {
        $query = $this->filter($filters, $this->getModelFilter());
        $query = $query->orderBy($orderBy, $order)->with($with);

        if (!empty($where)) {
            $query = $query->where($where);
        }
        if ($paginate) {
            $perPage = $this->app['request']->input('per_page') ?? self::PER_PAGE;

            $query = $query->paginate($perPage);
        } else {
            $query = $query->get();
        }

        $this->resetModel();

        return $this->parserResult($query);
    }

    public function filter(array $filters, ?string $modelFilter)
    {
        $this->applyCriteria();
        $this->applyScope();

        if ($modelFilter) {
            return $this->model->filter($filters, $modelFilter);
        }

        return $this->model;
    }

    public function getAllWithFilterAndSort(array $filters = [], array $with = [], bool $paginate = true)
    {
        // @Todo: need to improve
        $query = $this->filter($filters, $this->getModelFilter());
        //$query = $query->orderBy($orderBy, $order)->with($with);

        if ($paginate) {
            $perPage = $this->app['request']->input('per_page') ?? self::PER_PAGE;

            $query = $query->paginate($perPage);
        } else {
            $query = $query->get();
        }

        $this->resetModel();

        return $this->parserResult($query);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function upsert(array $data, array $conditionColumn, array $storeCollumn = null)
    {

        $this->applyCriteria();
        $this->applyScope();

        $query = $this->model->upsert($data, $conditionColumn, $storeCollumn);

        $this->resetModel();

        return $this->parserResult($query);
    }


    public function getAllWithFilterAndMultiWhere(array $where = [], array $filters = [], array $with = [], string $order = 'DESC', string $orderBy = 'id', bool $paginate = true, array $whereDoestHave = [])
    {
        $query = $this->filter($filters, $this->getModelFilter());
        $query = $query->orderBy($orderBy, $order)->with($with);

        if (!empty($where)) {
            $query = $query->where($where);
        }
        if (!empty($whereDoestHave)) {
            $query = $query->whereDoesntHave($whereDoestHave['with'], function ($query) use ($whereDoestHave) {
                return $query->where($whereDoestHave['column'], $whereDoestHave['param']);
            });
        }
        if ($paginate) {
            $perPage = $this->app['request']->input('per_page') ?? self::PER_PAGE;

            $query = $query->paginate($perPage);
        } else {
            $query = $query->get();
        }

        $this->resetModel();
        return $this->parserResult($query);
    }

    public function findByFieldOnlyTrashed(array $where = [])
    {
        $this->applyCriteria();
        $this->applyScope();
        $query = $this->model->where($where)->onlyTrashed()->get();
        $this->resetModel();
        return $this->parserResult($query);
    }
}
