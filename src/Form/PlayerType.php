<?php

namespace App\Form;

use App\Entity\Player;
use App\Enum\PlayerCategoryEnumType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('category', ChoiceType::class, [
                'choices' => $this->getCategoryChoices(),
            ])
        ;
    }

    private function getCategoryChoices(): array
    {
        $reflectionClass = new \ReflectionClass(PlayerCategoryEnumType::class);
        $constants = $reflectionClass->getConstants();

        $choices = [];
        foreach ($constants as $constant) {
            $choices[$constant] = $constant;
        }

        return $choices;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}

