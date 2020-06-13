<?php

namespace Remagine\Traits;

use Illuminate\Support\Str;

trait HasUuid {

	public static function bootHasUuid()
	{
		static::creating(function($model) {
            $model->{ $model->uuid_field ?? 'uuid' } = Str::uuid();
        });
    }
}
