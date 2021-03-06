<?php

   /**
   * MeliOrderTable
   * 
   * This class has been auto-generated by the Doctrine ORM Framework
   */
   class MeliOrderTable extends Doctrine_Table
   {
      /**
      * Returns an instance of this class.
      *
      * @return object MeliOrderTable
      */
      public static function getInstance()
      {
         return Doctrine_Core::getTable('MeliOrder');
      }

      // Recibe una compra o venta
      // y la crea o la actualiza si ya existe
      public function createOrUpdate($orderOrSale)
      {
         $meliOrder = $this->findOneByMeliOrderId($orderOrSale['id']);

         if( ! $meliOrder)
         {
            $meliOrder = new MeliOrder();
         }

         $meliOrder->setMeliOrderId($orderOrSale['id']);
         $meliOrder->setItemId($orderOrSale['item_id']);
         $meliOrder->setBuyerId($orderOrSale['buyer_id']);
         $meliOrder->setBuyerNickname($orderOrSale['buyer_nickname']);
         $meliOrder->setBuyerEmail($orderOrSale['buyer_email']);
         $meliOrder->setSellerId($orderOrSale['seller_id']);
         $meliOrder->setSellerNickname($orderOrSale['seller_nickname']);
         $meliOrder->setSellerEmail($orderOrSale['seller_email']);
         $meliOrder->setDateCreated(date("Y-m-d H:i:s", strtotime($orderOrSale['date_created'])));
         $meliOrder->setTitle($orderOrSale['title']);
         $meliOrder->setQuantity($orderOrSale['quantity']);
         $meliOrder->setUnitPrice($orderOrSale['unit_price']);
         $meliOrder->setCurrencyId($orderOrSale['currency_id']);
         if($orderOrSale['thumbnail'])
         {
            $meliOrder->setThumbnail($orderOrSale['thumbnail']);
         }
         $meliOrder->setStatus($orderOrSale['status']);
         $meliOrder->save();
      }


      // Trae las ventas por id de vendedor
      public function getSales($sellerId)
      {
         return $this->createQuery("a")
         ->where("a.seller_id = ?", $sellerId)
         ->orderBy("a.date_created DESC")
         ->execute(null, Doctrine::HYDRATE_ARRAY);
      }

      // Trae las ventas por id de vendedor de un item
      public function getSalesByItem($sellerId, $itemId)
      {
         return $this->createQuery("a")
         ->where("a.seller_id = ?", $sellerId)
         ->andWhere("a.item_id = ?", $itemId)
         ->execute(null, Doctrine::HYDRATE_ARRAY);
      }

      // Trae las compras por id de comprador
      public function getOrders($buyerId)
      {
         return $this->createQuery("a")
         ->where("a.buyer_id = ?", $buyerId)
         ->orderBy("a.date_created DESC")
         ->execute(null, Doctrine::HYDRATE_ARRAY);
      }

   }
