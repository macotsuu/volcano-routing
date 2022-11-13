<?php

    namespace Volcano\Routing\Matcher;

    use Volcano\Routing\Route;

    interface UrlMatcherInterface
    {
        /**
         * Undocumented function
         *
         * @param string $path
         * $param string $method
         * @param Route $route
         * @return false|array
         */
        public function match(string $path, string $method, Route $route): false|Route;
    }
