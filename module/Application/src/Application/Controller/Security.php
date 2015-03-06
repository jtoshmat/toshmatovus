<?php
	namespace Application\Controller;
	use Zend\Db\Adapter\Adapter;
	use Zend\Http\Client;
	use Zend\Http\Cookies;
	use Zend\Http\Header\Cookie;
	use Zend\Http\Header\SetCookie;
	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\Stdlib\ArrayObject;
	use Zend\View\Model\ViewModel;
	use Zend\Session\Container as SessionContainer;
	use Zend\Http\Request;

	class Security extends AbstractActionController
	{

		public $session;
		public function __construct($sessionDomain='toshmatovus'){
			$this->session = new SessionContainer($sessionDomain);
		}

		public function createUserSession($data, $action='delete'){
			if($action=='delete'){
				$this->session->toshmatovusid=null;
				unset($this->session->toshmatovusid);
				return false;
			}
			$fullName = $data['firstName']." ". $data['lastName'];
			$this->session->toshmatovusid = array('id'=>$data['user_id'],'email'=>$data['email'], 'fullname'
			=>$fullName);
			return $this->session->toshmatovusid;
		}

		public function getSession($id){
			return $this->session->{$id};
		}

		public function createSession($id, $value){
			return $this->session->{$id} = $value;
		}

		public function hashText($txt='toshmatovus'){
			return '$!9.@03~02-2015.'.md5($txt).'.T0sHmAt0V';
		}

		public function setRandomHash($txt){
			return '<token>'.md5($txt).'</token>';
		}

		public function setCookies($id, $value){
			$cookies = new Cookie();

		}

		public function getCookies($id){
			$cookies = new Cookie();
			return $cookies->getEncodeValue();
		}



	}
