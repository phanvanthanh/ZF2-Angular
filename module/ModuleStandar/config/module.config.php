<?php
return array(
     'controllers' => array(
         'invokables' => array(
             'ModuleStandar\Controller\Index' => 'ModuleStandar\Controller\IndexController',

         ),
     ),

     // The following section is new and should be added to your file
     'router' => array(
         'routes' => array(
            'module_standar' => array(
                'type'    => 'literal', 
                'options' => array(
                    'route'    => '/module-standar',                     
                    'defaults' => array(
                       '__NAMESPACE__'=>'ModuleStandar\Controller',
                        'controller' => 'Index',
                        'action'     => 'index',
                    ),
                ),                
                'may_terminate' => true,
                'child_routes' => array(            
                    'crud' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action][/:id]',
                            'constraints' => array(                            
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id'=>'[0-9]+',
                            ),                                                     
                        ),    
                    ),                                  
                ),
            ),
         ),
     ),

     'view_manager' => array(
         'template_path_stack' => array(
             'module_standar' => __DIR__ . '/../view',
         ),
    
 )
     );
?>