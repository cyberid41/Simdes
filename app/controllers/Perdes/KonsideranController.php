<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 6/15/2014
 * Time: 22:18
 */

namespace Perdes;

use Simdes\Repositories\Perdes\JudulRepositoryInterface;
use Simdes\Repositories\Perdes\KonsideranRepositoryInterface;
use Simdes\Repositories\User\UserRepositoryInterface;

/**
 * Class KonsideranController
 * @package Perdes
 */
class KonsideranController extends \BaseController
{
    /**
     * @var \Simdes\Repositories\Perdes\JudulRepositoryInterface
     */
    protected $judul;

    /**
     * @var \Simdes\Repositories\Perdes\KonsideranRepositoryInterface
     */
    protected $konsideran;

    /**
     * @param UserRepositoryInterface $auth
     * @param KonsideranRepositoryInterface $konsideran
     * @param JudulRepositoryInterface $judul
     */
    public function __construct(
        UserRepositoryInterface $auth,
        KonsideranRepositoryInterface $konsideran,
        JudulRepositoryInterface $judul
    )
    {
        parent::__construct();

        $this->auth = $auth;
        $this->konsideran = $konsideran;
        $this->judul = $judul;

    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->redirectURLTo('data-perdes-judul');
    }

    /**
     * @return mixed
     */
    public function read()
    {
        $term = $this->input('term');
        $perdes_id = $this->input('perdes_id');

        return $this->konsideran->findAll($term, $this->auth->getOrganisasiId(), $perdes_id);
    }

    /**
     * @return array
     */
    public function store()
    {
        $form = $this->konsideran->getCreationForm();

        if (!$form->isValid()) {
            $message = $form->getErrors();

            return [
                'Status'     => 'Validation',
                'validation' => [
                    'konsideran' => $message->first('konsideran'),
                    'perdes_id'  => $message->first('perdes_id`'),
                ],
            ];

        }

        $data = $form->getInputData();
        $data['user_id'] = $this->auth->getUserId();
        $data['organisasi_id'] = $this->auth->getOrganisasiId();
        $this->konsideran->create($data);

        return [
            'Status' => 'Sukses',
            'msg'    => 'Sukses : Data berhasil disimpan.',
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function edit($id)
    {
        return $this->konsideran->findById($id, $this->auth->getOrganisasiId());
    }

    /**
     * @param $id
     * @return array
     */
    public function update($id)
    {
        $pendapatan = $this->konsideran->findById($id, $this->auth->getOrganisasiId());
        $form = $this->konsideran->getEditForm();

        if (!$form->isValid()) {
            $message = $form->getErrors();
            return [
                'Status'     => 'Validation',
                'validation' => [
                    'konsideran' => $message->first('konsideran'),
                    'perdes_id'  => $message->first('perdes_id`'),
                ],
            ];

        }

        $data = $form->getInputData();
        $data['user_id'] = $this->auth->getUserId();
        $this->konsideran->update($pendapatan, $data);

        return [
            'Status' => 'Sukses',
            'msg'    => 'Sukses : Data berhasil diupdate.',
        ];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->judul->findById($id, $this->auth->getOrganisasiId());

        if (!$data) {
            return $this->redirectURLTo('data-perdes-judul');
        }
        $this->view('perdes.data-perdes-konsideran', [
            'data' => $data,
        ]);
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id)
    {
        $this->konsideran->delete($id, $this->auth->getOrganisasiId());

        return [
            'Status' => 'Sukses',
            'msg'    => 'Sukses : Data berhasil dihapus.',
        ];
    }

} 