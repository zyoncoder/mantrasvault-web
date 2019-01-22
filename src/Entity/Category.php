<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    /**
     * @ORM\Column(name="lft",type="integer")
     * @Gedmo\TreeLeft
     */
    private $left;
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl",type="integer")
     */
    private $level;
    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt",type="integer")
     */
    private $right;
    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;
    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;
    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=128)
     */
    private $slug;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getTitle(): ?string
    {
        return $this->title;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function getLeft(): ?int
    {
        return $this->left;
    }
    public function setLeft(int $left): self
    {
        $this->left = $left;
        return $this;
    }
    public function getLevel(): ?int
    {
        return $this->level;
    }
    public function setLevel(int $level): self
    {
        $this->level = $level;
        return $this;
    }
    public function getRight(): ?int
    {
        return $this->right;
    }
    public function setRight(int $right): self
    {
        $this->right = $right;
        return $this;
    }
    public function setRoot(int $root): self
    {
        $this->root = $root;
        return $this;
    }
    public function getRoot()
    {
        return $this->root;
    }
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }
    public function getParent()
    {
        return $this->parent;
    }
    public function setChildren(int $children): self
    {
        $this->children = $children;
        return $this;
    }
    public function getChildren()
    {
        return $this->children;
    }
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function __toString() {
        return (string) $this->title;
    }
}