<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/16/19
 * Time: 2:18 PM
 */

namespace OutputFormatter;

trait BaseOutputTrait
{
    /**
     * out 方法的别名 兼容 福生 和文虎的风格
     * @param int $code
     * @param string $msg
     * @param array $debug
     * @param bool $directOutput
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public static function end($result = [], $code = 200, $msg = '', $debug = [], $directOutput = false)
    {
        return self::out($result, $code, $msg, $debug, $directOutput);
    }


    /**
     * 响应输出
     * @param  $result
     * @param int $code
     * @param string $msg
     * @param array $debug
     * @param bool $directOutput
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @return \Illuminate\Http\Response
     */
    public static function out($result = true, $code = 200, $msg = '', $debug = [], $directOutput = false)
    {

        $appCode = config('appcode');
        $msg     = empty($msg) ? get_var_field($appCode, $code) : $msg;

        $output = [
            'success'   => $code == 200 ? true : false,
            'error_no'  => (int)$code,
            'error_msg' => $msg,
            'result'    => $result,
        ];

        if (config('app.debug')) {
            $output[ '_debug' ] = $debug;
        }

        return response($output);
//        return response($output)->send();

    }
}