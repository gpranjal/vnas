<?php namespace Sukohi\Cahen;

class Cahen {

    private $_model;
    private $_where_clauses, $_model_data = [];

    public function move($model) {

        $this->_model = $model;
        return $this;

    }

    public function where($column, $operator, $value) {

        $this->_where_clauses[] = [$column, $operator, $value];
        return $this;

    }

    public function data($models) {

        $this->_model_data = $models;
        return $this;

    }

    public function to($column, $position) {

        if($position <= 0) {

            $position = 1;

        }

        $moving_id = $this->_model->id;
        $moving_position = $position - 1;

        if(!empty($this->_model_data)) {

            $model_data = $this->_model_data;

        } else {

            $query = $this->_model->select('id');

            if(!empty($this->_where_clauses)) {

                foreach ($this->_where_clauses as $where_clauses) {

                    $query->where($where_clauses[0], $where_clauses[1], $where_clauses[2]);

                }

            }

            $model_data = $query->where('id', '<>', $moving_id)->orderBy($column, 'ASC')->get();

        }

        $new_position = 0;
        $moved = false;

        foreach ($model_data as $model_values) {

            if($new_position == $moving_position) {

                $this->_model->$column = $new_position;

                if(!$this->_model->save()) {

                    return false;

                }

                $moved = true;
                $new_position++;

            }

            $model_values->$column = $new_position;

            if(!$model_values->save()) {

                return false;

            }

            $new_position++;

        }

        if(!$moved) {

            $this->_model->$column = $new_position;
            $this->_model->save();

        }

        $this->_where_clauses = [];
        return true;

    }

    public function up($column) {

        $position = $this->_model->$column;
        $this->to($column, $position);

    }

    public function down($column) {

        $position = $this->_model->$column + 2;
        $this->to($column, $position);

    }

    public function first($column) {

        $this->to($column, 0);

    }

    public function last($column) {

        $query = $this->_model->select('id');

        if(!empty($this->_where_clauses)) {

            foreach ($this->_where_clauses as $where_clauses) {

                $query->where($where_clauses[0], $where_clauses[1], $where_clauses[2]);

            }

        }

        $this->to($column, $query->count());

    }

    public function align($model, $column) {

        foreach ($model as $index => $model_values) {

            $model_values->$column = $index;

            if(!$model_values->save()) {

                return false;

            }

        }

        return true;

    }

}