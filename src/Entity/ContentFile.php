<?php
namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @Gedmo\Uploadable(path="/uploads", allowOverwrite=true, appendNumber=true, allowedTypes="image/jpeg,image/pjpeg,image/png,image/x-png", maxSize=10000000)
 */
class ContentFile
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column
     * @Gedmo\UploadableFilePath
     */
    private $path;

    /**
     * @ORM\Column
     * @Gedmo\UploadableFileName
     */
    private $name;

    /**
     * @ORM\Column
     * @Gedmo\UploadableFileMimeType
     */
    private $mimeType;

    /**
     * @ORM\Column(type="decimal")
     * @Gedmo\UploadableFileSize
     */
    private $size;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable
     */
    private $dateUpdated;



    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(\DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }



}