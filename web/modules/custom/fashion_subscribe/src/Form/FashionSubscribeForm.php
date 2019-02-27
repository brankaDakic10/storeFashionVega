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
        $form['#attributes']['class'] []= [];
        $form['#prefix']='<div class="subscribe-form">';
        $form['#suffix'] = '</div>';
        $form['email'] = [
            '#title' => t("SUBSCRIBE TO OUR NEWSLETTER"),
            '#type' => 'email',
            '#attributes' => [
                'placeholder' => t("Your e-mail."),
//                'class'=> "",
                'id'=> 'subscribe-input'
                ],
//
//                 '#prefix'=>'<label for="subscribe-input">',
//                  '#suffix'=>'</label>'
            ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => t('OK'),
            ];
//        $form['submit']['#attributes']['class'] = "";
        return $form;
    }


    /**
     * (@inheritdoc)
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
//        for debug
//       $a=1;
    }


}