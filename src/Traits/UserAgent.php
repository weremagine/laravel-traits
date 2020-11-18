<?php

namespace Remagine\Traits;

use Jenssegers\Agent\Agent;

trait UserAgent {

	public static function bootUserAgent()
	{
		static::creating(function($model) {
            $model->agent = request()->header('user-agent');

            if ($model->parse_agent_fields) {
                $model = self::parseAgentString($model);
            }
        });
    }

    public static function parseAgentString($model)
    {
        $agent = new Agent();
        $agent->setUserAgent($model->agent);

        $model->platform = $agent->platform();
        $model->platform_version = $agent->version($model->platform);
        $model->browser = $agent->browser();
        $model->browser_version = $agent->version($model->browser);
        $model->device = self::getDevice($agent);
        $model->device_name = $agent->device();

        return $model;
    }

    public static function getDevice(Agent $agent)
    {
        if ($agent->isMobile()) return 'mobile';
        if ($agent->isDesktop()) return 'desktop';
        if ($agent->isTablet()) return 'tablet';
        if ($agent->isBot()) return 'bot';
        return 'unknown';
    }
}
