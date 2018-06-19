
## Requirements

This module alters the existing Drupal "Site Information" form. Specifics:

* A new form text field named "Site API Key" is added to the "Site Information" form with the default value of “No API Key yet”.
* When this form is submitted, the value that the user entered for this field is saved as the system variable named "site_apikey".
* A Drupal message inform the user that the Site API Key has been saved with that value.
* When this form is visited after the "Site API Key" is saved, the field is populated with the correct value.
* The text of the "Save configuration" button is changed to "Update Configuration".
* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

## URL

<Website host>/custom_webservices/node_resource?_format=json&apikey=shweta&nid=1

## Dependencies:

* It creates the GET Webservice so is dependent on REST module and Restui so as to enable the Webservice from - /admin/config/services/rest and select authentication providers as cookie to check resource url on browser.
* This module extends the SiteInformationForm.
* For Resources : I have enabled Cookie authentication so once you are logged into your website, then can hit this url in browser to view results.


## List of resources used:

* Extending Core forms:
https://gist.github.com/davebeach/0e01e9a089bc4770022f5c74e85eab53
* Drupal.org docs for Configuration API
* For Custom Rest Webservices
https://www.drupal.org/docs/8/api/restful-web-services-api/custom-rest-resources


## Total time to complete the task : 3hrs