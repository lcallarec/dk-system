<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Dk\Bundle\ImportBundle\Import\AssetImporter;
use Dk\Bundle\ImportBundle\Import\CharacteristicImporter;
use Dk\Bundle\ImportBundle\Import\Extractor\YmlExtractor;
use Dk\Bundle\ImportBundle\Import\RulesetImporter;
use Dk\Bundle\ImportBundle\Import\SkillImporter;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\SplFileInfo;
use Dk\Bundle\SystemBundle\Entity\Ruleset;

/**
 * Class RulesetData

 * @package Dk\Bundle\SystemBundle\DataFixtures\Test
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
class RulesetData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $rulesetDir = $this->container->get('kernel')->locateResource('@DkSystemBundle/Resources/rules');

        $finder = new Finder();
        $finder->directories()->in($rulesetDir);

        $yaml = new Parser();

        $accessor = PropertyAccess::createPropertyAccessor();

        $extractor = new YmlExtractor($yaml);

        $ruleset = new Ruleset();

        $ruleset->setOwner($this->getReference('l.callarec@gmail.com'));

        /** @var SplFileInfo $directory */
        foreach ($finder as $directory) {
            $rulesetFinder = (new Finder())->files()->in($directory->getPath())->name('*.yml')->sortByName();
            /** @var SplFileInfo $file */
            foreach ($rulesetFinder as $file) {

                preg_match('/[0-9]*-([a-zA-Z_]*).yml/', $file->getBasename(), $type);
                switch ($type[1]) {
                    case 'ruleset':
                        $ri = new RulesetImporter($accessor, $extractor, $file->getContents());
                        $ri->import($ruleset);
                        break;
                    case 'characteristics':
                        $ci = new CharacteristicImporter($accessor, $extractor, $file->getContents());
                        $ci->import($ruleset);
                        break;
                    case 'skills':
                        $si = new SkillImporter($accessor, $extractor, $file->getContents());
                        $si->import($ruleset);
                        break;
                    case 'assets':
                        $ai = new AssetImporter($accessor, $extractor, $file->getContents());
                        $ai->import($ruleset);
                        break;
                }
            }
        }

        $manager->persist($ruleset);
        $manager->flush();

        $this->setReference('dk-std', $ruleset);
    }


    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
}
