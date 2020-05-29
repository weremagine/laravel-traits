<?php

namespace Remagine\Traits;

trait HasImages {

    abstract public function imagesArray(): array;

    public static function bootHasImages()
    {
        static::retrieved(function($model) {
            collect($model->imagesArray())->map(function($image) use($model) {
                $prefix = method_exists($model, 'imagePrefix') ? $model->imagePrefix() : '';

                $model->{ $image['attribute'] } = $prefix.$model->{ $image['field'] };
            });
        });
    }
}
