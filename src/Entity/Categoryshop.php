<?php

namespace App\Entity;

use App\Repository\CategoryshopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryshopRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Categoryshop
{
    use Trait\DateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categoryshops')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $categoryshops;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(targetEntity: Product::class, mappedBy: 'categoryShop')]
    private Collection $products;

    public function __construct()
    {
        $this->categoryshops = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategoryshops(): Collection
    {
        return $this->categoryshops;
    }

    public function addCategoryshop(self $categoryshop): static
    {
        if (!$this->categoryshops->contains($categoryshop)) {
            $this->categoryshops->add($categoryshop);
            $categoryshop->setParent($this);
        }

        return $this;
    }

    public function removeCategoryshop(self $categoryshop): static
    {
        if ($this->categoryshops->removeElement($categoryshop)) {
            // set the owning side to null (unless already changed)
            if ($categoryshop->getParent() === $this) {
                $categoryshop->setParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setCategoryShop($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getCategoryShop() === $this) {
                $product->setCategoryShop(null);
            }
        }

        return $this;
    }
}
