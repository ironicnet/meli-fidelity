<?php
class defaultActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
     $this->orders = $this->getUser()->getOrders();
     $this->publications = $this->getUser()->getPublications();
  }
}
