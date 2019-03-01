<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe\Form\FashionSubscribeForm
 */
namespace Drupal\fashion_subscribe\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
//use Drupal\Core\Render\Element\Ajax;

//use Drupal\user\Entity\User;
//use Drupal\Core\Ajax\AjaxResponse;
//use Drupal\Core\Ajax\HtmlCommand;
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
//            '#ajax' => [
//                'callback' => '::setMessage',
//            ],
        ];
//        $form['nid'] = [
//            '#type' => 'hidden',
//            '#value' => $nid,
//        ];

        return $form;
    }


     /**
      *
      */
//     public function setMessage(array $form, FormStateInterface $form_state) {
//
//         $response = new AjaxResponse();
//         $response->addCommand(
//             new HtmlCommand(
//                 '.result_message',
//                 '<div class="my_top_message">' . t('You are subscribed with @result', ['@result' => ($form_state->getValue('email') . '</div>'),
//    );
//         return $response;
//
//     }


     /**
      * Validate the email of the form
      *
      * @param array $form
      * @param \Drupal\Core\Form\FormStateInterface $form_state
      *
      */
     public function validateForm(array &$form, FormStateInterface $form_state) {
//         parent::validateForm($form, $form_state);
         $valueEmail = $form_state->getValue('email');
         $storedValue = \Drupal::state()->get($valueEmail);
//         if ($valueEmail == "") {
//             $form_state->setErrorByName('email', t('Please enter you email address.'));
//         }
         if ( !filter_var( $valueEmail, FILTER_VALIDATE_EMAIL)) {
             $form_state->setErrorByName('email', t('The email address %mail is not valid.', array('%mail' =>
                 $valueEmail)));
         }
         if ($storedValue) {
             $form_state->setErrorByName('email', t('%mail email address is already subscribed.', array('%mail' =>
                 $valueEmail)));
         }
//         if (empty($valueEmail) ) {
//             $form_state->setErrorByName('email', t('Please enter your email to subscribe.'));
//         }



     }

    /**
     * (@inheritdoc)
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
//        for debug
//   $a=1;
//         test to get current user id
//        $user = User::load(\Drupal::currentUser()->id());
        $state = \Drupal::state();
//       $stateEmail= \Drupal::state()->get('email');
//        $email = $form_state->getUserInput()['email'];

        $node = \Drupal::routeMatch()->getParameter('node');
//
        $userState = [
            'nid' => $node->id(),
            'created' => time(),

        ];

//                    this 'email' is unique key for set state od user
      $state->set($form_state->getValue('email'), $userState);


//        $response = new AjaxResponse();
//        $response->addCommand(new ReplaceCommand('.subscribe-form', 'Thank you for subscribing to our newsletter'));
//        return  $response;
//         $state->get($form_state->getValue('email'));
//        $form_state->setRedirect('<front>');
//        ;
//        $node_v2 = \Drupal::routeMatch()->getParameters()->get('node')

    }


}