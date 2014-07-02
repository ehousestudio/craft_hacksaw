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
        return 'Ryan Shrum';
    }

    function getDeveloperUrl()
    {
        return 'http://www.ryanshrum.com';
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