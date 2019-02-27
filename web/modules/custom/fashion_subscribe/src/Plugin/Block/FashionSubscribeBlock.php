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
 * )
 */
class  FashionSubscribeBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return \Drupal::formBuilder()->getForm('Drupal\fashion_subscribe\Form\FashionSubscribeForm');
    }
}