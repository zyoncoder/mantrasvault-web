<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
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
     * @ORM\OrderBy({"left" = "ASC"})
     */
    private $children;
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="slug", type="string", length=128)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content", mappedBy="category", orphanRemoval=true)
     */
    private $contents;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $categoryFileId;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CategoryFile", cascade={"persist", "remove"})
     */
    private $categoryFile;



    public function __construct()
    {
        $this->contents = new ArrayCollection();
    }
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

    /**
     * @return Collection|Content[]
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): self
    {
        if (!$this->contents->contains($content)) {
            $this->contents[] = $content;
            $content->setCategory($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->contents->contains($content)) {
            $this->contents->removeElement($content);
            // set the owning side to null (unless already changed)
            if ($content->getCategory() === $this) {
                $content->setCategory(null);
            }
        }

        return $this;
    }

    public function getCategoryFileId(): ?int
    {
        return $this->categoryFileId;
    }

    public function setCategoryFileId(?int $categoryFileId): self
    {
        $this->categoryFileId = $categoryFileId;

        return $this;
    }

    public function getCategoryFile(): ?CategoryFile
    {
        return $this->categoryFile;
    }

    public function setCategoryFile(?CategoryFile $categoryFile): self
    {
        $this->categoryFile = $categoryFile;

        return $this;
    }

}