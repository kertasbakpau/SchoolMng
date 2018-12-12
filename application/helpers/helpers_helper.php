<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function encryptMd5($string){
    $hash = md5($string);
    $lastestString = substr($hash, strlen($hash) - 1,1);
    $asci = ord($lastestString);
    $asci++;
    $newChar = chr($asci++);
    $newString = substr($hash, 0,strlen($hash) - 1).$newChar;
    echo $lastestString;
    return $newString;
}

function formatDateString($date){
    return (string)date("d-m-Y",strtotime($date));
}

// function decryptMd5($hash){
//     $lastestString = substr($string, strlen($string) - 2,1);
//     $asci = ord($lastestString);
//     $asci--;
//     $newChar = chr($asci++);
//     $newString = substr($string, 0,strlen($string) - 1).$newChar;
//     return $newString;
// }