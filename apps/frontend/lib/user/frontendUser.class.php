<?php

   require_once sfConfig::get("sf_root_dir") . '/lib/vendor/meli-php-sdk/src/meli.php';

   class frontendUser extends ProjectUser
   {
      private $MELI = NULL;

      public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
      {
         parent::initialize($dispatcher, $storage, $options);

         // MELI SDK
         $this->MELI = new Meli(array(
            'appId'         => '3595336132524779',
            'secret'        => 'jObc2V5oFYP2t1ai5TFc5ZDgeRfqCAGK',
         ));
      }

      public function getMELI()
      { 
         return $this->MELI;
      } 

      public function getMELIUser()
      {
         $userId = $this->MELI->initConnect();

         if ($userId) {
            $response = $this->MELI->getWithAccessToken('/users/me');
            return json_decode($response['body']);
         }
      }
   }
