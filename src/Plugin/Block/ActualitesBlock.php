<?php

namespace Drupal\cci_actualites\Plugin\Block;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'ActualitesBlock' block.
 *
 * @Block(
 *  id = "actualites_block",
 *  admin_label = @Translation("Actualites block"),
 * )
 */
class ActualitesBlock extends BlockBase implements ContainerFactoryPluginInterface{

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
    $actualites_service = $container->get('cci_actualites.actualites_service');
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $actualites_service
    );
  }

  public function __construct(array $configuration, $plugin_id, $plugin_definition ,$actualites_service) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->actualites_service = $actualites_service;
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
  $news = $this->actualites_service->lastNews();

    return array(
      '#theme' => 'cci_actualites',
      '#all_news' => $news
    );

  }
}
