<?php

namespace OutputFormatter;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use stdClass;
use Throwable;

trait InstanceOutFormatTrait
{



    /**
     * @param Throwable $throwable
     * @param null $code 要覆盖 throwable 的 code
     * @param null $message 要覆盖 throwable 的 message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|\Illuminate\Http\Response
     */
    public static function respondDefaultFail(
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



    /**
     * @param $items
     * @param null $transformer
     * @param mixed ...$params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function respondSuccessThroughTransformCollection(
        $items,
        $transformer = null,
        ...$params
    ) {
        $items = $transformer->transFormCollection(
            $items,...$params
        );

        return $this->respondDefaultSuccess(
            $items
        );
    }

    /**
     * @param $item
     * @param TransformerInterface|null|SimpleTransformer $transformer
     * @param mixed ...$params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function respondSuccessThroughTransformer($item, $transformer = null, ...$params)
    {
        if ($transformer !== null) {
            /**
             * @var $transformer Transformer
             */
            $data = $transformer->transform($item, ...$params);
        } else {
            $data = $item;
        }

        return $this->respondDefaultSuccess($data);
    }


}