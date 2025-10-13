<?php

namespace App\Form;
use App\Entity\Advertiser;
use App\Entity\Offer;
use Dom\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Stream;

class StreamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('offer', EntityType::class,[
                'required' => true,
                'class' => Offer::class,
                'placeholder' => 'Choose offer',
                'label' => 'Offer',
                'choice_label' => function (Offer $offer) {
                return $offer->getTitle() . $offer->getId();
                },
                'mapped' => false,
            ])
            ->add('affiliate', EntityType::class,[
                'required' => true,
                'class' => Advertiser::class,
                'choice_label' => function (Advertiser $advertiser) {
                    return $advertiser->getAffiseTitle() . $advertiser->getId();
                },
                'placeholder' => 'Choose affiliate',
                'label' => 'Affiliate Id',
                'mapped' => false,
            ])
            ->add('geo', ChoiceType::class,[
                'required' => true,
                'label' => 'geo',
            ])
            ->add('Source', ChoiceType::class,[
                'required' => true,
                'label' => 'Source',
            ])
            ->add('start_at', DateType::class,[
                'required' => true,
                'label' => 'Start At',
            ])
            ->add('source_comment', TextareaType::class,[
                'required' => false,
                'label' => 'Source Comment',])
            ->add('stream_comment', TextareaType::class,[
                'required' => false,
                'label' => 'Stream Comment',])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void{
        $resolver->setDefaults([
            'data_class' => Stream::class,
        ]);
    }
}
