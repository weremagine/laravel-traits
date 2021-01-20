<?php

namespace Remagine\Traits;

use Illuminate\Support\Str;

trait HasUniqueKey {

	public static function bootHasUniqueKey()
	{
		static::creating(function($model) {
            $model->{ $model->unique_key ?? 'key' } = self::getUniqueKey($model);
        });
    }

    public static function getUniqueKey($model)
    {
        $key = Str::random($model->unique_key_length ?? 10);

        if ($model->uppercase_key ?? false) $key = strtoupper($key);

        if ($model->key_prefix ?? false) $key = $model->key_prefix.$key;

        if ($model->key_suffix ?? false) $key = $key.$model->key_suffix;

        $exists = get_class($model)::where($model->unique_key ?? 'key', $key)->count();

        if ($exists) return self::getUniqueKey($model);

        return $key;
    }
}
