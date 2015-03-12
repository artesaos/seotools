<?php namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\TwitterCards as TwitterCardsContract;

class TwitterCards implements TwitterCardsContract
{
    
    /**
     *  @var array
     */
    protected $values = [];
    
     /**
     *  @var array
     */
    protected $images = [];
    
     /**
     * @param array $defaults
     */
    public function __construct(array $defaults)
    {
        $this->values = $defaults;
    }
    
    /**
     * @return string 
     */
    public function generate()
    {
        return 'TwitterCards';
    }
    
    /**
     * @oaram string $key
     * @oaram string|array $key
     * 
     * @return TwitterCardsContract
     */
    public function addValue($key, $value)
    {
        $this->values[$key] = $value;
        
        return $this;
    }
    
    /**
     * @param string $type
     * 
     * @return TwitterCardsContract
     */
    public function setType($type)
    {
        return $this->addValue('type', $site);
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
        return $this->addValue('description', $site);
    }
    
    /**
     * @param string $description
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
     */
    public function setImages($images)
    {
        $this->images = [];
        
        return $this->addImage($images);
    }
}