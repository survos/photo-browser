<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MainMenuBuilder
{

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function sidebarMenu(Array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu
            ->setChildrenAttribute('class', 'nav');


        $menu->addChild('Home', array(
            'route' => 'home',
            'extras' => array(
                'icon' => 'fa fa-dashboard fa-fw',
            ),
            ));
        $menu->addChild('Roots', array(
            'extras' =>
                [
                    'icon' => 'fa fa-chess-bishop'
                ],
            'route' => 'digi_kam'));
        return $menu;
        
    }

    public function mainMenu(Array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'home'));
        $menu->addChild('Roots', array('route' => 'digi_kam'));

// access services from the container!
        /*
        $em = $this->container->get('doctrine')->getManager();
// findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('App:Albums')->findMostRecent();

        $menu->addChild('Latest Blog Post', array(
            'route' => 'blog_show',
            'routeParameters' => array('id' => $blog->getId())
        ));
        */
        return $menu;

// create another menu item
        $menu->addChild('About Me', array('route' => 'about'));
// you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

// ... add more children

        return $menu;
    }
}