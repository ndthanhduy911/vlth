<?php

namespace Models;

class ClassesLang extends \Phalcon\Mvc\Model
{
    public $id;

    public $class_id;
    
    public $lang_id;

    public $title;

    public $content;

    public $excerpt;

    public function getSource()
    {
        return 'classes_lang';
    }

    public static function getNamepace (){
        return 'Models\ClassesLang';
    }

    public static function findFirstId($id, $columns = "*")
    {
        return parent::findFirst([
            "conditions" => "id = :id:",
            "bind" => array('id' => $id),
            "columns" => $columns
        ]);   
    }
}