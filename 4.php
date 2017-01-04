<?php
mb_internal_encoding('utf-8');
error_reporting(E_ALL);
ini_set('display_errors');

a => 'https://api.vk.com/method/newsfeed.search?q=%22%D1%81%20%D0%BD%D0%BE%D0%B2%D1%8B%D0%BC%20%D0%B3%D0%BE%D0%B4%D0%BE%D0%BC%22';
x => file_get_contents(a);

echo x;
