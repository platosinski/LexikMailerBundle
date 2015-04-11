<?php

namespace Lexik\Bundle\MailerBundle\Model;

/**
 * Class LayoutManager
 * @package Lexik\Bundle\MailerBundle\Model
 */
abstract class LayoutManager implements LayoutManagerInterface
{
    /**
     * @return BaseLayout
     */
    public function createLayout()
    {
        $class = $this->getLayoutClass();
        $layout = new $class;

        return $layout;
    }

    /**
     * @param BaseLayout $layout
     * @param string    $lang
     *
     * @return BaseLayoutTranslation
     */
    public function createLayoutTranslation(BaseLayout $layout, $lang = null)
    {
        $class = $this->getLayoutTranslationClass();
        /** @var BaseLayoutTranslation $translation */
        $translation = new $class($lang);
        $translation->setLayout($layout);

        return $translation;
    }
}
