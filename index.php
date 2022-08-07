<?php
require 'tools/Router.php';
require_once './tools/Authentificator.php';
require './Model/UserClass.php';

$authentifier = new Authentificator();
$authentifier->startSession();

$homeWay = new Router;
$homeWay->Way();
