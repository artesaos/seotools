<?php

namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\JsonLdMulti as JsonLdMultiContract;

/**
 * JsonLdMulti provides implementation for `JsonLdMulti` contract.
 *
 * @see \Artesaos\SEOTools\Contracts\JsonLdMulti
 */
class JsonLdMulti implements JsonLdMultiContract
{
    /**
     * Index of the targeted JsonLd group
     *
     * @var int
     */
    protected $index = 0;
    /**
     * List of the JsonLd groups
     *
     * @var array
     */
    protected $list = [];
    /**
     * @var array
     */
    protected $defaultJsonLdData = [];

    /**
     * JsonLdMulti constructor.
     *
     * @param array $defaultJsonLdData
     */
    public function __construct(array $defaultJsonLdData = [])
    {
        $this->defaultJsonLdData = $defaultJsonLdData;
        // init the first JsonLd group
        if (empty($this->list)) {
            $this->newJsonLd();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function generate($minify = false)
    {
        if (count($this->list) > 1) {
            return array_reduce($this->list, function (string $output, JsonLd $jsonLd) {
                return $output . (! $jsonLd->isEmpty() ? $jsonLd->generate() : '');
            }, '');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function newJsonLd()
    {
        $this->index = count($this->list);
        $this->list[] = new JsonLd($this->defaultJsonLdData);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty()
    {
        return $this->list[$this->index]->isEmpty();
    }

    /**
     * {@inheritdoc}
     */
    public function select($index)
    {
        // don't change the index if the new one doesn't exists
        if (key_exists($this->index, $this->list)) {
            $this->index = $index;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addValue($key, $value)
    {
        $this->list[$this->index]->addValue($key, $value);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addValues(array $values)
    {
        $this->list[$this->index]->addValues($values);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->list[$this->index]->setType($type);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->list[$this->index]->setTitle($title);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setSite($site)
    {
        $this->list[$this->index]->setSite($site);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->list[$this->index]->setDescription($description);

        return $this;
    }

    /**
     *{@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->list[$this->index]->setUrl($url);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setImages($images)
    {
        $this->list[$this->index]->setImages($images);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addImage($image)
    {
        $this->list[$this->index]->addImage($image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image)
    {
        $this->list[$this->index]->setImage($image);

        return $this;
    }
}
