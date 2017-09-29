<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket
//class Basket extends Model
{
    public $items = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldBasket)
    {
        if ($oldBasket) {
            $this->items = $oldBasket->items;
            $this->totalQuantity = $oldBasket->totalQuantity;
            $this->totalPrice = $oldBasket->totalPrice;
        }
    }

    public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' =>$item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice += $item->price;
    }

    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQuantity--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    public function reduceItem($id)
    {
        $this->totalQuantity -= $this->items[$id]['qty'];
        number_format($this->totalPrice -= $this->items[$id]['price'], 2);
        unset($this->items[$id]);
    }
}
