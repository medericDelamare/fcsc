<?php
namespace AppBundle\Service\Category\Data;
use AppBundle\Service\Category\Category;

class CategoryU18 extends Category
{
    public function __construct($em, $category)
    {
        parent::__construct($em, $category);
        $this->urlResult        = "https://eure.fff.fr/competitions/?id=339172&poule=1&phase=1&type=ch&tab=resultat";
        $this->urlAgenda        = "https://eure.fff.fr/competitions/?id=339172&poule=1&phase=1&type=ch&tab=agenda";
        $this->urlClassement    = "https://eure.fff.fr/competitions/?id=339172&poule=1&phase=1&type=ch&tab=ranking";
        $this->urlCalendrier    = "https://eure.fff.fr/competitions/?journee=&date=&equipe=104246-4&opposant=&place=&sens=&id=339172&poule=1&phase=1&tab=advanced_search&type=ch";
        $this->division         = "Départemental 3 Groupe A";
    }
}