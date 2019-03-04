<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe\Form\FashionSubscribeSecondForm
 */
namespace Drupal\fashion_subscribe\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides an Subscribe Email Form form.
 */
class FashionSubscribeSecondForm extends FormBase {
    /**
     * (@inheritdoc)
     */
    public function getFormId() {
        return 'fashion_subscribe_second_form';
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
        $users = \Drupal::state()->get('users');
        $valueEmail = $form_state->getValue('email');

//         this is storedValue with state submit example
        $storedValue = isset($users[$valueEmail]);

        if ( !filter_var( $valueEmail, FILTER_VALIDATE_EMAIL)) {
            $form_state->setErrorByName('email', t('The email address %mail is not valid.', array('%mail' =>
                $valueEmail)));
        }
        if ($storedValue) {
            $form_state->setErrorByName('email', t('%mail email address is already subscribed.', array('%mail' =>
                $valueEmail)));
        }




    }

    /**
     * (@inheritdoc)
     */

    public function submitForm(array &$form, FormStateInterface $form_state) {

        $node = \Drupal::routeMatch()->getParameter('node');
//
        $userState = [
            'nid' => $node->id(),
            'created' => time(),

        ];
//        saving data  in state example
        $state = \Drupal::state();
////                    this 'email' is unique key for set state od user
//     here is null  $users
        $users = $state->get('users');
//        $users[$form_state->getValue('email')];
        $users[$form_state->getValue('email')] = $userState;
        $state->set('users', $users);
//       end saving data  in state users



//        see all users in state form example use breakpoint
//      \Drupal::state()->get('users')



    }


}