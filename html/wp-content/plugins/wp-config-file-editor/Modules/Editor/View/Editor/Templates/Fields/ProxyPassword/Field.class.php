<?php
/**
* 
*/

# Define namespace
namespace WCFE\Modules\Editor\View\Editor\Templates\Fields\ProxyPassword;

# Input field base
use WCFE\Modules\Editor\View\Editor\Fields\InputField;

/**
* 
*/
class Field extends InputField {

	/**
	* put your comment there...
	* 
	* @var mixed
	*/
	protected $type = 'password';

	/**
	* put your comment there...
	* 
	*/
	public function getText() {
		return $this->__( 'Password' );
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getTipText() {
		return $this->__( 'Proxy password, if it requires authentication' );
	}

}
