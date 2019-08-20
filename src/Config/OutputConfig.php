<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/20/19
 * Time: 2:21 PM
 */

namespace OutputFormatter\Config;


class OutputConfig
{
    public static function get_success_code()
    {
        return 200;
    }


    public static function get_fail_code()
    {
        return 400;
    }

    public static function default_current_page()
    {
        return 1;
    }

    public static function default_per_page_size()
    {
        return 20;
    }
}
