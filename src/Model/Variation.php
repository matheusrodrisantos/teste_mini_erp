<?php
namespace App\Model;

use App\Model\Product;

class Variation
{
    private int $id;

    private ?Inventory $inventory = null;

    public function __construct(
        private string $description,
        private Product $product,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function setIventory(Inventory $inventory): self
    {
        $this->inventory = $inventory;
        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }
}
