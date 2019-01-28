<?php

require("lib.php");

$name = $_POST["name"];
$score = $_POST["score"];

$chat = new ChatAPI();
$chat->auth($name, $score);
