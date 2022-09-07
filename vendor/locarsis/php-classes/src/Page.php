<?php
namespace locarsis;
use Rain\Tpl;

class Page {

	private $tpl;
    
    private $options = [];
    private $default = [
        "header"=>true,
        "footer"=>true,
        "data"=>[
        ]
    ];

   public function __construct($opts = array(),$tpl_dir = "/views/")
   {
   	$this->options = array_merge($this->default,$opts);

   	  $config = array(
            "tpl_dir"=>$_SERVER["DOCUMENT_ROOT"].$tpl_dir,
            "cache_dir"=>$_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug"=>false
        );
        

        Tpl::configure($config);
  
        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);
  
        if($this->options["header"] === true) $this->tpl->draw("header");

   }

public function setData($data){
     foreach ($data as $key => $value) {
        $this->tpl->assign($key,$value);     
     }
}

  public function setTpl($name, $data= array(), $returnHtml = false)
  {
          $this->setData($data);
          return $this->tpl->draw($name,$returnHtml);
  }


   public function __destruct()
   {
      
      if($this->options["footer"] === true)
      $this->tpl->draw("footer");

   }

}

?>