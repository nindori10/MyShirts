<?php
require('lib.php');

$message = $_GET["score"];

$chat = new ChatAPI();
$chat->set($message);
