<?php
	return array(
		'classes' => array(
			'Account\Controller\Account' => 'Account\Controller\AccountController',
		),
		'controllers' => array(
			'invokables' => array(
				'Account\Controller\Account' => 'Account\Controller\AccountController',

			),
		),
		'router' => array(
			'routes' => array(
				'account' => array(
					'type' => 'Zend\Mvc\Router\Http\Literal',
					'options' => array(
						'route'    => '/account',
						'defaults' => array(
							'controller' => 'Account\Controller\Account',
							'action'     => 'index',
						),
					),
				),

				'user' => array(
					'type' => 'Zend\Mvc\Router\Http\Segment',
					'options' => array(
						'route'    => '/account[/:action][/:id]',
						'constraints' => array(
							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
							'id'     => '[0-9]+',
						),

						'defaults' => array(
							'controller' => 'Account\Controller\Account',
							'action'     => 'test',
						),
					),
				),



			),
		),
		'service_manager' => array(
			'abstract_factories' => array(
				'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
				'Zend\Log\LoggerAbstractServiceFactory',
			),
			'factories' => array(
				'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
			),
			'aliases' => array(
				'translator' => 'MvcTranslator',
			),
		),
		'translator' => array(
			'locale' => 'en_US',
			'translation_file_patterns' => array(
				array(
					'type'     => 'gettext',
					'base_dir' => __DIR__ . '/../language',
					'pattern'  => '%s.mo',
				),
			),
		),

		'view_manager' => array(
			'display_not_found_reason' => true,
			'display_exceptions'       => true,
			'doctype'                  => 'HTML5',
			'not_found_template'       => 'error/404',
			'exception_template'       => 'error/index',
			'template_map' => array(
				'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
				'account/index/index' => __DIR__ . '/../view/account/index/index.phtml',
				'error/404'               => __DIR__ . '/../view/error/404.phtml',
				'error/index'             => __DIR__ . '/../view/error/index.phtml',
			),
			'template_path_stack' => array(
				__DIR__ . '/../view',
			),

		),
		// Placeholder for console routes
		'console' => array(
			'router' => array(
				'routes' => array(
				),
			),
		),
	);
