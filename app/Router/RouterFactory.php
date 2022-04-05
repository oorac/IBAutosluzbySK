<?php

declare(strict_types=1);

namespace App\Router;

use Nette\Application\Routers\RouteList;
use Nette\StaticClass;


final class RouterFactory
{
    use StaticClass;

    public static function createRouter(): RouteList
    {
        $adminRouter = new RouteList('Admin');

        $adminRouter->addRoute('admin/zoznamy/auta', 'List:car');
        $adminRouter->addRoute('admin/zoznamy/parametre', 'List:parameter');
        $adminRouter->addRoute('admin/zoznamy/paliva', 'List:fuel');
        $adminRouter->addRoute('admin/zoznamy/tagy', 'List:tag');
        $adminRouter->addRoute('admin/zoznamy/prevodovky', 'List:transmission');
        $adminRouter->addRoute('admin/zoznamy/karoseria', 'List:bodywork');
        $adminRouter->addRoute('admin/zoznamy/znacky', 'List:mark');
        $adminRouter->addRoute('admin/zoznamy/modely', 'List:model');

        $adminRouter->addRoute('admin/nastavenie/dph', 'Settings:vat');
        $adminRouter->addRoute('admin/nastavenie/bloky', 'Settings:block');
        $adminRouter->addRoute('admin/nastavenie/referencie', 'Settings:reference');
        $adminRouter->addRoute('admin/nastavenie', 'Settings:default');

        $adminRouter->addRoute('admin/stranky/auta', 'Page:car');
        $adminRouter->addRoute('admin/stranky/o-nas', 'Page:about');
        $adminRouter->addRoute('admin/stranky/sluzby', 'Page:service');
        $adminRouter->addRoute('admin/stranky/doplnkove-sluzby', 'Page:additionalservice');

        $adminRouter->addRoute('admin/<presenter>/<action>[/<id>]', 'Homepage:default');

        $frontRouter = new RouteList('Front');
        $frontRouter->addRoute('registracia', 'Sign:up');
        $frontRouter->addRoute('prihlasenie', 'Sign:in');
        $frontRouter->addRoute('odhlasenie', 'Sign:out');
        $frontRouter->addRoute('doplnkove-sluzby', 'AdditionalService:default');
        $frontRouter->addRoute('sluzby', 'Service:default');
        $frontRouter->addRoute('auta', 'Car:default');
        $frontRouter->addRoute('o-nas', 'About:default');
        $frontRouter->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');

        $router = new RouteList();
        $router->add($adminRouter);
        $router->add($frontRouter);

        return $router;
    }
}