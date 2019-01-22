<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Category;

final class CategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $categoryRepository = $entityManager->getRepository(Category::class);
        //$rootNodes = array_column($categoryRepository->getRootNodes(), 'id', 'title');
        $rootNodes = $categoryRepository->getRootNodes();

        $formMapper->add('title', TextType::class);
        $formMapper->add('parent', ChoiceType::class, [
            'sortable' => true,
            'choices' =>  array_values($rootNodes),
            'choice_label' => function($category, $key, $value) {
                /** @var Category $category */
                return $category->getTitle();
            },
            'choice_attr' => function($category, $key, $value) {
                return ['class' => $category->getId()];
            },
            'placeholder' =>  'Select',
            'required' => false

        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
    }
}