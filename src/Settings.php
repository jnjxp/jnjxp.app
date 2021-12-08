<?php

declare(strict_types=1);

namespace Jnjxp\App;

class Settings
{
    public static function load(array $files) : array
    {
        $settings = [];
        foreach ($files as $file) {
            if (file_exists($file)) {
                $settings = array_replace_recursive($settings, include $file);
            }
        }
        return $settings;
    }
}
