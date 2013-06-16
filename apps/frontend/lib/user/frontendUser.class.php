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

         // Sincronizacion
         // 1) Ventas

         $sales = $this->getSales();
         foreach($sales as $sale)
         {
            MeliOrderTable::getInstance()->createOrUpdate($sale);   
         }

         // 2) Compras
         $orders = $this->getOrders();
         foreach($orders as $order)
         {
            MeliOrderTable::getInstance()->createOrUpdate($order);
         }
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

      // Ventas
      public function getSales()
      {
         if($this->getMELIUser())
         {
            $orders_response = $this->getMELI()->getWithAccessToken("/orders/search", array(
               "seller" => $this->getMELIUserId()
            ));

            $preparsed_orders = array(); // Voy a armar un array con los campos que necesito y la foto que no la trae por default en los items

            $orders = $orders_response['statusCode'] == 200 ? ($orders_response['json']['results']) : array();

            // Armo array base sin foto
            foreach($orders as $order)
            {
               $preparsed_order = array(
                  "id" => $order['id'],
                  "item_id" => $order['order_items'][0]['item']['id'],
                  "buyer_id" => $order['buyer']['id'],
                  "buyer_nickname" => $order['buyer']['nickname'],
                  "buyer_email" => $order['buyer']['email'],
                  "seller_id" => $order['seller']['id'],
                  "seller_nickname" => $order['seller']['nickname'],
                  "seller_email" => $order['seller']['email'],
                  "date_created" => $order['date_created'],
                  "title" => $order['order_items'][0]['item']['title'],
                  "quantity" => $order['order_items'][0]['quantity'],
                  "unit_price" => $order['order_items'][0]['unit_price'],
                  "currency_id" => $order['order_items'][0]['currency_id'],
                  "status" => $order['status']
               );

               $preparsed_orders[$preparsed_order['item_id']] = $preparsed_order;
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


      // Compras
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
                  "id" => $order['id'],
                  "item_id" => $order['order_items'][0]['item']['id'],
                  "buyer_id" => $order['buyer']['id'],
                  "buyer_nickname" => $order['buyer']['nickname'],
                  "buyer_email" => $order['buyer']['email'],
                  "seller_id" => $order['seller']['id'],
                  "seller_nickname" => $order['seller']['nickname'],
                  "seller_email" => $order['seller']['email'],
                  "date_created" => $order['date_created'],
                  "title" => $order['order_items'][0]['item']['title'],
                  "quantity" => $order['order_items'][0]['quantity'],
                  "unit_price" => $order['order_items'][0]['unit_price'],
                  "currency_id" => $order['order_items'][0]['currency_id'],
                  "status" => $order['status']
               );

               $preparsed_orders[$preparsed_order['item_id']] = $preparsed_order;
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

      // Publicaciones
      public function getPublications()
      {
         if($this->getMELIUser())
         {
            // Primero traigo los id's de todas las publicaciones
            $publications_response = $this->getMELI()->getWithAccessToken("/users/" . $this->getMELIUserId() . "/items/search");
            $publications_json_decoded = json_decode($publications_response['body']);
            $publications_ids = $publications_json_decoded->results;

            $publications_items_response = $this->getMELI()->getWithAccessToken("/items?ids=" . implode(",", $publications_ids) . "");
            $preparsed_publications = $publications_items_response['statusCode'] == 200 ? $publications_items_response['json'] : array();

            // Ahora le voy a asociar las ventas si tiene algun sold_quantity

            $parsed_publications = array();
            foreach($preparsed_publications as $preparsed_publication)
            { 
               if($preparsed_publication['sold_quantity'] > 0)
               {
                  $preparsed_publication['sales'] = MeliOrderTable::getInstance()->getSalesByItem($preparsed_publication['seller_id'], $preparsed_publication['id']);
               }

               $parsed_publications[] = $preparsed_publication;
            }

            return $parsed_publications;
         }

      }
   }
