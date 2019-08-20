<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 3/25/19
 * Time: 1:29 PM
 */

namespace OutputFormatter\Interfaces;

use Exception;

interface ErrorLoggerInterface
{
    public function log(Exception $exception);
}
