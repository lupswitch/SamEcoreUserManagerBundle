<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CanalTP\SamEcoreUserManagerBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends BaseRegistrationFormType
{

    protected $class;
    protected $groupClass;
    protected $aFormRegistrationConfig;
    protected $registrationListener;

    /**
     * @inherit
     */
    public function __construct($groupClass, $registrationListener)
    {

        $this->groupClass = $groupClass;

        $this->registrationListener = $registrationListener;
    }

    /**
     * @inherit
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', 'sam_user');

        // $this->addGroup($builder);
        $builder->addEventSubscriber($this->registrationListener);
    }

    /**
     * Ajoute un champs select pour choisir le role si l'utilisateur
     * est un SUPER_ADMIN
     *
     * @throws \LogicException
     */
    public function addGroup(FormBuilderInterface $builder)
    {
        $builder->add(
            'groups',
            'entity',
            array(
                'class' => $this->groupClass,
                'property' => 'name',
                'label' => 'ctp_user.user.add.groups',
                'multiple' => true,
                'expanded' => true,
            )
        );
    }

    /**
     * @inherit
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'CanalTP\SamEcoreUserManagerBundle\Form\Model\UserRegistration',
                'intention'  => 'admin_registration',
            )
        );
    }

    public function getName()
    {
        return 'sam_user_registration';
    }
}
