<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 5/23/2014
 * Time: 09:05
 */

namespace Simdes\Services\Forms\SSH;


use Simdes\Services\Forms\AbstractForm;

/**
 * Class KelompokBarangForm
 *
 * @package Simdes\Services\Forms\ssh
 */
class KelompokBarangForm extends AbstractForm
{
    /**
     * @var array
     */
    protected $rules = [
        'kode_rekening' => 'required|max:50',
        'kelas_id'      => 'required|max:50',
        'kelompok'      => 'required|max:255'
    ];

    /**
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'kode_rekening',
            'kelas_id',
            'kelompok',
        ]);
    }
}