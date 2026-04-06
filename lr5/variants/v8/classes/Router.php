<?php

class Router
{
    private string $defaultController = 'index';
    private string $defaultAction = 'main';
    private $routes = [
        '/guestbook' => 'GuestbookController@index',
        '/guestbook/add' => 'GuestbookController@add',
        '/upload' => 'UploadController@index',
        '/upload/upload' => 'UploadController@upload',
        '/directories/create' => 'DirectoriesController@create',
        '/directories/delete' => 'DirectoriesController@delete',
        '/instruments' => 'InstrumentsController@index',
        '/instruments/add' => 'InstrumentsController@add',
        '/instruments/edit/:id' => 'InstrumentsController@edit',
        '/instruments/delete/:id' => 'InstrumentsController@delete',
        '/auth/register' => 'AuthController@register',
        '/auth/login' => 'AuthController@login',
        '/auth/profile' => 'AuthController@profile',
        '/auth/edit' => 'AuthController@edit',
        '/auth/delete' => 'AuthController@delete',
        '/auth/logout' => 'AuthController@logout',
    ];

    public function parseRoute(): array
    {
        $route = $_GET['route'] ?? $this->defaultController . '/' . $this->defaultAction;
        $route = trim($route, '/');
        $parts = explode('/', $route);

        $controller = $parts[0] ?? $this->defaultController;
        $action = $parts[1] ?? $this->defaultAction;

        if (!preg_match('/^[a-z][a-z0-9]*$/i', $controller) || !preg_match('/^[a-z][a-z0-9_]*$/i', $action)) {
            $controller = $this->defaultController;
            $action = $this->defaultAction;
        }

        return [
            'controller' => $controller,
            'action' => $action,
        ];
    }
}
