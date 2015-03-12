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
     * @return TwitterCardsContract
     */
    public function setType($type);

    /**
     * @param string $site
     * 
     * @return TwitterCardsContract
     */
    public function setSite($site);

    /**
     * @param string $description
     * 
     * @return TwitterCardsContract
     */
    public function setDescription($description);

    /**
     * @param string $description
     * 
     * @return TwitterCardsContract
     */
    public function setUrl($url);

    /**
     * @param string|array $image
     * 
     * @return TwitterCardsContract
     */
    public function addImage($image);

    /**
     * @param string|array $images
     * 
     * @return TwitterCardsContract
     */
    public function setImages($images);
}