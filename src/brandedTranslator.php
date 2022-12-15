<?php

namespace LostInTranslation;

use Illuminate\Contracts\Translation\Loader;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator as BaseTranslator;
use LostInTranslation\Exceptions\MissingTranslationException;
use Psr\Log\LoggerInterface;

class brandedTranslator extends BaseTranslator
{
    private ?array $commonTranslationsTranslated = null;

    /**
     * Create a new translator instance.
     *
     * @param \Illuminate\Contracts\Translation\Loader $loader
     * @param string $locale
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return void
     */
    public function __construct(Loader $loader, string $locale)
    {
        parent::__construct($loader, $locale);

        $this->loader = new FileLoader(new Filesystem(), config('lostintranslation.translation_brand_path'));
    }


    /**
     * Get the translation for the given key.
     *
     * This method acts as a pass-through to Illuminate\Translation\Translator::get(), but verifies
     * that a replacement has actually been made.
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @param bool $fallback
     *
     * @return string|array|null
     * @throws MissingTranslationException When no replacement is made.
     *
     */
    public function getWithCommon($key, array $replace = [], array $with = [], $locale = null, $fallback = true)
    {
        $replace = $this->addCommonAttributes($replace, $with);

        $translation = parent::get($key, $replace, $locale, $fallback);

        return $translation;
    }

    protected function addCommonAttributes(array $replace, array $with): array
    {
        if (is_array($with)) {
            foreach ($with as $attribute => $translated) {
                $replace[$attribute] = $translated;
            }
        }

        return $replace;
    }
}
