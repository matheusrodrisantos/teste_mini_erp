<?php
namespace App\Model;

class Product
{
    private int $id;
    private array $variations = [];
    public function __construct(
        private string $name,
        private float $price,
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        if ($price < 0) {
            throw new \InvalidArgumentException('Price cannot be less than 0.');
        }
        $this->price = $price;
        return $this;
    }


    public function addVariation(Variation $variation): self
    {
        $this->variations[] = $variation;
        return $this;
    }

    /** @return Variation[] */
    public function getVariations(): array
    {
        return $this->variations;
    }

    public function setVariations(array $variations): self
    {
        $this->variations = $variations;
        return $this;
    }

}
