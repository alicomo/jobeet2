<?php
namespace Shaduli\JobeetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
/**
 * Description of CategoryAdmin
 *
 * @author Muhammadali Shaduli
 */
class JobAdmin extends Admin 
{
     static public $types = array(
        'full-time' => 'Full time',
        'part-time' => 'Part time',
        'freelance' => 'Freelance',
    );
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category', 'entity', array('class' => 'ShaduliJobeetBundle:Category', 'property' => 'name'))
                ->add('type', 'choice', array(
                    'choices' => $this->getTypes(), 
                    'expanded' => true ))
                ->add('company')
                ->add('logo', 'file', array('label' => 'Company logo', 'data_class' => null))
                ->add('url')
                ->add('position')
                ->add('location')
                ->add('description', 'textarea')
                ->add('how_to_apply', 'textarea', array('label' => 'How to apply?'))
                ->add('is_public', 'text', array('label' => 'Public?', 
                    'attr' => array('help' => 'Whether the job can also be published on affiliate websites or not.')))
                ->add('email');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category.name')
            ->add('company')
            ->add('position')
            ->add('location');
            
                    
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('category.name', null, array('label' => 'Category'))
            ->add('type')
            ->add('company')
            ->add('position')
            ->add('location')
            ->add('is_public')
            ->add('_action', 'actions', array(
    'actions' => array(
        'view' => array(),
        'edit' => array(),
        'delete' => array(),
    )));
    }
    
    
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper->add('category.name')
                ->add('type')
                ->add('company')
                ->add('url')
                ->add('position')
                ->add('location')
                ->add('description')
                ->add('how_to_apply')
                ->add('is_public')
                ->add('email')
                ->add('expires_at')
                ->add('activated_at');
    }

//    public function validate(ErrorElement $errorElement, $object)
//    {
//        $errorElement
//            ->with('name')
//                ->assertMaxLength(array('limit' => 32))
//            ->end()
//        ;
//    }
    
    public function getTypes() {
        return self::$types;
    }
}


