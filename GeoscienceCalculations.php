<?php

class GeoscienceCalculations {
    const G = 9.81; // شتاب گرانش (m/s²)
    const R = 8.314; // ثابت گازها (J/mol·K)

    /**
     * فشار اتمسفری با ارتفاع
     * @param float $p0 فشار سطح (Pa)
     * @param float $h ارتفاع (m)
     * @return float فشار (Pa)
     */
    public function atmosphericPressure($p0, $h) {
        if ($p0 <= 0 || $h < 0) return "خطا: مقادیر باید معتبر باشند";
        return $p0 * exp(-self::G * 0.0289644 * $h / (self::R * 288));
    }

    /**
     * شدت زلزله (انرژی)
     * @param float $magnitude بزرگی ریشتر
     * @return float انرژی (J)
     */
    public function earthquakeEnergy($magnitude) {
        if ($magnitude < 0) return "خطا: بزرگی باید نامنفی باشد";
        return pow(10, 1.5 * $magnitude + 4.8);
    }

    /**
     * تست توابع
     */
    public function runTests() {
        echo "atmosphericPressure(101325, 1000): " . $this->atmosphericPressure(101325, 1000) . "\n";
        echo "earthquakeEnergy(5): " . $this->earthquakeEnergy(5) . "\n";
    }
}

$geo = new GeoscienceCalculations();
$geo->runTests();
?>