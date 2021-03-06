<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\ProductoServicio;
use PhpCfdi\SatCatalogos\EntryInterface;
use PHPUnit\Framework\TestCase;

class ProductoServicioTest extends TestCase
{
    public function testCreateInstance()
    {
        $id = '10101511';
        $texto = 'Cerdos';
        $requiereIvaTrasladado = true;
        $requiereIepsTrasladado = true;
        $requiereComplemento = false;
        $complemento = '';
        $similares = 'Cerdo montés, Chanchos, Chanchos almizcleros';
        $vigenteDesde = strtotime('2017-01-01');
        $vigenteHasta = 0;

        $productoServicio = new ProductoServicio(
            $id,
            $texto,
            $requiereIvaTrasladado,
            $requiereIepsTrasladado,
            $complemento,
            $similares,
            $vigenteDesde,
            $vigenteHasta
        );

        $this->assertInstanceOf(EntryInterface::class, $productoServicio);
        $this->assertSame($id, $productoServicio->id());
        $this->assertSame($texto, $productoServicio->texto());
        $this->assertSame($requiereIvaTrasladado, $productoServicio->requiereIvaTrasladado());
        $this->assertSame($requiereIepsTrasladado, $productoServicio->requiereIepsTrasladado());
        $this->assertSame($requiereComplemento, $productoServicio->requiereComplemento());
        $this->assertSame($complemento, $productoServicio->complemento());
        $this->assertSame($similares, $productoServicio->similares());
        $this->assertSame($vigenteDesde, $productoServicio->vigenteDesde());
        $this->assertSame($vigenteHasta, $productoServicio->vigenteHasta());
    }

    /**
     * @param bool $requiereIvaTrasladado
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRequiereIvaTrasladado(bool $requiereIvaTrasladado)
    {
        $productoServicio = new ProductoServicio('x', 'x', $requiereIvaTrasladado, false, '', '', 0, 0);

        $this->assertSame($requiereIvaTrasladado, $productoServicio->requiereIvaTrasladado());
    }

    /**
     * @param bool $requiereIepsTrasladado
     * @testWith [true]
     *           [false]
     */
    public function testPropertyRequiereIepsTrasladado(bool $requiereIepsTrasladado)
    {
        $productoServicio = new ProductoServicio('x', 'x', false, $requiereIepsTrasladado, '', '', 0, 0);

        $this->assertSame($requiereIepsTrasladado, $productoServicio->requiereIepsTrasladado());
    }

    /**
     * @param bool $expectedValue
     * @param string $complemento
     * @testWith [false, ""]
     *           [true, "Algun complemento"]
     */
    public function testPropertyRequiereComplemento(bool $expectedValue, string $complemento)
    {
        $productoServicio = new ProductoServicio('x', 'x', false, false, $complemento, '', 0, 0);

        $this->assertSame($expectedValue, $productoServicio->requiereComplemento());
    }
}
