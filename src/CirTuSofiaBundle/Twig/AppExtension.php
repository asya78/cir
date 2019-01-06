<?php
/**
 * Created by PhpStorm.
 * User: WebDev
 * Date: 4.1.2019 г.
 * Time: 10:11 ч.
 */

namespace CirTuSofiaBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(new TwigFilter('translate',array($this,'trans')));
    }

    /**
     * @param $input
     * @var string $translate
     * @return string
     */
    public function trans($input)
    {
        $translate = '';
        switch ($input) {
            case "ROLE_ADMIN":
                $translate = "Администратор";
                break;
            case "ROLE_LECTOR":
                $translate = "Преподавател";
                break;
            case "ROLE_OPERATOR":
                $translate = "Оператор";
                break;
            case "ROLE_USER":
                $translate = "Потребител";
                break;
        }
        return $translate;
    }

    public function getName()
    {
        return 'translate';
    }
}