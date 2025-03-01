<?php

class AstrophysicsCalculations {
    const G = 6.67430e-11; // ثابت گرانش (m³/kg·s²)
    const C = 299792458; // سرعت نور (m/s)
    const SIGMA = 5.670374419e-8; // ثابت استفان-بولتزمان (W/m²·K⁴)

    /**
     * سرعت فرار
     * @param float $m جرم (kg)
     * @param float $r شعاع (m)
     * @return float سرعت فرار (m/s)
     */
    public function escapeVelocity($m, $r) {
        if ($m <= 0 || $r <= 0) return "خطا: مقادیر باید مثبت باشند";
        return sqrt(2 * self::G * $m / $r);
    }

    /**
     * قانون سوم کپلر
     * @param float $m جرم ستاره (kg)
     * @param float $r فاصله (m)
     * @return float دوره تناوب (s)
     */
    public function keplerThirdLaw($m, $r) {
        if ($m <= 0 || $r <= 0) return "خطا: مقادیر باید مثبت باشند";
        return sqrt((4 * M_PI * M_PI * pow($r, 3)) / (self::G * $m));
    }

    /**
     * درخشندگی ستاره
     * @param float $r شعاع (m)
     * @param float $t دما (K)
     * @return float درخشندگی (W)
     */
    public function luminosity($r, $t) {
        if ($r <= 0 || $t <= 0) return "خطا: مقادیر باید مثبت باشند";
        return 4 * M_PI * pow($r, 2) * self::SIGMA * pow($t, 4);
    }

    /**
     * تست توابع
     */
    public function runTests() {
        echo "escapeVelocity(5.972e24, 6.371e6): " . $this->escapeVelocity(5.972e24, 6.371e6) . "\n";
        echo "keplerThirdLaw(1.989e30, 1.496e11): " . $this->keplerThirdLaw(1.989e30, 1.496e11) . "\n";
        echo "luminosity(6.96e8, 5778): " . $this->luminosity(6.96e8, 5778) . "\n";
    }
}

$astro = new AstrophysicsCalculations();
$astro->runTests();
?>