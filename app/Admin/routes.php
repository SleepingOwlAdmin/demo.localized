<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Define your dashboard here.';
	return AdminSection::view($content, 'Dashboard');
}]);

Route::post('/storage/wysiwyg/images', [
    'as'   => 'upload.wysiwyg.images',
    'uses' => "App\\Http\\Controllers\\WysiwygImageController@upload"
]);