<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 6/15/2014
 * Time: 19:34
 */

namespace Simdes\Services\Forms\Perdes;


use Simdes\Services\Forms\AbstractForm;

/**
 * Class BatangTubuhEditForm
 * @package Simdes\Services\Forms\Perdes
 */
class BatangTubuhEditForm extends AbstractForm
{
    /**
     * @var array
     */
    protected $rules = [
        'istilah'   => 'required',
        'perdes_id' => 'required'
    ];

    /**
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'istilah',
            'perdes_id',
            'user_id',
            'organisasi_id',
        ]);
    }

} 