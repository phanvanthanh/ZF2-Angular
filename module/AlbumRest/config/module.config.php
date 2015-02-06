<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AlbumRest\Controller\AlbumRest' => 'AlbumRest\Controller\AlbumRestController',
            'AlbumRest\Controller\UserRest' => 'AlbumRest\Controller\UserRestController',
        ),
    ),

    // The following section is new` and should be added to your file
    'router' => array(
        'routes' => array(
            'album-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/album-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AlbumRest\Controller\AlbumRest',
                    ),
                ),
            ),
            'user-rest' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/user-rest[/:id]',
                    'constraints' => array(
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'AlbumRest\Controller\UserRest',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);