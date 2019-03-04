<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe\Plugin\Block\FashionSubscribeBlock
 */
namespace Drupal\fashion_subscribe\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a ' FashionSubscribe' Block.
 *
 * @Block(
 *   id = "subscribe_block",
 *   admin_label = @Translation("Fashion Subscribe block"),
 *   category = @Translation("Blocks")
 * )
 */
class  FashionSubscribeBlock extends BlockBase {
    public function build() {

//        $nid = $node->nid->value;
       if( \Drupal::routeMatch()->getParameter('node')){
           $build[] = \Drupal::formBuilder()->getForm('Drupal\fashion_subscribe\Form\FashionSubscribeForm');
           $build[] = \Drupal::formBuilder()->getForm('Drupal\fashion_subscribe\Form\FashionSubscribeSecondForm');
       }
       else {
           $build[] = $this->t('Hello World');
       }

        return $build;
    }
//   this  clear cache
    public function getCacheMaxAge()
    {
       return 0;
    }
}

