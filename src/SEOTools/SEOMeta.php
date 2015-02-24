<?php namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\MetaTagsContracts;

class SEOMeta implements MetaTagsContracts
{

    /**
	 * The meta title.
	 *
	 * @var string
	 */
	protected $title;
	
	/**
	 * The meta title session.
	 *
	 * @var string
	 */
	protected $title_session;
	
	/**
	 * The meta description.
	 *
	 * @var string
	 */
	protected $description;
	
	/**
	 * The meta keywords.
	 *
	 * @var array
	 */
	protected $keywords;
	
	/**
	 * extra metatags
	 *
	 * @var array
	 */
	protected $metatags = [];
	
	/**
	 * The default configurations.
	 *
	 * @var array
	 */
	protected $defaults = array(
		'title'       => false,
		'description' => false,
		'separator'   => ' | ',
		'keywords'    => array()
	);
	
	/**
	 * The webmaster tags values.
	 * 
	 * @var array
	 */
	protected $webmaster = array(
		'google'    => null,
		'bing'      => null,
		'alexa'     => null,
		'pinterest' => null,
		'yandex'    => null
	);
	
	/**
	 * The webmaster tags.
	 * 
	 * @var array
	 */
	public $webmasterTags = array(
		'google'   => "google-site-verification",
		'bing'     => "msvalidate.01",
		'alexa'    => "alexaVerifyID",
		'pintrest' => "p:domain_verify",
		'yandex'   => "yandex-verification"
	);
	
    public function __construct(array $defaults = array(), array $webmaster = array())
    {
        $this->defaults = array_merge($this->defaults, $defaults);
        
		$this->webmaster = array_merge($this->webmaster, $webmaster);
    }

    /**
     * Generates meta tags
     *
     * @return string
     */
    public function generate()
    {
        // TODO: Implement generate() method.
    }

    /**
     * Sets the title
     *
     * @param string $title
     *
     * @return MetaTagsContracts
     */
    public function setTitle($title)
    {
        // clean title
        $title = strip_tags($title);
        
        // store title session        
		$this->title_session = $title;
		
		// store title
		$this->title = $this->parseTitle($title);
		
		return $this;
    }

    /**
     * @param string $description
     *
     * @return MetaTagsContracts
     */
    public function setDescription($description)
    {
        // clean and store description
		$this->description = strip_tags($description);
		
		return $this;
    }

    /**
     * Sets the list of keywords, you can send an array or string separated with commas
     * also clears the previously set keywords
     *
     * @param string|array $keywords
     *
     * @return MetaTagsContracts
     */
    public function setKeywords($keywords)
    {
        
        if(!is_array($keywords)):
            $keywords = explode(', ', $this->keywords);    
        endif;
        
        // clean keywords
        $keywords = array_map('strip_tags', $keywords);
        
        // store keywords
        $this->keywords = $keywords;
        
        return $this;
    }

    /**
     * Add a keyword
     *
     * @param string|array $keyword
     *
     * @return MetaTagsContracts
     */
    public function addKeyword($keyword)
    {
		if(is_array($keyword)):
		    $this->keywords = array_merge($keyword, $this->keywords);
		else:
		    $this->keywords[] = strip_tags($keyword);  
		endif;
		
		return $this;
    }

    /**
     * Add a custom meta tag.
     *
     * @param string|array $meta
     * @param string $value
     * @param string $name
     *
     * @return MetaTagsContracts
     */
    public function addMeta($meta, $value = null, $name = 'name')
    {
        if (is_array($meta)):
			foreach ($meta as $key => $value):
				$this->metatags[$key] = array($name, $value);
			endforeach;
		else:
			$this->metatags[$meta] = array($name, $value);
		endif;
    }

    /**
     * Takes the title formatted for display
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title ? : $this->getDefault('title');
    }

    /**
     * takes the title that was set
     *
     * @return string
     */
    public function getTitleSession()
    {
        return $this->title_session ? : $this->getTitle();
    }

    /**
     * Get the Meta keywords.
     *
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Get the Meta description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description ? : $this->getDefault('description');
    }

    /**
     * Reset all data.
     *
     * @return void
     */
    public function reset()
    {
        // TODO: Implement reset() method.
    }

    /**
     * Get a default value of configuration.
     *
     * @param string $default
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getDefault($default)
    {
        if (array_key_exists($default, $this->defaults)):
            throw new \InvalidArgumentException("SEOTools\SEOMeta: default configuration {$default} does not exist.");			
		endif;
		
		return $this->defaults[$default];
    }
    
    /**
     * Get parsed title.
     * 
     * @param string $title
     * 
     * @return string
     */
    private function parseTitle($title)
    {
        return $title . $this->getDefault('separator') . $this->getDefault('title');
    }
}