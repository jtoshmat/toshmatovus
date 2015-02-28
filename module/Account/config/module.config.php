<?php
	return array(
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

				'test' => array(
					'type' => 'Zend\Mvc\Router\Http\Segment',
					'options' => array(
						'route'    => '/account/test[/:action]',
						'constraints' => array(
							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',

						),
						'defaults' => array(
							'controller' => 'Account\Controller\Account',
							'action'     => 'test',
						),
					),
				),


				// The following is a route to simplify getting started creating
				// new controllers and actions without needing to create a new
				// module. Simply drop new controllers in, and you can access them
				// using the path /account/:controller/:action
				'account2' => array(
					'type'    => 'Literal',
					'options' => array(
						'route'    => '/account',
						'defaults' => array(
							'__NAMESPACE__' => 'Account\Controller',
							'controller'    => 'Account',
							'action'        => 'index',
						),
					),
					'may_terminate' => true,
					'child_routes' => array(
						'default' => array(
							'type'    => 'Segment',
							'options' => array(
								'route'    => '/[:controller[/:action]]',
								'constraints' => array(
									'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
									'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
								),
								'defaults' => array(
								),
							),
						),

						'test2333' => array(
							'type' => 'Zend\Mvc\Router\Http\Segment',
							'options' => array(
								'route'    => 'development[/:action]',
								'constraints' => array(
									'action' => '[a-zA-Z][a-zA-Z0-9_-]*',

								),
								'defaults' => array(
									'controller' => 'Account\Controller\Account',
									'action'     => 'test',
								),
							),
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
		'controllers' => array(
			'invokables' => array(
				'Account\Controller\Account' => 'Account\Controller\AccountController'
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
