<?php

namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\TwitterCards as TwitterCardsContract;

class TwitterCards implements TwitterCardsContract
{
    /**
     * @var string
     */
    protected $prefix = 'twitter:';

    /**
     * @var array
     */
    protected $html = [];

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @var array
     */
    protected $images = [];

    /**
     * @param array $defaults
     */
    public function __construct(array $defaults = [])
    {
        $this->values = $defaults;
    }

    /**
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false)
    {
        $this->eachValue($this->values);
        $this->eachValue($this->images, 'images');

        return ($minify) ? implode('', $this->html) : implode(PHP_EOL, $this->html);
    }

    /**
     * Make tags.
     *
     * @param array       $values
     * @param null|string $prefix
     *
     * @internal param array $properties
     */
    protected function eachValue(array $values, $prefix = null)
    {
        foreach ($values as $key => $value):
            if (is_array($value)):
                $this->eachValue($value, $key); else:
                if (is_numeric($key)):
                    $key = $prefix.$key; elseif (is_string($prefix)):
                    $key = $prefix.':'.$key;
        endif;

        $this->html[] = $this->makeTag($key, $value);
        endif;
        endforeach;
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return string
     *
     * @internal param string $values
     */
    private function makeTag($key, $value)
    {
        return '<meta name="'.$this->prefix.strip_tags($key).'" content="'.strip_tags($value).'" />';
    }

    /**
     * @param string       $key
     * @param string|array $value
     *
     * @return TwitterCardsContract
     */
    public function addValue($key, $value)
    {
        $this->values[$key] = $value;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return TwitterCardsContract
     */
    public function setTitle($title)
    {
        return $this->addValue('title', $title);
    }

    /**
     * @param string $type
     *
     * @return TwitterCardsContract
     */
    public function setType($type)
    {
        return $this->addValue('type', $type);
    }

    /**
     * @param string $site
     *
     * @return TwitterCardsContract
     */
    public function setSite($site)
    {
        return $this->addValue('site', $site);
    }

    /**
     * @param string $description
     *
     * @return TwitterCardsContract
     */
    public function setDescription($description)
    {
        return $this->addValue('description', $description);
    }

    /**
     * @param string $url
     *
     * @return TwitterCardsContract
     */
    public function setUrl($url)
    {
        return $this->addValue('url', $url);
    }

    /**
     * @param string|array $image
     *
     * @return TwitterCardsContract
     *
     * @deprecated use setImage($image) instead
     */
    public function addImage($image)
    {
        foreach ((array) $image as $url):
            $this->images[] = $url;
        endforeach;

        return $this;
    }

    /**
     * @param string|array $images
     *
     * @return TwitterCardsContract
     *
     * @deprecated use setImage($image) instead
     */
    public function setImages($images)
    {
        $this->images = [];

        return $this->addImage($images);
    }

    /**
     * @param $image
     * @return TwitterCardsContract
     */
    public function setImage($image)
    {
        return $this->addValue('image', $image);
    }
}
