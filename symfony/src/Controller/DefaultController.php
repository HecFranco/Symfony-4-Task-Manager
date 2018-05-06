<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\User;

class DefaultController extends Controller {
  public function index (request $request) {
    return $this->render('default/index.html.twig', [
      'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
    ]);
  }
  public function login(Request $request, Helpers $helpers, JwtAuth $jwt_auth){
    // Receive json by POST
    $json = $request->get('json', null);
    // Array to return by default
    $data = array(
        'status' => 'error',
        'data' => 'Send json via post !!'
    );
    if($json != null){
        // you make the login
        // We convert a json to a php object
        $params = json_decode($json);
        $email = (isset($params->email)) ? $params->email : null;
        $password = (isset($params->password)) ? $params->password : null;
        $getHash = (isset($params->getHash)) ? $params->getHash : null;

        $emailConstraint = new Assert\Email();
        $emailConstraint->message = "This email is not valid !!";
        $validate_email = $this->get("validator")->validate($email, $emailConstraint);
        // Encrypt the password
        $pwd = hash('sha256', $password);
        if($email != null && count($validate_email) == 0 && $password != null){
            if($getHash === null || $getHash === 'null' || $getHash === false || $getHash === 'false'){
                $signup = $jwt_auth->signup($email, $pwd);
            }elseif($getHash === true || $getHash === 'true') {
                $signup = $jwt_auth->signup($email, $pwd, true);
            }
            return new JsonResponse($signup);
            /*
            return $this->json($signup);
            */
        }else{
            $data = array(
                'status' => 'error',
                'data' => 'Email or password incorrect'
            );
        }        
    }
    return $helpers->json($data);
  } 

  public function tests (Request $request, Helpers $helpers){
    $token = $request->get("authorization", null);
    if($token){
      $em = $this->getDoctrine()->getManager();
      $user_repo = $em->getRepository(User::class);
      $userList = $user_repo->findAll();
  
      return $helpers->json(array(
        'status' => 'success',
        'users' => $userList
      ));
    }else{
      return $helpers->json(array(
        'status' => 'error',
        'code' => 400,
        'users' => 'Login failed!!!'
      ));     
    }
  }
}