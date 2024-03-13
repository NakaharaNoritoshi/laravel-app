<?php

return [
    'validates' => [
        'name' => 'required',
        'mail' => 'required|email',
        'mail_confirmation' => 'required|email|same:mail',
        'title' => 'required',
        'content' => 'required',
        'reply' => 'required',
        'category' => 'required',
    ]
];
