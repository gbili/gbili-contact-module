<?php
namespace GbiliContactModule;

return array(
    'gbili_symlink_module' => array(
        'gbili_contact_module_contact_form_phtml' => __DIR__ . '/../view/partial/contact_form.phtml', 
    ),
    'controller_plugins' => include __DIR__ . '/controller_plugins.config.php',
    'doctrine' => include __DIR__ . '/doctrine.config.php',
);
