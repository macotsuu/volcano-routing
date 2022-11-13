<?php

    namespace Volcano\Routing;

    class Route
    {
        public $attributes = [];

        public function __construct(
            public string $method,
            public string $path,
            public mixed $handler
        ) {
        }

        /**
         * Get regex for path
         *
         * @return string
         */
        public function getRegex(): string
        {
            preg_match_all('/{[^}]*}/', $this->path, $matches);

            $regex = $this->path;
            $params = reset($matches) ?? [];

            foreach ($params as $param) {
                $regex = str_replace(
                    $param,
                    '(?P<' . trim($param, '{\}') . '>[^/]++)',
                    $regex
                );
            }

            return "#^$regex$#sD";
        }

        public function getAttribute(string $key): mixed
        {
            return $this->attributes[$key] ?: null;
        }
    }
