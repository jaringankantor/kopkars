<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\StringHelper;


class Kopkarstext extends Component {
    public function textOrNull($input)
    {
       return empty($input)?null:$input;
    }
    public function hp62($input)
    {
       return empty($input)?null:'62'.$input;
    }
}
