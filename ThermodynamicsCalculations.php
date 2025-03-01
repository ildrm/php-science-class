<?php

require_once 'PhysicsCalculations.php'; // For using higher-priority class functions

class ThermodynamicsCalculations {
    const R = 8.314462618; // Universal gas constant (J/mol·K)
    const NA = 6.02214076e23; // Avogadro's number (1/mol)
    const KB = 1.380649e-23; // Boltzmann constant (J/K)
    const ATM_TO_PA = 101325; // Conversion from atm to Pa
    const CAL_TO_J = 4.184; // Conversion from cal to J

    private $physics;

    public function __construct() {
        $this->physics = new PhysicsCalculations();
    }

    /**
     * Calculate ideal gas pressure (P = nRT / V)
     * @param float $n Number of moles (mol)
     * @param float $t Temperature (default: K)
     * @param float $v Volume (default: m³)
     * @param string $unitPressure Pressure unit (default: Pa)
     * @param string $unitTemperature Temperature unit (default: K)
     * @param string $unitVolume Volume unit (default: m³)
     * @return float|string Pressure or error message
     */
    public function idealGasPressure($n, $t, $v, $unitPressure = "Pa", $unitTemperature = "K", $unitVolume = "m³") {
        return $this->physics->idealGasPressure($n, $t, $v, $unitPressure, $unitTemperature, $unitVolume);
    }

