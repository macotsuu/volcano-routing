<?php

    namespace Volcano\Routing;

    use Volcano\Routing\Matcher\UrlMatcher;
    use Volcano\Routing\Matcher\UrlMatcherInterface;
    use Volcano\Routing\RouteCollection\RouteCollection;
    use Volcano\Routing\RouteCollection\RouteCollectionInterface;

    class Router
    {
        private UrlMatcherInterface $matcher;
        private RouteCollectionInterface $routes;

        public function __construct()
        {
            $this->matcher = new UrlMatcher();
            $this->routes = new RouteCollection();
        }

        public function get(string $uri, mixed $handler)
        {
            return $this->route('GET', $uri, $handler);
        }

        public function post(string $uri, mixed $handler)
        {
            return $this->route('POST', $uri, $handler);
        }

        public function put(string $uri, mixed $handler)
        {
            return $this->route('PUT', $uri, $handler);
        }

        public function patch(string $uri, mixed $handler)
        {
            return $this->route('PATCH', $uri, $handler);
        }

        public function delete(string $uri, mixed $handler)
        {
            return $this->route('DELETE', $uri, $handler);
        }

        public function options(string $uri, mixed $handler)
        {
            return $this->route('options', $uri, $handler);
        }

        public function match(array $methods, string $uri, mixed $handler)
        {
            foreach ($methods as $method) {
                $this->route(strtoupper($method), $uri, $handler);
            }
        }

        public function dispatch(string $uri, string $method = "GET"): false|Route
        {
            $uri = explode('?', $uri)[0] ?: $uri;

            foreach ($this->routes as $path => $routes) {
                foreach ($routes as $route) {
                    if ($result = $this->matcher->match($uri, $method, $route)) {
                        return $result;
                    }
                }
            }
            return false;
        }

        protected function route(string $method, string $uri, mixed $handler): bool
        {
            $this->routes->add(
                $uri,
                new Route($method, $uri, $handler)
            );

            return true;
        }
    }
