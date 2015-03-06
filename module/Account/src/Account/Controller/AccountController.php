<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAccount for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Account\Controller;

use Account\Form\ForgotPasswordForm;
use Account\Form\LoginForm;
use Account\Model\ForgotPasswordModel;
use Account\Model\LoginModel;
use Account\Model\LoginTable;
use Application\Controller\Security;
use Zend\Http\Header\Cookie;
use Zend\Http\Header\SetCookie;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Navigation\Page\Uri;
use Zend\View\Model\ViewModel;



class AccountController extends AbstractActionController
{

	public $Security;
	public $isUserLoggedIn = false;
	public $userSession;
	protected $token;
	public function __construct(){
		$this->Security = new Security();
		$sess = $this->Security->getSession('toshmatovusid');
		if ($sess){
			$this->isUserLoggedIn = true;
			$this->userSession = $sess;
		}

		$this->token = $this->Security->setRandomHash('toshmatov');
		$this->Security->createSession('sessionToken', $this->token);

	}

	public function __destruct(){
		$this->Security->createSession('sessionToken', $this->token);
	}

	public function indexAction()
    {

	    $dbtest = new LoginTable();
	    var_dump($dbtest->insertForgotPasswordTokenModel());
	    return false;

	    return new ViewModel(array(
		    'usersession' => $this->userSession
	    ));
    }

	public function testAction()
	{
		return new ViewModel();
	}

	public function loginAction()
	{
		$form = new LoginForm('userLoginForm');
		$request = $this->getRequest();
		$sessionToken = $this->Security->getSession('sessionToken');
		$this->Security->createSession('formToken', $sessionToken);


		if ($request->isPost()) {
			$loginModel = new LoginModel();
			$ip = $request->getServer('REMOTE_ADDR');
			$form->get('ip')->setAttribute('value',$ip);
			$form->setInputFilter($loginModel->getInputFilter());
			$form->setData($request->getPost());
			$formToken = $form->get('token')->getValue();
			$sessionToken = $this->Security->getSession('sessionToken');
			$rememberLogin = (int) $form->get('rememberLogin')->getValue();
			$uid = $form->get('username')->getValue();
			$pwd = $form->get('password')->getValue();

			//Form is hacked if this is true
			if ($formToken!==$sessionToken){
				$this->flashMessenger()->addErrorMessage('Your form inputs are invalid');
				return $this->redirect()->toRoute('user', array('action'=>'login'));
			}

			if ($form->isValid()) {
				//TODO create Model and connect to DB
				$output = $this->loginRegular($form);
				var_dump($output);
				$this->flashMessenger()->addInfoMessage('You are logged on');
				return $this->redirect()->toRoute('user');
				return false;
			}

		}

		$token = $this->Security->getSession('formToken');
		return new ViewModel(array(
			'token' => $token,
			'form' => $form,
			'usersession' => $this->userSession
		));
	}


	protected function loginRegular(LoginForm $loginForm){
		$loginTable = new LoginTable();
		$output = $loginTable->loginModel($loginForm);
		return $output;
	}


	public function logoutAction(){
		$this->Security->createUserSession('delete');
		$this->flashMessenger()->addInfoMessage('You have been logged out');
		return $this->redirect()->toRoute('user', array('action'=>'login'));

	}

	protected function loginWithFacebook(LoginForm $loginForm){
//		$loginTable = new LoginTable();
//		$output = $loginTable->loginModel($loginForm);
//		return $output;
	}

	public function forgotPasswordAction(){
		$request = $this->getRequest();
		$form = new ForgotPasswordForm('forgot_password');
		$token = $this->Security->getSession('formToken');

		if ($request->isPost()) {
			$forgotPasswordModel = new ForgotPasswordModel();
			$ip = $request->getServer('REMOTE_ADDR');
			$form->get('ip')->setAttribute('value', $ip);
			$form->setInputFilter($forgotPasswordModel->getInputFilter());
			$form->setData($request->getPost());
			$formToken = $form->get('token')->getValue();
			$sessionToken = $this->Security->getSession('sessionToken');
			$http = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
			$url = "$http$_SERVER[HTTP_HOST]/account/forgotpassword";
			$form->get('url')->setValue($url);

			//Form is hacked if this is true
			if ($formToken !== $sessionToken) {
				$this->flashMessenger()->addErrorMessage('Your form inputs are invalid');
				return $this->redirect()->toRoute('user', array('action' => 'forgotpassword'));
			}

			if ($form->isValid()){
				$email = $form->get('username')->getValue();
				if (!$this->verifyEmail($email)){
					$this->flashMessenger()->addErrorMessage('Your email address is invalid');
					return $this->redirect()->toRoute('user', array('action' => 'forgotpassword'));
				}
				//SAFE ZONE STARTS
				$loginTable = new LoginTable();
				$output = $loginTable->forgotPasswordModel($form);
				var_dump($output); return false;
				//SAFE ZONE ENDS
			}
			$this->flashMessenger()->addErrorMessage('Your email address format is invalid');
			return $this->redirect()->toRoute('user', array('action' => 'forgotpassword'));

		}

		return new ViewModel(array(
			'token' => $token,
			'form' => $form,
			'usersession' => $this->userSession
		));
	}



	public function verifyEmail($email){
		$email_arr = explode("@", $email);
		$domain = array_slice($email_arr, -1);
		if (checkdnsrr($domain[0])){
			return true;
		}
		return false;
	}


}
