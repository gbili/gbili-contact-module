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
class Contact extends \Zend\Mvc\Controller\Plugin\AbstractPlugin
{
    /**
     * Contact Form Action 
     * @return mixed
     */
    public function __invoke(array $routeSuccessParams)
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

        $message = new $messageEntityClass();

        $contactForm = new \GbiliContactModule\Form\Contact($sm);
        $contactForm->bind($message);

        if (!$request->isPost()) {
            return new \Zend\View\Model\ViewModel(array(
                'form' => $contactForm,
                'firstRendering' => true,
                'messages' => $controller->messenger()->getMessages(),
            ));
        }

        $httpPostData = $request->getPost();
        $contactForm->setData($httpPostData);

        if (!$contactForm->isValid()) {
            return new \Zend\View\Model\ViewModel(array(
                'form' => $contactForm,
                'firstRendering' => false,
                'messages' => $controller->messenger()->getMessages(),
            ));
        }

        $message->setLocale($locale); //what is the interface language...

        $message->setDate(new \DateTime());
        $em->persist($message);
        $em->flush();

        return call_user_func_array(array($controller->redirect(), 'toRoute'), $routeSuccessParams);
    }
}
