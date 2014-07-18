<?php
namespace Craft;

class HacksawPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Hacksaw');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'eHouse Studio';
    }

    function getDeveloperUrl()
    {
        return 'http://www.ehousestudio.com';
    }

	/**
	 * Register twig extension
	 */
    public function addTwigExtension()
    {
        Craft::import('plugins.hacksaw.twigextensions.HacksawTwigExtension');

        return new HacksawTwigExtension();
    }
}