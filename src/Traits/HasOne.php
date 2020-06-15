<?php

namespace Remagine\Traits;

trait HasOne {

	public static function bootHasOne()
	{
		static::retrieved(function($model) {
            $model->{ $model->has_one_attribute ?? 'model' } = call_user_func($model->{ $model->has_one_type ?? 'model_type' }.'::find', $model->{ $model->has_one_id ?? 'model_id' });
            $model->setRelation($model->has_one_attribute ?? 'model', $model->{ $model->has_one_attribute ?? 'model' });
        });
    }
}
