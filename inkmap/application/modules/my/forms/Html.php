<?php
class My_Form_Html extends Zend_Form_Element {
	
	protected $_html;
	/**
	 * Render form element
	 *
	 * @param  Zend_View_Interface $view
	 * @return string
	 */
	public function render(Zend_View_Interface $view = null) {
		if (null !== $view) {
			$this->setView ( $view );
		}
		return $this->html;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
}