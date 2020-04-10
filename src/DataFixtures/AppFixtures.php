<?php


namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {


        $admin = new Admin();
        $admin->setUsername('admin')
            ->setPassword('admin')
            ->setEmail('admin@admin.com');

        $encoded = $this->encoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($encoded);
        $manager->persist($admin);

        for ($i = 1; $i < 20; $i++) {
            $article = new Article();
            $article->setTitle('Une replique culte : ' . $i)
                ->setIntroduction('c\'est une bonne situation ça "script" ?')
                ->setContenu(' Vous savez, moi je ne crois pas qu’il y ait de bonne ou de mauvaise situation. Moi, si je devais résumer ma vie aujourd’hui avec vous, je dirais que c’est d’abord des rencontres. Des gens qui m’ont tendu la main, peut-être à un moment où je ne pouvais pas, où j’étais seul chez moi. Et c’est assez curieux de se dire que les hasards, les rencontres forgent une destinée… Parce que quand on a le goût de la chose, quand on a le goût de la chose bien faite, le beau geste, parfois on ne trouve pas l’interlocuteur en face je dirais, le miroir qui vous aide à avancer. Alors ça n’est pas mon cas, comme je disais là, puisque moi au contraire, j’ai pu : et je dis merci à la vie, je lui dis merci, je chante la vie, je danse la vie… je ne suis qu’amour ! Et finalement, quand beaucoup de gens aujourd’hui me disent « Mais comment fais-tu pour avoir cette humanité ? », et bien je leur réponds très simplement, je leur dis que c’est ce goût de l’amour ce goût donc qui m’a poussé aujourd’hui à entreprendre une construction mécanique, mais demain qui sait ? Peut-être simplement à me mettre au service de la communauté, à faire le don, le don de soi… ')
                ->setImage('https://picsum.photos/350/180')
                ->setSource('Astérix et Obélix : mission Cléopâtre, Panoramix et Otis.');
            $manager->persist($article);
        }
        $manager->flush();
    }
}
