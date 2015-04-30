<?php namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\OpenGraph as OpenGraphContract;

class OpenGraph implements OpenGraphContract
{

    /**
     * @var string
     */
    protected $og_prefix = 'og:';

    /**
     * @var array
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
        $this->config = $config;
    }

    /**
     * Generates open graph tags.
     *
     * @return string
     */
    public function generate()
    {
        $this->setupDefaults();

        $properties = $this->eachProperties($this->properties);
        $images     = $this->eachProperties($this->images, 'image');

        return PHP_EOL . $properties . PHP_EOL . $images;
    }

    /**
     * Make list of open graph tags
     *
     * @param array       $properties
     * @param null|string $prefix
     *
     * @return string
     */
    protected function eachProperties(array $properties, $prefix = null)
    {
        $html = [];

        foreach ($properties as $property => $value):
            // multiple properties
            if (is_array($value)):

                $subListPrefix = (is_string($property)) ? $property : $prefix;
                $subList       = $this->eachProperties($value, $subListPrefix);

                $html[] = $subList;
            else:
                if (is_string($prefix)):
                    $key = (is_string($property)) ? $prefix . ':' . $property : $prefix;
                else:
                    $key = $property;
                endif;

                // if empty jump to next
                if (empty($value)) continue;

                $html[] = $this->makeTag($key, $value);
            endif;
        endforeach;

        return implode(PHP_EOL, $html);
    }

    /**
     * Make a og tag
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function makeTag($key, $value)
    {
        return '<meta property="' . $this->og_prefix . strip_tags($key) . '" content="' . strip_tags($value) . '" />';
    }

    /**
     * Setup default values
     */
    protected function setupDefaults()
    {
        $defaults = (isset($this->config['defaults'])) ? $this->config['defaults'] : [];

        foreach ($defaults as $key => $value):
            if ($key == 'images'):
                if (empty($this->images)):
                    $this->images = $value;
                endif;
            elseif (!empty($value) && !array_key_exists($key, $this->properties)):
                $this->addProperty($key, $value);
            endif;
        endforeach;
    }

    /**
     * Add or update property.
     *
     * @param string       $key
     * @param string|array $value
     *
     * @return OpenGraphContract
     */
    public function addProperty($key, $value)
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * Remove property.
     *
     * @param string $key
     *
     * @return OpenGraphContract
     */
    public function removeProperty($key)
    {
        array_forget($this->properties, $key);

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
     * @param array $urls
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
