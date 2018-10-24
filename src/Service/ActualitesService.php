<?php


namespace Drupal\cci_actualites\Service;

use Drupal\node\Entity\Node;

/**
 * Class ActualitesService
 *
 * @package Drupal\actualites_cci
 */
class ActualitesService{
    
    /**
   * Fetch the news that will display;
   *
   * @return array The nodes.
   *   empty if there is no node,
   *   array of nodes if there is.
   */
  public function lastNews(){

    $date = Date('Y-m-d');
        
    $query = \Drupal::entityQuery('node')
            ->range(0,5)
            ->condition('field_cci_actualites_date_pub', $date, '<=');
    
        $nodes = $query->execute();

    if (empty($nodes)) {
        return [];
        }
    return Node::loadMultiple($nodes);
    }

}