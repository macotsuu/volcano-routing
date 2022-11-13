<?php

    namespace Volcano\Routing\RouteCollection;

    use Traversable;
    use Volcano\Routing\Route;

    class RouteCollection implements RouteCollectionInterface
    {
        protected array $elements = [];
        protected int $pointer = -1;

        /**
         * @inheritDoc
         */
        public function add(string $key, Route $route): bool
        {
            $this->elements[$key][] = $route;

            return true;
        }

        public function toArray(): array
        {
            return $this->elements;
        }

        public function getIterator(): Traversable
        {
            yield from $this->toArray();
        }

        public function contains(string $key): bool
        {
            return isset($this->elements[$key]);
        }

        public function size(string $key): int
        {
            return count($this->elements[$key]);
        }
    }
