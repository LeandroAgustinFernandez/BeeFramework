<?php

class errorController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = ['title' => 'Error', 'bg' => 'dark'];
        View::render('404', $data);
    }
}
