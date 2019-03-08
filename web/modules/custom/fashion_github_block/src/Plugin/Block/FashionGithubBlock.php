<?php
/**
 * @file
 * Contains \Drupal\fashion_subscribe\Plugin\Block\FashionSubscribeBlock
 */
namespace Drupal\fashion_github_block\Plugin\Block;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a ' FashionGithubBlock' Block.
 *
 * @Block(
 *   id = "fashion_github_block",
 *   admin_label = @Translation("Fashion Github block"),
 *   category = @Translation("Blocks")
 * )
 */
class  FashionGithubBlock extends BlockBase
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {

        $client = \Drupal::service('http_client_factory')->fromOptions([
            'base_uri' => 'https://api.github.com/',
        ]);

        $response = $client->get('/search/repositories?q=Drupal&sort=stars&order=desc');
        $facts = Json::decode($response->getBody());

        $build['items'] = [];
//        $items=[];
//       $a=1;
        foreach ($facts["items"] as $key=>$fact) {
            $build['items'][$key] = [
                'name' => $fact['name'],
                'description' =>$fact['description'],
                'homepage' =>$fact['homepage'],
            ];
         }

        return $build;

//
//        return [
//            '#theme' => 'item_list',
//            '#items' => $items,
//        ];

//        $a=1;
//        return [
//            '#type' => 'markup',
//            '#markup' => $this->t('This is a simple block!'),
//        ];
    }

    public function getCacheMaxAge()
    {
        return 0;

    }

}