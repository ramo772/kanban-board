<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

abstract class _Service
{


     protected function create( array $data)
     {

          return $this->model::create($data);
     }


     public function __call($method, $args)
     {
          return DB::transaction(function () use ($method, $args) {
               return call_user_func_array(
                    [$this, $method],
                    array_map(function ($arg) {
                         return is_array($arg) ? collect($arg) : $arg;
                    }, $args)
               );
          });
     }
}
