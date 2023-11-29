<?php

namespace App\Models;

class Model extends BaseModel {

    public function __construct($table = '')
    {
        parent::__construct($table);
    }

    public function value($column)
    {
        return $this->first($column);
    }

    public function pluckToArray($column)
    {
        return $this->pluck($column)->toArray();
    }

    public function pluck($column)
    {
        return $this->select($column);
    }

    public function toArray()
    {
        return array_column($this->get(), $this->columns);
    }

    public function delete()
    {
        $this->operation = "DELETE ";
        $this->select(null);
        $this->execute();
        return true;
    }

    public function count($column = '*')
    {
        $this->select('COUNT('.$column.') as total_count');

        return (int) $this->value('total_count');
    }

    public function whereIn($column, $values)
    {
        $values = rtrim(implode(', ', $values), ', ');

        $values = empty($values) ? "('')": '('.$values.')';

        return $this->where($column, 'IN', $values);
    }

    public function join($table, $joiningCondition)
    {
        $this->joinsWith[] = [
            'table' => $table,
            'condition' => $joiningCondition
        ];

        return $this;
    }

    public function orderBy($key, $order = 'DESC')
    {
        $this->sorting = ['key' => $key, 'order' => $order];

        return $this;
    }

    public function limit($count)
    {
        $this->limit = $count;

        return $this;
    }

    public function offset($count)
    {
        $this->offset = $count;

        return $this;
    }

    public function take($count)
    {
        return $this->limit($count)->get();
    }

    public function first($column = null)
    {
        $data = !empty($data = $this->execute()) ? $data[0] : [];

        return !$column ? $data : ($data[$column] ?? null);
    }

    public function find($id)
    {
        return $this->where('id', $id)->first();
    }

    public function get()
    {
        return $this->execute();
    }

    public function all()
    {
        return $this->get();
    }

    public function toSql()
    {
        return $this->baseQuery();
    }

    public function insert($data)
    {
        return $this->save($data);
    }

    public function update($data)
    {
        return $this->save($data, true);
    }

    public function sum($column)
    {
        $total = 0;

        foreach ($this->get() as $item)
        {
            $total = $total + $item[$column];
        }

        return $total;
    }

    public function execute($sql = null)
    {
        return parent::execute($sql); // TODO: Change the autogenerated stub
    }
}