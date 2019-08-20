<?php

namespace OutputFormatter\Output;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use OutputFormatter\FakeLogic;
use OutputFormatter\Interfaces\TransformerInterface;
use OutputFormatter\Transformer\Transformer;

trait CollectionOutTrait
{
    /**
     * @param Paginator $worksPaginator
     * @param null|TransformerInterface $transformer
     * @param mixed ...$params
     * @return mixed
     */
    public function respond_fake_pagination(
        Paginator $worksPaginator,
        ?TransformerInterface $transformer = null,
        ...$params
    ) {
        $items = $worksPaginator->items();

        $num = count($items);

        if ($transformer !== null) {
            $items = $transformer->transFormCollection(
                $items, ...$params
            );
        }

        $fake_num = FakeLogic::getFakeTotal($num);

        return $this->respond_success(
            [
                "list"  => $items,
                "total" => $fake_num,
            ]
        );
    }

    /**
     * @param Paginator $worksPaginator
     * @param null|TransformerInterface $transformer
     * @param mixed ...$params
     * @return mixed
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

        return $this->respond_success(
            [
                "list" => $items,
            ]
        );
    }

    /**
     * @param LengthAwarePaginator $worksPaginator
     * @param null $transformer
     * @param mixed ...$params
     * @return mixed
     */
    public function respond_pagination(
        LengthAwarePaginator $worksPaginator,
        $transformer = null,
        ...$params
    ) {
        if ($transformer !== null) {
            /**
             * @var $transformer Transformer
             */
            $items = $transformer->transFormCollection(
                //在这里　传递 $worksPaginator->items(), 和传递  $worksPaginator
                //效果是一致的　 worksPaginator 内部实现了　iterator
                $worksPaginator->items(),
                ...$params
            );
        } else {
            $items = $worksPaginator->items();
        }

        return $this->respond_success(
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
     * @return mixed
     */
    public function respond_collection(
        $items,
        $transformer = null,
        ...$params
    ) {
        if ($transformer !== null) {
            /**
             * @var $transformer Transformer
             */
            $items = $transformer->transFormCollection(
                $items, ...$params
            );
        }

        return $this->respond_success(
            $items
        );
    }
}