<?php

namespace Artesaos\SEOTools\Contracts;

interface OpenGraph
{
    /**
     * @param array $config
     * @return void
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
     * @return static
     */
    public function addProperty($key, $value);

    /**
     * Remove property.
     *
     * @param string $key
     *
     * @return static
     */
    public function removeProperty($key);

    /**
     * Add image to properties.
     *
     * @param string $url
     * @param array  $attributes
     *
     * @return static
     */
    public function addImage($url, $attributes = []);

    /**
     * Add images to properties.
     *
     * @param array $urls
     *
     * @return static
     */
    public function addImages(array $urls);

    /**
     * Define title property.
     *
     * @param string $title
     *
     * @return static
     */
    public function setTitle($title);

    /**
     * Define description property.
     *
     * @param string $description
     *
     * @return static
     */
    public function setDescription($description);

    /**
     * Define url property.
     *
     * @param string $url
     *
     * @return static
     */
    public function setUrl($url);

    /**
     * Define site_name property.
     *
     * @param string $name
     *
     * @return static
     */
    public function setSiteName($name);

    /**
     * Define type property.
     *
     * @param string|null $type set the opengraph type
     *
     * @return static
     */
    public function setType($type = null);

    /**
     * Set Article properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setArticle($attributes = []);

    /**
     * Set Profile properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setProfile($attributes = []);

    /**
     * Set Music Song properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setMusicSong($attributes = []);

    /**
     * Set Music Album properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setMusicAlbum($attributes = []);

    /**
     * Set Music Playlist properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setMusicPlaylist($attributes = []);

    /**
     * Set Music  RadioStation properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setMusicRadioStation($attributes = []);

    /**
     * Set Video Movie properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setVideoMovie($attributes = []);

    /**
     * Set Video Episode properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setVideoEpisode($attributes = []);

    /**
     * Set Video Episode properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setVideoOther($attributes = []);

    /**
     * Set Video Episode properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setVideoTVShow($attributes = []);

    /**
     * Set Book properties.
     *
     * @param array $attributes
     *
     * @return static
     */
    public function setBook($attributes = []);

    /**
     * Add Video properties.
     *
     * @param string $source
     * @param array  $attributes
     *
     * @return static
     */
    public function addVideo($source = null, $attributes = []);

    /**
     * Add audio properties.
     *
     * @param string $source
     * @param array  $attributes
     *
     * @return static
     */
    public function addAudio($source = null, $attributes = []);
}
