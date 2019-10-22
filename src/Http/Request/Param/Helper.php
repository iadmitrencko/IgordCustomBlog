<?php

namespace Igord\CustomBlog\Http\Request\Param;

class Helper
{
    // ########################################

    /**
     * @param string $param
     *
     * @return string
     */
    public function prepareStringParam(string $param): string
    {
        return htmlentities(trim($param));
    }

    // ########################################
}