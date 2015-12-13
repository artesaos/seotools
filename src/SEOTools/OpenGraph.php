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
    protected $articleProperties = [];

    /**
     * @var array
     */
    protected $profileProperties = [];

    /**
     * @var array
     */
    protected $musicSongProperties = [];

    /**
     * @var array
     */
    protected $musicAlbumProperties = [];

    /**
     * @var array
     */
    protected $musicPlaylistProperties = [];

    /**
     * @var array
     */
    protected $musicRadioStationProperties = [];

    /**
     * @var array
     */
    protected $videoMovieProperties = [];

    /**
     * @var array
     */
    protected $videoEpisodeProperties = [];

    /**
     * @var array
     */
    protected $videoTVShowProperties = [];
    /**
     * @var array
     */
    protected $videoOtherProperties = [];

    /**
     * @var array
     */
    protected $bookProperties = [];

    /**
     * @var array
     */
    protected $videoProperties = [];

    /**
     * @var array
     */
    protected $audioProperties = [];

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

        $output = null;

        $output .= $this->eachProperties($this->properties);

        if ($images =  $this->eachProperties($this->images, 'image'))
            $output .= $images;

        if ($article = $this->eachProperties($this->articleProperties, 'article', false))
            $output .= $article;

        if ($profile = $this->eachProperties($this->profileProperties, 'profile', false))
            $output .= $profile;

        if ($book = $this->eachProperties($this->bookProperties, 'book', false))
            $output .= $book;

        if ($musicSong = $this->eachProperties($this->musicSongProperties, 'music', false))
            $output .= $musicSong;

        if ($musicAlbum = $this->eachProperties($this->musicAlbumProperties, 'music', false))
            $output .= $musicAlbum;

        if ($musicPlaylist = $this->eachProperties($this->musicPlaylistProperties, 'music', false))
            $output .= $musicPlaylist;

        if ($musicRadioStation = $this->eachProperties($this->musicRadioStationProperties, 'music', false))
            $output .= $musicRadioStation;

        if ($videoMovie = $this->eachProperties($this->videoMovieProperties, 'video', false))
            $output .= $videoMovie;

        if ($videoEpisode = $this->eachProperties($this->videoEpisodeProperties, 'video', false))
            $output .= $videoEpisode;

        if ($videoTVShow = $this->eachProperties($this->videoTVShowProperties, 'video', false))
            $output .= $videoTVShow;

        if ($videoOther = $this->eachProperties($this->videoOtherProperties, 'video', false))
            $output .= $videoOther;

        if ($video = $this->eachProperties($this->videoProperties, 'video', true))
            $output .= $video;

        if ($audio = $this->eachProperties($this->audioProperties, 'audio', true))
            $output .= $audio;

        return $output;
    }

    /**
     * Make list of open graph tags
     *
     * @param array       $properties
     * @param null|string $prefix
     * @param boolean $ogPrefix
     *
     * @return string
     */
    protected function eachProperties(array $properties, $prefix = null, $ogPrefix = true)
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

                $html[] = $this->makeTag($key, $value, $ogPrefix);
            endif;
        endforeach;

        return implode($html);
    }

    /**
     * Make a og tag
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function makeTag($key, $value, $ogPrefix = false)
    {
        return '<meta property="' . (($ogPrefix) ? $this->og_prefix : '') . strip_tags($key) . '" content="' . strip_tags($value) . '" />' . PHP_EOL;
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
     * Set article properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setArticle($attributes = array())
    {
        $validkeys = [
            'published_time',
            'modified_time',
            'expiration_time',
            'author',
            'section',
            'tag',
        ];

        $this->setProperties('article', 'articleProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set profile properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setProfile($attributes = array())
    {
        $validkeys = [
            'first_name',
            'last_name',
            'username',
            'gender',
        ];

        $this->setProperties('profile', 'profileProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set book properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setBook($attributes = array())
    {
        $validkeys = [
            'author',
            'isbn',
            'release_date',
            'tag'
        ];

        $this->setProperties('book', 'bookProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set music song properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setMusicSong($attributes = array())
    {
        $validkeys = [
            'duration',
            'album',
            'album:disc',
            'album:track',
            'musician',
        ];

        $this->setProperties('music.song', 'musicSongProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set music album properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setMusicAlbum($attributes = array())
    {
        $validkeys = [
            'song',
            'song:disc',
            'song:track',
            'musician',
            'release_date',
        ];

        $this->setProperties('music.album', 'musicAlbumProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set music playlist properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setMusicPlaylist($attributes = array())
    {
        $validkeys = [
            'song',
            'song:disc',
            'song:track',
            'creator'
        ];

        $this->setProperties('music.playlist', 'musicPlaylistProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set music radio station properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setMusicRadioStation($attributes = array())
    {
        $validkeys = [
            'creator'
        ];

        $this->setProperties('music.radio_station', 'musicRadioStationProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set video movie properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setVideoMovie($attributes = array())
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag'
        ];

        $this->setProperties('video.movie', 'videoMovieProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set video episode properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setVideoEpisode($attributes = array())
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag',
            'series'
        ];

        $this->setProperties('video.episode', 'videoEpisodeProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set video episode properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setVideoOther($attributes = array())
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag'
        ];

        $this->setProperties('video.other', 'videoOtherProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set video episode properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function setVideoTVShow($attributes = array())
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag'
        ];

        $this->setProperties('video.tv_show', 'videoTVShowProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Add video properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function addVideo($source = null, $attributes = array())
    {
        $validkeys = [
            'url',
            'secure_url',
            'type',
            'width',
            'height'
        ];

        $this->videoProperties[] = [$source, $this->cleanProperties($attributes, $validkeys)];

        return $this;
    }

    /**
     * Add video properties.
     *
     * @param array $value
     *
     * @return OpenGraphContract
     */
    public function addAudio($source = null, $attributes = array())
    {
        $validkeys = [
            'url',
            'secure_url',
            'type'
        ];

        $this->audioProperties[] = [$source, $this->cleanProperties($attributes, $validkeys)];

        return $this;
    }

    /**
     * Clean invalid properties
     *
     * @param array $attributes
     * @param array $validkeys
     *
     * @return void
     */
    protected function cleanProperties($attributes = array(), $validkeys = array())
    {
        $array = array();

        foreach ($attributes as $attribute => $value) {
            if (in_array($attribute, $validkeys)) {
                $array[$attribute] = $value;
            }
        }

        return $array;
    }

    /**
     * Set properties
     *
     * @param string $type
     * @param string $key
     * @param array $attributes
     * @param array $validkeys
     *
     * @return void
     */
    protected function setProperties($type = null, $key = null, $attributes = array(), $validkeys = array())
    {
        if (isset($this->properties['type']) && $this->properties['type'] == $type) {
            foreach ($attributes as $attribute => $value) {
                if (in_array($attribute, $validkeys)) {
                    $this->{$key}[$attribute] = $value;
                }
            }
        }
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
     * @param mixed $source
     * @param string $attributes
     *
     * @return OpenGraphContract
     */
    public function addImage($source = null, $attributes = array())
    {
        $validkeys = [
            'url',
            'secure_url',
            'type',
            'width',
            'height'
        ];

        if (is_array($source)) {
            $this->images[] = $this->cleanProperties($source, $validkeys);
        } else {
            $this->images[] = [$source, $this->cleanProperties($attributes, $validkeys)];
        }

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
    public function setType($type = null)
    {
        return $this->addProperty('type', $type);
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
