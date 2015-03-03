<?php namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\OpenGraph as OpenGraphContract;
use Illuminate\Config\Repository as Config;

class OpenGraph implements OpenGraphContract
{

    /**
     * @var string
     */
    protected $og_prefix = 'og:';

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var array
     */
    protected $images = [];

    /**
     * @param array $config
     */
    public function __construct(array $config = array())
    {
        $this->config = new Config($config);
    }

    /**
     * Generates open graph tags.
     *
     * @return string
     */
    public function generate()
    {
        // TODO: Implement generate() method.
    }

    /**
     * Add or update property.
     *
     * @param string $key
     * @param string $value
     *
     * @return OpenGraphContract
     */
    public function addProperty($key, $value)
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * Add image to properties.
     *
     * @param string $url
     *
     * @return OpenGraphContract
     */
    public function addImage($url)
    {
        $this->images[] = $url;

        return $this;
    }

    /**
     * Add images to properties.
     *
     * @param string $urls
     *
     * @return OpenGraphContract
     */
    public function addImages(array $urls)
    {
        array_push($this->images, $urls);

        return $this;
    }

    /**
     * Define title property.
     *
     * @param $title
     *
     * @return OpenGraphContract
     */
    public function setTitle($title)
    {
        return $this->addProperty('title', $title);
    }

    /**
     * Define description property.
     *
     * @param string $description
     *
     * @return OpenGraphContract
     */
    public function setDescription($description)
    {
        return $this->addProperty('description', $description);
    }

    /**
     * Define url property.
     *
     * @param string $url
     *
     * @return OpenGraphContract
     */
    public function setUrl($url)
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Define site_name property
     *
     * @param string $name
     *
     * @return OpenGraphContract
     */
    public function setSiteName($name)
    {
        return $this->addProperty('site_name', $name);
    }
}