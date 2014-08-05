<?php

class Controller {

    public function model($model) {
        if (is_array($model)) {
            foreach ($model as $name) {
                $this->model($name);
            }
        }

        if ($model == '') {
            return;
        }

        $name = strtolower($model);

        $this->$name = new $model();
    }

}
