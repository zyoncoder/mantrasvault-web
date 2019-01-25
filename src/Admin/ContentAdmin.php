<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Content;
use App\Entity\Category;
use App\Entity\User;

final class ContentAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $categoryRepository = $entityManager->getRepository(Category::class);
        $userRepository = $entityManager->getRepository(User::class);

        $users = $userRepository->findAll();
        $rootNodes = $categoryRepository->getRootNodes();

        $formMapper->add('title', TextType::class);
        $formMapper->add('category', ChoiceType::class, [
            'sortable' => true,
            'choices' =>  $rootNodes,
            'choice_label' => function($category, $key, $value) {
                return $category->getTitle();
            },
            'choice_value' => function($category) {
                return $category ? $category->getId() : '';
            },
            'placeholder' =>  'Select',
            'required' => false

        ]);

        $formMapper->add('user', ChoiceType::class, [
            'sortable' => true,
            'choices' =>  $users,
            'choice_label' => function($user, $key, $value) {
                return $user->getEmail();
            },

            'choice_value' => function($user) {
                return $user ? $user->getId() : '';
            },
            'placeholder' =>  'Select',
            'required' => false

        ]);
        $formMapper->add('short_description', TextareaType::class, [
            'attr' => ['class' => 'tinymce'],
        ]);

        $formMapper->add('description', TextareaType::class, [
            'attr' => ['class' => 'tinymce'],
        ]);

        $formMapper->add('status', ChoiceType::class, [
            'sortable' => true,
            'choices' =>  ['draft' => 'draft', 'published' => 'published']
        ]);


    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->add('slug')
            ->add('_action', 'actions', [
                'actions' => [
                    'edit' => [],
                    'delete' => []
                ]
            ]);
    }
}