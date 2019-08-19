<?php

namespace OutputFormatter;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;

trait CollectionOutFormatTrait
{
    /**
     * @param Paginator $worksPaginator
     * @param TransformerInterface|null|Transformer $transformer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function respond_fake_pagination(
        Paginator $worksPaginator,
        ?TransformerInterface $transformer = null,
        ...$params
    ) {
        if ($transformer !== null) {
            $items = $transformer->transFormCollection(
                $worksPaginator->items(),
                ...$params
            );
        } else {
            $items = $worksPaginator->items();
        }

        return $this->respondDefaultSuccess(
            [
                "list" => $items,
            ]
        );
    }

    /**
     * @param Paginator $worksPaginator
     * @param TransformerInterface|null|Transformer $transformer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function respond_simple_pagination(
        Paginator $worksPaginator,
        ?TransformerInterface $transformer = null,
        ...$params
    ) {
        if ($transformer !== null) {
            $items = $transformer->transFormCollection(
                $worksPaginator->items(),
                ...$params
            );
        } else {
            $items = $worksPaginator->items();
        }

        return $this->respondDefaultSuccess(
            [
                "list" => $items,
            ]
        );
    }

    /**
     * @param $worksPaginator
     * @param null|Transformer $transformer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function respond_pagination(
        LengthAwarePaginator $worksPaginator,
        $transformer = null,
        ...$params
    ) {
        if ($transformer) {
            $items = $transformer->transFormCollection(
                $worksPaginator->items(),
                ...$params
            );
        } else {
            $items = $worksPaginator->items();
        }

        return $this->respondDefaultSuccess(
            [
                "list"  => $items,
                "total" => $worksPaginator->total(),
            ]
        );
    }


    /**
     * @param $items
     * @param null $transformer
     * @param mixed ...$params
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function respond_collection(
        $items,
        $transformer = null,
        ...$params
    ) {
        $items = $transformer->transFormCollection(
            $items, ...$params
        );

        return $this->respondDefaultSuccess(
            $items
        );
    }
}