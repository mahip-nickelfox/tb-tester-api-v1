<?php

$router->options('/{any:.*}', ['middleware' => ['CorsMiddleware'], function () {
	return response(['status' => 'success']);
}]);

$router->get('/', function () use ($router) {
    return [
    	'api'		=>	'T.B. Tester Api',
    	'version'	=>	'1.0'
    ];
});

$router->group(['prefix' => 'v1/', 'middleware' => 'CorsMiddleware'], function () use ($router) {
	$router->get('hospitals[/{lang}]', 'HospitalController@getHospitals');
	$router->get('questions[/{lang}]', 'QuestionsController@getQuestions');
	$router->get('extra/questions[/{lang}]', 'QuestionsController@getExtraQuestions');
});