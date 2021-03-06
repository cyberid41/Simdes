<?php
    /**
     * Created by PhpStorm.
     * Email: edicyber@gmail.com
     * User: Edi Santoso
     * Date: 5/13/2014
     * Time: 13:15
     */

    namespace Simdes\Services\Forms\RPJMDesa;


    use Simdes\Services\Forms\AbstractForm;

    /**
     * Class RPJMDesaEditForm
     *
     * @package Simdes\Services\Forms\RPJMDesa
     */
    class RPJMDesaEditForm extends AbstractForm
    {
        /**
         * @var array
         */
        protected $rules = [
            'visi_id' => 'required|integer'
        ];

        /**
         * @return array
         */
        public function getInputData()
        {
            return array_only($this->inputData, [
                'visi_id'
            ]);
        }
    }