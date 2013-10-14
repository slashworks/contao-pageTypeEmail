<?php

/**
 * pageTypeEmail extension for Contao Open Source CMS
 *
 * @package pageTypeEmail
 * @author Joe Ray Gregory joe@slash-works.de
 * @copyright 2013 Joe Ray Gregory
 * @link    https://slash-works.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

namespace slashworks;

/**
 * Class PageEmail
 * @package pageTypeEmail
 * @author Joe Ray Gregory joe@slash-works.de
 */

class PageEmail extends \Frontend {

    private $mailtoQuery;

    /**
     * Open the email client
     * @param object
     */
    public function generate($objPage)
    {
        $this->mailtoQuery = 'mailto:'.$objPage->mailto;

        $this->mailtoQuery .= $this->addSubject($objPage);
        $this->mailtoQuery .= $this->addBody($objPage);

        header('HTTP/1.1 301 Moved Permanently');
        header('Location: ' . $this->mailtoQuery);

        exit;
    }

    /**
     * Add the subject if exists
     * @param $objPage
     * @return bool|string
     */

    private function addSubject($objPage)
    {
        if(!$objPage->subject)
            return false;

        return $this->addGetParam('subject') . rawurlencode($objPage->subject);

    }

    /**
     * Add the body if exists
     * @param $objPage
     * @return bool|string
     */

    private function addBody($objPage)
    {
        if(!$objPage->mailbody)
            return false;

        return $this->addGetParam('body') . rawurlencode($objPage->mailbody);

    }

    /**
     * Little helper method to check to set a "?" or and "&" to the query string
     * @param $key
     * @return string
     */

    private function addGetParam($key)
    {
        return (parse_url($this->mailtoQuery, PHP_URL_QUERY)) ? '&'.$key.'=': '?'.$key.'=';
    }

}