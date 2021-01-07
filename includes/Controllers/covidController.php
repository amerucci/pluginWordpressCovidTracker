<?php
require_once  __DIR__ . '/../Models/Data.php';

/**
 * Get a department by giving his name
 *
 * @param  mixed $atts
 * @return void
 */
function getDepartment($atts)
{
    $data = new Data;
    $datas = $data->getDepartement($atts);
    require(__DIR__ . "/../Views/list.php");
    return $html;
}

/**
 * Get All the departments
 *
 * @return void
 */
function getAllDepartment(){
    $data = new Data; 
    $datas = $data->getDepartement($atts);
    require(__DIR__ . "/../Views/list.php");
    return $html;
}