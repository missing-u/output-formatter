<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 3/25/19
 * Time: 1:29 PM
 */

namespace OutputFormatter\Transformer;

use OutputFormatter\Interfaces\ErrorLoggerInterface;
use OutputFormatter\Interfaces\TransformerInterface;
use Throwable;

//use Monolog\Logger;

abstract class Transformer implements TransformerInterface
{
    private $logger;

    public abstract function transform($data, ...$params) : array;

    /**
     * @param $collection
     * @param mixed ...$extra_params
     * @return array
     */
    function transformCollection($collection, ...$extra_params)
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
                if (($logger = $this->getLogger()) !== null) {
                    $logger->log($exception);
                }
            }
        }

        return $res;
    }

    /**
     * @return null|ErrorLoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param ErrorLoggerInterface $logger
     */
    public function setLogger(ErrorLoggerInterface $logger) : void
    {
        $this->logger = $logger;
    }
}