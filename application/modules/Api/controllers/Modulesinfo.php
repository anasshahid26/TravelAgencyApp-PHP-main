<?php

header('Access-Control-Allow-Origin: *');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions

require APPPATH . 'modules/Api/libraries/REST_Controller.php';



class Modulesinfo extends REST_Controller {



		function __construct() {

// Construct our parent class

				parent :: __construct();
				if(!$this->isValidApiKey){
               	$this->response($this->invalidResponse, 200);
               }

// Configure limits on our controller methods. Ensure

// you have created the 'limits' table and enabled 'limits'

// within application/config/rest.php

				$this->methods['list_get']['limit'] = 500; //500 requests per hour per user/key

				$this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key

				$this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key




    }



		function list_get() {

				$list = $this->ptmodules->listModuleForApi();
				$couponsEnabled = pt_is_module_enabled('coupons');
				$list[] = array("title" => "coupons", 'status' => $couponsEnabled);
				$defaultLang = pt_get_default_language();
				if (!empty ($list)) {

						$this->response(array('response' => $list, 'error' => array('status' => FALSE,'msg' => ''), 'languageInfo' => array('code' => $defaultLang , 'isRTL' => isRTL($defaultLang))), 200); // 200 being the HTTP response code

				}

				else {

						$this->response(array('response' => "", array('status' => TRUE,'msg' => 'Modules Not Found')), 200);

				}

		}

		function dohop_get(){
			$this->load->library('Flightsdohop/Dohop_lib');

			$result = $this->Dohop_lib->getUserName();


				if ($result->exists) {

						$this->response(array('response' => array('username' => $result->username)), 200);

				}

				else {

						$this->response(array('response' => "",array('status' => TRUE,'msg' => 'Dohop Module Not Found')), 200);

				}

			}

			function wego_get(){
				$this->load->model("Wegoflights/Wegoflights_model");

				$result = $this->Wegoflights_model->get_front_settings();


					if ($result->url) {

							$this->response(array('response' => $result), 200);

					}

					else {

							$this->response(array('response' => "",array('status' => TRUE,'msg' => 'WegoFlights Module Not Found')), 200);

					}

				}


				function hotelscombined_get(){
					$this->load->model("Hotelscombined/Hotelscombined_model");

					$result = $this->Hotelscombined_model->get_front_settings();


						if ($result->aid) {

								$this->response(array('response' => $result), 200);

						}

						else {

								$this->response(array('response' => "",array('status' => TRUE,'msg' => 'HotelsCombined Module Not Found')), 200);

						}

					}

					function travelstart_get(){
						$this->load->model("Travelstart/Travelstart_model");

						$result = $this->Travelstart_model->get_front_settings();


							if ($result->affid) {

									$this->response(array('response' => $result), 200);

							}

							else {

									$this->response(array('response' => "",array('status' => TRUE,'msg' => 'Travelstart Module Not Found')), 200);

							}

						}

						function cartrawler_get(){

							 $settings =  $this->Settings_model->get_front_settings("cartrawler");
							 $result = new stdClass;
							 $result->cid = $settings[0]->cid;
						   $result->url = $settings[0]->secret;


								if ($result->cid) {

										$this->response(array('response' => $result), 200);

								}

								else {

										$this->response(array('response' => "",array('status' => TRUE,'msg' => 'HotelsCombined Module Not Found')), 200);

								}

							}



		function items_get(){
			$this->load->library('Hotels/Hotels_lib');

			$list1 = $this->Hotels_lib->getLatestHotelsForAPI();

			$this->load->library('Tours/Tours_lib');

			$list2 = $this->Tours_lib->getLatestToursForAPI();

			$this->load->library('Cars/Cars_lib');

			$list3 = $this->Cars_lib->getLatestCarsForAPI();

			$list = array_merge($list1,$list2,$list3);
			usort($list, array($this, "cmp"));

				if (!empty ($list)){

						$this->response(array('response' => $list, 'error' => array('status' => FALSE,'msg' => '')), 200); // 200 being the HTTP response code

				}

				else {

						$this->response(array('response' => "", array('status' => TRUE,'msg' => 'Items Not Found')), 200);

				}

			}

		function aboutus_get(){
		$mobileSettings =	mobileSettings();

		$this->response(array('response' => $mobileSettings->aboutUs), 200);

		}

		function cmp($a, $b)
		{
		return strcmp($b->createdAt,$a->createdAt);
		}




}
