<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/send-mail',function(){
    Mail::raw('This is a test email using Laravel 12', function($message){
        $message->to('user@localhost.test')->subject('Test Email from Laravel 12');
    });
    return "Email Sent Successfully";
});
