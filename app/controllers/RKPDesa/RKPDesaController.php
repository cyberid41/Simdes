<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 5/16/2014
 * Time: 22:42
 */

namespace RKPDesa;

use Simdes\Repositories\RKPDesa\RKPDesaRepositoryInterface;
use Simdes\Repositories\RPJMDesa\ProgramRepositoyInterface;
use Simdes\Repositories\User\UserRepositoryInterface;

/**
 * Class RKPDesaController
 *
 * @package RKPDesa
 */
class RKPDesaController extends \BaseController
{

    /**
     * @var RKPDesaRepositoryInterface
     */
    private $RKPDesa;

    /**
     * @var ProgramRepositoyInterface
     */
    protected $program;

    /**
     * @param RKPDesaRepositoryInterface $RKPDesa
     * @param ProgramRepositoyInterface $program
     * @param UserRepositoryInterface $auth
     */
    public function __construct(
        RKPDesaRepositoryInterface $RKPDesa,
        ProgramRepositoyInterface $program,
        UserRepositoryInterface $auth
    )
    {
        parent::__construct();

        $this->RKPDesa = $RKPDesa;
        $this->auth = $auth;
        $this->program = $program;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $data = $this->program->getList($term = null,$this->auth->getOrganisasiId());
        $this->view('rkpdesa.data-rkpdesa',compact('data'));
    }

    /**
     * @return mixed
     */
    public function read()
    {
        $term = $this->input('term');
        return $this->program->getList($term,$this->auth->getOrganisasiId());
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $data = $this->program->findByOrganisasi_id($id,$this->auth->getOrganisasiId());

        $result = $this->RKPDesa->findAll($term = null, $this->auth->getOrganisasiId(),$id);

        if (is_null($data)) {
            return $this->redirectURLTo('data-rkpdesa');
        } else {
            $this->view('rkpdesa.detail-rkpdesa',compact('data','result'));
        }
    }

    public function getRkpdesa($program_id){
        return $this->RKPDesa->findAll($term = null, $this->auth->getOrganisasiId(),$program_id);
    }

    /**
     * @return array
     */
    public function store()
    {
        $form = $this->RKPDesa->getCreationForm();

        if (!$form->isValid()) {
            $message = $form->getErrors();

            return [
                'Status'     => 'Validation',
                'validation' => [
                    'program_id'      => $message->first('program_id'),
                    'kegiatan_id'     => $message->first('kegiatan_id'),
                    'rpjmdesa_id'     => $message->first('rpjmdesa_id'),
                    'tahun'           => $message->first('tahun'),
                    'lokasi'          => $message->first('lokasi'),
                    'pejabat_desa_id' => $message->first('pejabat_desa_id'),
                    'target'          => $message->first('target'),
                    'sasaran'         => $message->first('sasaran'),
                    'tujuan'          => $message->first('tujuan'),
                    'waktu'           => $message->first('waktu'),
                    'status'          => $message->first('status'),
                    'pagu_anggaran'   => $message->first('pagu_anggaran'),
                    'sumber_dana_id'  => $message->first('sumber_dana_id'),
                ],
            ];
        }
        $data = $form->getInputData();
        $data['user_id'] = $this->auth->getUserId();
        $data['organisasi_id'] = $this->auth->getOrganisasiId();
        $this->RKPDesa->create($data);

        return [
            'Status' => 'Sukses',
            'msg'    => 'Sukses : Data berhasil disimpan.',
        ];

    }

    /**
     * @param $id
     *
     * @return array
     */
    public function edit($id)
    {
        $data = $this->RKPDesa->findById($id);
        return [
            'id'              => $data->id,
            'program'         => $data->program_id . '|' . $data->rpjmdesa_id . '|' . $data->lokasi . '|' . $data->waktu . '|' . $data->sasaran . '|' . $data->tujuan . '|' . $data->target . '|' . $data->pagu_anggaran . '|' . $data->sumber_dana_id,
            'kegiatan_id'     => $data->kegiatan_id,
            'tahun'           => $data->tahun,
            'lokasi'          => $data->lokasi,
            'target'          => $data->target,
            'pejabat_desa_id' => $data->pejabat_desa_id,
            'sasaran'         => $data->sasaran,
            'tujuan'          => $data->tujuan,
            'waktu'           => $data->waktu,
            'status'          => $data->status,
            'pagu_anggaran'   => $data->pagu_anggaran,
            'sumber_dana_id'  => $data->sumber_dana_id
        ];
    }


    /**
     * @param $id
     *
     * @return array
     */
    public function update($id)
    {
        $RKPDesa = $this->RKPDesa->findById($id);
        $form = $this->RKPDesa->getEditForm();

        if (!$form->isValid()) {
            $message = $form->getErrors();

            return [
                'Status'     => 'Validation',
                'validation' => [
                    'validation' => [
                        'program_id'      => $message->first('program_id'),
                        'kegiatan_id'     => $message->first('kegiatan_id'),
                        'rpjmdesa_id'     => $message->first('rpjmdesa_id'),
                        'tahun'           => $message->first('tahun'),
                        'lokasi'          => $message->first('lokasi'),
                        'pejabat_desa_id' => $message->first('pejabat_desa_id'),
                        'target'          => $message->first('target'),
                        'sasaran'         => $message->first('sasaran'),
                        'tujuan'          => $message->first('tujuan'),
                        'waktu'           => $message->first('waktu'),
                        'status'          => $message->first('status'),
                        'pagu_anggaran'   => $message->first('pagu_anggaran'),
                        'sumber_dana_id'  => $message->first('sumber_dana_id'),
                    ],
                ]
            ];
        }

        $data = $form->getInputData();
        $data['user_id'] = $this->auth->getUserId();
        $this->RKPDesa->update($RKPDesa, $data);

        return [
            'Status' => 'Sukses',
            'msg'    => 'Sukses : Data berhasil diupdate.'
        ];
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function destroy($id)
    {
        $this->RKPDesa->delete($id);

        return [
            'Status' => 'Sukses',
            'msg'    => 'Sukses : Data berhasil dihapus.'
        ];
    }
}