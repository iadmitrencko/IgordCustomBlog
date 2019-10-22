<?php

namespace Igord\CustomBlog\lib\Http;

class Redirect
{
    // ########################################

    /**
     * @param string $uri
     * @param int    $responseCode
     */
    public function to(string $uri, $responseCode = 303)
    {
        header('Location: ' . $uri, true, $responseCode);
    }

    // ########################################
}