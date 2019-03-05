<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe\Form\FashionSubscribeForm
 */
namespace Drupal\fashion_subscribe\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an Subscribe Email Form form.
 */
 class FashionSubscribeForm extends FormBase {
    /**
     * (@inheritdoc)
     */
    public function getFormId() {
        return 'fashion_subscribe_form';
    }

    /**
     * (@inheritdoc)
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
//        test to get node id
//        $node = \Drupal::routeMatch()->getParameter('node');
//        $nid = $node->nid->value;
//        $getEmailValue=$form_state->getUserInput()['email'];
        $form['#attached']['library'][] = 'fashion_subscribe/subscribe_block';

        $form['#attributes']['class'] = [];
        $form['#prefix']='<div class="subscribe-form">';
        $form['#suffix'] = '</div>';
        $form['email'] = [
            '#title' => t("SUBSCRIBE TO OUR NEWSLETTER"),
            '#type' => 'email',

            '#attributes' => [
                'placeholder' => t("Your e-mail."),
                'class'=> "",
                'id'=> 'subscribe-input'
                ],

            ];
        $form['actions'] = ['#type' => 'actions'];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('OK'),
            '#button_type' => 'primary',
            '#attributes' => [
                'id'=> 'subscribe-submit',
            ],
        ];
//        $form['nid'] = [
//            '#type' => 'hidden',
//            '#value' => $nid,
//        ];

        return $form;
    }

     /**
      * Validate the email of the form
      *
      * @param array $form
      * @param \Drupal\Core\Form\FormStateInterface $form_state
      *
      */
     public function validateForm(array &$form, FormStateInterface $form_state) {
         $valueEmail = $form_state->getValue('email');
//        this is storedValue with example saving data  in config which we made in submitForm()   -fashion_subscribe.settings
          $storedValue= \Drupal::configFactory()->getEditable('fashion_subscribe.settings')->get($form_state->getValue('email'));


         if ( !filter_var( $valueEmail, FILTER_VALIDATE_EMAIL)) {
             $form_state->setErrorByName('email', t('The email address %mail is not valid.', array('%mail' =>
                 $valueEmail)));
         }
         if ($storedValue['com']) {
             $form_state->setErrorByName('email', t('%mail email address is already subscribed.', array('%mail' =>
                 $valueEmail)));
         }


     }

    /**
     * (@inheritdoc)
     */

    public function submitForm(array &$form, FormStateInterface $form_state) {
//        for debug
//         $a=1;
//         test to get current user id
//        $user = User::load(\Drupal::currentUser()->id());

        $node = \Drupal::routeMatch()->getParameter('node');
//
        $userState = [
            'nid' => $node->id(),
            'created' => time(),

        ];
//        saving data  in config
        $values = $form_state->getValues();
        \Drupal::configFactory()->getEditable('fashion_subscribe.settings')
            ->set( str_replace('.', '_',$form_state->getValue('email')), $userState)
            ->save();

//        $this->config('fashion_subscribe.settings')
//        see list of config in brakpoint
//     \Drupal::configFactory()->getEditable('fashion_subscribe.settings')->get()


    }


}