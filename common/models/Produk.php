<?php

namespace common\models;
use common\models\SettingMarketplace;
use common\models\Toko;
use common\models\User;

use Yii;

/**
 * This is the model class for table "produk".
 *
 * @property string $sku
 * @property bool $status_aktif
 * @property string $nama_produk
 * @property string $brand
 * @property string $warna
 * @property string $deskripsi
 * @property int $harga_async
 * @property int $stok_async
 * @property int $berat
 * @property resource $foto_1
 * @property resource|null $foto_2
 * @property resource|null $foto_3
 * @property resource|null $foto_4
 * @property resource|null $foto_5
 * @property resource|null $foto_6
 * @property resource|null $foto_7
 * @property string|null $video_url_1
 * @property string|null $video_url_2
 * @property string|null $video_url_3
 * @property string|null $video_url_4
 * @property string|null $video_url_5
 * @property string|null $rekomendasi_1
 * @property string|null $rekomendasi_2
 * @property string|null $rekomendasi_3
 * @property string|null $rekomendasi_4
 * @property string|null $rekomendasi_5
 * @property string|null $urlid_bli 
 * @property string|null $urlid_bkl 
 * @property string|null $urlid_fbc 
 * @property string|null $urlid_fbm 
 * @property string|null $urlid_jdi 
 * @property string|null $urlid_lzd 
 * @property string|null $urlid_shp 
 * @property string|null $urlid_tkp 
 *
 * @property Produk $rekomendasi1
 * @property Produk[] $produks
 * @property Produk $rekomendasi2
 * @property Produk[] $produks0
 * @property Produk $rekomendasi3
 * @property Produk[] $produks1
 * @property Produk $rekomendasi4
 * @property Produk[] $produks2
 * @property Produk $rekomendasi5
 * @property Produk[] $produks3
 * @property Toko $kodeToko
 */
