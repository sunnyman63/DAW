<?php
// src/Twig/AppExtension.php
namespace App\Twig;

use App\Entity\Liga;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('fechaIni', [$this, 'getFechaIni']),
            new TwigFunction('fechaFin', [$this, 'getFechaFin']),
        ];
    }

    public function getFechaIni(Liga $liga): ?\DateTimeInterface
    {
        return $liga->getFechaInicio();
    }

    public function getFechaFin(Liga $liga): ?\DateTimeInterface
    {
        return $liga->getFechaFin();
    }
}