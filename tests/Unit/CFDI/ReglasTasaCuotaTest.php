<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\Tests\Unit\CFDI;

use PhpCfdi\SatCatalogos\CFDI\ReglasTasaCuota;
use PhpCfdi\SatCatalogos\CFDI\ReglaTasaCuota;
use PhpCfdi\SatCatalogos\Tests\UsingTestingDatabaseTestCase;

class ReglasTasaCuotaTest extends UsingTestingDatabaseTestCase
{
    /** @var ReglasTasaCuota */
    private $reglas;

    public function setUp()
    {
        parent::setUp();
        $this->reglas = new ReglasTasaCuota();
        $this->reglas->withRepository($this->getRepository());
    }

    public function testObtainRules()
    {
        $rules = $this->reglas->obtainRules('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO);
        $this->assertCount(2, $rules);
        $this->assertContainsOnlyInstancesOf(ReglaTasaCuota::class, $rules);

        $rules = $this->reglas->obtainRules('IEPS', 'Cuota', ReglasTasaCuota::USO_TRASLADO);
        $this->assertCount(1, $rules);
        $this->assertContainsOnlyInstancesOf(ReglaTasaCuota::class, $rules);

        $rules = $this->reglas->obtainRules('ISR', 'Tasa', ReglasTasaCuota::USO_RETENCION);
        $this->assertCount(1, $rules);
        $this->assertContainsOnlyInstancesOf(ReglaTasaCuota::class, $rules);
    }

    public function testFindMatchingRule()
    {
        $this->assertNull($this->reglas->findMatchingRule('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO, '0.16'));
        $this->assertNotNull($this->reglas->findMatchingRule('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO, '0.160000'));
        $this->assertNotNull($this->reglas->findMatchingRule('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO, '0.000000'));
    }

    public function testHasValidRule()
    {
        $this->assertFalse($this->reglas->hasMatchingRule('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO, '0.16'));
        $this->assertTrue($this->reglas->hasMatchingRule('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO, '0.160000'));
        $this->assertTrue($this->reglas->hasMatchingRule('IVA', 'Tasa', ReglasTasaCuota::USO_TRASLADO, '0.000000'));
    }
}
