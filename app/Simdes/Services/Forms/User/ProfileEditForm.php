<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 5/15/2014
 * Time: 15:52
 */

namespace Simdes\Services\Forms\User;


use Simdes\Services\Forms\AbstractForm;

class ProfileEditForm extends AbstractForm
{

    /**
     * @var array
     */
    protected $rules = [
        'email' => 'required',
        'name'  => 'required'
    ];

    /**
     * Siapkan input data
     *
     * @return array
     */
    public function getInputData()
    {
        return array_only($this->inputData, [
            'email',
            'name'
        ]);
    }
}