
# volcano/routing

The Routing component of a regular expression based router.

## Getting Started

```bash
composer require volcano/routing
```
```php
$router = new \Volcano\Routing\Router();
$router->get('/forum/{forum_id}', function () {return 'Hello world';});

if ($route = $router->dispatch('/forum3/321')) {
    echo call_user_func($route->handler);
} else {
    echo 'Route not found';
}
```

## License

[MIT](LICENSE.md)

    