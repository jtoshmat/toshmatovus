<?php
	return array(
		'controllers' => array(
			'invokables' => array(
				'Candidate\Controller\Index' => 'Candidate\Controller\IndexController',
			),
		),
		'router' => array(
			'routes' => array(
				'candidate' => array(
					'type' => 'Zend\Mvc\Router\Http\Literal',
					'options' => array(
						'route'    => '/candidate',
						'defaults' => array(
							'controller' => 'Candidate\Controller\Index',
							'action'     => 'index',
						),
					),
				),

				'test' => array(
					'type' => 'Zend\Mvc\Router\Http\Segment',
					'options' => array(
						'route'    => '/test[/:action]',
						'constraints' => array(
							'action' => '[a-zA-Z][a-zA-Z0-9_-]*',

						),
						'defaults' => array(
							'controller' => 'Candidate\Controller\Index',
							'action'     => 'test',
						),
					),
				),


				// The following is a route to simplify getting started creating
				// new controllers and actions without needing to create a new
				// module. Simply drop new controllers in, and you can access them
				// using the path /candidate/:controller/:action
				'candidate' => array(
					'type'    => 'Literal',
					'options' => array(
						'route'    => '/candidate',
						'defaults' => array(
							'__NAMESPACE__' => 'Candidate\Controller',
							'controller'    => 'Index',
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

						'test2' => array(
							'type' => 'Zend\Mvc\Router\Http\Segment',
							'options' => array(
								'route'    => 'development[/:action]',
								'constraints' => array(
									'action' => '[a-zA-Z][a-zA-Z0-9_-]*',

								),
								'defaults' => array(
									'controller' => 'Candidate\Controller\Index',
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
				'Candidate\Controller\Index' => 'Candidate\Controller\IndexController'
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
				'candidate/index/index' => __DIR__ . '/../view/candidate/index/index.phtml',
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
