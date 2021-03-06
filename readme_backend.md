# Symfony 4 - Task Manager (Backend)

We will make the backend of the application with the framework Symfony. We will have two entities, **User** and **Task**. Access to the login will be via `Jwt`

### Phases of the Demo
1. []()


---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton symfony`

---------------------------------------------------------------------------------------

### Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Apache-Pack Component](https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules), `composer require symfony/apache-pack`
* [Var-dumper Component](https://symfony.com/doc/current/components/var_dumper.html), `composer require var-dumper`
* [Debug-Bundle Component](https://symfony.com/doc/current/components/debug.html), `composer require debug --dev`
* [The Config Component](https://symfony.com/doc/current/components/config.html), `composer require symfony/config`.

* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Twig Extension Component](https://symfony.com/doc/current/templating/twig_extension.html), `composer require twig/extensions`
* [Asset component](https://symfony.com/doc/current/components/asset.html), `composer require symfony/asset`
* [Knplabs/knp-paginator-bundle](https://packagist.org/packages/knplabs/knp-paginator-bundle), `composer require knplabs/knp-paginator-bundle`

* [Doctrine Component](https://symfony.com/doc/current/doctrine.html), `composer require doctrine`
* [Security Component](https://symfony.com/doc/current/components/security.html), `composer require security`
* [Validator Component](https://symfony.com/doc/current/components/validator.html), `composer require validator`
* [Form Componente](https://symfony.com/doc/current/forms.html), `composer require form`

* [Firebase/php-jwt](https://packagist.org/packages/firebase/php-jwt), `composer require firebase/php-jwt`
* [The HttpFoundation Component](https://symfony.com/doc/current/components/http_foundation.html), `composer require symfony/http-foundation`.
* [The Serializer Component](https://symfony.com/doc/current/components/serializer.html#using-callbacks-to-serialize-properties-with-object-instances), `composer require symfony/serializer`

* [Mailer Component](https://symfony.com/doc/current/email.html), `composer require mailer`
* [Check Requirements for Running Symfony Component](https://symfony.com/doc/current/reference/requirements.html), `composer require symfony/requirements-checker` 

### Summary Console command`s to be used

* `php bin/console server:run`
* `php bin/console doctrine:database:create`
* `php bin/console doctrine:schema:update --force`
* `php bin/console doctrine:migrations:diff`
* `php bin/console doctrine:migrations:migrate`

# Symfony 4 - Task Manager (Backend)

--------------------------------------------------------------------------------------------

### 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton symfony
```

2. In the next step we will access the project folder using:

```bash
cd symfony
```

3. It is necessary to install the **server component**, to use our **Server Local**, through the console command:

```bash
composer require server --dev
```

4. Now, you will be able to view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```

