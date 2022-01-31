<?php
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;
class Event extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_event');
    }

    public function index_get()
    {
        $events = $this->model_event;
        $events = $events->get_event();
        $this->response($events, 200);
    }
    
    // insert
    
    public function index_post($id = 0)
    {
        $events = $this->model_event;
        $data = [
            'nom_event' =>  $this->post('nom_event'),
            'image' => $this->post('image'),
            'details_event' => $this->post('details_event'),
            'date' => $this->post('date'),
            
        ];
        $result = $events->insert_event($data);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'EVENT CREE'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'EVENT NON CREE'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function index_put($id = 0)
    {
        $events = $this->model_event;
        $data = [
            'nom_event' =>  $this->put('nom_event'),
            'image' => $this->put('image'),
            'details_event' => $this->put('details_event'),
            'date' => $this->put('date'),
        ];
        
        $events->update_event($data, $id);
        $this->response([
            'status' => true,
            'message' => 'EVENT MIS A JOUR'
        ], RestController::HTTP_OK); 
    }
    
    
    // delete
    public function index_delete($id = 0)
    {
        $events = $this->model_event;
        $result = $events->delete_event($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'EVENT SUPPRIME'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'EVENT NON SUPPRIME'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
   
}
