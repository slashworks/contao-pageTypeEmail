<?php

/**
 * pageTypeEmail extension for Contao Open Source CMS
 *
 * Copyright (c) 2013 Joe Ray Gregory
 *
 * @package pageTypeEmail
 * @link    https://slash-works.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * overwrite the current callback
 */

$GLOBALS['TL_DCA']['tl_page']['list']['label']['label_callback'] = array('tl_page_email', 'addIconSwitch');

/**
 * Adding a new palette
 */

$GLOBALS['TL_DCA']['tl_page']['palettes']['email'] = '
    {title_legend}
        ,title
        ,type;
    {email_legend}
        ,mailto
        ,subject
        ,mailbody;
    {expert_legend:hide}
        ,cssClass;
    {publish_legend}
        ,published
        ,start
        ,stop;
';

/**
 * prepare new fields
 */

$pageEmailFields = array
(
    'mailto' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_page']['mailto'],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('maxlength'=>255, 'rgxp'=>'friendly', 'decodeEntities'=>true, 'tl_class'=>'w50', 'mandatory'=>true),
        'sql'                     => "varchar(255) NOT NULL default ''"
    ),

    'subject' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_page']['subject'],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => array('decodeEntities'=>true, 'tl_class'=>'clr long'),
        'sql'                     => "varchar(32) NOT NULL default ''"
    ),

    'mailbody' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_page']['mailbody'],
        'exclude'                 => true,
        'inputType'               => 'textarea',
        'search'                  => true,
        'eval'                    => array('style'=>'height:60px', 'decodeEntities'=>true, 'tl_class'=>'clr'),
        'sql'                     => "text NULL"
    )

);

/**
 * merge the new fields to the old ones
 */

$GLOBALS['TL_DCA']['tl_page']['fields'] = array_merge($GLOBALS['TL_DCA']['tl_page']['fields'], $pageEmailFields);


/**
 * Class tl_page_email
 */

class tl_page_email extends tl_page
{

    /**
     * add own icons without loading them from the theme folder
     * @param $row
     * @param $label
     * @param DataContainer $dc
     * @param string $imageAttribute
     * @param bool $blnReturnImage
     * @param bool $blnProtected
     * @return string
     */

    public function addIconSwitch($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false)
    {
        if($row['type'] !== 'email')
            return $this->addIcon($row, $label, $dc, $imageAttribute,$blnReturnImage,$blnProtected);

        $isPublished = ($row['published']) ? 'published': 'unpublished';

        $icon = \Contao\Image::getHtml('system/modules/pageTypeEmail/assets/icons/email_'.$isPublished.'.gif', false, false);

        return $icon . '<span style="padding-left: 7px;">' . $label . '</span>';
    }
}