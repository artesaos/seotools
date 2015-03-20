<?php namespace Artesaos\SEOTools\Contracts;

interface TwitterCards
{
     /**
     * @param array $defaults
     */
    public function __construct(array $defaults);

    /**
     * @return string 
     */
    public function generate();

    /**
     * @oaram string $key
     * @oaram string|array $key
     * 
     * @return TwitterCards
     */
    public function addValue($key, $value);

    /**
     * @param string $type
     * 
     * @return TwitterCards
     */
    public function setType($type);

    /**
     * @param string $title
     *
     * @return TwitterCards
     */
    public function setTitle($title);

    /**
     * @param string $site
     * 
     * @return TwitterCards
     */
    public function setSite($site);

    /**
     * @param string $description
     * 
     * @return TwitterCards
     */
    public function setDescription($description);

    /**
     * @param string $url
     * 
     * @return TwitterCards
     */
    public function setUrl($url);

    /**
     * @param string|array $image
     * 
     * @return TwitterCards
     */
    public function addImage($image);

    /**
     * @param string|array $images
     * 
     * @return TwitterCards
     */
    public function setImages($images);
}