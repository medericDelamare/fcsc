<?php

namespace AppBundle\Service\Category\Data;
use AppBundle\Service\Category\Category;

class CategorySeniorA extends Category
{
    public function __construct($em, $category)
    {
        parent::__construct($em, $category);
        $this->urlResult        = "https://eure.fff.fr/competitions/?id=339167&poule=1&phase=1&type=ch&tab=resultat";
        $this->urlAgenda        = "https://eure.fff.fr/competitions/?id=339167&poule=1&phase=1&type=ch&tab=agenda";
        $this->urlClassement    = "https://eure.fff.fr/competitions/?id=339167&poule=1&phase=1&type=ch&tab=ranking";
        $this->urlCalendrier    = "https://eure.fff.fr/competitions/?id=339167&poule=1&phase=1&type=ch&tab=advanced_search&journee=&date=&equipe=104246-1&opposant=&place=&sens=";
        $this->division         = "Départemental 3 Groupe A";
    }
}