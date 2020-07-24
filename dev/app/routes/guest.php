<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get("/{account}/{project}/info/refs", "Git\GitController@refs");
    Route::post("/{account}/{project}/git-upload-pack", "Git\GitController@uploadPack");
    Route::post("/{account}/{project}/git-receive-pack", "Git\GitController@receivePack");
});
