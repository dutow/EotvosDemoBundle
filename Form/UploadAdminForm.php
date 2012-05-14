<?php

namespace Eotvos\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class UploadAdminForm extends AbstractType
{

    /**
     * Creates a new userreg form consisting of a user registration and a term registration part.
     * 
     * @param RegistrationType $registrationType term form type
     * 
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Builds the form.
     * 
     * @param FormBuilder $builder builder
     * @param array       $options form options
     * 
     * @return void
     *
     * @todo I18N
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('filetypes', 'textarea');
        $builder->add('size', 'integer');
        $builder->add('categories', 'textarea');
    }

    public function fromInputFormat($config)
    {
        return array(
            'filetypes' => @implode(', ',$config->filetypes),
            'size' => @$config->maxfilesize,
            'name' => @$config->name,
            'categories' =>@implode(', ', $config->categories)
        );
    }

    public function toInputFormat($formdata)
    {
        return array(
            'filetypes' => @explode(', ',$formdata['filetypes']),
            'maxfilesize' => @$formdata['size'],
            'name' => $formdata['name'],
            'categories' =>@explode(', ', $formdata['categories']),
        );
    }

    public function getName()
    {
        return 'uploadadmin_form';
    }


}
