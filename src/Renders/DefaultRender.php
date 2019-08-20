<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/16/19
 * Time: 2:18 PM
 */

namespace OutputFormatter\Renders;

use OutputFormatter\Interfaces\RenderInterface;

class DefaultRender implements RenderInterface
{
    public function response(
        $data
    ) {
        [
            'data'    => $data,
            'code'    => $code,
            'msg'     => $msg,
            'success' => $success,
        ] = $data;

        $output = [
            'success'   => $success,
            'error_no'  => $code,
            'error_msg' => $msg,
            'result'    => $data,
        ];

        return response($output);
    }
}