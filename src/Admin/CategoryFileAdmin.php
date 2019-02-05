<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class CategoryFileAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('file', FileType::class, [
                'required' => false
            ]);
    }

    public function prePersist($file)
    {
        $this->manageFileUpload($file);
    }

    public function preUpdate($file)
    {
        $this->manageFileUpload($file);
    }

    private function manageFileUpload($file)
    {
        $uploadedFile = $this->getForm()->get('file')->getData();

        $uploadableManager = $this->getConfigurationPool()->getContainer()->get('stof_doctrine_extensions.uploadable.manager');

        //$listener = $uploadableManager->getUploadableListener();

        $file->file = $uploadedFile;

        if ($file->file instanceof UploadedFile) {
            $uploadableManager->markEntityToUpload($file, $file->file);
        }

    }

}