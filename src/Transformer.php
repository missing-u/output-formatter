<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 3/25/19
 * Time: 1:29 PM
 */

namespace OutputFormatter;

use Throwable;
use Monolog\Logger;

abstract class Transformer implements TransformerInterface
{
    public abstract function transform($data, ...$params) : array;

    /**
     * @param $collection
     * @param mixed ...$extra_params
     * @return array
     * @throws Throwable
     */
    function transFormCollection($collection, ...$extra_params)
    {
        $res = [];

        /**
         *无法确认传递过来的到底是数组还是collections
         *所以为了通用使用foreach方法
         */
        foreach ($collection as $v) {
            try {
                $res[] = $this->transform($v, ...$extra_params);
            } catch (Throwable $exception) {
                Logger::info("格式转换发生了错误" . $exception->getMessage());
            }
        }

        return $res;
    }
}