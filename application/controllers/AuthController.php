<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {


	public function index()
	{
		echo 'Auth controller';
	}
    
public function token (){
$jwt= new JWT();
$jwtSecretKey="Mysecretwordshere" ;

$data= array(
    'userID' => 145,
    'email'=> 'admin@gmail.com',
    'admin' => 1,


);   
$token = $jwt ->encode($data, $jwtSecretKey,'HS256');
echo $token;
    
}
}


