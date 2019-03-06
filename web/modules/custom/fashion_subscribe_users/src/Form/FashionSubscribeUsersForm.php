<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe_users\Form\FashionSubscribeUsersForm
 */
namespace Drupal\fashion_subscribe_users\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an Subscribe Users Form form.
 */
class FashionSubscribeUsersForm extends FormBase {
    /**
     * (@inheritdoc)
     */
    public function getFormId()
    {
        return 'fashion_subscribe_users_form';
    }


    /**
     * Form constructor.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The form structure.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {


        $form['nid'] = [
            '#title' => $this
                ->t('NID'),
            '#type' => 'link',
//            '#url' => Url::fromRoute('examples.description'),

        ];

        $form['email'] = [
            '#title' => t('Email Address'),
            '#type' => 'email',

        ];
        $form['created'] = [
            '#type' => 'date',
            '#title' => $this
                ->t('Created'),
        ];
        $form['email_notification'] = [
            '#type' => 'checkbox',
            '#title' => $this
                ->t('Send email to user?')
        ];

        $form['actions'] = ['#type' => 'actions'];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Send'),
            '#button_type' => 'primary',
        ];

        return $form;
    }

    /**
     * Form submission handler.
     *
     * @param array $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.
    }
}