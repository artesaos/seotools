<?php

namespace Artesaos\SEOTools;

use Artesaos\SEOTools\Contracts\OpenGraph as OpenGraphContract;

class OpenGraph implements OpenGraphContract
{
    /**
     * OpenGraph Prefix.
     *
     * @var string
     */
    protected $og_prefix = 'og:';

    /**
     * Config.
     *
     * @var array
     */
    protected $config;

    /**
     * Array of Properties.
     *
     * @var array
     */
    protected $properties = [];

    /**
     * Array of Article Properties.
     *
     * @var array
     */
    protected $articleProperties = [];

    /**
     * Array of Profile Properties.
     *
     * @var array
     */
    protected $profileProperties = [];

    /**
     * Array of Music Song Properties.
     *
     * @var array
     */
    protected $musicSongProperties = [];

    /**
     * Array of Music Album Properties.
     *
     * @var array
     */
    protected $musicAlbumProperties = [];

    /**
     * Array of Music Playlist Properties.
     *
     * @var array
     */
    protected $musicPlaylistProperties = [];

    /**
     * Array of Music Radio Properties.
     *
     * @var array
     */
    protected $musicRadioStationProperties = [];

    /**
     * Array of Video Movie Properties.
     *
     * @var array
     */
    protected $videoMovieProperties = [];

    /**
     * Array of Video Episode Properties.
     *
     * @var array
     */
    protected $videoEpisodeProperties = [];

    /**
     * Array of Video TV Show Properties.
     *
     * @var array
     */
    protected $videoTVShowProperties = [];

    /**
     * Array of Video Other Properties.
     *
     * @var array
     */
    protected $videoOtherProperties = [];

    /**
     * Array of Book Properties.
     *
     * @var array
     */
    protected $bookProperties = [];

    /**
     * Array of Video Properties.
     *
     * @var array
     */
    protected $videoProperties = [];

    /**
     * Array of Audio Properties.
     *
     * @var array
     */
    protected $audioProperties = [];

    /**
     * Array of Image Properties.
     *
     * @var array
     */
    protected $images = [];

    /**
     * Create a new OpenGraph instance.
     *
     * @param array $config config
     *
     * @return void
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Generates open graph tags.
     * 
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false)
    {
        $this->setupDefaults();

        $output = $this->eachProperties($this->properties);

        $props = [
            'images'                      => ['image',   true],
            'articleProperties'           => ['article', false],
            'profileProperties'           => ['profile', false],
            'bookProperties'              => ['book',    false],
            'musicSongProperties'         => ['music',   false],
            'musicAlbumProperties'        => ['music',   false],
            'musicPlaylistProperties'     => ['music',   false],
            'musicRadioStationProperties' => ['music',   false],
            'videoMovieProperties'        => ['video',   false],
            'videoEpisodeProperties'      => ['video',   false],
            'videoTVShowProperties'       => ['video',   false],
            'videoOtherProperties'        => ['video',   false],
            'videoProperties'             => ['video',   true],
            'audioProperties'             => ['audio',   true],
        ];

        foreach ($props as $prop => $options) {
            $output .= $this->eachProperties(
                $this->{$prop},
                $options[0],
                $options[1]
            );
        }

        return ($minify) ? str_replace(PHP_EOL, '', $output) : $output;
    }

    /**
     * Make list of open graph tags.
     *
     * @param array       $properties array of properties
     * @param null|string $prefix     prefix of property
     * @param bool        $ogPrefix   opengraph prefix
     *
     * @return string
     */
    protected function eachProperties(
        array $properties,
        $prefix = null,
        $ogPrefix = true
    ) {
        $html = [];

        foreach ($properties as $property => $value) {
            // multiple properties
            if (is_array($value)) {
                $subListPrefix = (is_string($property)) ? $property : $prefix;
                $subList = $this->eachProperties($value, $subListPrefix);

                $html[] = $subList;
            } else {
                if (is_string($prefix)) {
                    $key = (is_string($property)) ?
                        $prefix.':'.$property :
                        $prefix;
                } else {
                    $key = $property;
                }

                // if empty jump to next
                if (empty($value)) {
                    continue;
                }

                $html[] = $this->makeTag($key, $value, $ogPrefix);
            }
        }

        return implode($html);
    }

