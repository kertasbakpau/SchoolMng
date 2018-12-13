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


function getEnumName($enumName, $enumValue){
    $CI =& get_instance();
    $CI->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $CI->config->item('language'));

    $CI->db->select('b.*');
    $CI->db->from('m_enum a');
    $CI->db->join('m_enumdetail b','a.Id = b.EnumId','inner');
    $CI->db->where('a.Name', $enumName);
    $CI->db->where('b.Value', $enumValue);
    $data = $CI->db->get()->row();

    if($data){
        if(isset($data->Resource)){
            return $CI->lang->line($data->Resource);
        } else {
            return $data->EnumName;
        }
    }
    return "";
}

// function decryptMd5($hash){
//     $lastestString = substr($string, strlen($string) - 2,1);
//     $asci = ord($lastestString);
//     $asci--;
//     $newChar = chr($asci++);
//     $newString = substr($string, 0,strlen($string) - 1).$newChar;
//     return $newString;
// }