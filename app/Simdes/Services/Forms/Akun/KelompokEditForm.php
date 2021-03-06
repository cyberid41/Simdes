<?php
/**
 * Created by PhpStorm.
 * User: Edi Santoso
 * Date: 5/10/2014
 * Time: 18:18
 */

namespace Simdes\Services\Forms\Akun;


use Simdes\Services\Forms\AbstractForm;

/**
 * Class KelompokEditForm
 *
 * @package Simdes\Services\Forms\Akun
 */
class KelompokEditForm extends AbstractForm{
    /**
     * siapkan validasi
     *
     * @var array
     */
    protected $rules = [
        'kode_rekening' => 'required',
        'akun_id'       => 'required|integer',
        'kelompok'      => 'required'
    ];

    /**
     * siapkan data
     *
     * @return array
     */
    public function getInputData(){
        return array_only($this->inputData, ['kode_rekening','akun_id','kelompok','user_id','organisaasi_id']);
    }

} 