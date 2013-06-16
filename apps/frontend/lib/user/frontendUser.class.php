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
               "buyer" => $this->getMELIUserId()
            ));

            $preparsed_orders = array(); // Voy a armar un array con los campos que necesito y la foto que no la trae por default en los items

            $orders = $orders_response['statusCode'] == 200 ? ($orders_response['json']['results']) : array();

            // Armo array base sin foto
            foreach($orders as $order)
            {
               $preparsed_order = array(
                  "date_created" => $order['date_created'],
                  "id" => $order['order_items'][0]['item']['id'],
                  "title" => $order['order_items'][0]['item']['title'],
                  "quantity" => $order['order_items'][0]['quantity'],
                  "unit_price" => $order['order_items'][0]['unit_price'],
                  "currency_id" => $order['order_items'][0]['currency_id'],
                  "seller" => $order['seller']['nickname']
               );

               $preparsed_orders[$preparsed_order['id']] = $preparsed_order;
            }

            // Busco las fotos de todos los ids
            $thumbnails_response = $this->getMELI()->getWithAccessToken("/items?ids=" . implode(",", array_keys($preparsed_orders)) . "&attributes=id,thumbnail");
            $thumbnails = $thumbnails_response['statusCode'] == 200 ? $thumbnails_response['json'] : array();

            foreach($thumbnails as $thumbnail)
            { 
               $preparsed_orders[$thumbnail['id']]['thumbnail'] = $thumbnail['thumbnail'];
            }

            return $preparsed_orders;
         }
      }

      public function getPublications()
      {
         if($this->getMELIUser())
         {
            // Primero traigo los id's de todas las publicaciones
            $publications_response = $this->getMELI()->getWithAccessToken("/users/" . $this->getMELIUserId() . "/items/search");
            $publications_json_decoded = json_decode($publications_response['body']);
            $publications_ids = $publications_json_decoded->results;

            $publications_items_response = $this->getMELI()->getWithAccessToken("/items?ids=" . implode(",", $publications_ids) . "&attributes=id,title,price,base_price,currency_id,initial_quantity,available_quantity,sold_quantity,thumbnail");
            return $publications_items_response['statusCode'] == 200 ? $publications_items_response['json'] : array();
         }

      }
   }
