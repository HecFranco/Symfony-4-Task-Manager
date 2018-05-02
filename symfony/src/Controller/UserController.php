<?php
// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\User;

class UserController extends Controller {

	public function new(Request $request, Helpers $helpers){
    // Entity manager
    $em = $this->getDoctrine()->getManager();
		$json = $request->get("json", null);
		$params = json_decode($json);

    $user_repo = $em->getRepository(User::class);

		$data = array(
			'status' => 'error',
			'code'   => 400,
			'msg'	 => 'User not created !!'
		);

		if($json != null){
			$createdAt = new \Datetime("now");
			$role = 'user';

			$email = (isset($params->email)) ? $params->email : null;
			$name = (isset($params->name)) ? $params->name : null;
			$surname = (isset($params->surname)) ? $params->surname : null;
			$password = (isset($params->password)) ? $params->password : null;

			$emailConstraint = new Assert\Email();
			$emailConstraint->message = "This email is not valid !!";
			$validate_email = $this->get("validator")->validate($email, $emailConstraint);

			if($email != null && count($validate_email) == 0 && $password != null && $name != null && $surname != null){
					$user = new User();
					$user->setCreatedAt($createdAt);
					$user->setRole($role);
					$user->setEmail($email);
					$user->setName($name);
					$user->setSurname($surname);
					// Encrypt the password
					$pwd = hash('sha256', $password);
					$user->setPassword($pwd);
          
					$isset_user = $user_repo->findBy(array(
						"email" => $email
					));

					if(count($isset_user) == 0){
						$em->persist($user);
						$em->flush();

						$data = array(
							'status' => 'success',
							'code'   => 200,
							'msg'	 => 'New user created !!',
							'user'   => $user
						);
					}else{
						$data = array(
							'status' => 'error',
							'code'   => 400,
							'msg'	 => 'User not created, duplicated !!'
						);
					}
			}
		}

		return $helpers->json($data);
	}

	public function edit(Request $request, Helpers $helpers, JwtAuth $jwt_auth ){
    // Entity manager
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);

    $user_repo = $em->getRepository(User::class);

		if($authCheck){
				// Obtain user data identified via token
				$identity = $jwt_auth->checkToken($token, true);
				// Get the object to update
				$user = $user_repo->findOneBy(array( 'id' => $identity->sub ));
				// Collect post data
				$json = $request->get("json", null);
				$params = json_decode($json);
				// Default error array
				$data = array( 'status' => 'error', 'code' => 400, 'msg' => 'User not updated !!' );
				if($json != null){
					//$createdAt = new \Datetime("now");
					$role = 'user';

					$email = (isset($params->email)) ? $params->email : null;
					$name = (isset($params->name)) ? $params->name : null;
					$surname = (isset($params->surname)) ? $params->surname : null;
					$password = (isset($params->password)) ? $params->password : null;

					$emailConstraint = new Assert\Email();
					$emailConstraint->message = "This email is not valid !!";
					$validate_email = $this->get("validator")->validate($email, $emailConstraint);

					if($email != null && count($validate_email) == 0 && $name != null && $surname != null){
							//$user->setCreatedAt($createdAt);
							$user->setRole($role);
							$user->setEmail($email);
							$user->setName($name);
							$user->setSurname($surname);
							// Encrypt the password
							if($password != null){
								$pwd = hash('sha256', $password);
								$user->setPassword($pwd);
							}
							$isset_user = $user_repo->findBy(array( "email" => $email )); 
							if(count($isset_user) == 0 || $identity->email == $email){
								$em->persist($user);
								$em->flush();
								$data = array( 'status' => 'success', 'code' => 200, 'msg' => 'New user updated !!', 'user' => $user );
							}else{
								$data = array( 'status' => 'error', 'code' => 400, 'msg' => 'User not updated, duplicated !!' );
							}
					}
				}
		}else{
			$data = array( 'status' => 'error', 'code' => 400, 'msg' => 'Authorization not valid' );
		}
		return $helpers->json($data);
	}

}