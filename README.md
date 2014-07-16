#Hacksaw

A migrated (and improved) version (for [Craft CMS](http://buildwithcraft.com/)) of Brett DeWoody's Hacksaw for ExpressionEngine. This plugin adds a [Twig](http://twig.sensiolabs.org/) filter to take your entry's content and whittle it down to a more manageable size. It strips the HTML and limits the excerpts by character count, word count or cutoff marker.

## Installation

1. Move `hacksaw` directory to `craft/plugins` directory
2. Install **Hacksaw** under **Craft Admin &rsaquo; Settings &rsaquo; Plugins**

## Parameters

There are several parameters you can use to control how the content is truncated. These options are:

| Parameter			| Type		| Default	| Description														|
| -----------------	| :-------:	| :-------:	| -----------------------------------------------------------------	|
| chars 			| int		| `null`	| Limit by number of characters (**Note:** includes chars of HTML)	|
| chars_start		| int		| 0			| Starting point for chars limit (used with chars param)			|
| words				| int		| `null`	| Limit by number of words											|
| cutoff			| string	| `null`	| Limit by a specific cutoff string									|
| append			| string	| `null`	| String to append to the end of the excerpt						|
| allow				| string	| `null`	| HTML tags you want to allow										|

## Usage

For example, if you want to limit your excerpt to 100 words you would do this:

```
{{ entry.richTextField|hacksaw(words="100") }}
```
By default Hacksaw will strip all HTML from your excerpt. If you would like to keep some basic HTML you can use the 'allow' parameter to keep specific HTML tags. For example, let's say you want to keep `<p>` and `<b>` tags:

```
{{ entry.richTextField|hacksaw(words="100", allow="<p><b>") }}
```

Another way to limit content is by a cutoff string. This is similar to the way Wordpress's "more" feature works. In your content you could add a specific string to indicate the spot you want the excerpt to stop. Let's say you use "`<!-- END -->`". To cut the excerpt off at this location you would do this:

```
{{ entry.richTextField|hacksaw(cutoff="<!-- END -->") }}
```

The 'cutoff' parameter can be coupled with the 'words' parameter in case you forget to add the cutoff string to some of your entries. This way the excerpt will be truncated at the cutoff string, OR after X words.

You can add any string at the end of the excerpt using the 'append' parameter, like this:

```
{{ entry.richTextField|hacksaw(words="100", append="...") }}
```

This would append "..." to the end of the excerpt.

## Feedback?

Contact me on Twitter: [@ryanshrum](https://twitter.com/ryanshrum) or [@ehousestudio](https://twitter.com/ehousestudio)