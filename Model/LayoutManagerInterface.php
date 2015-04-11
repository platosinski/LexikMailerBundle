<?php

namespace Lexik\Bundle\MailerBundle\Model;

/**
 * Interface LayoutManagerInterface
 * @package Lexik\Bundle\MailerBundle\Model
 */
interface LayoutManagerInterface
{
    /**
     * @return BaseLayout
     */
    public function createLayout();

    /**
     * @param BaseLayout $layout
     * @param string     $lang
     *
     * @return mixed
     */
    public function createLayoutTranslation(BaseLayout $layout, $lang = null);

    /**
     * @return string
     */
    public function getLayoutClass();

    /**
     * @return string
     */
    public function getLayoutTranslationClass();

    /**
     * @param $layout
     */
    public function save($layout);
}
