<?php

    namespace Volcano\Routing\RouteCollection;

    use IteratorAggregate;
    use Volcano\Routing\Route;

    interface RouteCollectionInterface extends IteratorAggregate
    {
        /**
         * Undocumented function
         *
         * @param string $path
         * @param Route $route
         * @return bool
         */
        public function add(string $path, Route $route): bool;
        public function toArray(): array;
        public function contains(string $key): bool;
        public function size(string $key): int;
    }
