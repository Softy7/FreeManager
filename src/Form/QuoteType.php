<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Quote;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Brouillon'  => Quote::STATUS_DRAFT,     // Affiche "Brouillon", stocke 0
                    'En attente' => Quote::STATUS_PENDING,   // Affiche "En attente", stocke 1
                    'Validé'     => Quote::STATUS_VALIDATED, // Affiche "Validé", stocke 2
                    'Refusé'     => Quote::STATUS_REJECTED,  // Affiche "Refusé", stocke 3
                    'Payé'       => Quote::STATUS_PAID,      // Affiche "Payé", stocke 4
                ],
                    'label' => 'Statut du devis'
                ])
            ->add('total_ht')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'getDisplayName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Quote::class,
        ]);
    }
}