    /**
     * Make a og tag.
     *
     * @param string $key      meta property key
     * @param string $value    meta property value
     * @param bool   $ogPrefix opengraph prefix
     *
     * @return string
     */
    protected function makeTag($key = null, $value = null, $ogPrefix = false)
    {
        return sprintf(
            '<meta property="%s%s" content="%s" />%s',
            $ogPrefix ? $this->og_prefix : '',
            strip_tags($key),
            strip_tags($value),
            PHP_EOL
        );
    }

    /**
     * Add or update property.
     *
     * @return void
     */
    protected function setupDefaults()
    {
        $defaults = (isset($this->config['defaults'])) ?
            $this->config['defaults'] :
            [];

        foreach ($defaults as $key => $value) {
            if ($key == 'images') {
                if (empty($this->images)) {
                    $this->images = $value;
                }
            } elseif ($key == 'url' && $value === null) {
                $this->setUrl(app('url')->current());
            } elseif (! empty($value) && ! array_key_exists($key, $this->properties)) {
                $this->addProperty($key, $value);
            }
        }
    }

    /**
     * Add or update property.
     *
     * @param string       $key   key of property
     * @param string|array $value value of property
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
     * @param array $attributes opengraph article attributes
     *
     * @return OpenGraphContract
     */
    public function setArticle($attributes = [])
    {
        $validkeys = [
            'published_time',
            'modified_time',
            'expiration_time',
            'author',
            'section',
            'tag',
        ];

        $this->setProperties(
            'article',
            'articleProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set profile properties.
     *
     * @param array $attributes opengraph profile attributes
     *
     * @return OpenGraphContract
     */
    public function setProfile($attributes = [])
    {
        $validkeys = [
            'first_name',
            'last_name',
            'username',
            'gender',
        ];

        $this->setProperties(
            'profile',
            'profileProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set book properties.
     *
     * @param array $attributes opengraph book attributes
     *
     * @return OpenGraphContract
     */
    public function setBook($attributes = [])
    {
        $validkeys = [
            'author',
            'isbn',
            'release_date',
            'tag',
        ];

        $this->setProperties('book', 'bookProperties', $attributes, $validkeys);

        return $this;
    }

    /**
     * Set music song properties.
     *
     * @param array $attributes opengraph music.song attributes
     *
     * @return OpenGraphContract
     */
    public function setMusicSong($attributes = [])
    {
        $validkeys = [
            'duration',
            'album',
            'album:disc',
            'album:track',
            'musician',
        ];

        $this->setProperties(
            'music.song',
            'musicSongProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set music album properties.
     *
     * @param array $attributes opengraph music.album attributes
     *
     * @return OpenGraphContract
     */
    public function setMusicAlbum($attributes = [])
    {
        $validkeys = [
            'song',
            'song:disc',
            'song:track',
            'musician',
            'release_date',
        ];

        $this->setProperties(
            'music.album',
            'musicAlbumProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set music playlist properties.
     *
     * @param array $attributes opengraph music.playlist attributes
     *
     * @return OpenGraphContract
     */
    public function setMusicPlaylist($attributes = [])
    {
        $validkeys = [
            'song',
            'song:disc',
            'song:track',
            'creator',
        ];

        $this->setProperties(
            'music.playlist',
            'musicPlaylistProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set music radio station properties.
     *
     * @param array $attributes opengraph music.radio_station attributes
     *
     * @return OpenGraphContract
     */
    public function setMusicRadioStation($attributes = [])
    {
        $validkeys = [
            'creator',
        ];

        $this->setProperties(
            'music.radio_station',
            'musicRadioStationProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set video movie properties.
     *
     * @param array $attributes opengraph video.movie attributes
     *
     * @return OpenGraphContract
     */
    public function setVideoMovie($attributes = [])
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag',
        ];

        $this->setProperties(
            'video.movie',
            'videoMovieProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set video episode properties.
     *
     * @param array $attributes opengraph video.episode attributes
     *
     * @return OpenGraphContract
     */
    public function setVideoEpisode($attributes = [])
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag',
            'series',
        ];

        $this->setProperties(
            'video.episode',
            'videoEpisodeProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set video episode properties.
     *
     * @param array $attributes opengraph video.other attributes
     *
     * @return OpenGraphContract
     */
    public function setVideoOther($attributes = [])
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag',
        ];

        $this->setProperties(
            'video.other',
            'videoOtherProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Set video episode properties.
     *
     * @param array $attributes opengraph video.tv_show attributes
     *
     * @return OpenGraphContract
     */
    public function setVideoTVShow($attributes = [])
    {
        $validkeys = [
            'actor',
            'actor:role',
            'director',
            'writer',
            'duration',
            'release_date',
            'tag',
        ];

        $this->setProperties(
            'video.tv_show',
            'videoTVShowProperties',
            $attributes,
            $validkeys
        );

        return $this;
    }

    /**
     * Add video properties.
     *
     * @param string $source     url of video source
     * @param array  $attributes opengraph video attributes
     *
     * @return OpenGraphContract
     */
    public function addVideo($source = null, $attributes = [])
    {
        $validKeys = [
            'url',
            'secure_url',
            'type',
            'width',
            'height',
        ];

        $this->videoProperties[] = [
            $source,
            $this->cleanProperties($attributes, $validKeys),
        ];

        return $this;
    }

    /**
     * Add audio properties.
     *
     * @param string $source     url for audio source
     * @param array  $attributes opengraph audio attributes
     *
     * @return OpenGraphContract
     */
    public function addAudio($source = null, $attributes = [])
    {
        $validKeys = [
            'url',
            'secure_url',
            'type',
        ];

        $this->audioProperties[] = [
            $source,
            $this->cleanProperties($attributes, $validKeys),
        ];

        return $this;
    }

    /**
     * Clean invalid properties.
     *
     * @param array $attributes attributes input
     * @param array $validKeys  keys that are allowed
     *
     * @return array
     */
    protected function cleanProperties($attributes = [], $validKeys = [])
    {
        $array = [];

        foreach ($attributes as $attribute => $value) {
            if (in_array($attribute, $validKeys)) {
                $array[$attribute] = $value;
            }
        }

        return $array;
    }

    /**
     * Set properties.
     *
     * @param string $type       type of og:type
     * @param string $key        variable key
     * @param array  $attributes inputted opengraph attributes
     * @param array  $validKeys  valid opengraph attributes
     *
     * @return void
     */
    protected function setProperties(
        $type = null,
        $key = null,
        $attributes = [],
        $validKeys = []
    ) {
        if (isset($this->properties['type']) && $this->properties['type'] == $type) {
            foreach ($attributes as $attribute => $value) {
                if (in_array($attribute, $validKeys)) {
                    $this->{$key}[$attribute] = $value;
                }
            }
        }
    }

    /**
     * Remove property.
     *
     * @param string $key key
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
     * @param mixed $source     URL of image source
     * @param array $attributes Object type attributes
     *
     * @return OpenGraphContract
     */
    public function addImage($source = null, $attributes = [])
    {
        $validKeys = [
            'url',
            'secure_url',
            'type',
            'width',
            'height',
        ];

        if (is_array($source)) {
            $this->images[] = $this->cleanProperties($source, $validKeys);
        } else {
            $this->images[] = [
                $source,
                $this->cleanProperties($attributes, $validKeys),
            ];
        }

        return $this;
    }

    /**
     * Add images to properties.
     *
     * @param array $urls array of image urls
     *
     * @return OpenGraphContract
     */
    public function addImages(array $urls)
    {
        array_push($this->images, $urls);

        return $this;
    }

    /**
     * Define type property.
     *
     * @param string $type set the opengraph type
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
     * @param string $title set the opengraph title
     *
     * @return OpenGraphContract
     */
    public function setTitle($title = null)
    {
        return $this->addProperty('title', $title);
    }

    /**
     * Define description property.
     *
     * @param string $description set the opengraph description
     *
     * @return OpenGraphContract
     */
    public function setDescription($description = null)
    {
        return $this->addProperty('description', $description);
    }

    /**
     * Define url property.
     *
     * @param string $url set the opengraph url
     *
     * @return OpenGraphContract
     */
    public function setUrl($url)
    {
        return $this->addProperty('url', $url);
    }

    /**
     * Define site_name property.
     *
     * @param string $name set the site_name
     *
     * @return OpenGraphContract
     */
    public function setSiteName($name)
    {
        return $this->addProperty('site_name', $name);
    }
}
