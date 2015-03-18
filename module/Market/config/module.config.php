<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'market-city-controller' => 'Market\Controller\CityCodesController',
        ),
        'factories' => array(
            'market-index-controller' => 'Market\Factory\IndexControllerFactory',
            'market-view-controller' => 'Market\Factory\ViewControllerFactory',
            'market-post-controller' => 'Market\Factory\PostControllerFactory',
            'market-delete-controller' => 'Market\Factory\DeleteControllerFactory',
        )
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'market-index-controller',
                        'action' => 'index'
                    )
                )
            ),
            'city-lookup' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/city-lookup',
                    'defaults' => array(
                        'controller' => 'market-city-controller',
                        'action' => 'lookup',
                    ),
                ),
            ),
            'market' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/market[/]',
                    'defaults' => array(
                        'controller' => 'market-index-controller',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'view' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'view[/]',
                            'defaults' => array(
                                'controller' => 'market-view-controller',
                                'action' => 'index'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'main' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => 'main[/:category]',
                                    'defaults' => array(
                                        'action' => 'index'
                                    )
                                )
                            ),
                            'item' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => 'item[/:itemId]',
                                    'defaults' => array(
                                        'action' => 'item'
                                    )
                                )
                            ),
                        ),
                    ),
                    'post' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => 'post[/]',
                            'defaults' => array(
                                'controller' => 'market-post-controller',
                                'action' => 'index'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            'market-delete-form' => 'Market\Form\DeleteForm',
            'market-delete-filter' => 'Market\Form\DeleteFormFilter',
        ),
        'factories' => array(
            'general-adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'market-post-form' => 'Market\Factory\PostFormFactory',
            'market-post-filter' => 'Market\Factory\PostFilterFactory',
            'listings-table' => 'Market\Factory\ListingsTableFactory',
            'city-codes-table' => 'Market\Factory\CityCodesTableFactory',
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Market' => __DIR__ . '/../view',
        ),
    ),
);
