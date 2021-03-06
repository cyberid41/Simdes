<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 6/7/2014
 * Time: 05:45
 */

namespace Simdes\Services\Forms\Transaksi;


use Simdes\Services\Forms\AbstractForm;

/**
 * Class PendapatanForm
 * @package Simdes\Services\Forms\Transaksi
 */
class PendapatanForm extends AbstractForm
{
    /**
     * @var array
     */
    protected $rules = [
        'pendapatan'      => 'required',
        'pejabat_desa_id' => 'required',
        'no_bukti'        => 'required',
        'tanggal'         => 'required',
        'jumlah'          => 'required',
    ];

    /**
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'pendapatan_id',
            'pendapatan',
            'pejabat_desa_id',
            'no_bukti',
            'tanggal',
            'uraian',
            'jumlah',
            'user_id',
            'organisasi_id'
        ]);
    }
}