class Produk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $toko=Toko::findOne(['kode'=>Yii::$app->user->identity->kode_toko]);

        $text_skuprefix='';
        foreach ($toko->attributes as $key => $value) {
            if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                $text_skuprefix .=$value.'|';
            }
        }
        $text_skuprefix = rtrim($text_skuprefix,'|');

        return [
            [['kode_toko','sku', 'nama_produk', 'brand', 'warna', 'deskripsi', 'harga_async', 'stok_async', 'berat'], 'required'],
            ['kode_toko', 'string', 'max' => 50],
            ['kode_toko', 'match' ,'pattern'=>'/^[A-Za-z0-9._-]+$/u','message'=> 'Only alphanumeric, dot(.), underscore(_), and hypen(-)'],
            [['status_aktif'], 'boolean'],
            [['harga_async', 'stok_async', 'berat'], 'default', 'value' => null],
            [['harga_async', 'stok_async', 'berat'], 'integer'],
            [['foto_1', 'foto_2', 'foto_3', 'foto_4', 'foto_5', 'foto_6', 'foto_7'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg', 'mimeTypes'=>'image/jpeg'],
            [['urlid_bli', 'urlid_bkl', 'urlid_fbc', 'urlid_fbm', 'urlid_jdi', 'urlid_lzd', 'urlid_shp', 'urlid_tkp'], 'string'],
            [['sku','warna','id_tkp'], 'string', 'max' => 20],
            [['nama_produk','brand'], 'string', 'max' => 70],
            [['deskripsi'], 'string', 'max' => 2000],
            [['video_url_1', 'video_url_2', 'video_url_3', 'video_url_4', 'video_url_5', 'rekomendasi_1', 'rekomendasi_2', 'rekomendasi_3', 'rekomendasi_4', 'rekomendasi_5'], 'string', 'max' => 250],
            ['sku', 'match' ,'pattern'=>'/^('.$text_skuprefix.')[0-9]{4}/','message'=> 'Format SKU harus sesuai contoh'],
            ['sku', 'unique', 'targetAttribute' => ['kode_toko', 'sku']],
            [['rekomendasi_1'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['rekomendasi_1' => 'sku']],
            [['rekomendasi_2'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['rekomendasi_2' => 'sku']],
            [['rekomendasi_3'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['rekomendasi_3' => 'sku']],
            [['rekomendasi_4'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['rekomendasi_4' => 'sku']],
            [['rekomendasi_5'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::className(), 'targetAttribute' => ['rekomendasi_5' => 'sku']],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['backend-import-deskripsi'] = ['deskripsi'];
        $scenarios['backend-import-foto'] = ['foto_1','foto_2','foto_3','foto_4','foto_5','foto_6','foto_7'];
        $scenarios['backend-import-hargastok'] = ['harga_async','stok_async'];
        $scenarios['backend-import-tambah-produk'] = ['kode_toko','sku','nama_produk','brand','warna','deskripsi','harga_async','stok_async','berat','video_url_1','video_url_2','video_url_3'];
        $scenarios['backend-import-urlid'] = ['urlid_bli', 'urlid_bkl', 'urlid_fbc', 'urlid_fbm', 'urlid_jdi', 'urlid_lzd', 'urlid_shp', 'urlid_tkp','id_tkp'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_toko' => 'Kode Toko',
            'sku' => 'SKU',
            'status_aktif' => 'Status Aktif',
            'nama_produk' => 'Nama Produk',
            'brand' => 'Brand',
            'warna' => 'Warna',
            'deskripsi' => 'Deskripsi',
            'harga_async' => 'Harga',
            'stok_async' => 'Stok',
            'berat' => 'Berat',
            'foto_1' => 'Foto 1',
            'foto_2' => 'Foto 2',
            'foto_3' => 'Foto 3',
            'foto_4' => 'Foto 4',
            'foto_5' => 'Foto 5',
            'foto_6' => 'Foto 6',
            'foto_7' => 'Foto 7',
            'video_url_1' => 'Video Url 1',
            'video_url_2' => 'Video Url 2',
            'video_url_3' => 'Video Url 3',
            'video_url_4' => 'Video Url 4',
            'video_url_5' => 'Video Url 5',
            'rekomendasi_1' => 'Rekomendasi 1',
            'rekomendasi_2' => 'Rekomendasi 2',
            'rekomendasi_3' => 'Rekomendasi 3',
            'rekomendasi_4' => 'Rekomendasi 4',
            'rekomendasi_5' => 'Rekomendasi 5',
            'urlid_bli' => 'URL/ID Blibli', 
            'urlid_bkl' => 'URL/ID Bukalapak', 
            'urlid_fbc' => 'URL/ID FB Catalog', 
            'urlid_fbm' => 'URL/ID FB Marketplace', 
            'urlid_jdi' => 'URL/ID JDID', 
            'urlid_lzd' => 'URL/ID Lazada', 
            'urlid_shp' => 'URL/ID Shopee', 
            'urlid_tkp' => 'URL/ID Tokopedia', 
            'id_tkp' => 'Produk ID Tokopedia', 
        ];
    }

    /**
     * Gets query for [[Rekomendasi1]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getRekomendasi1()
    {
        return $this->hasOne(Produk::className(), ['sku' => 'rekomendasi_1'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);;
    }

    /**
     * Gets query for [[Produks]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::className(), ['rekomendasi_1' => 'sku'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Rekomendasi2]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getRekomendasi2()
    {
        return $this->hasOne(Produk::className(), ['sku' => 'rekomendasi_2'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Produks0]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getProduks0()
    {
        return $this->hasMany(Produk::className(), ['rekomendasi_2' => 'sku'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function deskripsiProduk($marketplace,$sku){
        $deskripsi_produk = self::headerProduk($marketplace).self::findOneProduk($sku)->deskripsi.self::rekomendasiProduk($marketplace,$sku).self::footerProduk($marketplace);
        
        switch ($marketplace) {
            case 'lzd':
                $deskripsi_produk = nl2br($deskripsi_produk);
                break;
        }

        return empty($deskripsi_produk) ? null : $deskripsi_produk;
    }

    public static function deskripsiProdukWithAllMarketplaceLink($marketplace,$sku){
        return self::headerProduk($marketplace).self::findOneProduk($sku)->deskripsi.self::rekomendasiProduk($marketplace,$sku).self::allMarketplaceLinkProduk($sku).self::footerProduk($marketplace);
    }

    public static function allMarketplaceLinkProduk($sku){
        
        $obj = new Produk();

        $arrFields = array_keys($obj->attributes); 

        $all_marketplace_link_produk = null;
        foreach ($arrFields as $key => $value) {
            if(substr($value,0,5)=='urlid') {
                $all_marketplace_link_produk .= empty(self::findOneProduk($sku)->$value) ? null : '* '.self::urlProduk(substr($value,6,3),$sku)."\n";
            }
        }

        return empty($all_marketplace_link_produk) ? null : "\n\n".'Beli '.self::findOneProduk($sku)->nama_produk.' langsung di online shop kami:'."\n".$all_marketplace_link_produk."\n";
    }

    public static function footerProduk($marketplace){
        $footer_produk =SettingMarketplace::parameter($marketplace)->footer_produk;
        return empty($footer_produk) ? null : "\n\n".$footer_produk;
    }

    public static function headerProduk($marketplace){
        $header_produk =SettingMarketplace::parameter($marketplace)->header_produk;
        return empty($header_produk) ? null : $header_produk."\n\n";
    }

    public static function keywordProduk($sku){
        $nama_produk = self::findOneProduk($sku)->nama_produk;

        $karakter_asal = array('+','(',')',' ');
        $karakter_pengganti = array(',',',',',',',');
        $keyword_produk = str_replace($karakter_asal,$karakter_pengganti,$nama_produk);

        return empty($keyword_produk) ? null : $keyword_produk;
    }

    public static function namaProduk($marketplace,$sku){
        switch ($marketplace) {
            case 'bkl':
                $karakter_asal = array('+','(',')',',','/',"'");
                $karakter_pengganti = array('&','- ',' -','','Atau','');
                $nama_produk = str_replace($karakter_asal,$karakter_pengganti,self::findOneProduk($sku)->nama_produk);
                break;
            default:
                $nama_produk = self::findOneProduk($sku)->nama_produk;
                break;
        }

        return empty($nama_produk) ? null : $nama_produk;
    }

    public static function rekomendasiProduk($marketplace,$sku){
        $rekomendasi = null;
        for ($i=1; $i <= 5 ; $i++) { 
            $rekomendasi_ke = 'rekomendasi_'.$i;
            $rekomendasi .= empty(self::findOneProduk($sku)->$rekomendasi_ke) ? null : '* '.self::namaProduk($marketplace,self::findOneProduk($sku)->$rekomendasi_ke).' '.self::urlProduk($marketplace,self::findOneProduk($sku)->$rekomendasi_ke)."\n";
        }
 
        return empty($rekomendasi) ? null : "\n\n".'Rekomendasi barang lainnya:'."\n".$rekomendasi."\n";
    }

    public static function urlProduk($marketplace,$sku){
        switch ($marketplace) {
            case 'bkl':
                return self::findOneProduk($sku)->urlid_bkl;
                break;
            case 'bli':
                return 'http://blibli.com/product-detail-'.substr(str_replace('-','.',self::findOneProduk($sku)->urlid_bli),0,15).'.html';
                break;
            case 'lzd';
                return '<a href="https://www.lazada.co.id/products/i'.self::findOneProduk($sku)->urlid_lzd.'.html">https://www.lazada.co.id/products/i'.self::findOneProduk($sku)->urlid_lzd.'.html</a>';
                break;
            case 'shp';
                $idtoko = SettingMarketplace::parameter('shp')->shp_idtoko;
                return 'https://shopee.co.id/product/'.$idtoko.'/'.self::findOneProduk($sku)->urlid_shp;
                break;
            case 'tkp':
                return self::findOneProduk($sku)->urlid_tkp;
                break;
            default:
                return null;
                break;
        }
    }

    /**
     * Gets query for [[Rekomendasi3]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getRekomendasi3()
    {
        return $this->hasOne(Produk::className(), ['sku' => 'rekomendasi_3'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Produks1]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getProduks1()
    {
        return $this->hasMany(Produk::className(), ['rekomendasi_3' => 'sku'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Rekomendasi4]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getRekomendasi4()
    {
        return $this->hasOne(Produk::className(), ['sku' => 'rekomendasi_4'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Produks2]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getProduks2()
    {
        return $this->hasMany(Produk::className(), ['rekomendasi_4' => 'sku'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Rekomendasi5]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getRekomendasi5()
    {
        return $this->hasOne(Produk::className(), ['sku' => 'rekomendasi_5'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * Gets query for [[Produks3]].
     *
     * @return \yii\db\ActiveQuery|ProdukQuery
     */
    public function getProduks3()
    {
        return $this->hasMany(Produk::className(), ['rekomendasi_5' => 'sku'])
        ->andOnCondition(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    /**
     * {@inheritdoc}
     * @return ProdukQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProdukQuery(get_called_class());
    }

    public static function findProduk()
    {
        return self::find()
            ->where(['kode_toko'=>Yii::$app->user->identity->kode_toko]);
    }

    public static function findOneProduk($sku)
    {
        return self::findProduk()
            ->andWhere(['sku'=>$sku])
            ->one();
    }

    public static function findOneProdukByIdLzd($id_lzd)
    {
        return self::findProduk()
            ->andWhere(['urlid_lzd'=>$id_lzd])
            ->one();
    }

    public static function findOneProdukByIdTkp($id_tkp)
    {
        return self::findProduk()
            ->andWhere(['id_tkp'=>$id_tkp])
            ->one();
    }

    public static function findOneProdukSkuAsign($sku)
    {
        $user=User::findOneUser(Yii::$app->user->identity->email);

        $skuprefix=array();
        foreach ($user->attributes as $key => $value) {
            if(substr($key,0,9)=='skuprefix'&&!empty($value)){
                array_push($skuprefix,$value);
            }
        }
        
        return self::findProduk()
            ->andWhere(['sku'=>$sku])
            ->andWhere(['or like','sku',[$skuprefix]])
            ->one();
        
    }

    public static function findProdukAktif()
    {
        return self::findProduk()
            ->andWhere(['status_aktif'=>TRUE]);
    }

    public static function findRequestPost($sku)
    {
        return self::findProduk()
            ->andWhere(['in','sku',$sku])
            ->orderBy(['sku' => SORT_ASC]);
    }

    public static function findProdukBelumTerpilih($list_exist)
    {
        return self::findProduk()
            ->andWhere(['NOT IN','sku',$list_exist])
            ->orderBy(['sku'=>SORT_ASC]);
    }

    
}
