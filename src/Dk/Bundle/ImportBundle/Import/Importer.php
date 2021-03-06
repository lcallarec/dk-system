<?php

namespace Dk\Bundle\ImportBundle\Import;

use Closure;
use Dk\Bundle\ImportBundle\Import\Extractor\DataExtractorInterface;
use Dk\Bundle\SystemBundle\Entity\Ruleset;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\PropertyAccess\PropertyAccessor;

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
    protected $accessor;

    /** @var DataExtractorInterface */
    protected $extractor;

    /** @var array */
    protected $data;

    /**
     * {@inheritDoc}
     */
    abstract public function import(Ruleset $ruleset);

    /**
     * @param PropertyAccessor       $accessor
     * @param DataExtractorInterface $extractor
     * @param string                 $content
     *
     * @author Laurent Callarec <l.callarec@gmail.com>
     */
    public function __construct(PropertyAccessor $accessor, DataExtractorInterface $extractor, $content)
    {
        $this->accessor  = $accessor;

        $this->extractor = $extractor;

        $this->data      = $this->extractor->extract($content)[static::$namespace];
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
     *
     * @author Laurent Callarec <l.callarec@gmail.com>
     */
    protected function recursiveItemManager(array &$value, $parent, Closure $addGroup, Closure $addItem )
    {
        static $level = 0;
        foreach ($value as $key => &$v) {

            if ('list' === $key) {

                foreach ($v as $name => $item) {
                    $addItem($name, $item, $parent);
                }

                unset($value[$key]);
                break;

            } elseif (is_array($v)) {

                $level++;
                $addGroup($key, $parent, $level);
                $this->recursiveItemManager($v, $key, $addGroup, $addItem);
            }

        }

        $level--;
    }

    /**
     * Get the callable used in a to create Ruleset groups on-demand
     *
     * @param Ruleset         $ruleset
     * @param ArrayCollection $groups
     * @param string          $groupClass   A RulesetGroup class name
     *
     * @author Laurent Callarec <l.callarec@gmail.com>
     *
     * @return Closure
     */
    protected function getGroupClosure(Ruleset $ruleset, ArrayCollection $groups, $groupClass)
    {
        return function($name, $parent, $level) use ($groups, $groupClass, $ruleset) {
            $group = new $groupClass();
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