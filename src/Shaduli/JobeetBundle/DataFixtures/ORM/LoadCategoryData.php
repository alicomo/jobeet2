<?php
/*
 * @author Muhammadali Shaduli
 */
namespace Shaduli\JobeetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shaduli\JobeetBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
 
    public function load(ObjectManager $manager)
    {
        $categories = array('Design', 'Programming', 'Manager', 'Administrator');
        foreach($categories as $category) {
            $entity = new Category();
            $entity->setName($category);
            $manager->persist($entity);
            $manager->flush();
            
            $this->addReference($category, $entity);
        }
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}

