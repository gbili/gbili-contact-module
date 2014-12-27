<?php
namespace GbiliContactModule\Form;

class Contact extends \Zend\Form\Form 
{
    public function __construct($sm)
    {
        parent::__construct('form-contact');

        $config = $sm->get('Config');
        $fieldsetClassname = (isset($config['gbili_contact_module']['message_fieldset_class']))
            ? $config['gbili_contact_module']['message_fieldset_class']
            : __NAMESPACE__ . '\Fieldset\DefaultMessage';
 
        $contactFieldset = new $fieldsetClassname($sm);
        $contactFieldset->setUseAsBaseFieldset(true);

        $this->add($contactFieldset);

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security',
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'btn btn-primary', 
            ),
        ));
    }
}
