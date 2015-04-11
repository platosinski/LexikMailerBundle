<?php

namespace Lexik\Bundle\MailerBundle\Form\Handler;

use Doctrine\ORM\EntityManager;

use Lexik\Bundle\MailerBundle\Entity\BaseLayout;
use Lexik\Bundle\MailerBundle\Entity\Layout;
use Lexik\Bundle\MailerBundle\Entity\LayoutTranslation;
use Lexik\Bundle\MailerBundle\Form\Model\EntityTranslationModel;
use Lexik\Bundle\MailerBundle\Model\LayoutManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class LayoutFormHandler implements FormHandlerInterface
{
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $factory;

    /**
     * @var LayoutManagerInterface
     */
    private $manager;

    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var string
     */
    private $locale;

    /**
     * @param FormFactoryInterface   $factory
     * @param LayoutManagerInterface $manager
     * @param string                 $defaultLocale
     */
    public function __construct(FormFactoryInterface $factory, LayoutManagerInterface $manager, $defaultLocale)
    {
        $this->factory = $factory;
        $this->manager = $manager;
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param BaseLayout $layout
     * @param string     $lang
     * @return FormInterface
     */
    public function createForm($layout = null, $lang = null)
    {
        $edit = ($layout !== null);
        $this->locale = $lang ? : $this->defaultLocale;

        if ($edit) {
            $translation = $layout->getTranslation($this->locale);
            if ($translation === null) {
                $translation = $this->manager->createLayoutTranslation($layout, $this->locale);
            }
        } else {
            $layout = $this->manager->createLayout();
            $translation = $this->manager->createLayoutTranslation($layout, $this->defaultLocale);
        }

        $model = new EntityTranslationModel($layout, $translation);

        return $this->factory->create('mailer_layout', $model, array(
            'data_translation' => $translation,
            'edit'             => $edit,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function processForm(FormInterface $form, Request $request)
    {
        $valid = false;
        $form->handleRequest($request);

        if ($form->isValid()) {
            $model = $form->getData();
            $model->getEntity()->addTranslation($model->getTranslation());

            $this->manager->save($model->getEntity());

            $valid = true;
        }

        return $valid;
    }
}
