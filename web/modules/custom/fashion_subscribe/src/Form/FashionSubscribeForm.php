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
         $valueEmail = $form_state->getValue('email');
//         this is storedValue with state submit example
//         $storedValue = \Drupal::state()->get($valueEmail);

//        this is storedValue with example saving data  in config which we made in submitForm()   -fashion_subscribe.settings
          $storedValue= \Drupal::configFactory()->getEditable('fashion_subscribe.settings')->get($form_state->getValue('email'));
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
//         $a=1;
//         test to get current user id
//        $user = User::load(\Drupal::currentUser()->id());

//       $stateEmail= \Drupal::state()->get('email');
//        $email = $form_state->getUserInput()['email'];

        $node = \Drupal::routeMatch()->getParameter('node');
//
        $userState = [
            'nid' => $node->id(),
            'created' => time(),

        ];
//        saving data  in state example
//        $state = \Drupal::state();
////                    this 'email' is unique key for set state od user
///      $users = $state->get('users');
///      $users[$form_state->getValue('email')]
///      $users[] = [$form_state->getValue('email') =>$userState]
//       $state->set('user', $users);
//       end saving data  in state


//        saving data  in config
        $values = $form_state->getValues();
        \Drupal::configFactory()->getEditable('fashion_subscribe.settings')
            ->set($form_state->getValue('email'), $userState)
            ->save();

//        $this->config('fashion_subscribe.settings')








//        example with Ajax
//        $response = new AjaxResponse();
//        $response->addCommand(new ReplaceCommand('.subscribe-form', 'Thank you for subscribing to our newsletter'));
//        return  $response;
//         $state->get($form_state->getValue('email'));
//        $form_state->setRedirect('<front>');
//        ;
//        $node_v2 = \Drupal::routeMatch()->getParameters()->get('node')

    }


}