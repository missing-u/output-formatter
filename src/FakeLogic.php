<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/20/19
 * Time: 2:48 PM
 */

namespace OutputFormatter;


use OutputFormatter\Config\OutputConfig;

class FakeLogic
{
    public static function getFakeTotal($retrieve_record_num)
    {
        $size = self::getSize();

        $page = self::getPage();

        if ($size === $retrieve_record_num) {
            return $size * ($page + 1);
        }

        return $size * $page;
    }

    public static function getSize() : int
    {
        $default_per_page_size = OutputConfig::default_per_page_size();

        return (int)request()->input("size", $default_per_page_size);

    }

    public static function getPage() : int
    {
        $page_num = OutputConfig::default_current_page();

        return request()->input("page", $page_num);
    }
}