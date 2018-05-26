<?php


namespace backend\modules\settings;

use Aabc;

/**
 * @author Aris Karageorgos <aris@phe.me>
 */
class Module extends \aabc\base\Module
{
    /**
     * @var string The controller namespace to use
     */
    public $controllerNamespace = 'backend\modules\settings\controllers';

    /**
     *
     * @var string source language for translation
     */
    public $sourceLanguage = 'en-US';

    /**
     * @var null|array The roles which have access to module controllers, eg. ['admin']. If set to `null`, there is no accessFilter applied
     */
    public $accessRoles = null;

    /**
     * Init module
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    /**
     * Registers the translation files
     */
    protected function registerTranslations()
    {
        Aabc::$app->i18n->translations['extensions/aabc2-settings/*'] = [
            'class' => 'aabc\i18n\PhpMessageSource',
            'sourceLanguage' => $this->sourceLanguage,
            // 'basePath' => '@vendor/pheme/aabc2-settings/messages',
            'fileMap' => [
                'extensions/aabc2-settings/settings' => 'settings.php',
            ],
        ];
    }

    /**
     * Translates a message. This is just a wrapper of Aabc::t
     *
     * @see Aabc::t
     *
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Aabc::t('extensions/aabc2-settings/' . $category, $message, $params, $language);
    }
}
