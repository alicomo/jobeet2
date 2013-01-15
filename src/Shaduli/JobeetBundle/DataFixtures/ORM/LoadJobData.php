<?php

/*
 * @author Muhammadali Shaduli
 */

namespace Shaduli\JobeetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Shaduli\JobeetBundle\Entity\Job;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $job = new Job();
        $job->setCategory($this->getReference('Design'));
        $job->setType('part-time');
        $job->setCompany('Extreme Sensio');
        $job->setLogo(null);
        $job->setUrl('http://www.extreme-sensio.com/');
        $job->setPosition('Web Designer');
        $job->setLocation('Paris, France');
        $job->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
      eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
      enim ad minim veniam, quis nostrud exercitation ullamco laboris
      nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
      in reprehenderit in.");
        $job->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job->setIsPublic(true);
        $job->setIsActivated(true);
        $job->setEmail('job@example.com');
        $job->setToken('job_extreme_sensio');
        $job->setExpiresAt(new \DateTime('2013-01-22'));
        $manager->persist($job);
        $manager->flush();


        $job = new Job();
        $job->setCategory($this->getReference('Programming'));
        $job->setType('full-time');
        $job->setCompany('Sensio Labs');
        $job->setLogo(null);
        $job->setUrl('http://www.sensiolabs.com/');
        $job->setPosition('Web Developer');
        $job->setLocation('Paris, France');
        $job->setDescription("You've already developed websites with symfony and you want to work
      with Open-Source technologies. You have a minimum of 3 years
      experience in web development with PHP or Java and you wish to
      participate to development of Web 2.0 sites using the best
      frameworks available");
        $job->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $job->setIsPublic(true);
        $job->setIsActivated(true);
        $job->setEmail('job@example.com');
        $job->setToken('some');
        $job->setExpiresAt(new \DateTime('2013-12-22'));
        $manager->persist($job);
        $manager->flush();


        $categories = array('Design', 'Programming', 'Manager', 'Administrator');

        foreach ($categories as $category) {

            for ($i = 100; $i <= 130; $i++) {
                $job = new Job();
                $job->setCategory($this->getReference($category));
                $job->setType('full-time');
                $job->setCompany('Company ' . $i);
                $job->setLogo(null);
                $job->setUrl('http://www.sensiolabs.com/');
                $job->setPosition($category.$i);
                $job->setLocation('Paris, France');
                $job->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit.");
                $job->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
                $job->setIsPublic(true);
                $job->setIsActivated(true);
                $job->setEmail('job@example.com');
                $job->setToken('job_' . $i);
                $job->setExpiresAt(new \DateTime('2013-12-22'));
                $manager->persist($job);
                $manager->flush();
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 2; // the order in which fixtures will be loaded
    }

}

