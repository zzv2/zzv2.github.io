<?php

class Payments {
	private $api_key;
	private $api_secret;

	public function __construct($api_key, $api_secret){
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        \Stripe\Stripe::setApiKey($api_secret);
    }

//    public function create
}

?>