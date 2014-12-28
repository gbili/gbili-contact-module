<?php
namespace GbiliContactModule\Form\Fieldset;

class DefaultMessage extends \Zend\Form\Fieldset 
implements \Zend\InputFilter\InputFilterProviderInterface
{
    public function __construct($sm)
    {
        parent::__construct('default-message');

        $objectManager = $sm->get('Doctrine\ORM\EntityManager');

        $this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager))
             ->setObject(new \GbiliContactModule\Entity\DefaultMessage());
        
        $this->add(array(
            'name' => 'id',
            'type'  => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'firstname',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Firstname'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Johnny',
            )
        ));

        $this->add(array(
            'name' => 'lastname',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Lastname'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'De Vito',
            )
        ));

        $this->add(array(
            'name' => 'email',
            'type'  => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Email'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'johnny.devito@example.com',
            )
        ));

        $this->add(array(
            'name' => 'company',
            'type'  => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Where do you work?'
            ),
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Company name',
            )
        ));
        
        $this->add(array(
            'name' => 'service',
            'type'  => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'How can we help you?',
                'empty_option' => '---',
                'value_options' => array(
                    'website' => 'Build my Website',
                    'ads' => 'Online Advertising',
                    'automate' => 'Automate',
                    'other' => 'Something else',
                ),
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'body',
            'type'  => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Message',
            ),
            'attributes' => array(
                'class' => 'form-control',
                'rows' => '8',
                'placeholder' => 'Your message here...',
            )
        ));
    }

    public function getInputFilterSpecification()
    {
        return array(
            'id' => array(
                'required' => false,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            ),

            'firstname' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ),

            'lastname' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ),

            'email' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'EmailAddress',
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ),

            'company' => array(
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ),

            'service' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            ),

            'body' => array(
                'required' => false,
                'filters'  => array(
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 700,
                        ),
                    ),
                ),
            ),
        );
    }
}
