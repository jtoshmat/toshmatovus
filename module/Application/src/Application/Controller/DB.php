<?php
	namespace Application\Controller;
	use Zend\Db\Adapter\Adapter;
	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\Stdlib\ArrayObject;
	use Zend\View\Model\ViewModel;
	class DB extends AbstractActionController
	{
		public $conn;
		public function __construct($uid='webselect', $pwd='%H56F09NGV@d(*&%^$JKLGKBJ^&(*YHJLK'){
			$this->conn = new Adapter(array(
				'driver' => 'Pdo_Mysql',
				'hostname' =>'localhost',
				'database' => 'toshmatovus',
				'username' => $uid,
				'password' => $pwd
			));
		}

		public function query($sql, $parms=''){
			$result = $this->conn->createStatement($sql, $parms);
			return $result->execute();
		}


	}
