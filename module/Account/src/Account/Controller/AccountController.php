<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAccount for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Account\Controller;

use Account\Form\LoginForm;
use Account\Model\LoginModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class AccountController extends AbstractActionController
{


	public function indexAction()
    {

		$view = new ViewModel();


		return $view;
    }

	public function testAction()
	{
		return new ViewModel();
	}

	public function loginAction()
	{
		$form = new LoginForm('userLoginForm');
		$request = $this->getRequest();

		if ($request->isPost()) {
			$loginModel = new LoginModel();
			$ip = $request->getServer('REMOTE_ADDR');
			$form->get('ip')->setAttribute('value',$ip);
			$form->setInputFilter($loginModel->getInputFilter());
			$form->setData($request->getPost());
			if ($form->isValid()) {
				//TODO create Model and connect to DB
			}

		}
		return new ViewModel(array(
			'form' => $form
		));
	}
}
