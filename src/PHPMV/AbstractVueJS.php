<?php
namespace PHPMV;

use PHPMV\parts\VueData;
use PHPMV\parts\VueMethods;

use PHPMV\js\JavascriptUtils;
use PHPMV\parts\VueComputeds;

/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 13/11/2020
 * Time: 22:25
 */
class AbstractVueJS {
	protected $data;
	protected $methods;
	protected $computed;
	protected $watcher;
	protected $directives;
	protected $filters;
	protected $hooks;
	
	
	public function __construct() {
	    $this->data= new VueData();
	    $this->methods= new VueMethods();
	    $this->computeds=new VueComputeds();
	    $this->watcher=null;
	    $this->directives=null;
	    $this->filters=null;
	    $this->hooks=array();
	}

	public function addData(string $name,$value):void {
	    $this->data->put($name, $value);
	}

	public function addDataRaw(string $name,string $value):void {
	    $this->data->put($name,$value."");
	}
	
	public function addMethod(string $name,string $body, string $params = null) {
	    $this->methods->add($name, $body, $params);
	}
	
	public function addComputed(string $name,string $get,string $set=null) {
	    $this->computeds->add($name, $get, $set);
	}
	
	public function getComputeds():string {
		return $this->computeds;
	}

	public function setComputeds(string $computeds) {
		$this->computeds = $computeds;
	}

	public function setWatcher(string $watcher) {
		$this->watcher = $watcher;
	}
	
	public function getData():array {
	    return $this->data;
	}
	
	public function getMethod():string {
	    return $this->method;
	}
	
	public function getWatcher():string {
	    return $this->watcher;
	}
}