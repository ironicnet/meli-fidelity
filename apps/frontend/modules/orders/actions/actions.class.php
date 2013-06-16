<?php
   class ordersActions extends sfActions
   {
      public function executeIndex(sfWebRequest $request)
      {
         }

         public function executeGetMessages(sfWebRequest $request)
         {
            $orderId = $request->getParameter('orderId');
            $lastTime = $request->getParameter('lastTime', null);	
            return $this->renderText(json_encode(ChatMessageTable::getInstance()->getLastMessages($orderId, $lastTime)));
         }

         public function executeNewMessage(sfWebRequest $request)
         {
            $this->getContext()->getConfiguration()->loadHelpers('Date');
            $response = array();
            $params = $request->getParameter("message");

            $order = MeliOrderTable::getInstance()->findOneByMeliOrderId($params['order_id']);
            
            if($params['message'])
            {
               $chatMessage = new ChatMessage();
               $chatMessage->setMeliOrderId($params['order_id']);
               $chatMessage->setMessage($params['message']);
               $chatMessage->setUserId($this->getUser()->getMELIUserId());
               $chatMessage->save();

               $response['state'] = "success";
               $response['message'] = "Su mensaje ha sido enviado";
               $response['new_message_html'] = '<div class="row-fluid">
               <div class="span12 alert alert-success ' . ($chatMessage->getUserId() == $order['seller_id'] ? "seller" : "buyer") .'">
                  <p>
                     <i class="icon-user"></i><b> ' . $chatMessage->getUser()->getUsername() . '</b><br />' 
                     . $chatMessage->getMessage() . '
                     <br />
                     <i>' . time_ago_in_words(strtotime($chatMessage->getCreatedAt())) . '</i>
                  </p>
               </div>
               </div>';
            }       
            else
            {
               $response['state'] = "error";
               $response['message'] = "Se ha producido un error";
            }

            return $this->renderText(json_encode($response));
         }

         public function executeDetail(sfWebRequest $request)
         {
            $this->order = MeliOrderTable::getInstance()->findOneByMeliOrderId($request->getParameter("id"));
            $this->forward404Unless($this->order);
         }
      }
