<?php

namespace Dk\Bundle\ImportBundle\Import;

use Closure;
use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Abstract class LoaderInterface
 *
 * @package Dk\Bundle\ImportBundle\Import
 *
 * @author Laurent Callarec <l.callarec@gmail.com>
 */
abstract class Importer implements ImporterInterface
{
    /** @var PropertyAccessor */
    private $accessor;

    /** @var DataExtractorInterface */
    private $extractor;

    /** @var array */
    private $data;

    /**
     * {@inheritDoc}
     */
    abstract public function import(Ruleset $ruleset);

    /**
     * @param PropertyAccessor       $accessor
     * @param DataExtractorInterface $extractor
     * @param string                 $content
     */
    public function __construct(PropertyAccessor $accessor, DataExtractorInterface $extractor, $content)
    {
        $this->accessor  = $accessor;

        $this->extractor = $extractor;

        $this->data      = $this->extractor->extract($content);
    }

    /**
     * Get key value
     *
     * @param string $key
     * @return mixed
     */
    protected function getValue($key)
    {
        return $this->accessor->getValue($this->data, $key);
    }

    /**
     * @param array $value
     * @param $parent
     * @param callable $addGroup
     * @param callable $addItem
     */
    protected function recursiveItemManager(array &$value, $parent, Closure $addGroup, Closure $addItem )
    {
        static $level = 0;
        foreach ($value as $k => &$v) {
            if('list' === $k) {
                foreach ($v as $name => $item) {
                    $addItem($name, $item, $parent);
                }
                unset($value[$k]);
                break;
            } elseif(is_array($v)) {

                $level++;
                $addGroup($k, $parent, $level);
                $this->recursiveItemManager($v, $k, $addGroup, $addItem);
            }
        }

        $level--;
    }

    /**
     * @param Ruleset $ruleset
     * @param ArrayCollection $groups
     *
     * @return Closure
     */
    protected function getGroupClosure(Ruleset $ruleset, ArrayCollection $groups)
    {
        return function($name, $parent, $level) use ($groups, $ruleset) {

            $group = new RulesetSkillGroup();
            $group
                ->setName($name)
                ->setRuleset($ruleset)
            ;

            if (1 !== $level) {
                $group->setParent($groups->get($parent));
            }

            $groups->offsetSet($name, $group);
        };
    }
} 