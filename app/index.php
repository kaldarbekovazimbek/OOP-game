<?php
require_once '..\classes\Game.php';
require_once '..\classes\Player.php';

$game = new Game(
    new Player('Jon', 100),
    new Player('Jane', 10)
);

$game->start();