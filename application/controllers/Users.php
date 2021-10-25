<?php
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;
class Users extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
    }

    public function index_get()
    {
        $users = $this->model_user;
        $users = $users->get_user();
        $this->response($users, 200);
    }
    
    // insert
// create
    public function index_post($id = 0)
    {
        // $jwt= new JWT();
        $users = $this->model_user;
        $data = [
            'nom' =>  $this->post('nom'),
            'prenom' => $this->post('prenom'),
            'email' => $this->post('email'),
            'password' => password_hash($this->post('password'),PASSWORD_DEFAULT),
            'admin' => 0
        ];
        $result = $users->insert_user($data);
        if($result > 0)
        {
            $data['id'] = $users->lastInsert();
            // $jwtSecretKey="Mysecretwordshere" ;
            unset($data['password']);
            // $token = $jwt ->encode($data, $jwtSecretKey,'HS256');
            $this->response([
                'status' => true,
                'message' => 'UTILISATEUR CREE',
                // 'token' => $token
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'UTILISATEUR NON CREE'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
// update
    public function index_put($id = 0)
    {
        $users = $this->model_user;
        $data = [
            'nom' =>  $this->put('nom'),
            'prenom' => $this->put('prenom'),
            'email' => $this->put('email'),
            'password' =>password_hash($this->put('password'),PASSWORD_DEFAULT),
            'admin' => 0
        ];
        
        $users->update_user($data, $id);
        $this->response([
            'status' => true,
            'message' => 'UTILISATEUR MIS A JOUR'
        ], RestController::HTTP_OK); 
    }
    
    
    // delete
    public function index_delete($id = 0)
    {
        $users = $this->model_user;
        $result = $users->delete_user($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'UTILISATEUR SUPPRIME'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'UTILISATEUR NON SUPPRIME'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    // inscription +verif
    public function user_post()
    {
        $jwt= new JWT();
        $email = $this->post('email');
        var_dump($email);
        $password = $this->post('password');

        $user = $this->model_user->getLogin($email);
        

        if(!empty($user))
        {
            if(password_verify($password, $user['password']))
            {
                $jwtSecretKey="Mysecretwordshere" ;
                unset($user['password']);
                $token = $jwt->encode($user, $jwtSecretKey,'HS256');
                $this->response(['token' => $token]);
            }
            else
            {
                $this->response(['error password']);
            }
        }
        else{
            $this->response(['error email']);
        }
    } 
    
//     public function Login_post() {

//     echo"dddd";

//  }
}