5. Access to [http://127.0.0.1:8000/](http://127.0.0.1:8000/) to view the result.

--------------------------------------------------------------------------------------------

### 2.Database Configuration

--------------------------------------------------------------------------------------------

1. We will installed **Doctrine Component** to manage the database of project using the command:

```bash
composer require doctrine
```

2. To configurate the database connection, we will modified the environment variable called `DATABASE_URL`. For then, we you can find and customize this inside [.env](.env):

_[.env](.env)_
```diff
# .env
###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
# DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
++ DATABASE_URL=mysql://root:@127.0.0.1:3306/symfony-4-task-manager
++ # db_user: root
++ # db_password: 
++ # db_name: symfony-4-task-manager
# to use sqlite:
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/app.db"
###< doctrine/doctrine-bundle ###
```

(Source: [https://symfony.com/doc/current/doctrine.html#configuring-the-database](https://symfony.com/doc/current/doctrine.html#configuring-the-database))

3. In console lunch the command `php bin/console doctrine:database:create`. Now you have your data base created in your local server.

4. If you want to use XML instead of `yaml`, add `type: yml` and `dir: '%kernel.project_dir%/config/doctrine'` to the entity mappings in your [config/packages/doctrine.yaml](config/packages/doctrine.yaml) file.

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yml
doctrine:
    # ...
    orm:
        # ...
        mappings:
            App:
                is_bundle: false
                # type: annotation
                type: yml
                # dir: '%kernel.project_dir%/src/Entity'
                dir: '%kernel.project_dir%/config/doctrine'
                prefix: 'App\Entity'
                alias: App
```

(Source: [https://symfony.com/doc/current/doctrine.html](https://symfony.com/doc/current/doctrine.html))

--------------------------------------------------------------------------------------------

### 3.Entities

--------------------------------------------------------------------------------------------

1. Now, We can generate our user and task entities.

#### User Entity

_[src/Resources/config/doctrine/User.orm.yml](./symfony/src/Resources/config/doctrine/User.orm.yml)_
```yml
App\Entity\User:
    type: entity
    #repositoryClass: App\Repository\UserRepository    
    table: users
    id:
        id:
            type: integer
            nullable: false
            options:
                unsigned: false
            id: true
            generator:
                strategy: IDENTITY
    fields:
        role:
            type: string
            nullable: true
            length: 20
            options:
                fixed: false
        username:
            type: string
            nullable: true
            length: 180
            options:
                fixed: false
        name:
            type: string
            nullable: true
            length: 180
            options:
                fixed: false
        surname:
            type: string
            nullable: true
            length: 255
            options:
                fixed: false
        email:
            type: string
            nullable: true
            length: 255
            options:
                fixed: false
        password:
            type: string
            nullable: true
            length: 255
            options:
                fixed: false
        createdAt:
            type: datetime
            nullable: true
            column: created_at
    lifecycleCallbacks: {  }
```

_[src/Entity/User.php](./symfony/src/Entity/User.php)_
```php
<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

class User implements UserInterface {
    private $id;
		public function getId() { return $this->id; } 
    private $username;
    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; } 		 
		private $name;
    public function setName($name) { $this->name = $name; return $this; }
    public function getName() { return $this->name; }		
		private $surname;
    public function setSurname($surname) { $this->surname = $surname; return $this; }
    public function getSurname() { return $this->surname; }		
		private $email;
    public function setEmail($email) { $this->email = $email; return $this; }
    public function getEmail() { return $this->email; }		
		private $password;
    public function setPassword($password) { $this->password = $password; return $this; }
    public function getPassword() { return $this->password; }		
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
		public function getCreatedAt() { return $this->createdAt; }
    /* other necessary methods ***********************************************************************************/
    public function getSalt() {
			// The bcrypt and argon2i algorithms don't require a separate salt.
			// You *may* need a real salt if you choose a different encoder.
			return null;
		}
		// other methods, including security methods like getRoles()
		private $role;
			public function setRole($role) { $this->role = $role; /*return $this;*/ }
		public function getRole() { return $this->role; }
		public function getRoles(){ return array('ROLE_USER','ROLE ADMIN'); }
		// ... and eraseCredentials()
		public function eraseCredentials() { }
		/** @see \Serializable::serialize() */
		public function serialize() {
				return serialize(array(
						$this->id,
						$this->username,
						$this->password,
						$this->role,
						// see section on salt below
						// $this->salt,
				));
		}
		public function unserialize($serialized) {
				list (
						$this->id,
						$this->username,
						$this->password,
						// see section on salt below
						// $this->salt
				) = unserialize($serialized);
		} 		
}
```


#### Task Entity

_[src/Resources/config/doctrine/Task.orm.yml](./symfony/src/Resources/config/doctrine/Task.orm.yml)_
```yml
App\Entity\Task:
    type: entity
    repositoryClass: App\Repository\TaskRepository
    table: tasks
    indexes:
        fk_tasks_users:
            columns:
                - user
    id:
        id:
            type: integer
            nullable: false
            options:
                unsigned: false
            id: true
            generator:
                strategy: IDENTITY
    fields:
        title:
            type: string
            nullable: true
            length: 255
            options:
                fixed: false
        description:
            type: text
            nullable: true
            length: 65535
            options:
                fixed: false
        status:
            type: string
            nullable: true
            length: 100
            options:
                fixed: false
        createdAt:
            type: datetime
            nullable: true
            column: created_at
        updatedAt:
            type: datetime
            nullable: true
            column: updated_at
    manyToOne:
        user:
            targetEntity: User
            cascade: {  }
            fetch: LAZY
            mappedBy: null
            inversedBy: null
            joinColumns:
                user:
                    referencedColumnName: id
            orphanRemoval: false
    lifecycleCallbacks: {  }
```

_[src/Entity/Task.php](./symfony/src/Entity/Task.php)_
```php
<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;	

class Task {
    private $id;
    public function getId() { return $this->id; }    
    private $title;
    public function setTitle($title) { $this->title = $title; return $this; }
    public function getTitle() { return $this->title; }    
    private $description;
    public function setDescription($description) { $this->description = $description; return $this; }
    public function getDescription() { return $this->description; }    
    private $status;
    public function setStatus($status) { $this->status = $status; return $this; }
    public function getStatus() { return $this->status; }    
    private $createdAt;
    public function setCreatedAt($createdAt) { $this->createdAt = $createdAt; return $this; }
    public function getCreatedAt() { return $this->createdAt; }    
    private $updatedAt;
    public function setUpdatedAt($updatedAt) { $this->updatedAt = $updatedAt; return $this; }
    public function getUpdatedAt() { return $this->updatedAt; }    
    private $user;
    public function setUser(User $user = null) { $this->user = $user; return $this; }
    public function getUser() { return $this->user; }
}
```

> We can load the database ([/symfony/bbdd/bbdd.sql](./symfony/bbdd/bbdd.sql)) using phmyadmin and enter a first example user.

--------------------------------------------------------------------------------------------

### 4.Routing

--------------------------------------------------------------------------------------------

1. We will use the routing type **yaml**, for them we configure the type of routing in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](config/routes.yaml)_
```yml
#index:
#    path: /
#    controller: App\Controller\DefaultController::index
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
routing_distributed:
    # loads routes from the given routing file stored in some bundle
    resource: '..\src\Resources\config\routing.yml' 
    type: yaml
```

2. Next step is defined our folder with routing files of our app in [src/Resources/config/routing.yml](src/Resources/config/routing.yml)

_[src/Resources/config/routing.yml](src/Resources/config/routing.yml)_
```yml
app_routing_folder:
    # loads routes from the given routing file stored in some bundle
    resource: 'routing\' 
    type: directory
```

_[src/Resources/config/routing/default.yml](src/Resources/config/routing/default.yml)_
```yml
default_pruebas:
    path: /test
    controller: App\Controller\DefaultController::tests
    #methods:   [POST] 
```

3. Now we can test the generated entities and the router. For this we generate a first controller [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php) with a method `tests()`.

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```php
<?php
// src/Controller/DefaultController.php
namespace App\Controller;
// Permite usar el método response, genera una respuesta que se mostrará en pantalla que contiene código html.
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Service\Helpers;

use App\Entity\User;

class DefaultController extends Controller {
  public function tests (Request $request, Helpers $helpers){
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(User::class);
    $userList = $user_repo->findAll();
    
    var_dump($userList);die();
  }
}
```

4. If we run `php bin/console server:run` and access [http://127.0.0.1:8000/test](http://127.0.0.1:8000/test) we can see the existing entity.

--------------------------------------------------------------------------------------------

### 5.Creating a JSON Response

--------------------------------------------------------------------------------------------

> To convert data to Json using symfony it is necessary to have the `http-foundation` component ( Source: [The HttpFoundation Component](https://symfony.com/doc/current/components/http_foundation.html) ).

```bash
composer require symfony/http-foundation
```

1. First we will check the sending method jsonResponse, generating a test in the controller [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php).

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
++ use Symfony\Component\HttpFoundation\JsonResponse;

use App\Entity\User;

class DefaultController extends Controller {
  public function tests (Request $request){
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(User::class);
    $userList = $user_repo->findAll();
    
--  var_dump($userList);die();    
++  return new JsonResponse(array(
++    'status' => 'succes',
++    'users' => $userList
++  ));
  }
}
```

> Although we use the `JsonResponse()` component, in symfony there is a default component which we access through `$this->json()`.

2. If we run `php bin / console server: run` and access [http://127.0.0.1:8000/](http://127.0.0.1:8000/) we will see that it does not convert correctly. Still we see that `JsonResponse()` does not perform the conversion correctly so we will have to generate a service that performs the conversion correctly.

> To create our encoder **Json** you must execute the command `composer require symfony/serializer` to download the **serializer component**.

```bash
composer require symfony/serializer
```

_[src/Service/Helpers.php](./symfony/src/Service/Helpers.php)_
```php
<?php
// src/Service/Helpers.php
namespace App\Service;

class Helpers{
    public $manager;
	public function __construct($manager){
		$this->manager = $manager;
	}    
	public function json($data){
		$normalizers = array(new \Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer());
		// 
		$encoders = array("json" => new \Symfony\Component\Serializer\Encoder\JsonEncoder());

		$serializer = new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
		$json = $serializer->serialize($data, 'json');

		$response = new \Symfony\Component\HttpFoundation\Response();
		$response->setContent($json);
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}
	public function decoding_json($json){
		$params = json_decode($json);
		return $params;
	}
}
```

* `GetSetMethodNormalizer`, This normalizer reads the content of the class by calling the "getters" (public methods starting with "get"). It will denormalize data by calling the constructor and the "setters" (public methods starting with "set").
Objects are normalized to a map of property names and values (names are generated removing the `get` prefix from the method name and lowercasing the first letter; e.g. `getFirstName() -> firstName`).

* **Encoders**, `JsonEncoder`, This class encodes and decodes data in JSON.

3. To use this new service it is necessary to declare it in [config/services.yaml](./symfony/config/services.yaml).

_[config/services.yaml](./symfony/config/services.yaml)_
```diff
//...
    # controllers are imported separately to make sure services can be injected
    # as action arguments even if you don't extend any base controller class
    App\Controller\:
        resource: '../src/Controller'
        tags: ['controller.service_arguments']

    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones
++  App\Service\Helpers:
++      public: true
++      arguments: 
++          $manager: '@doctrine.orm.entity_manager'
```

4. Inside the [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php) we will call it that.

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

++ use App\Service\Helpers;

use App\Entity\User;

class DefaultController extends Controller {
-- public function tests (Request $request){
++ public function tests (Request $request, Helpers $helpers){    
    $em = $this->getDoctrine()->getManager();
    $user_repo = $em->getRepository(User::class);
    $userList = $user_repo->findAll();

++  return $helpers->json($userList);   
--  return new JsonResponse(array(
--      'status' => 'succes',
--      'users' => $userList
--  ));
  }
}
```

--------------------------------------------------------------------------------------------

### 6.Login JWT

--------------------------------------------------------------------------------------------

1. Create the `function login` within [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php).

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```diff
++ use Symfony\Component\Validator\Constraints as Assert;

//...
class DefaultController extends Controller {
  //..

++ public function login(Request $request, Helpers $helpers){
++  // Receive json by POST
++  $json = $request->get('json', null);
++  // Array to return by default
++  $data = array(
++      'status' => 'error',
++      'data' => 'Send json via post !!'
++    );
++  }
++  return $helpers->json($data);
++ }

//..
```

3. We add a new route in [src/Resources/config/routing/default.yml](src/Resources/config/routing/default.yml).

_[src/Resources/config/routing/default.yml](src/Resources/config/routing/default.yml)_
```diff
default_pruebas:
    path: /test
    controller: App\Controller\DefaultController::tests
    methods:   [POST]
++ default_login:
++    path: /login
++    controller: App\Controller\DefaultController::login
++    methods:   [POST]    
```

4. Access to [https://app.getpostman.com/](https://app.getpostman.com/) and send a petition to url [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

> You must receive the following message: `{"status":"error","data":"Send json via post !!"}`.

5. We complete the **method login** so that it looks for the email match within the **User entity**.

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```diff
//...
class DefaultController extends Controller {
  //..
  public function login(Request $request, Helpers $helpers){
    // Receive json by POST
    $json = $request->get('json', null);
    // Array to return by default
    $data = array( 'status' => 'error', 'data' => 'Send json via post !!' );
++  if($json != null){
++      // you make the login
++      // We convert a json to a php object
++      $params = json_decode($json);
++      $email = (isset($params->email)) ? $params->email : null;
++      $password = (isset($params->password)) ? $params->password : null;

++      $emailConstraint = new Assert\Email();
++      $emailConstraint->message = "This email is not valid !!";
++      $validate_email = $this->get("validator")->validate($email, $emailConstraint);

++      if($email != null && count($validate_email) == 0 && $password != null){
++          $data = array(
++              'status' => 'success',
++              'data' => 'Login success'
++          );
++      }else{
++          $data = array(
++              'status' => 'error',
++              'data' => 'Email or password incorrect'
++          );
++      }
++  }
    return $helpers->json($data);
  }
//..
```

6. Access to [https://app.getpostman.com/](https://app.getpostman.com/) and send a petition to url [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login) using in the body `x-www-form-urlencoded` with **key** `json` and **value** `{"email":"admin@admin.com", "password":"1"}`.

> You must receive the following message: `{"status":"success","data":"Email or password success"}`.

7. we will need to create a new **service** that authenticates us and generates the token.

_[src/Service/JwtAuth.php](./symfony/src/Service/JwtAuth.php)_
```php
<?php
// src/Service/JwtAuth.php
namespace App\Service;

use App\Entity\User;
use Firebase\JWT\JWT;

class JwtAuth{
	public $manager;
	public $key;

	public function __construct($manager){
		$this->manager = $manager;
		$this->key = 'helloHowIAmTheSecretKey-98439284934829';
	}
	public function signup($email, $password, $getHash = null){
		$user = $this->manager->getRepository(User::class)->findOneBy(array(
			"email" => $email,
			"password" => $password
		));
		$signup = (is_object($user))? true : false;
		if($signup == true){
			// GENERATE TOKEN JWT
			$token = array(
				"sub"   => $user->getId(),
				"email" => $user->getEmail(),
				"name"	=> $user->getName(),
				"surname" => $user->getSurname(),
				"iat"	=> time(),
				"exp"	=> time() + (7 * 24 * 60 * 60)
			);
			$jwt = JWT::encode($token, $this->key, 'HS256');
			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
            $data = ($getHash == null)? $jwt : $decoded ;
		}else{
			$data = array( 'status' => 'error', 'data' => 'Login failed!!' );
		}
		return $data;
	}
}
```

> You need the library **Firebase\JWT**, to install execute the command `composer require firebase/php-jwt`.

8. To use this new service it is necessary to declare it in [config/services.yaml](./symfony/config/services.yaml).

_[config/services.yaml](./symfony/config/services.yaml)_
```diff
//...
    # controllers are imported separately to make sure services can be injected
    # as action arguments even if you don't extend any base controller class
    App\Controller\:
        resource: '../src/Controller'
        tags: ['controller.service_arguments']

    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones
    App\Service\Helpers:
        public: true
        arguments: 
            $manager: '$manager: '@doctrine.orm.entity_manager'
++  App\Service\JwtAuth:
++      public: true
++      arguments: 
++          $manager: '@doctrine.orm.entity_manager'            
```


9. Now we will modify the **login method**, in [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php), so that it consults in the database if the user exists and if it exists, it generates a **token**.

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```diff
//...
use App\Service\Helpers;
++ use App\Service\JwtAuth;
//...
class DefaultController extends Controller {
  //..
-- public function login(Request $request, Helpers $helpers){
++ public function login(Request $request, Helpers $helpers, JwtAuth $jwt_auth ){    
    // Receive json by POST
    $json = $request->get('json', null);
    // Array to return by default
    $data = array( 'status' => 'error', 'data' => 'Send json via post !!' );
    if($json != null){
        // you make the login
        // We convert a json to a php object
        $params = json_decode($json);
        $email = (isset($params->email)) ? $params->email : null;
        $password = (isset($params->password)) ? $params->password : null;

        $emailConstraint = new Assert\Email();
        $emailConstraint->message = "This email is not valid !!";
        $validate_email = $this->get("validator")->validate($email, $emailConstraint);

        if($email != null && count($validate_email) == 0 && $password != null){
--          $data = array(
--              'status' => 'success',
--              'data' => 'Login success'
--          );
++          $jwt_auth = $this->get(JwtAuth::class);
++          if($getHash == null || $getHash == false){
++              $signup = $jwt_auth->signup($email, $pwd);
++          }else{
++              $signup = $jwt_auth->signup($email, $pwd, true);
++          }
++          return new JsonResponse($signup);
        }else{
            $data = array(
                'status' => 'error',
                'data' => 'Email or password incorrect'
            );
        }
    }
    return $helpers->json($data);
  }
//..
```

> **IMPORTANT** We replace the return command `$this->json($signup);` by `return new JsonResponse($signup);` to avoid failures in the transformation to json.

10. we must generate a new method within the service that checks the token.

_[src/Service/JwtAuth.php](./symfony/src/Service/JwtAuth.php)_
```diff
//..
class JwtAuth{
    //..
++	public function checkToken($jwt, $getIdentity = false){
++      $auth = false;
++		try{
++			$decoded = JWT::decode($jwt, $this->key, array('HS256'));
++      }catch(
++            \UnexpectedValueException $e){ $auth = false; 
++      }catch(
++            \DomainException $e){ $auth = false; 
++      }
++		if(isset($decoded) && is_object($decoded) && isset($decoded->sub)){ $auth = true; }else{ $auth = false; }
++		if($getIdentity == false){ 
++          return $auth; 
++      }else{
++          return $decoded; 
++      }
++  }
    //..
```

11. Now, I can post in [https://app.getpostman.com/](https://app.getpostman.com/) a new request to url [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login) using in the body `x-www-form-urlencoded` with **key** `json` and **value** `{"email":"admin@admin.com", "password":"1"}` to collect the token. 

In our case we received:

```bash
"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiYWRtaW5AYWRtaW4uY29tIiwibmFtZSI6ImFkbWluIiwic3VybmFtZSI6ImFkbWluIiwiaWF0IjoxNTI1MDk3NTEwLCJleHAiOjE1MjU3MDIzMTB9.UA3f6W2mqzrHCoJNvCqxHW4NmOFe-9sMVfNOXXPW_gY"
```

12. We modify the **test method** in [/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php).

_[/symfony/src/Controller/DefaultController.php](./symfony/src/Controller/DefaultController.php)_
```diff
//...
use App\Service\Helpers;
use App\Service\JwtAuth;
//...
class DefaultController extends Controller {
  public function tests (Request $request, Helpers $helpers){
++  $token = $request->get("authorization", null);      
++  if ($token){  
        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository(User::class);
        $userList = $user_repo->findAll();

        return $helpers->json(array(
            'status' => 'success',
            'users' => $userList
        ));
++  } else {
--      return $helpers->json($userList);
++    return $helpers->json(array(
++      'status' => 'error',
++      'code' => 400,
++      'users' => 'Login failed!!!'
++    )); 
++  }
}
```

12. Again, I can post in [https://app.getpostman.com/](https://app.getpostman.com/) a new request to url [http://127.0.0.1:8000/test](http://127.0.0.1:8000/test) using in the body `x-www-form-urlencoded` with **key** `authorization` and **value** `"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImVtYWlsIjoiYWRtaW5AYWRtaW4uY29tIiwibmFtZSI6ImFkbWluIiwic3VybmFtZSI6ImFkbWluIiwiaWF0IjoxNTI1MDk3NTEwLCJleHAiOjE1MjU3MDIzMTB9.UA3f6W2mqzrHCoJNvCqxHW4NmOFe-9sMVfNOXXPW_gY"` to collect the token.

In our case we received:

```bash
{"status":"success","users":[{"id":1,"username":"","name":"admin","surname":"admin","email":"admin@admin.com","password":"1","createdAt":{"timezone":{"name":"UTC","transitions":[{"ts":-9223372036854775808,"time":"-292277022657-01-27T08:29:52+0000","offset":0,"isdst":false,"abbr":"UTC"}],"location":{"country_code":"??","latitude":0,"longitude":0,"comments":""}},"offset":0,"timestamp":1522540800},"salt":null,"role":"admin","roles":["ROLE_USER","ROLE ADMIN"]}]}
```

--------------------------------------------------------------------------------------------

### 7.User Controller

--------------------------------------------------------------------------------------------

--------------------------------------------------------------------------------------------

### 8.Task Controller

--------------------------------------------------------------------------------------------