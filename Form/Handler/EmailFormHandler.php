<?php

namespace Lexik\Bundle\MailerBundle\Form\Handler;

use Lexik\Bundle\MailerBundle\Entity\BaseEmail;
use Lexik\Bundle\MailerBundle\Form\Model\EntityTranslationModel;
use Lexik\Bundle\MailerBundle\Model\EmailManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Cédric Girard <c.girard@lexik.fr>
 */
class EmailFormHandler implements FormHandlerInterface
{
    /**
     * @var \Symfony\Component\Form\FormFactoryInterface
     */
    private $factory;

    /**
     * @var EmailManagerInterface
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
     * @param FormFactoryInterface  $factory
     * @param EmailManagerInterface $manager
     * @param string                $defaultLocale
     */
    public function __construct(FormFactoryInterface $factory, EmailManagerInterface $manager, $defaultLocale)
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
     * @param BaseEmail $email
     * @param string    $lang
     * @return FormInterface
     */
    public function createForm($email = null, $lang = null)
    {
        $edit = ($email !== null);
        $this->locale = $lang ? : $this->defaultLocale;

        if ($edit) {
            $translation = $email->getTranslation($this->locale);
            if ($translation === null) {
                $translation = $this->manager->createEmailTranslation($email, $this->locale);
                $translation->setEmail($email);
            }
        } else {
            $email = $this->manager->createEmail();
            $translation = $this->manager->createEmailTranslation($email, $this->defaultLocale);
            $translation->setEmail($email);
        }

        $model = new EntityTranslationModel($email, $translation);

        return $this->factory->create('mailer_email', $model, array(
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
