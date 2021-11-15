<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pub_pegawai".
 *
 * @property int $pegId tabel data pegawai
 * @property string|null $pegKodeResmi
 * @property string|null $pegKodeInternal
 * @property string|null $pegKodeLain
 * @property int|null $pegKodeGateAccess
 * @property string|null $pegNama
 * @property string|null $pegAlamat
 * @property string|null $pegKodePos
 * @property string|null $pegNoTelp
 * @property string|null $pegNoHp
 * @property string|null $pegEmail
 * @property int|null $pegSatwilId reference ke tabel pub_res_satuan_wilayah
 * @property string|null $pegTmpLahir
 * @property string|null $pegTglLahir
 * @property string|null $pegKelamin
 * @property string|null $pegJenisIdLain
 * @property string|null $pegIdLain
 * @property int|null $pegAgamaId
 * @property string|null $pegKepercayaan
 * @property int|null $pegStatnikahId
 * @property int|null $pegGoldrhId
 * @property int|null $pegTinggiBadan
 * @property int|null $pegBeratBadan
 * @property string|null $pegWarnaRambut
 * @property string|null $pegWarnaKulit
 * @property string|null $pegBentukMuka
 * @property string|null $pegCiriKhas
 * @property string|null $pegCacat
 * @property string|null $pegHobby
 * @property int|null $pegJnspegrId
 * @property string|null $pegPnsTmt
 * @property string|null $pegCpnsTmt
 * @property string|null $pegTglMasukInstitusi
 * @property string|null $pegTglKeluarInstitusi
 * @property int|null $pegPnsCpnsTkpddkrId
 * @property string|null $pegNoTaspen
 * @property string|null $pegNoAskes
 * @property string|null $pegStatusNPWP
 * @property string|null $pegNoNPWP
 * @property int|null $pegUsiaPensiun
 * @property int|null $pegStatrId
 * @property int|null $pegLevelId
 * @property string|null $pegGelarDepan
 * @property string|null $pegGelarBelakang
 * @property string|null $pegFoto
 * @property int|null $pegKodeAbsen
 * @property string|null $pegCreationDate tanggal insert data
 * @property string|null $pegLastUpdate tanggal update data terakhir
 * @property int|null $pegUserId user pengubah terakhir
 * @property string|null $pegStatusWargaNeg
 * @property int|null $pegIsCalon
 * @property int|null $pegNipLama
 * @property string|null $pegKodeKontrak
 * @property string|null $pegNoKarpeg
 * @property string|null $pegNoSer
 * @property string|null $pegThnSer
 * @property string|null $pegNoSk
 * @property string|null $pegJalanRumah
 * @property string|null $pegDesaRumah
 * @property string|null $pegKecRumah
 * @property string|null $pegKotaRumah
 * @property string|null $pegProvinsiRumah
 * @property int|null $pegGradeId
 * @property int|null $pegSertifikatId
 * @property int|null $pegKepakaranTeknisId
 * @property int|null $pegPengalamanIndustriId
 * @property int|null $pegPenilaianKinerjaId
 */
class DbpegawaiPubPegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pub_pegawai';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_pegawai');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pegKodeGateAccess', 'pegSatwilId', 'pegAgamaId', 'pegStatnikahId', 'pegGoldrhId', 'pegTinggiBadan', 'pegBeratBadan', 'pegJnspegrId', 'pegPnsCpnsTkpddkrId', 'pegUsiaPensiun', 'pegStatrId', 'pegLevelId', 'pegKodeAbsen', 'pegUserId', 'pegIsCalon', 'pegNipLama', 'pegGradeId', 'pegSertifikatId', 'pegKepakaranTeknisId', 'pegPengalamanIndustriId', 'pegPenilaianKinerjaId'], 'integer'],
            [['pegAlamat', 'pegKelamin', 'pegStatusNPWP', 'pegStatusWargaNeg'], 'string'],
            [['pegTglLahir', 'pegPnsTmt', 'pegCpnsTmt', 'pegTglMasukInstitusi', 'pegTglKeluarInstitusi', 'pegCreationDate', 'pegLastUpdate', 'pegThnSer'], 'safe'],
            [['pegKodeResmi', 'pegKodeInternal', 'pegKodeLain', 'pegNoTelp', 'pegNoHp', 'pegIdLain', 'pegNoTaspen', 'pegNoAskes', 'pegGelarDepan', 'pegGelarBelakang'], 'string', 'max' => 20],
            [['pegNama', 'pegEmail', 'pegTmpLahir', 'pegNoSk'], 'string', 'max' => 100],
            [['pegKodePos', 'pegJenisIdLain'], 'string', 'max' => 10],
            [['pegKepercayaan', 'pegCiriKhas', 'pegCacat', 'pegHobby', 'pegDesaRumah', 'pegKecRumah', 'pegKotaRumah', 'pegProvinsiRumah'], 'string', 'max' => 50],
            [['pegWarnaRambut', 'pegWarnaKulit', 'pegBentukMuka'], 'string', 'max' => 25],
            [['pegNoNPWP', 'pegKodeKontrak', 'pegNoKarpeg', 'pegNoSer'], 'string', 'max' => 30],
            [['pegFoto'], 'string', 'max' => 255],
            [['pegJalanRumah'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pegId' => 'Peg ID',
            'pegKodeResmi' => 'Peg Kode Resmi',
            'pegKodeInternal' => 'Peg Kode Internal',
            'pegKodeLain' => 'Peg Kode Lain',
            'pegKodeGateAccess' => 'Peg Kode Gate Access',
            'pegNama' => 'Peg Nama',
            'pegAlamat' => 'Peg Alamat',
            'pegKodePos' => 'Peg Kode Pos',
            'pegNoTelp' => 'Peg No Telp',
            'pegNoHp' => 'Peg No Hp',
            'pegEmail' => 'Peg Email',
            'pegSatwilId' => 'Peg Satwil ID',
            'pegTmpLahir' => 'Peg Tmp Lahir',
            'pegTglLahir' => 'Peg Tgl Lahir',
            'pegKelamin' => 'Peg Kelamin',
            'pegJenisIdLain' => 'Peg Jenis Id Lain',
            'pegIdLain' => 'Peg Id Lain',
            'pegAgamaId' => 'Peg Agama ID',
            'pegKepercayaan' => 'Peg Kepercayaan',
            'pegStatnikahId' => 'Peg Statnikah ID',
            'pegGoldrhId' => 'Peg Goldrh ID',
            'pegTinggiBadan' => 'Peg Tinggi Badan',
            'pegBeratBadan' => 'Peg Berat Badan',
            'pegWarnaRambut' => 'Peg Warna Rambut',
            'pegWarnaKulit' => 'Peg Warna Kulit',
            'pegBentukMuka' => 'Peg Bentuk Muka',
            'pegCiriKhas' => 'Peg Ciri Khas',
            'pegCacat' => 'Peg Cacat',
            'pegHobby' => 'Peg Hobby',
            'pegJnspegrId' => 'Peg Jnspegr ID',
            'pegPnsTmt' => 'Peg Pns Tmt',
            'pegCpnsTmt' => 'Peg Cpns Tmt',
            'pegTglMasukInstitusi' => 'Peg Tgl Masuk Institusi',
            'pegTglKeluarInstitusi' => 'Peg Tgl Keluar Institusi',
            'pegPnsCpnsTkpddkrId' => 'Peg Pns Cpns Tkpddkr ID',
            'pegNoTaspen' => 'Peg No Taspen',
            'pegNoAskes' => 'Peg No Askes',
            'pegStatusNPWP' => 'Peg Status Npwp',
            'pegNoNPWP' => 'Peg No Npwp',
            'pegUsiaPensiun' => 'Peg Usia Pensiun',
            'pegStatrId' => 'Peg Statr ID',
            'pegLevelId' => 'Peg Level ID',
            'pegGelarDepan' => 'Peg Gelar Depan',
            'pegGelarBelakang' => 'Peg Gelar Belakang',
            'pegFoto' => 'Peg Foto',
            'pegKodeAbsen' => 'Peg Kode Absen',
            'pegCreationDate' => 'Peg Creation Date',
            'pegLastUpdate' => 'Peg Last Update',
            'pegUserId' => 'Peg User ID',
            'pegStatusWargaNeg' => 'Peg Status Warga Neg',
            'pegIsCalon' => 'Peg Is Calon',
            'pegNipLama' => 'Peg Nip Lama',
            'pegKodeKontrak' => 'Peg Kode Kontrak',
            'pegNoKarpeg' => 'Peg No Karpeg',
            'pegNoSer' => 'Peg No Ser',
            'pegThnSer' => 'Peg Thn Ser',
            'pegNoSk' => 'Peg No Sk',
            'pegJalanRumah' => 'Peg Jalan Rumah',
            'pegDesaRumah' => 'Peg Desa Rumah',
            'pegKecRumah' => 'Peg Kec Rumah',
            'pegKotaRumah' => 'Peg Kota Rumah',
            'pegProvinsiRumah' => 'Peg Provinsi Rumah',
            'pegGradeId' => 'Peg Grade ID',
            'pegSertifikatId' => 'Peg Sertifikat ID',
            'pegKepakaranTeknisId' => 'Peg Kepakaran Teknis ID',
            'pegPengalamanIndustriId' => 'Peg Pengalaman Industri ID',
            'pegPenilaianKinerjaId' => 'Peg Penilaian Kinerja ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DbpegawaiPubPegawaiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DbpegawaiPubPegawaiQuery(get_called_class());
    }
}
