<?php 

namespace Drupal\custom_webservices\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\Core\Routing\RequestContext;
use Drupal\system\Form\SiteInformationForm;

//Extended SiteInformationForm to get the original form and then alter it.
class ApikeySiteInformationForm extends SiteInformationForm {

	protected $config;

  /**
     * {@inheritdoc}
  */
	public function __construct(ConfigFactoryInterface $config_factory, AliasManagerInterface $alias_manager, PathValidatorInterface $path_validator, RequestContext $request_context) {

    //Initialise parent constructor.
    parent::__construct($config_factory, $alias_manager, $path_validator, $request_context);

    //Retrieve the system site configuration.
		$this->config = \Drupal::service('config.factory')->getEditable('system.site');
	}


	public function buildForm(array $form, FormStateInterface $form_state) {

        $form = parent::buildForm($form, $form_state);

        //Added additional field to save Apikey in system setting
        $form['site_information']['site_apikey'] = [
            '#type' => 'textfield',
	        '#title' => t('Site ApiKey'),
	        '#default_value' => !empty($this->config('system.site')->get('site_apikey')) ? $this->config('system.site')->get('site_apikey') : t('No ApiKey yet'),
	        '#description' => t("Apikey will be used to access site content"),
        ];

        //Updated Submit button text only if Apikey is saved once.
        if(!empty($this->config('system.site')->get('site_apikey'))) {
          $form['actions']['submit']['#value'] = t("Update Configuration");
        }        

        return $form;
    }

    /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  

    //To save the configuration in system.site.site_apikey
    $this->config('system.site')
      ->set('site_apikey', $form_state->getValue('site_apikey'))  
      ->save();  

    $message = t("Site Apikey has been saved.");
    \Drupal::messenger()->addMessage($message, 'status', FALSE);
  }
}