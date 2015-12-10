<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class HacksawTwigExtension extends Twig_Extension
{
    public function getName()
    {
        return 'Hacksaw';
    }

    public function getFilters()
    {
        return array(
            'hacksaw' => new Twig_Filter_Method( $this, 'HacksawFilter',
                array(
                    'is_safe' => array('html')
                )
            )
        );
    }

    public function HacksawFilter( $content, $chars_start='0', $chars='', $words='', $cutoff='', $append='', $allow='' )
    {

        if(isset($cutoff) && $cutoff != "") {

            $cutoff_content = $this->_truncate_cutoff($content, $cutoff, $words, $allow, $append);

            // Strip the HTML
            $new_content = (mb_strpos($content, $cutoff) ? strip_tags($cutoff_content, $allow) : strip_tags($cutoff_content, $allow));

        } elseif (isset($chars) && $chars != "") {

            // Strip the HTML
            $stripped_content = strip_tags($content, $allow);

            $new_content = (mb_strlen($stripped_content) <= $chars ? $stripped_content : $this->_truncate_chars($stripped_content, $chars_start, $chars, $append));

        } elseif (isset($words) && $words != "") {

            // Strip the HTML
            $stripped_content = strip_tags($content, $allow);

            $new_content = (str_word_count($stripped_content) <= $words ? $stripped_content : $this->_truncate_words($stripped_content, $words, $append));

        } else {

            // Strip the HTML
            $stripped_content = strip_tags($content, $allow);

            $new_content = $stripped_content;

        }

        // Return the new content
        return $this->_close_tags($new_content);
    }

    // Helper Function - Truncate by Word Limit
    function _truncate_words($content, $limit, $append) {

        $num_words = str_word_count($content, 0);

        if ($num_words > $limit) {

            $words = preg_split('/\s+/', $content);

            $content = implode(' ', array_slice($words, 0, $limit));

            if (preg_match("/[0-9.!?,;:]$/", $content)) {
                $content = mb_substr($content, 0, -1);
            }

            $content .= $append;
        }

        return $content;

    }

    // Helper Function - Truncate by Character Limit
    function _truncate_chars($content, $chars_start, $limit, $append) {

        // Removing the below to see how it effect UTF-8.
        $content = preg_replace('/\s+?(\S+)?$/', '', mb_substr($content, $chars_start, ($limit+1))) . $append;

        return $content;

    }

    // Helper Function - Truncate by Cutoff Marker
    function _truncate_cutoff($content, $cutoff, $words, $allow, $append) {

        $pos = mb_strpos($content, $cutoff);

        if ($pos != FALSE) {

            $content = mb_substr($content, 0, $pos) . $append;

        } elseif ($words != "") {

            $content = $this->_truncate_words(strip_tags($content, $allow), $words, '') . $append;
        }

        return $content;

    }

    function _close_tags($content) {

        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $content, $result);

        $openedtags = $result[1];

        preg_match_all('#</([a-z]+)>#iU', $content, $result);

        $closedtags = $result[1];

        $len_opened = count($openedtags);

        if (count($closedtags) == $len_opened) {

            return $content;

        }

        $openedtags = array_reverse($openedtags);

        for ($i=0; $i < $len_opened; $i++) {

            if (!in_array($openedtags[$i], $closedtags)) {

                $content .= '</'.$openedtags[$i].'>';

            } else {

                unset($closedtags[array_search($openedtags[$i], $closedtags)]);

            }

        }

        return $content;

    }

}