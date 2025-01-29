<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Enum\PrioriteTicketEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('category', ChoiceType::class, [
                'choices' => [
                    'Bug' => 'bug',
                    'Feature Request' => 'feature_request',
                    'Support' => 'support',
                ],
                'label' => 'Categories',
            ])
            ->add('priorite', ChoiceType::class, [
                'choices' => [
                    'Basse' => PrioriteTicketEnum::BASSE,
                    'Normale' => PrioriteTicketEnum::NORMALE,
                    'Haute' => PrioriteTicketEnum::HAUTE,
                ],
                'label' => 'Priorité',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['rows' => 10],
            ])
            ->add('attachment', FileType::class, [
                'label' => 'Ajouter un fichier',
                'required' => false,
            ])
            ->add('save_draft', SubmitType::class, [
                'label' => 'Sauvegarder comme brouillon',
                'attr' => ['class' => 'btn btn-secondary'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre le ticket',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}