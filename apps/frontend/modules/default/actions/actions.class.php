<?php
class defaultActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
     $this->orders = MeliOrderTable::getInstance()->getOrders($this->getUser()->getMELIUserId());
     $this->sales = MeliOrderTable::getInstance()->getSales($this->getUser()->getMELIUserId());
  }
}