    /**
     * Calculate work in isothermal process (W = nRT ln(V2 / V1))
     * @param float $n Number of moles (mol)
     * @param float $t Temperature (default: K)
     * @param float $v1 Initial volume (default: m³)
     * @param float $v2 Final volume (default: m³)
     * @param string $unitTemperature Temperature unit (default: K)
     * @param string $unitVolume Volume unit (default: m³)
     * @param string $unitWork Work unit (default: J)
     * @return float|string Work done or error message
     */
    public function workIsothermal($n, $t, $v1, $v2, $unitTemperature = "K", $unitVolume = "m³", $unitWork = "J") {
        if ($n <= 0 || $t <= 0 || $v1 <= 0 || $v2 <= 0) return "Error: All inputs must be positive";
        
        if ($unitTemperature === "C") $t += 273.15; // Convert C to K
        if ($unitVolume === "L") {
            $v1 /= 1000; // Convert L to m³
            $v2 /= 1000;
        }
        
        $result = $n * self::R * $t * log($v2 / $v1); // Work in J
        
        if ($unitWork === "kJ") return $result / 1000; // J to kJ
        elseif ($unitWork === "cal") return $result / self::CAL_TO_J; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate heat transferred (Q = ΔU + W)
     * @param float $deltaU Change in internal energy (default: J)
     * @param float $w Work done (default: J)
     * @param string $unitEnergy Energy unit (default: J)
     * @return float|string Heat or error message
     */
    public function heatTransferred($deltaU, $w, $unitEnergy = "J") {
        if ($unitEnergy === "kJ") {
            $deltaU *= 1000; // kJ to J
            $w *= 1000;
        } elseif ($unitEnergy === "cal") {
            $deltaU *= self::CAL_TO_J; // cal to J
            $w *= self::CAL_TO_J;
        }
        
        $result = $deltaU + $w; // Heat in J
        
        if ($unitEnergy === "kJ") return $result / 1000; // J to kJ
        elseif ($unitEnergy === "cal") return $result / self::CAL_TO_J; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate efficiency of heat engine (η = 1 - T_cold / T_hot)
     * @param float $tHot Temperature of hot reservoir (default: K)
     * @param float $tCold Temperature of cold reservoir (default: K)
     * @param string $unitTemperature Temperature unit (default: K)
     * @return float|string Efficiency or error message
     */
    public function efficiencyHeatEngine($tHot, $tCold, $unitTemperature = "K") {
        if ($unitTemperature === "C") {
            $tHot += 273.15; // Convert C to K
            $tCold += 273.15;
        }
        if ($tHot <= $tCold || $tHot <= 0 || $tCold <= 0) return "Error: Invalid temperatures";
        return 1 - ($tCold / $tHot); // Efficiency (unitless)
    }

    /**
     * Calculate coefficient of performance for refrigerator (COP = T_cold / (T_hot - T_cold))
     * @param float $tHot Temperature of hot reservoir (default: K)
     * @param float $tCold Temperature of cold reservoir (default: K)
     * @param string $unitTemperature Temperature unit (default: K)
     * @return float|string COP or error message
     */
    public function copRefrigerator($tHot, $tCold, $unitTemperature = "K") {
        if ($unitTemperature === "C") {
            $tHot += 273.15; // Convert C to K
            $tCold += 273.15;
        }
        if ($tHot <= $tCold || $tHot <= 0 || $tCold <= 0) return "Error: Invalid temperatures";
        return $tCold / ($tHot - $tCold); // COP (unitless)
    }

    /**
     * Calculate entropy change (ΔS = Q_rev / T)
     * @param float $qRev Reversible heat (default: J)
     * @param float $t Temperature (default: K)
     * @param string $unitHeat Heat unit (default: J)
     * @param string $unitTemperature Temperature unit (default: K)
     * @param string $unitEntropy Entropy unit (default: J/K)
     * @return float|string Entropy change or error message
     */
    public function entropyChange($qRev, $t, $unitHeat = "J", $unitTemperature = "K", $unitEntropy = "J/K") {
        if ($t <= 0) return "Error: Temperature must be positive";
        
        if ($unitHeat === "cal") $qRev *= self::CAL_TO_J; // cal to J
        if ($unitTemperature === "C") $t += 273.15; // C to K
        
        $result = $qRev / $t; // Entropy in J/K
        
        if ($unitEntropy === "cal/K") return $result / self::CAL_TO_J; // J/K to cal/K
        return $result; // Default J/K
    }

    /**
     * Calculate specific heat capacity at constant volume (C_v)
     * For monatomic gas: C_v = (3/2)R, for diatomic gas: C_v = (5/2)R
     * @param string $gasType Gas type (monatomic or diatomic)
     * @return float|string Specific heat or error message
     */
    public function specificHeatCapacityVolume($gasType) {
        switch (strtolower($gasType)) {
            case "monatomic":
                return (3 / 2) * self::R; // J/mol·K
            case "diatomic":
                return (5 / 2) * self::R; // J/mol·K
            default:
                return "Error: Unsupported gas type";
        }
    }

    /**
     * Calculate specific heat capacity at constant pressure (C_p = C_v + R)
     * @param float $cv Specific heat at constant volume (J/mol·K)
     * @return float Specific heat at constant pressure (J/mol·K)
     */
    public function specificHeatCapacityPressure($cv) {
        return $cv + self::R; // J/mol·K
    }

    /**
     * Run comprehensive tests for all functions
     * @return void
     */
    public function runTests() {
        echo "Start Testing ThermodynamicsCalculations:\n";
        echo "----------------------------------------\n";

        // Group 1: Ideal Gas Law Tests
        echo "Group 1: Ideal Gas Law Tests\n";
        echo "----------------------------\n";
        echo "Test 1: Calculate pressure with n=1 mol, T=300 K, V=0.025 m³\n";
        echo "Result: " . $this->idealGasPressure(1, 300, 0.025) . " Pa (Expected: ~99735.14)\n";
        echo "Test 2: Calculate pressure with n=2 mol, T=25 C, V=50 L, unitPressure='atm'\n";
        echo "Result: " . $this->idealGasPressure(2, 25, 50, "atm", "C", "L") . " atm (Expected: ~0.983)\n";

        // Group 2: Work and Heat Tests
        echo "\nGroup 2: Work and Heat Tests\n";
        echo "----------------------------\n";
        echo "Test 3: Calculate work in isothermal process with n=1 mol, T=300 K, V1=0.01 m³, V2=0.02 m³\n";
        echo "Result: " . $this->workIsothermal(1, 300, 0.01, 0.02) . " J (Expected: ~1728.64)\n";
        echo "Test 4: Calculate work with n=2 mol, T=25 C, V1=10 L, V2=20 L, unitWork='kJ'\n";
        echo "Result: " . $this->workIsothermal(2, 25, 10, 20, "C", "L", "kJ") . " kJ (Expected: ~3.457)\n";
        echo "Test 5: Calculate heat transferred with ΔU=1000 J, W=500 J\n";
        echo "Result: " . $this->heatTransferred(1000, 500) . " J (Expected: 1500)\n";

        // Group 3: Efficiency and COP Tests
        echo "\nGroup 3: Efficiency and COP Tests\n";
        echo "----------------------------\n";
        echo "Test 6: Calculate efficiency of heat engine with T_hot=500 K, T_cold=300 K\n";
        echo "Result: " . $this->efficiencyHeatEngine(500, 300) . " (Expected: 0.4)\n";
        echo "Test 7: Calculate COP of refrigerator with T_hot=300 K, T_cold=250 K\n";
        echo "Result: " . $this->copRefrigerator(300, 250) . " (Expected: 5)\n";

        // Group 4: Entropy and Specific Heat Tests
        echo "\nGroup 4: Entropy and Specific Heat Tests\n";
        echo "----------------------------\n";
        echo "Test 8: Calculate entropy change with Q_rev=1000 J, T=300 K\n";
        echo "Result: " . $this->entropyChange(1000, 300) . " J/K (Expected: ~3.3333)\n";
        echo "Test 9: Calculate specific heat at constant volume for monatomic gas\n";
        echo "Result: " . $this->specificHeatCapacityVolume("monatomic") . " J/mol·K (Expected: 12.4717)\n";

        // Error Condition Tests
        echo "\nError Condition Tests\n";
        echo "----------------------------\n";
        echo "Test 10: Calculate pressure with V=0\n";
        echo "Result: " . $this->idealGasPressure(1, 300, 0) . " (Expected: Error)\n";
        echo "Test 11: Calculate efficiency with T_cold > T_hot\n";
        echo "Result: " . $this->efficiencyHeatEngine(300, 500) . " (Expected: Error)\n";

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$thermo = new ThermodynamicsCalculations();
$thermo->runTests();
?>