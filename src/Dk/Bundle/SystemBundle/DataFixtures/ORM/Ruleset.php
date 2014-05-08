<?php
namespace Dk\Bundle\SystemBundle\DataFixtures\ORM;

use Dk\Bundle\SystemBundle\Entity\RulesetAsset;
use Dk\Bundle\SystemBundle\Entity\RulesetSkillGroup;
use Dk\Bundle\SystemBundle\Entity\RulesetAssetGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Finder\SplFileInfo;
use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Dk\Bundle\SystemBundle\Entity\RulesetCharacteristic;
use Dk\Bundle\SystemBundle\Entity\RulesetSkill;

class LoadRulesetData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
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

        /** @var SplFileInfo $directory */
        foreach ($finder as $directory) {
            $rulesetFinder = (new Finder())->files()->in($directory->getPath())->name('*.yml')->sortByName();
            /** @var SplFileInfo $file */
            foreach ($rulesetFinder as $file) {

                $data = $yaml->parse($file->getContents());

                preg_match('/[0-9]*-([a-zA-Z_]*).yml/', $file->getBasename(), $type);
                switch ($type[1]) {
                    case 'ruleset':
                        $ruleset = $this->setRuleset($data['ruleset'], $manager);
                        break;
                    case 'characteristics':
                        $this->setCharacteristics($ruleset, $data['characteristics'], $manager);
                        break;
                    case 'skills':
                        $this->setSkills($ruleset, $data['skills'], $manager);
                        break;
                    case 'assets':
                        $this->setAssets($ruleset, $data['assets'], $manager);
                        break;
                }
             }
        }

        $manager->flush();
    }

    private function setRuleset(array $data, ObjectManager $manager)
    {

        $ruleset = new Ruleset();
        $ruleset
            ->setName($data['name'])
            ->setOwner($this->getReference($data['owner']))
            ->setReference($data['reference'])
        ;

        $this->addReference($data['reference'], $ruleset);

        $manager->persist($ruleset);

        return $ruleset;
    }

    private function setCharacteristics(Ruleset $ruleset, array $characteristics, ObjectManager $manager)
    {
        foreach ($characteristics as $shortName => $def) {

            $char = new RulesetCharacteristic();

            $char
                ->setShortname($shortName)
                ->setLongname($def['longname'])
                ->setDescription($def['desc'])
                ->setRuleset($ruleset)
            ;

            $manager->persist($char);

            $this->setReference(strtoupper($shortName), $char);
        }

    }

    private function setSkills(Ruleset $ruleset, array $skills, ObjectManager $manager)
    {
        $groups = new ArrayCollection();
        $addGroup = function($name, $parent, $level) use ($manager, $groups, $ruleset) {

            $group = new RulesetSkillGroup();
            $group
                ->setName($name)
                //->setRuleset($ruleset)
            ;

            if (1 !== $level) {
                $group->setParent($groups->get($parent));
            }

            $groups->offsetSet($name, $group);

            $manager->persist($group);
            $manager->flush();

        };

        $skillCollection = new ArrayCollection();
        $addSkill = function($name, $data, $group) use ($manager, $skillCollection, $groups, $ruleset) {

            $skill = new RulesetSkill();
            $skill
                ->setRuleset($ruleset)
                ->setName($name)
                ->setOverloadMalus(isset($data['malus'])? true : false)
                ->setChar1($this->getReference($data['chars'][0]))
                ->setChar2($this->getReference($data['chars'][1]))
                ->setDescription($data['desc'])
            ;

            if (!$groups->isEmpty()) {
                $skill->setGroup($groups->get($group));
            }

            $manager->persist($skill);
            $manager->flush();
        };

        $this->recursiveItemManager($skills, null, $addGroup, $addSkill);

    }

    private function setAssets(Ruleset $ruleset, array $assets, ObjectManager $manager)
    {
        $groups = new ArrayCollection();
        $addGroup = function($name, $parent, $level) use ($manager, $groups, $ruleset) {

            $group = new RulesetAssetGroup();
            $group
                ->setName($name)
                ->setRuleset($ruleset)
            ;

            if (null !== $parent) {
                $group->setParent($groups->get($parent));
            }

            $groups->offsetSet($name, $group);

            $manager->persist($group);
            $manager->flush();

        };

        $assetsCollection = new ArrayCollection();
        $addAsset = function($name, $data, $group) use ($manager, $assetsCollection, $groups, $ruleset) {
            $asset = new RulesetAsset();
            $asset
                ->setName($name)
                ->setDescription($data['desc'])
                ->setGroup($groups->get($group))
                ->setRuleset($ruleset)
            ;

            $manager->persist($asset);
            $manager->flush();
        };

        $this->recursiveItemManager($assets, null, $addGroup, $addAsset);
    }

    private function recursiveItemManager(array &$value, $p, \Closure $addGroup, \Closure $addItem ) {

        static $level = 0;
        foreach ($value as $k => &$v) {
            if('list' === $k) {
                foreach ($v as $name => $item) {
                    $addItem($name, $item, $p);
                }
                unset($value[$k]);
                break;
            } elseif(is_array($v)) {

                $level++;
                $addGroup($k, $p, $level);
                $this->recursiveItemManager($v, $k, $addGroup, $addItem);


            }
        }

        $level--;
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
