<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

use PhpCfdi\SatCatalogos\Exceptions\SatCatalogosLogicException;

class NumeroPedimentoAduana
{
    /** @var string */
    private $aduana;

    /** @var string */
    private $patente;

    /** @var int */
    private $ejercicio;

    /** @var int */
    private $cantidad;

    /** @var int */
    private $vigenteDesde;

    /** @var int */
    private $vigenteHasta;

    public function __construct(
        string $aduana,
        string $patente,
        int $ejercicio,
        int $cantidad,
        int $vigenteDesde,
        int $vigenteHasta
    ) {
        if ('' === $aduana) {
            throw new SatCatalogosLogicException('El campo aduana no puede ser una cadena de caracteres vacía');
        }
        if ('' === $patente) {
            throw new SatCatalogosLogicException('El campo patente no puede ser una cadena de caracteres vacía');
        }
        if ($ejercicio < 0) {
            throw new SatCatalogosLogicException('El campo ejercicio no puede ser menor a cero');
        }
        if ($cantidad < 0) {
            throw new SatCatalogosLogicException('El campo ejercicio no puede ser menor a cero');
        }
        if ($vigenteDesde < 0) {
            throw new SatCatalogosLogicException('El campo vigente desde no puede ser menor a cero');
        }
        if ($vigenteHasta < 0) {
            throw new SatCatalogosLogicException('El campo vigente hasta no puede ser menor a cero');
        }
        $this->aduana = $aduana;
        $this->patente = $patente;
        $this->ejercicio = $ejercicio;
        $this->cantidad = $cantidad;
        $this->vigenteDesde = $vigenteDesde;
        $this->vigenteHasta = $vigenteHasta;
    }

    public function aduana(): string
    {
        return $this->aduana;
    }

    public function patente(): string
    {
        return $this->patente;
    }

    public function ejercicio(): int
    {
        return $this->ejercicio;
    }

    public function cantidad(): int
    {
        return $this->cantidad;
    }

    public function vigenteDesde(): int
    {
        return $this->vigenteDesde;
    }

    public function vigenteHasta(): int
    {
        return $this->vigenteHasta;
    }
}
