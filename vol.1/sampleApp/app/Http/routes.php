<?php

resource('bus', 'BusController', ['only' => 'index']);
resource('f1', 'FormulaController', ['only' => 'index']);
resource('wrc', 'RallyController', ['only' => 'index']);
resource('tag', 'TagController', ['only' => 'index']);

\Route::group(['prefix' => 'v1'], function () {
    resource('api', 'ApiController', ['only' => 'index']);
});

\Route::group(['middleware' => 'home'], function() {
    \Route::controller("/", "HomeController");
});
