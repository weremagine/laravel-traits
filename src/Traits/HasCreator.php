<?php

namespace Remagine\Traits;

trait HasCreator {

	public static function bootHasCreator()
	{
		static::creating(fn($model) => $model->user_id = request()->user()->id);
	}
}
