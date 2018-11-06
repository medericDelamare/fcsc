<?php

namespace AppBundle\Service\Category\Data;
use AppBundle\Service\Category\Category;

class CategorySeniorB extends Category
{
    public function __construct($em, $category)
    {
        parent::__construct($em, $category);
        $this->urlResult        = "https://eure.fff.fr/competitions/?id=339168&poule=3&phase=1&type=ch&tab=resultat";
        $this->urlAgenda        = "https://eure.fff.fr/competitions/?id=339168&poule=3&phase=1&type=ch&tab=agenda";
        $this->urlClassement    = "https://eure.fff.fr/competitions/?id=339168&poule=3&phase=1&type=ch&tab=ranking";
        $this->urlCalendrier    = "https://eure.fff.fr/competitions/?journee=&date=&equipe=104246-2&opposant=&place=&sens=&id=339168&poule=3&phase=1&tab=advanced_search&type=ch";
        $this->division         = "Départemental 4 Groupe C";
    }
}