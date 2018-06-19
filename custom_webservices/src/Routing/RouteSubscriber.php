<?php 

namespace Drupal\custom_webservices\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {
    /**
     * {@inheritdoc}
     */
    protected function alterRoutes(RouteCollection $collection) {
        if ($route = $collection->get('system.site_information_settings')) {
        	//Change form for the system.site_information_settings route
            $route->setDefault('_form', '\Drupal\custom_webservices\Form\ApikeySiteInformationForm');
        }
    }

}
