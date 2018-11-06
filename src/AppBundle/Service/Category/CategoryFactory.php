<?php

namespace AppBundle\Service\Category;

/**
 * Created by PhpStorm.
 * User: mdelamare
 * Date: 27/09/2017
 * Time: 19:20
 */

class CategoryFactory
{
    private $em;
	
	private static $instance;

    private function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * @param $category
     * @return Category
     */
    public function createInstance($category){
        $class = "AppBundle\\Service\\Category\\Data\\Category" . ucfirst(str_replace('-', '', $category));
        return new $class($this->em, $category);
    }
	
	public static function getInstance($em) {
		if (null === self::$instance) {
			self::$instance = new self($em);
		}
		return self::$instance;
	}

}