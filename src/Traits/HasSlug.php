<?php

namespace Remagine\Traits;

use Illuminate\Support\Str;

trait HasSlug {

	public static function bootHasSlug()
	{
        static::saving(function($model) {
            $base_slug =  Str::slug($model->{ $model->sluggify ?? 'name' });
            $slug = $base_slug;
            $count = 1;

            while (self::where('slug', $slug)->where('id', '!=', $model->id)->exists()) {
                $slug = "$base_slug-$count";
                $count++;
            }

            $model->slug = $slug;
        });
	}
}
