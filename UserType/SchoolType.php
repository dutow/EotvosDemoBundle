<?php

namespace Eotvos\DemoBundle\UserType;

use Eotvos\VersenyrBundle\Entity\Registration;
use Eotvos\DemoBundle\Entity\SchoolRegistration;
use Eotvos\DemoBundle\Form\Type\SchoolRegistrationType;

use Eotvos\VersenyrBundle\UserType\UserTypeInterface;

/**
 * Empty usertype.
 * 
 * @uses UserTypeInterface
 * @author    Zsolt Parragi <zsolt.parragi@cancellar.hu> 
 * @copyright 2012 Cancellar
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version   Release: v0.1
 */
class SchoolType implements UserTypeInterface
{
    /**
     * Returns an instance of the FormType of term registration.
     *
     * FormType should extend RegistrationType.
     * 
     * @return RegistrationType
     */
    public function getRegistrationFormInstance()
    {
        return new SchoolRegistrationType();
    }

    /**
     * Returns an instance of the term Registration entity
     *
     * FormType should extend RegistrationType.
     * 
     * @return Registration
     */
    public function getRegistrationEntityInstance()
    {
        return new SchoolRegistration();
    }

    /**
     * Returns the partial twig template required by additional form parameters.
     * 
     * @return string
     */
    public function getRegistrationFormPartial()
    {
        return 'EotvosDemoBundle:User:schoolRegistration.html.twig';
    }

    /**
     * Returns the partial twig template rendering the right part of the registration page.
     * 
     * @return string
     */
    public function getRegistrationRightBox()
    {
        return 'EotvosVersenyrBundle:User:emptyRegistrationBox.html.twig';
    }

    public function getDisplayName()
    {
        return 'School Type';
    }
}

