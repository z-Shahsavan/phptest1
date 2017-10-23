<?php

namespace App\Http\Controllers;

use App\PizzaFLD\GreekPizza;
use App\PizzaFLD\CheesePizza;
use App\PizzaFLD\PepperoniPizza;
use App\PizzaFLD\CalmPizza;
use App\PizzaFLD\PizzaType;
use Illuminate\Http\Request;
use Session;
class PizzaStore extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|string
     * @var int $id in range [0-3]
     */
    public static function orderPizza() {
        $id=$_GET['id'];
        if ($id == PizzaType::CHEESE) {
            $pizza = new CheesePizza();
        } elseif ($id == PizzaType::PEPPERONI) {
            $pizza = new PepperoniPizza();
        } elseif ($id == PizzaType::CALM) {
            $pizza = new CalmPizza();
        } elseif ($id == PizzaType::GREEK) {
            $pizza = new GreekPizza();
        } else {
            //return nothing to view to avoid people from wrong orders
            return redirect()->route('menu');
        }
        $show='';
        $show.= '<li>'.$pizza->prepare().'</li>';
        $show.= '<li>'.$pizza->bake($pizza->getName()).'</li>';
        $show.= '<li>'.$pizza->cut($pizza->getName()).'</li>';
        $show.= '<li>'.$pizza->box().'</li>';
        return $show;
    }
}