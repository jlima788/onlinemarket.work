<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'market-index-controller' => 'Market\Controller\IndexController',
            'market-view-controller' => 'Market\Controller\ViewController'
        ),
        'factories' => array(
            'market-post-controller' => 'Market\Factory\PostControllerFactory'
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
            'market' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/market',
                    'defaults' => array(
                        'controller' => 'market-index-controller',
                        'action' => 'index'
                    )
                )
            ),
            'market-view' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/market/view',
                    'defaults' => array(
                        'controller' => 'market-view-controller',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'index' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/main[/:category]',
                            'defaults' => array(
                                'action' => 'index'
                            )
                        )
                    ),
                    'item' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/item[/:itemId]',
                            'defaults' => array(
                                'action' => 'item'
                            )
                        )
                    )
                )
            ),
            'market-post' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => 'market/post',
                    'defaults' => array(
                        'controller' => 'market-post-controller',
                        'action' => 'index'
                    )
                )
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Market' => __DIR__ . '/../view',
        ),
    ),
);
