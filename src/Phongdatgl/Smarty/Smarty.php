<?php 
namespace Phongdatgl\Smarty;
class Smarty extends \Smarty {
	public function render($template = null, $cache_id = null, $compile_id = null, $parent = null)
	{
		if(is_array($cache_id)) {
			foreach ($cache_id as $key => $value) {
				parent::assign($key, $value);
			}
		}
		return parent::fetch($template, null, $compile_id, $parent);
	}
}
