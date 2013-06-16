<?php

   require_once sfConfig::get("sf_root_dir") . '/lib/vendor/meli-php-sdk/src/meli.php';

   class frontendUser extends ProjectUser
   {
      private $MELI = NULL;
      private $MELIUser = NULL;

      public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
      {
         parent::initialize($dispatcher, $storage, $options);

         // MELI SDK
         $this->MELI = new Meli(array(
            'appId'         => '3595336132524779',
            'secret'        => 'jObc2V5oFYP2t1ai5TFc5ZDgeRfqCAGK',
         ));

         // Conecto
         $this->MELI->initConnect();

         // Guardo usuario
         $response = $this->MELI->getWithAccessToken('/users/me');
         $this->MELIUser = $response['statusCode'] == 200 ? json_decode($response['body']) : false;
      }

      public function getMELI()
      { 
         return $this->MELI;
      } 

      public function getMELIUser()
      {
         return $this->MELIUser;
      }

      public function getMELIUserId()
      {
         return $this->MELIUser ? $this->MELIUser->id : NULL;
      }

      public function getOrders()
      {
         if($this->getMELIUser())
         {
            $orders_response = $this->getMELI()->getWithAccessToken("/orders/search", array(
               "buyer" => $this->MELIUser->id
            ));

            $orders_json_decoded = json_decode($orders_response['body']);
            return $orders_json_decoded->results;
         }
      }

      public function getPublications()
      {
         if($this->getMELIUser())
         {
            $publications_response = $this->getMELI()->getWithAccessToken("/users/" . $this->getMELIUserId() . "/items/search");
            $publications_json_decoded = json_decode($publications_response['body']);
            var_dump($publications_json_decoded->results); die();
            return $publications_json_decoded->results;
         }

      }
   }
