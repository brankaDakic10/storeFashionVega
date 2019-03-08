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
class FashionSubscribeUsersForm extends FormBase
{
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
//       header of table
        $header = [
            'id' =>['data' => t('User ID')],
            'nid' => ['data' => t('Node ID')],
            'email' => ['data' => t('Email')],
            'created' => ['data' => t('Created')] ,
            'email_notification' =>['data' => t('Email notification')] ,
        ];
        $rows = [];
//$query  with data results
        $query = \Drupal::database()->select('fashion_subscribe', 'f');
        $query->fields('f', ['id', 'nid', 'mail', 'created', 'email_notification']);
        $results = $query->execute()->fetchAll();
//make rows
        foreach ($results as $key => $row) {
            if($row->email_notification == 0) {
                $form['checkbox_' . $row->id] = [
                    '#type' => 'checkbox',
                    '#default_value' => $row->email_notification
                ];
            }
            $rows[] = [
                'id' => ['data' => $row->id],
                'nid' => ['data' => $row->nid],
                'email' => ['data' => $row->mail],
                'created' => ['data' => $row->created],
//                'email_notification' => ['data' => $row->email_notification],
            ];
//            $rows[$key] = array(
//                'data' => array(
//                    $row->id,
//                    $row->nid,
//                    $row->mail,
//                    $row->created,
//
//                    render($form['fashion_subscribe_users']),
//                ),
//            );
        }
        $form['#attached']['library'][] = 'fashion_subscribe_users/subscribe_table';

        $form['fashion_subscribe_users'] = [
            '#type' => 'table',
            '#caption' => $this
                ->t('All Subscribed Users '),
            '#header' => $header,
            '#rows' => $rows,

        ];

//                $form['fashion_subscribe_users']['id'] = [
////                    '#title' => t('User ID'),
////                    '#markup' => $result->id,
////                ];
////            $form['fashion_subscribe_users']['nid'] = [
////                '#title' => $this
////                    ->t('NID'),
//////            '#type' => 'link',
////                '#markup' => '<a>$result->nid</a>',
//////            '#url' => Url::fromRoute('examples.description'),
////            ];
////            $form['fashion_subscribe_users']['email'] = [
////                '#title' => t('Email Address'),
////                '#markup' => $result->mail,
////            ];
////            $form['fashion_subscribe_users']['created'] = [
////                '#markup' => $result->created,
////                '#title' => $this
////                    ->t('Created'),
////            ];
////
////            ];

//            ]


        $form['actions'] = ['#type' => 'actions'];
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Send Email'),
            '#button_type' => 'primary',
        ];

        return $form;
//$a=1;

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

        $db = \Drupal::database();

        foreach ($form_state->getUserInput() as $key => $value) {
            if (strpos($key,'checkbox_') !== FALSE  && $value) {
                $id = explode('_',$key)[1];
                $db->update('fashion_subscribe')
                    ->fields(['email_notification' => 1])
                    ->condition('id', $id, '=')
                    ->execute();
            }

        }


//              foreach ($values as $key => $value) {
//
//                  $query = $connection->insert('fashion_subscribe')
//                      ->fields([
//                          'id'=> $value['id'],
//                          'nid' => $value['nid'],
//                          'mail' => $value['mail'],
//                          'created' => $value['created'],
//                          'email_notification' => $value['email_notification']
//                      ])->execute();
//              }


    }
}