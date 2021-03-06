<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 6/15/2014
 * Time: 20:23
 */

namespace Simdes\Repositories\Perdes;
use Simdes\Models\Perdes\MateriPokok;


/**
 * Interface MekanismeRepositoryInterface
 * @package Simdes\Repositories\Perdes
 */
interface MateriPokokRepositoryInterface
{
    /**
     * @param $term
     * @param $organisasi_id
     * @return mixed
     */
    public function findAll($term, $organisasi_id,$perdes_id);

    /**
     * @param $id
     * @param $organisasi_id
     * @return mixed
     */
    public function findById($id, $organisasi_id);

    /**
     * @param $perdes_id
     * @param $organisasi_id
     * @return mixed
     */
    public function findByPerdesId($perdes_id, $organisasi_id);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param MateriPokok $materiPokok
     * @param array $data
     * @return mixed
     */
    public function update(MateriPokok $materiPokok, array $data);

    /**
     * @param $id
     * @param $organisasi_id
     * @return mixed
     */
    public function delete($id, $organisasi_id);

    /**
     * @return mixed
     */
    public function getCreationForm();

    /**
     * @return mixed
     */
    public function getEditForm();

} 