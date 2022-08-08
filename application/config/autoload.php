<?php
defined('BASEPATH') or exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'form_validation', 'email', 'encryption');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'form', 'file', 'text');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('ProductModel', 'AccountModel', 'DeskModel', 'SalesModel');