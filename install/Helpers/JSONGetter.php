<?php

namespace Install\Helpers;

class JSONGetter
{
    private array $json_data;

    public function __construct()
    {
        $this->json_data = json_decode(file_get_contents(__DIR__ . '/../test_data/data.json'), true);
    }

    public function getModel(int $brand_index, int $model_index)
    {
        $brand = $this->json_data['brands'][$brand_index];
        $model = $this->json_data['models'][$model_index];

        return "{$brand} - {$model}";
    }

    public function getSpecs()
    {
        $text = "";

        $specs = $this->json_data['specs'];

        for ($i = 0; $i < count($specs); $i++) {
            switch ($i) {
                case 0:
                    $spec_value = $this->json_data['CoreOptions'][rand(0, 3)];
                    break;
                case 1:
                    $spec_value = $this->json_data['RAMoptions'][rand(0, 3)];
                    break;
                case 2:
                    $spec_value = $this->json_data['ScreenOptions'][rand(0, 3)];
                    break;
                case 3:
                    $spec_value = $this->json_data['BatteryOptions'][rand(0, 3)];
                    break;
                default:
                    $spec_value = $this->json_data['CloseOptions'][rand(0, 1)];
                    break;
            }

            $text .= $specs[$i] . $spec_value . "<br />";
        }

        return $text;
    }

    public function getNames(int $name_index)
    {
        return $this->json_data['names'][$name_index];
    }

    public function getClassifications(int $classification_index)
    {
        return $this->json_data['classifications'][$classification_index];
    }

    public function getSubClassifications(int $sub_classification_index)
    {
        return $this->json_data['sub_classifications'][$sub_classification_index];
    }
}
