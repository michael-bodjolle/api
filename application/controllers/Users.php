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
    
    public function index_post($id = 0)
    {
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
            $this->response([
                'status' => true,
                'message' => 'UTILISATEUR CREE'
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
        /* your condition here 
$con['email'] = $email;
$con['admin'] = 1; or whatever you set in $con
*/
// $checkLogin = $this->user->getRows($con);
// if($checkLogin)
// {
//     if (password_verify($password,$checkLogin['password']))
//     {
//         $this->session->set_userdata('isUserLoggedIn',TRUE);
//         $this->session->set_userdata('userId',$checkLogin['id']);
//         redirect('users/account');
//     }

// }
// else
// {
//      $data['error_msg'] = 'Wrong email or password, please try again.';
// }
        
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
    public function user_get()
    {
        $email = $this->put('email');
        $password = $this->put('password');

        $user = $this->model_user->getLogin($email);

        if(!empty($user))
        {
            if(password_verify($password, $user['password']))
            {
                 
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
} 