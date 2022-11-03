<?php
/**
 * Configuration for the Lost In Translation package.
 */

return [

    /**
     * Log instances of missing translations?
     */
    'log' => env('TRANS_LOG_MISSING', true),

    /**
     * Throw exceptions when an untranslated string is found?
     *
     * When true, MissingTranslationException exceptions will be thrown when a string is unable to
     * be translated.
     */
    'throw_exceptions' => env('TRANS_ERROR_ON_MISSING', false),

    'translation_brand_path' => env('TRANS_BRAND_PATH', null),

    'log_file' => env('TRANS_LOG_FILE', null),

    /*
    |--------------------------------------------------------------------------
    | Common translations
    |--------------------------------------------------------------------------
    |
    | Sometimes there might be a lot of common attributes that need to be translated in the same way.
    | For example in the case of whitelabeling, the brand name appears in many strings but need to be changed.
    | This can be realized by filling the common_translations array with the attribute name and the key of the translation
    | Ie
    | 'common_translations' => [
    |    'xxx' => 'service/branding.name' // = "FakePost"
    | ]
    | Will translate the string 'My service name is :xxx'
    | into "My service name is FakePost
    | So when you want to change the brandname, you only have to change the content of the translation of 'service/branding.name'
    | and all strings with :xxx will have the new brandname
    |
    */
    'common_translations' => [
        'xxx' => 'service/branding.name'
    ]
];
