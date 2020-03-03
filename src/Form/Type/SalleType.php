<?php
namespace App\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Salle;
class SalleType extends AbstractType {
 public function buildForm(FormBuilderInterface $builder, array $options) {
 $builder->add('batiment', TextType::class)
 ->add('etage', TextType::class)
 ->add('numero', TextType::class) ;
 }
 public function configureOptions(OptionsResolver $resolver) {
 $resolver->setDefaults(array(
 'data_class' => Salle::class,
 ));
 }
}