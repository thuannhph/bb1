<?php

namespace Botble\Vip;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('vips');
        Schema::dropIfExists('vips_translations');
    }
}
