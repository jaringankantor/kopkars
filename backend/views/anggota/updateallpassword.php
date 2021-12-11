<?php

//Untuk memberikan password hash ke semua pengguna

use common\models\Anggota;

$query = Anggota::find()->all();

foreach ($query as $row) {

    $cu_id = $row['nama_lengkap'];

    $model = Anggota::findOne($row['id']);
    $model->scenario = 'updateallpassword';
    //$model->generateAuthKey();
    $model->setPassword($row['password_default']);

    $model->save();


    echo "$cu_id<br>";


}
