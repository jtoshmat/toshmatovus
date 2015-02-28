<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonAccount for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Account\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class AccountController extends AbstractActionController
{


	public function indexAction()
    {

		$view = new ViewModel();


		return $view;
    }

	public function interviewAction()
	{


		return new ViewModel();
	}
	public function testAction()
	{



		return new ViewModel();
	}
}
