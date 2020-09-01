<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array (
                'class' => 'nav navbar-nav',
            ),
        ));

        $menu->addChild('<i class="fa fa-home"></i>', [
            'route' => 'homepage',
            'extras' => ['safe_label' => true]
        ])
        ->setLinkAttribute('class', 'home');

        $menu->addChild('Giới thiệu', [
            'route' => 'news_show',
            'routeParameters' => ['slug' => 'gioi-thieu']
        ])
        ->setAttribute('class', 'dropdown')
        ->setLinkAttribute('class', 'dropdown-toggle')
        ->setLinkAttribute('data-toggle', 'dropdown')
        ->setChildrenAttribute('class', 'dropdown-menu');

        $menu['Giới thiệu']->addChild('Về chúng tôi', [
            'route' => 'news_show',
            'routeParameters' => ['slug' => 'gioi-thieu']
        ]);

        $menu['Giới thiệu']->addChild('Tuyển dụng', [
            'route' => 'news_show',
            'routeParameters' => ['slug' => 'tuyen-dung-kien-truc-su-xay-dung']
        ]);

        $menu->addChild('Thiết kế', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'thiet-ke-nha']
        ]);

        $menu->addChild('Xây dựng nhà', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'xay-dung-nha']
        ]);

        $menu->addChild('Sửa chữa nhà', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'sua-chua-nha']
        ]);

        $menu->addChild('Bảng giá', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'bang-gia-xay-dung']
        ]);

        $menu->addChild('Dự án', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'du-an']
        ])
        ->setAttribute('class', 'dropdown')
        ->setLinkAttribute('class', 'dropdown-toggle')
        ->setLinkAttribute('data-toggle', 'dropdown')
        ->setChildrenAttribute('class', 'dropdown-menu');

        $menu['Dự án']->addChild('Xây dựng nhà', [
            'route' => 'list_category',
            'routeParameters' => ['level1' => 'du-an', 'level2' => 'thi-cong-xay-dung-nha']
        ]);

        $menu['Dự án']->addChild('Sửa chữa nhà', [
            'route' => 'list_category',
            'routeParameters' => ['level1' => 'du-an', 'level2' => 'thi-cong-sua-chua-nha']
        ]);

        $menu->addChild('Tư vấn', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'cam-nang-xay-dung']
        ]);

        $menu->addChild('Phong thủy', [
            'route' => 'news_category',
            'routeParameters' => ['level1' => 'phong-thuy-xay-dung']
        ]);

        $menu->addChild('Liên hệ', [
            'route' => 'contact'
        ]);

        return $menu;
    }

    public function footerMenu(FactoryInterface $factory, array $options)
    {
        $footerMenu = $factory->createItem('root');

        return $footerMenu;
    }
}