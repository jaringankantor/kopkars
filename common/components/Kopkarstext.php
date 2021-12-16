<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\StringHelper;


class Apeitext extends Component {
    public function textOrNull($input)
    {
       return empty($input)?null:$input;
    }
}
