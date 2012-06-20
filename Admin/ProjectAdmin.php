<?php
namespace Brickstorm\SolidRBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

use Knplabs\Bundle\MenuBundle\MenuItem;

use Brickstorm\SolidRBundle\Entity\Project;

class ProjectAdmin extends Admin
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
                ->add('unit_cost')
                ->add('devise')
                ->add('parent', 'sonata_type_model', array('required' => false))
            ->end()
            ->with('Quantity')
                ->add('organization', 'sonata_type_model')
                ->add('creator', 'sonata_type_model')
            ->end()
            ->with('Organization')
                ->add('quantity_wanted')
                ->add('quantity_remaining')
            ->end()
            ->with('Area')
                ->add('areas', 'sonata_type_model')
            ->end()
            ->with('Location')
                ->add('cities', 'sonata_type_model')
            ->end()
            ->with('Medias')
                ->add('medias', 'sonata_type_model', array('required' => false))
            ->end()
        ;
    }
}