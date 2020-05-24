<?php
session_start();
$img = ImageCreateFromJpeg("images/noise.jpg");
$color = imageColorAllocate($img, 64, 64, 64);
imageAntiAlias($img, true);

$nChars = 5;

$randStr = substr(md5(uniqid()),0,$nChars);
$_SESSION['randStr'] = $randStr;

$x = 20; $y = 30; $deltaX = 40;
for ($i=0; $i<$nChars; $i++)
{
    $size = rand(24, 30);
    $angle = -30 + rand(0,60);
    imageTtfText($img, $size, $angle, $x, $y, $color, "C:/xampp/htdocs/servicedesk/admin/gd/fonts/bellb.ttf", $randStr{$i});
    $x += $deltaX;
}

header ("Content-type: image/jpeg");
imageJpeg($img); 
