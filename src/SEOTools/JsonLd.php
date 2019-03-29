<?php

namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\JsonLd as JsonLdContract;

class JsonLd implements JsonLdContract
{
    /**
     * @var array
     */
    protected $values = [];

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $url = '';

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
        $generated = [
            '@context' => 'https://schema.org',
            '@type' => $this->type,
            'name' => $this->title,
            'description' => $this->description,
            'url' => $this->url,
            'image' => count($this->images) === 1 ? reset($this->images) : json_encode($this->images),
        ] + $this->values;

        return json_encode($generated);
    }

    /**
     * @param string $key
     * @param string|array $value
     *
     * @return JsonLdContract
     */
    public function addValue($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * @param string $type
     *
     * @return JsonLdContract
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return JsonLdContract
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $site
     *
     * @return JsonLdContract
     */
    public function setSite($site)
    {
        // TODO: Implement setSite() method.
    }

    /**
     * @param string $description
     *
     * @return JsonLdContract
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $url
     *
     * @return JsonLdContract
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string|array $images
     *
     * @return JsonLdContract
     */
    public function setImages($images)
    {
        $this->images = [];

        return $this->addImage($images);
    }

    /**
     * @param string|array $image
     *
     * @return JsonLdContract
     */
    public function addImage($image)
    {
        $this->images[] = $image;

        return $this;
    }
}
