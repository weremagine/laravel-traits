<?php

namespace Remagine\Traits;

use Illuminate\Support\Str;

trait HasSlug {

	public static function bootHasSlug()
	{
		static::saving(function($model) {
            $model->slug = Str::slug($model->{ $model->sluggify ?? 'name' });
        });
	}
}
