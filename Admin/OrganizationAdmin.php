<?php
namespace Brickstorm\SolidRBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

use Knplabs\Bundle\MenuBundle\MenuItem;

use Brickstorm\SolidRBundle\Entity\Organization;

class OrganizationAdmin extends Admin
{
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Name')
                ->add('name')
                ->add('description')
                ->add('parent', 'sonata_type_model', array('required' => false))
            ->end()
            ->with('Details')
                ->add('areas', 'sonata_type_model')
                ->add('cities', 'sonata_type_model')
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_model', array('required' => false))
            ->end()
        ;
    }
}