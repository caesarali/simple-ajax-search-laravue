<?php

namespace App\Traits;

trait Code
{
    public static function bootCode()
    {
        static::created(function ($model) {
            $id = $model->id;
            $prefix = $model->codes['prefix'] ?? '';
            $length = ($model->codes['length'] ?? 6) - strlen($id);
            $digits = '';
            for ($i=0; $i < $length ; $i++) {
                $digits = $digits . '0';
            }
            $model->code = $prefix . $digits . $id;
            $model->save();
        });
    }
}
