<?php
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Dance_Cat extends RestController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_dancecategory');
	}

	public function index_get()
	{
		$cat = $this->model_dancecategory;
		$cat = $cat->get_cat();
		$this->response($cat, 200);
	}

	//insert
	public function index_post($id = 0)
	{
		$cat = $this->model_dancecategory;
		$data = [
			'style' => $this->post('style')
		];
		$result = $cat->insert_cat($data);
		if ($result > 0) {
			$this->response([
				'status' => true,
				'message' => 'STYLE CREE'
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'STYLE NON CREE'
			], RestController::HTTP_BAD_REQUEST);
		}
	}
}
