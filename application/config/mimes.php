<?php
defined('BASEPATH') OR exit('No direct script access allowed');

return array(
    'html' => array('text/html', 'text/plain'),
    'css'  => 'text/css',
    'js'   => 'application/javascript',
    'json' => array('application/json', 'text/json'),
    'xml'  => array('application/xml', 'text/xml'),
    'jpg'  => array('image/jpeg', 'image/pjpeg'),
    'jpeg' => array('image/jpeg', 'image/pjpeg'),
    'png'  => 'image/png',
    'gif'  => 'image/gif',
    'pdf'  => array('application/pdf', 'application/x-download'),
    'zip'  => array('application/zip', 'application/x-zip-compressed')
);
