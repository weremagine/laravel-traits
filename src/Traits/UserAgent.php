<?php

namespace Remagine\Traits;

trait UserAgent {

	public static function bootUserAgent()
	{
		static::creating(fn($model) => $model->agent = request()->header('user-agent'));
	}
}
