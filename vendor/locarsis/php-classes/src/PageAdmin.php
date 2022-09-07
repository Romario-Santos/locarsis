<?php
namespace locarsis;
use Rain\Tpl;
/**
 * 
 */
class PageAdmin extends Page
{
	
	function __construct($opts = array(),$tpl_dir = "/views/admin/")
	{

		parent::__construct($opts,$tpl_dir);
		
	}
}

?>