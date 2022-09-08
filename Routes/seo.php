<?php

declare(strict_types=1);

<<<<<<< HEAD
// custom route finche' siamo legati ai modelli
=======
//custom route finche' siamo legati ai modelli
>>>>>>> 9472ad4 (first)
// lista e' index, mostrare un elemento e' show ..

Route::get('{lang}/feed/{item}', 'RssFeedController@feed');
Route::get('/sitemap.xml', 'SiteMapController@index');
Route::get('{lang}/sitemap', 'SiteMapController@index');
