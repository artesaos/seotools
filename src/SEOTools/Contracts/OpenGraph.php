<?php

namespace Artesaos\SEOTools\Contracts;

interface OpenGraph
{
    /**
     * @param array $config
     */
    public function __construct(array $config = []);

    /**
     * Generates open graph tags.
     * 
     * @param bool $minify
     *
     * @return string
     */
    public function generate($minify = false);

    /**
     * Add or update property.
     *
     * @param string       $key
     * @param string|array $value
     *
     * @return OpenGraph
     */
    public function addProperty($key, $value);

    /**
     * Remove property.
     *
     * @param string $key
     *
     * @return OpenGraph
     */
    public function removeProperty($key);

    /**
     * Add image to properties.
     *
     * @param string $url
     * @param array  $attributes
     *
     * @return OpenGraph
     */
    public function addImage($url, $attributes = []);

    /**
     * Add images to properties.
     *
     * @param array $urls
     *
     * @return OpenGraph
     */
    public function addImages(array $urls);

    /**
     * Define title property.
     *
     * @param $title
     *
     * @return OpenGraph
     */
    public function setTitle($title);

    /**
     * Define description property.
     *
     * @param string $description
     *
     * @return OpenGraph
     */
    public function setDescription($description);

    /**
     * Define url property.
     *
     * @param string $url
     *
     * @return OpenGraph
     */
    public function setUrl($url);

    /**
     * Define site_name property.
     *
     * @param string $name
     *
     * @return OpenGraph
     */
    public function setSiteName($name);

    /**
     * Define type property.
     *
     * @param string $name
     *
     * @return OpenGraph
     */
    public function setType($type = null);

    /**
     * Set Article properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setArticle($attributes = []);

    /**
     * Set Profile properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setProfile($attributes = []);

    /**
     * Set Music Song properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setMusicSong($attributes = []);

    /**
     * Set Music Album properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setMusicAlbum($attributes = []);

    /**
     * Set Music Playlist properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setMusicPlaylist($attributes = []);

    /**
     * Set Music  RadioStation properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setMusicRadioStation($attributes = []);

    /**
     * Set Video Movie properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setVideoMovie($attributes = []);

    /**
     * Set Video Episode properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setVideoEpisode($attributes = []);

    /**
     * Set Video Episode properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setVideoOther($attributes = []);

    /**
     * Set Video Episode properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setVideoTVShow($attributes = []);

    /**
     * Set Book properties.
     *
     * @param array $attributes
     *
     * @return OpenGraph
     */
    public function setBook($attributes = []);

    /**
     * add Video properties.
     *
     * @param string $source
     * @param array  $attributes
     *
     * @return OpenGraph
     */
    public function addVideo($source = null, $attributes = []);

    /**
     * add audio properties.
     *
     * @param string $source
     * @param array  $attributes
     *
     * @return OpenGraph
     */
    public function addAudio($source = null, $attributes = []);
}
