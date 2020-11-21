<?php
namespace PHPMV;

use PHPMV\parts\VueMethod;
use PHPMV\parts\VueComputed;
use PHPMV\parts\VueWatcher;

/**
 * Created by PhpStorm.
 * User: qgorak
 * Date: 19/11/2020
 * Time: 14:20
 */
class AbstractVueJS {
	protected $data;
	protected $methods;
	protected $computeds;
	protected $watchers;
	protected $directives;
	protected $filters;
	protected $hooks;
	
	public function __construct() {
	    $this->data=[];
	    $this->methods=[];
	    $this->computeds=[];
	    $this->watchers=[];
	    $this->directives=[];
	    $this->filters=[];
	    $this->hooks=[];
	}
	
	public function addHook(string $name,string $body) {
	    $this->hooks[$name] = "%!! function(){ $body } !!%";;
	}
	
	/**
	 * Adds code (body) for the beforeCreate hook
	 * @param body the code to execute
	 */
	public function onBeforeCreate(string $body) {
		$this->addHook("beforeCreate", $body);
	}
	
	/**
	 * Adds code (body) for the created hook
	 * @param body the code to execute
	 */
	public function onCreated(string $body) {
		$this->addHook("created", $body);
	}
	
	/**
	 * Adds code (body) for the beforeMount hook
	 * @param body the code to execute
	 */
	public function onBeforeMount(string $body) {
		$this->addHook("beforeMount", $body);
	}
	
	/**
	 * Adds code (body) for the mounted hook
	 * @param body the code to execute
	 */
	public function onMounted(string $body) {
		$this->addHook("mounted", $body);
	}
	
	/**
	 * Adds code (body) for the beforeUpdate hook
	 * @param body the code to execute
	 */
	public function onBeforeUpdate(string $body) {
		$this->addHook("beforeUpdate", $body);
	}
	
	/**
	 * Adds code (body) for the updated hook
	 * @param body the code to execute
	 */
	public function onUpdated(string $body) {
		$this->addHook("updated", $body);
	}
	
	/**
	 * Adds code (body) for the updated hook
	 * wait until the entire view has been re-rendered with $nextTick
	 * @param body the code to execute
	 */
	public function onUpdatedNextTick(string $body) {
		$this->addHook("updated", "this.\$nextTick(function () {".body."})");
	}
	
	/**
	 * Adds code (body) for the beforeDestroy hook
	 * @param body the code to execute
	 */
	public function onBeforeDestroy(string $body) {
		$this->addHook("beforeDestroy", $body);
	}
	
	/**
	 * Adds code (body) for the destroyed hook
	 * @param body the code to execute
	 */
	public function onDestroyed(string $body) {
		$this->addHook("destroyed", body);
	}

	public function addData(string $name,$value):void {
	    if(!empty($this->data)){
	        $this->data["data"][$name]=$value;
	    }
	    else{
	        $this->data["data"]=[$name=>$value];
	    }
	}

	public function addDataRaw(string $name,string $value):void {
	    if(!empty($this->data)){
	       $this->data["data"][$name]="!!%$value%!!";
	    }
	    else{
	        $this->data["data"]=[$name=>"!!%$value%!!"];
	    }
	}
	
	public function addMethod(string $name,string $body, array $params = []) {
	    $vm=new VueMethod($body, $params);
	    if(!empty($this->methods)){
	        $this->methods["methods"][$name]=$vm->__toString();
	    }
	    else{
	        $this->methods["methods"]=[$name=>$vm->__toString()];
	    }
	}
	
	public function addComputed(string $name,string $get,string $set=null) {
	    $vc=new VueComputed($name, $get, $set);
	    if(!empty($this->computeds)){
	        $this->computeds["computeds"][$name]=$vc->__toString();
	    }
	    else{
	        $this->computeds["computeds"]=[$name=>$vc->__toString()];
	    }
	}
	
	public function addWatcher(string $var,string $body,array $params=[]):void{
	    $vw=new VueWatcher($var,$body,$params);
	    if(!empty($this->watchers)){
	        $this->watchers["watch"][$var]=$vw->__toString();
	    }
	    else{
	        $this->watchers["watch"]=[$var=>$vw->__toString()];
	    }
	}
	
	public function getComputeds():string {
		return $this->computeds;
	}

	public function setComputeds(string $computeds) {
		$this->computeds = $computeds;
	}

	public function setWatchers(string $watchers) {
		$this->watchers = $watchers;
	}
	
	public function getData():array {
	    return $this->data;
	}
	
	public function getMethod():string {
	    return $this->method;
	}
	
	public function getWatchers():string {
	    return $this->watchers;
	}
	
	public function getHooks() {
		return $this->hooks;
	}
	
	public function setHooks($hooks) {
		$this->hooks = $hooks;
	}
}