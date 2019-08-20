<?php

namespace OutputFormatter\Output;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use OutputFormatter\Config\OutputConfig;
use OutputFormatter\Transformer\Transformer;
use Throwable;

trait BaseOutTrait
{

    /**
     * @param bool $data
     * @param null $transformer
     * @param mixed ...$params
     * @return mixed
     */
    public function respond_success($data = true, $transformer = null, ...$params)
    {
        if ($transformer !== null) {
            /**
             * @var $transformer Transformer
             */
            $data = $transformer->transform($data, ...$params);
        }

        $code = OutputConfig::get_success_code();

        $pass = [
            'data'    => $data,
            'code'    => $code,
            'msg'     => '',
            'success' => true,
        ];

        return $this->output($pass);
    }

    /**
     * @param Throwable $throwable
     * @param null $code 要覆盖 throwable 的 code
     * @param null $message 要覆盖 throwable 的 message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public function respond_fail(
        Throwable $throwable
    ) {
        if (isset($throwable->explict_code)) {
            $code = $throwable->explict_code;
        } else {
            $code = $throwable->getCode();
        }

        if($code === 0 ){
            $code = OutputConfig::get_fail_code();
        }

        $msg = $throwable->getMessage();

        $pass = [
            'data'    => [],
            'code'    => $code,
            'msg'     => $msg,
            'success' => false,
        ];

        return $this->output($pass);
    }

}