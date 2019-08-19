<?php

namespace OutputFormatter;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use stdClass;
use Throwable;

trait OutFormatTrait
{
    use BaseOutputTrait;

    use InstanceOutFormatTrait;

    use CollectionOutFormatTrait;

    /**
     * @param $item
     * @param TransformerInterface|null|SimpleTransformer $transformer
     * @param mixed ...$params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function respond_success($data = true, $transformer = null, ...$params)
    {
        if ($transformer !== null) {
            /**
             * @var $transformer Transformer
             */
            $data = $transformer->transform($data, ...$params);
        } else {
            $data = $data;
        }

        return $this->respondDefaultSuccess($data);
    }

    /**
     * @param Throwable $throwable
     * @param null $code 要覆盖 throwable 的 code
     * @param null $message 要覆盖 throwable 的 message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public static function respond_fail(
        Throwable $throwable,
        $code =
        null,
        $message = null
    ) {
        return self::end(
            false,
            $code ?? $throwable->getCode(),
            $message ?? $throwable->getMessage(),
            null,
            false);
    }


}