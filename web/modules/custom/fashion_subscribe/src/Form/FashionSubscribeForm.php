<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe\Form\FashionSubscribeForm
 */
namespace Drupal\fashion_subscribe\Form;

use Drupal\Core\Database\Database;
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
//
//                 '#prefix'=>'<label for="subscribe-input">',
//                  '#suffix'=>'</label>'
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

//        $form['submit']['#attributes']['class'] = '';


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
         parent::validateForm($form, $form_state);
         $valueEmail = $form_state->getValue('email');
         if($valueEmail == !\Drupal::service('email.validator')->isValid($valueEmail)) {
             $form_state->setErrorByName('email', t('The email address %mail is not valid.', array('%mail' =>
                 $valueEmail)));
         }
     }

    /**
     * (@inheritdoc)
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
//        for debug
//    $a=1;
//         test to get current user id
//        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
    }


}