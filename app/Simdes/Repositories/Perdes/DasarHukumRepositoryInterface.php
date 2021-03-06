<?php
/**
 * Email: edicyber@gmail.com
 * User: Edi Santoso
 * Date: 6/15/2014
 * Time: 20:21
 */

namespace Simdes\Repositories\Perdes;


use Simdes\Models\Perdes\DasarHukum;

/**
 * Interface DasarHukumRepositoryInterface
 * @package Simdes\Repositories\Perdes
 */
interface DasarHukumRepositoryInterface
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
     * @param DasarHukum $dasarHukum
     * @param array $data
     * @return mixed
     */
    public function update(DasarHukum $dasarHukum, array $data);

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