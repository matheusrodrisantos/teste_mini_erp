<?php 

namespace App\Model;

class ItemOrder
{
    private int $id;
    public function __construct(
        private int $quantity,
        private Order $order,
        private Variation $variation,
        private float $price
    ){}

    
    public function getId(): int
    {
        return $this->id;
    }

    
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @return  self
     */ 
    public function setOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get the value of variation
     */ 
    public function getVariation(): Variation
    {
        return $this->variation;
    }

    /**
     * Set the value of variation
     *
     * @return  self
     */ 
    public function setVariation(Variation $variation): self
    {
        $this->variation = $variation;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
