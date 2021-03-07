<?php

namespace App\Repositories\Rest\Contracts;

interface RestInterface {
	/**
	 * @return mixed
	 */
	public function all();

	/**
	 * @param $limit
	 * @return mixed
	 */
	public function paginate($limit);

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function create(array $data);

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function createMany(array $data);

	/**
	 * @param array $data
	 * @param $id
	 * @return mixed
	 */
	public function update(array $data, $id);

	/**
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);

	/**
	 * @param $id
	 * @return mixed
	 */
	public function show($id);
}