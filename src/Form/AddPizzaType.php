<?php

namespace App\Form;

use Assert\NotBlank;
use App\Entity\Pates;
use App\Entity\Pizza;
use App\Entity\IngredientClassique;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AddPizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=> 'Le nom de ta pizza : ',
                'constraints'=>[
                    new Assert\NotBlank([
                        'message'=>'Le champ nom ne peux pas être vide',]),
                    ],
            ])
            ->add('ingredient_special', TextType::class,[
                'label'=> 'Ton ingrédient spécial : ',
            ])
            ->add('pates', EntityType::class,[
                'class'=> Pates::class,
                'choice_label'=> 'type',
            ])
            ->add('ingredientClassiques', EntityType::class, [
                'class' => IngredientClassique::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'mapped' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (JPEG, PNG, GIF).',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
