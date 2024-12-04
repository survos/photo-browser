<?php

namespace App\Menu;

use App\Entity\Colecta;
use App\Entity\Distrito;
use App\Entity\Especie;
use App\Entity\Familia;
use App\Entity\Genero;
use App\Entity\Location;
use App\Entity\Muestra;
use App\Entity\Municipio;
use App\Entity\Planta;
use App\Entity\Project;
use App\Entity\Region;
use App\Entity\Tax;
use App\Service\AppService;
use Doctrine\Persistence\ManagerRegistry;
use Survos\BaseBundle\Menu\AdminMenuInterface;
use Survos\BaseBundle\Menu\AdminMenuTrait;
use Survos\WorkflowBundle\Service\WorkflowHelperService;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Umbrella\AdminBundle\Menu\BaseAdminMenu;
use Umbrella\AdminBundle\UmbrellaAdminConfiguration;
use Umbrella\CoreBundle\Menu\Builder\MenuBuilder;
use Umbrella\CoreBundle\Menu\Builder\MenuItemBuilder;
use Umbrella\CoreBundle\Menu\DTO\MenuItem;
use function Symfony\Component\String\u;

class AdminMenu extends BaseAdminMenu implements AdminMenuInterface
{
    use AdminMenuTrait;

    public function __construct(private readonly AuthorizationCheckerInterface $security,
                                protected Environment                 $twig,
                                private readonly ManagerRegistry $managerRegistry,
//                                private AppService                    $appService,
                                protected UmbrellaAdminConfiguration  $configuration,
//                                private WorkflowHelperService         $workflowHelper,
    )
    {
        parent::__construct($this->twig, $configuration);
    }

    private function getLocationRanks()
    {
        return $this->managerRegistry->getRepository(Location::class)->getCounts('locationRank');
    }


    public function buildMenu(MenuBuilder $builder, array $options)
    {

        $rootMenu = null;
        $taxMenu = null;
        $subMenu = null;
        $options = (new OptionsResolver())
            ->setDefaults([
                'jurisdiction' => null
            ])->resolve($options);

        $menu = $builder->root();


        $this->addMenuItem($menu, [
            'route' => 'home',
            'extras' => ['icon' => 'fa fa-dashboard fa-fw'],
        ]);



    }

}
