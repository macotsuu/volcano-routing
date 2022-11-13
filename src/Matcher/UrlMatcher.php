<?php

    namespace Volcano\Routing\Matcher;

    use PDO;
    use Volcano\Routing\Route;

    class UrlMatcher implements UrlMatcherInterface
    {
        private Route $route;
        private string $path;
        private string $method;
        /**
         * @inheritDoc
         */
        public function match(string $path, string $method, Route $route): false|Route
        {
            $this->setRoute($route);
            $this->setMethod($method);
            $this->setPath(rawurldecode($path) ?: '/');

            return $this->matchRoute(
                $this->path,
                $this->method,
                $this->route
            );
        }

        /**
         * @param string $path
         * @param string $method
         * @param Route $route
         * @return false|Route
         */
        public function matchRoute(string $path, string $method, Route $route): false|Route
        {
            if ($route->method !== $method) {
                return false;
            }

            if ('HEAD' === $method) {
                $method = 'GET';
            }

            if (preg_match($route->getRegex(), rtrim($path, '/') ?: '/', $matches)) {
                $values = array_filter($matches, static function ($key) {
                    return is_string($key);
                }, ARRAY_FILTER_USE_KEY);

                foreach ($values as $key => $value) {
                    $route->attributes[$key] = $value;
                }

                return $route;
            }

            return false;
        }

        /**
         * @param Route $route
         * @return self
         */
        private function setRoute(Route $route): self
        {
            $this->route = $route;

            return $this;
        }

        /**
         * @param string $path
         * @return self
         */
        private function setPath(string $path): self
        {
            $this->path = rawurldecode($path) ?: '/';

            return $this;
        }
        /**
         * @param string $method
         * @return self
         */
        private function setMethod(string $method): self
        {
            $this->method = $method;

            return $this;
        }
    }
