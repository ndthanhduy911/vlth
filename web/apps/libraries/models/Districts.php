<?php

class Districts extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->setSchema(SCHEMADB);
        $this->setSource("districts");
    }

    public static function getS2DistrictCity($cityId = 0)
    {
        $data = parent::find([
            "provinceid = :cityId:",
            'columns' => "id, CONCAT(type,' ',name) as text",
            'bind' => [
                'cityId' => $cityId
            ]
        ]);
        return $data->toArray();
    }
}
