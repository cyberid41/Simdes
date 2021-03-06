<?php
    /**
     * Email: edicyber@gmail.com
     * User: Edi Santoso
     * Date: 5/18/2014
     * Time: 11:05
     */

    namespace Simdes\Services\Forms\RKPDesa;


    use Simdes\Services\Forms\AbstractForm;

    /**
     * Class IndikatorManfaatEditForm
     *
     * @package Simdes\Services\Forms\RKPDesa
     */
    class IndikatorManfaatEditForm extends AbstractForm
    {
        /**
         * @var array
         */
        protected $rules = [
            'tolok_ukur' => 'required',
            'target'     => 'required',
            'satuan'     => 'required'
        ];

        /**
         * @return array
         */
        public function getInputData()
        {
            return array_only($this->inputData, [
                'tolok_ukur',
                'target',
                'satuan',
                'user_id'
            ]);
        }

    }