<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace GbiliContactModule\Controller\Plugin;

/**
 *
 */
class Messages extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
{
    /**
     * Contact Form Action 
     * @return mixed
     */
    public function __invoke()
    {
        $controller = $this->getController();

        $em      = $controller->em();
        $sm      = $controller->getServiceLocator();
        $request = $controller->getRequest();
        $locale  = $controller->locale();

        $config = $sm->get('Config');
        $messageEntityClass = (isset($config['gbili_contact_module']['message_entity_class']))
            ? $config['gbili_contact_module']['message_entity_class']
            : '\GbiliContactModule\Entity\DefaultMessage';

        return new \Zend\View\Model\ViewModel([
            'messages' => $em->getRepository($messageEntityClass)->findAll(),
        ]);
    }
}
