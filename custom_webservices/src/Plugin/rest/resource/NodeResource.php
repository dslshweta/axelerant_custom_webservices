<?php

namespace Drupal\custom_webservices\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ModifiedResourceResponse;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Provides a Node Resource
 *
 * @RestResource(
 *   id = "node_resource",
 *   label = @Translation("Node Resource"),
 *   uri_paths = {
 *     "canonical" = "/custom_webservices/node_resource"
 *   }
 * )
 */
class NodeResource extends ResourceBase {

   /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ModifiedResourceResponse
   */
  public function get() {

  	$apikey = \Drupal::config('system.site')->get('site_apikey');
  	$nid = \Drupal::request()->query->get('nid');

  	//Cross check API key and node id to fetch
  	if (\Drupal::request()->query->get('apikey') == $apikey && !empty($nid)) {
  		
		$node = Node::load($nid);
		if(!empty($node)) {
			return new ModifiedResourceResponse($node);
		} else {
			throw new BadRequestHttpException('Invalid node id');
		}    	
    } else {
    	throw new AccessDeniedHttpException("Access denied. API key didnt matched.");
    }    
  }
}