<?php
/**
* 
*/

# Define namespace
namespace WCFE\Modules\Editor\View\Editor\Templates\Fields\CookieAuth;

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
	protected $class = 'long-input';
	
	/**
	* put your comment there...
	* 
	*/
	public function getText() {
		return $this->__( 'Auth' );
	}
	
	/**
	* put your comment there...
	* 
	*/
	public function getTipText() {
		return $this->__( 'Auth cookie name' );
	}

}
