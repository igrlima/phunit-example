<?php

namespace tests\cart;

use app\exceptions\CartQuantityException;
use app\libraries\Cart;
use app\libraries\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private readonly Cart $cart;

    //É a mesma coisa que o construct
    public function setup(): void
    {
        $this->cart = new Cart;
    }

    public function testIfCartIsEmpty()
    {
        $this->assertEmpty($this->cart->getCart());
    }

    public function testIfCartIsNotEmpty()
    {
        $this->cart->add(new Product());

        $this->assertNotEmpty($this->cart->getCart());
    }

    public function test_catch_exception_if_cart_have_more_than_2_items()
    {

        $product1 = new Product;
        $product2 = new Product;
        $product3 = new Product;


        $this->cart->add(new $product1);
        $this->cart->add(new $product2);
        $this->cart->add(new $product3);

        $this->expectException(CartQuantityException::class);

        // $this->assertNotEmpty($cart->getCart());
    }

    public function test_if_products_in_cart_greater_than_1()
    {

        $this->cart->add(new Product);
        // $cart->add(new Product);

        $this->assertGreaterThan(1, count($this->cart->getCart()));
    }
}
