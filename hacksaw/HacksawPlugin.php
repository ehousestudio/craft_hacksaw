<?php
namespace Craft;

class HacksawPlugin extends BasePlugin
{
    public function getName()
    {
         return Craft::t('Hacksaw');
    }

    public function getVersion()
    {
        return '1.1.2';
    }

    public function getDeveloper()
    {
        return 'eHouse Studio';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.ehousestudio.com';
    }

    public function getPluginUrl()
    {
        return 'https://github.com/ehousestudio/craft_hacksaw';
    }

    public function getDocumentationUrl()
    {
        return $this->getPluginUrl() . '/blob/master/README.md';
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.hacksaw.twigextensions.HacksawTwigExtension');

        return new HacksawTwigExtension();
    }
}
