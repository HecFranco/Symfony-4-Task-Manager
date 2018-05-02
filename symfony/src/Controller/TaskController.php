<?php
// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

use App\Service\Helpers;
use App\Service\JwtAuth;

use App\Entity\User;
use App\Entity\Task;

class TaskController extends Controller {

	public function new (Request $request, $id = null, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);
    
    $user_repo = $em->getRepository(User::class);
    $task_repo = $em->getRepository(Task::class);

    $status = "error"; $code = 200; $data = null; $msg = null;

		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
			$json = $request->get("json", null);
			if($json != null){
				$params = json_decode($json);
				$createdAt = new \Datetime('now');
				$updatedAt = new \Datetime('now');
        $user_id = ($identity->sub != null) ? $identity->sub : null;
				$title = (isset($params->title)) ? $params->title : null;
				$description = (isset($params->description)) ? $params->description : null;
				$status = (isset($params->status)) ? $params->status : null;
				if($user_id != null && $title != null){
					// Create Task
					$user = $user_repo->findOneBy(array( "id" => $user_id ));
					if($id == null){
						$task = new Task();
						$task->setUser($user);
						$task->setTitle($title);
						$task->setDescription($description);
						$task->setStatus($status);
						$task->setCreatedAt($createdAt);
						$task->setUpdatedAt($updatedAt);
						$em->persist($task);
            $em->flush();
            
            $status = "success"; 
            $data = $task;
					}else{
						$task = $task_repo->findOneBy(array( "id" => $id ));
						if(isset($identity->sub) && $identity->sub == $task->getUser()->getId()){
							$task->setTitle($title);
							$task->setDescription($description);
							$task->setStatus($status);
							$task->setUpdatedAt($updatedAt);
							$em->persist($task);
              $em->flush();
              
              $status = "success";
              $data = $task;
						}else{
              $code = 400;
							$msg = 'Task updated error, you not owner';
						}
					}
				}else{
          $code = 400;
          $msg = 'Task not created, validation failed';
				}
			}else{
        $code = 400;
        $msg = 'Task not created, params failed';
			}
		}else{
      $code = 400;
      $msg = 'Authorization not valid';
    }
    $data = array( "status" => $status, "code" => $code, "data" => $data, "msg"  => $msg );
		return $helpers->json($data);
	}

	public function tasks(Request $request, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);
    
    $user_repo = $em->getRepository(User::class);
    $task_repo = $em->getRepository(Task::class);

		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
      $user = $user_repo->findOneById($identity->sub);
      $taskListOfUser = $task_repo->findBy(array('user'=>$user), array('id'=>'DESC'));
      var_dump( $taskListOfUser );die();
			$page = $request->query->getInt('page', 1);
			$paginator = $this->get('knp_paginator');
			$items_per_page = 10;

			$pagination = $paginator->paginate($taskListOfUser, $page, $items_per_page);
			$total_items_count = $pagination->getTotalItemCount();

			$data = array(
				'status' => 'success',
				'code'   => 200,
				'total_items_count'	 => $total_items_count,
				'page_actual' => $page,
				'items_per_page' => $items_per_page,
				'total_pages' => ceil($total_items_count / $items_per_page),
				'data' => $pagination
			);
			
		}else{
			$data = array(
				'status' => 'error',
				'code'   => 400,
				'msg'	 => 'Authorization not valid'
			);
		}

		return $helpers->json($data);
	}

	public function task(Request $request, $id = null, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);
    
    $user_repo = $em->getRepository(User::class);
    $task_repo = $em->getRepository(Task::class);

		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
			$user = $user_repo->findOneById($identity->sub);
			$task = $task_repo->findOneBy(array( "id" => $id , 'user'=>$user));
			if($task && is_object($task) && $identity->sub == $task->getUser()->getId()){
				$data = array(
					'status' => 'success',
					'code'   => 200,
					'data'	 => $task
				);
			}else{
				$data = array(
					'status' => 'error',
					'code'   => 404,
					'msg'	 => 'Task not found'
				);
			}
		}else{
			$data = array(
				'status' => 'error',
				'code'   => 400,
				'msg'	 => 'Authorization not valid'
			);
		}

		return $helpers->json($data);
	}

	public function search(Request $request, $search = null, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);
    
    $user_repo = $em->getRepository(User::class);
    $task_repo = $em->getRepository(Task::class);

		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
      $user_id = $identity->sub;
			// Filter
			$status = $request->get('filter', null);
			if(empty($status)){
				$status = null;
			}elseif($status == 1){
				$status = 'new';
			}elseif($status == 2){
				$status = 'fact';
			}else{
				$status = 'finished';
			}
			// Order
      $order = (empty($order) || $order == 2) ? 'DESC' : 'ASC';
      // Search
      $taskListSearch = $task_repo->searchingTask($user_id, $search, $status, $order );

			$page = $request->query->getInt('page', 1);
			$paginator = $this->get('knp_paginator');
			$items_per_page = 10;

			$pagination = $paginator->paginate($taskListSearch, $page, $items_per_page);
			$total_items_count = $pagination->getTotalItemCount();

			$data = array(
					'status' => 'success',
          'code'   => 200,
          'total_items_count'	 => $total_items_count,
          'page_actual' => $page,
          'items_per_page' => $items_per_page,
          'total_pages' => ceil($total_items_count / $items_per_page),          
					'data' => $pagination
				);
		}else{
			$data = array(
					'status' => 'error',
					'code'   => 400,
					'msg'	 => 'Authorization not valid'
				);
		}
		return $helpers->json($data);
	}

	public function remove(Request $request, $id = null, Helpers $helpers, JwtAuth $jwt_auth){
    $em = $this->getDoctrine()->getManager();
		$token = $request->get('authorization', null);
		$authCheck = $jwt_auth->checkToken($token);
    
    $user_repo = $em->getRepository(User::class);
    $task_repo = $em->getRepository(Task::class);

		if($authCheck){
			$identity = $jwt_auth->checkToken($token, true);
			$user = $user_repo->findOneById($identity->sub);
			$task = $task_repo->findOneBy(array( "id" => $id , 'user'=>$user));

			if($task && is_object($task) && $identity->sub == $task->getUser()->getId()){
				// Borrar objeto y borrar registro de la tabla bbdd
				$em->remove($task);
				$em->flush();

				$data = array(
					'status' => 'success',
					'code'   => 200,
					'data'	 => $task
				);
			}else{
				$data = array(
					'status' => 'error',
					'code'   => 404,
					'msg'	 => 'Task not found'
				);
			}

		}else{
			$data = array(
				'status' => 'error',
				'code'   => 400,
				'msg'	 => 'Authorization not valid'
			);
		}

		return $helpers->json($data);
	}

}