<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/19/19
 * Time: 4:29 PM
 */

namespace OutputFormatter;


use OutputFormatter\Interfaces\RenderInterface;
use OutputFormatter\Output\BaseOutTrait;
use OutputFormatter\Output\CollectionOutTrait;
use OutputFormatter\Renders\DefaultRender;

trait OutputTrait
{
    use BaseOutTrait;

    use CollectionOutTrait;

    public $output_render = null;

    private function output($params)
    {
        [
            'data'    => $data,
            'code'    => $code,
            'msg'     => $msg,
            'success' => $success,
        ] = $params;

        $render = $this->get_render();

        $pass_params = [
            'data'    => $data,
            'code'    => $code,
            'msg'     => $msg,
            'success' => $success,
        ];

        return $render->response($pass_params);
    }

    /**
     * @return RenderInterface
     */
    private function get_render() : RenderInterface
    {
        if (null !== $this->output_render) {
            return $this->output_render;
        }

        return new DefaultRender();
    }
}