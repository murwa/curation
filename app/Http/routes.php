<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
/*
 * Routes for curation - TODO:- to be moved to own project
 */
# Model bind for institute
$router->bind('institute', function ($url) {
    return \App\Models\Curation\Institute::whereUrl($url)->first();
});
$router->resource('curation/institute', 'Curation\InstituteController', [
    'names' => [
        'index' => 'curation_institution_index',
        'store' => 'curation_institution_store',
        'show' => 'curation_institution_show',
        'update' => 'curation_institution_update',
        'destroy' => 'curation_institution_destroy'
    ],
    'only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ]
]);

# Model bind for faculty
$router->bind('faculty', function ($url) {
    return \App\Models\Curation\Faculty::whereUrl($url)->first();
});
$router->resource('curation/institute.faculty', 'Curation\FacultyController', [
    'names' => [
        'store' => 'curation_school_store',
        'show' => 'curation_school_show',
        'update' => 'curation_school_update',
        'destroy' => 'curation_school_destroy'
    ],
    'only' => [
        'store', 'show', 'update', 'destroy'
    ]
]);

# Model bind for course
$router->bind('degree', function ($url) {
    return \App\Models\Curation\Course::whereUrl($url)->first();
});
$router->resource('curation/institute.faculty.degree', 'Curation\CourseController', [
    'names' => [
        'store' => 'curation_course_store',
        'show' => 'curation_course_show',
        'update' => 'curation_course_update',
        'destroy' => 'curation_course_destroy'
    ],
    'only' => [
        'store', 'show', 'update', 'destroy'
    ]
]);

# Model bind for unit
$router->bind('entity', function ($url) {
    return \App\Models\Curation\Unit::whereUrl($url)->first();
});
$router->resource('curation/institute.faculty.degree.entity', 'Curation\UnitController', [
    'names' => [
        'store' => 'curation_unit_store',
        'show' => 'curation_unit_show',
        'update' => 'curation_unit_update',
        'destroy' => 'curation_unit_destroy'
    ],
    'only' => [
        'store', 'show', 'update', 'destroy'
    ]
]);

# Model bind for topic
$router->bind('topic', function ($url) {
    return \App\Models\Curation\Topic::whereUrl($url)->first();
});
$router->resource('curation/institute.faculty.degree.entity.topic', 'Curation\TopicController', [
    'names' => [
        'store' => 'curation_topic_store',
        'show' => 'curation_topic_show',
        'update' => 'curation_topic_update',
        'destroy' => 'curation_topic_destroy'
    ],
    'only' => [
        'store', 'show', 'update', 'destroy'
    ]
]);


