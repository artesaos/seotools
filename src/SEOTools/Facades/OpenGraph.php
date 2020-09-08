<?php

namespace Apility\SEOTools\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * OpenGraph is a facade for the `OpenGraph` implementation access.
 *
 * @see \Apility\SEOTools\Contracts\OpenGraph
 *
 * @method static string generate(bool $minify = false)
 * @method static \Apility\SEOTools\Contracts\OpenGraph addProperty(string $key, array|string $value)
 * @method static \Apility\SEOTools\Contracts\OpenGraph removeProperty(string $key)
 * @method static \Apility\SEOTools\Contracts\OpenGraph addImage(string $url, array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph addImages(array $urls)
 * @method static \Apility\SEOTools\Contracts\OpenGraph setTitle(string $title)
 * @method static \Apility\SEOTools\Contracts\OpenGraph setDescription(string $description)
 * @method static \Apility\SEOTools\Contracts\OpenGraph setUrl(string $url)
 * @method static \Apility\SEOTools\Contracts\OpenGraph setSiteName(string $name)
 * @method static \Apility\SEOTools\Contracts\OpenGraph setType(string|null $type = null)
 * @method static \Apility\SEOTools\Contracts\OpenGraph setArticle(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setProfile(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setMusicSong(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setMusicAlbum(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setMusicPlaylist(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setMusicRadioStation(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setVideoMovie(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setVideoEpisode(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setVideoOther(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setVideoTVShow(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph setBook(array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph addVideo(string|null $source = null, array $attributes = [])
 * @method static \Apility\SEOTools\Contracts\OpenGraph addAudio(string|null $source = null, array $attributes = [])
 */
class OpenGraph extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'seotools.opengraph';
    }
}
