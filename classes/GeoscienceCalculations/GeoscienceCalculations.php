<?php

class GeoscienceCalculations {
    const G = 9.81; // Gravitational acceleration (m/s²)
    const R = 8.314; // Universal gas constant (J/mol·K)
    const MOLAR_MASS_AIR = 0.0289644; // Molar mass of Earth's air (kg/mol)
    const STANDARD_TEMP = 288; // Standard temperature for atmospheric calculations (K)

    /**
     * Calculate atmospheric pressure with altitude
     * @param float $p0 Surface pressure (Pa by default)
     * @param float $h Height above sea level (m by default)
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "hPa")
     * @param string $unitHeight Unit for height (default: "m", options: "km")
     * @return float|string Pressure at height or error message
     */
    public function atmosphericPressure($p0, $h, $unitPressure = "Pa", $unitHeight = "m") {
        if ($p0 <= 0 || $h < 0) return "Error: Surface pressure must be positive and height must be non-negative";
        if (!is_numeric($p0) || !is_numeric($h)) return "Error: Inputs must be numeric";

        // Convert units to SI base (Pa, m)
        $convertedPressure = $unitPressure === "hPa" ? $p0 * 100 : $p0; // hPa to Pa
        $convertedHeight = $unitHeight === "km" ? $h * 1000 : $h; // km to m

        // P = P₀ * exp(-gMh/RT)
        $result = $convertedPressure * exp(-self::G * self::MOLAR_MASS_AIR * $convertedHeight / (self::R * self::STANDARD_TEMP));

        if ($unitPressure === "hPa") return $result / 100; // Pa to hPa
        return $result; // Default Pa
    }

    /**
     * Calculate earthquake energy from Richter magnitude
     * @param float $magnitude Richter magnitude
     * @param string $unitEnergy Unit for energy (default: "J", options: "kJ")
     * @return float|string Energy in Joules or error message
     */
    public function earthquakeEnergy($magnitude, $unitEnergy = "J") {
        if ($magnitude < 0) return "Error: Magnitude must be non-negative";
        if (!is_numeric($magnitude)) return "Error: Magnitude must be numeric";

        // E = 10^(1.5M + 4.8)
        $result = pow(10, 1.5 * $magnitude + 4.8);

        if ($unitEnergy === "kJ") return $result / 1000; // J to kJ
        return $result; // Default J
    }

    /**
     * Calculate hydrostatic pressure in a fluid column
     * @param float $rho Density of fluid (kg/m³ by default)
     * @param float $h Depth (m by default)
     * @param string $unitDensity Unit for density (default: "kg/m³", options: "g/cm³")
     * @param string $unitDepth Unit for depth (default: "m", options: "km")
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "MPa")
     * @return float|string Pressure or error message
     */
    public function hydrostaticPressure($rho, $h, $unitDensity = "kg/m³", $unitDepth = "m", $unitPressure = "Pa") {
        if ($rho <= 0 || $h < 0) return "Error: Density must be positive and depth must be non-negative";
        if (!is_numeric($rho) || !is_numeric($h)) return "Error: Inputs must be numeric";

        // Convert units to SI base (kg/m³, m)
        $convertedDensity = $unitDensity === "g/cm³" ? $rho * 1000 : $rho; // g/cm³ to kg/m³
        $convertedDepth = $unitDepth === "km" ? $h * 1000 : $h; // km to m

        // P = ρgh
        $result = $convertedDensity * self::G * $convertedDepth;

        if ($unitPressure === "MPa") return $result / 1e6; // Pa to MPa
        return $result; // Default Pa
    }

    /**
     * Calculate heat flow through the Earth's crust (Fourier's Law)
     * @param float $k Thermal conductivity (W/m·K by default)
     * @param float $dT Temperature difference (K by default)
     * @param float $dx Thickness of the layer (m by default)
     * @param string $unitConductivity Unit for thermal conductivity (default: "W/m·K", options: "mW/m·K")
     * @param string $unitThickness Unit for thickness (default: "m", options: "km")
     * @param string $unitHeatFlow Unit for heat flow (default: "W/m²", options: "mW/m²")
     * @return float|string Heat flow or error message
     */
    public function heatFlow($k, $dT, $dx, $unitConductivity = "W/m·K", $unitThickness = "m", $unitHeatFlow = "W/m²") {
        if ($k <= 0 || $dx <= 0) return "Error: Thermal conductivity and thickness must be positive";
        if (!is_numeric($k) || !is_numeric($dT) || !is_numeric($dx)) return "Error: Inputs must be numeric";

        // Convert units to SI base (W/m·K, m)
        $convertedConductivity = $unitConductivity === "mW/m·K" ? $k / 1000 : $k; // mW/m·K to W/m·K
        $convertedThickness = $unitThickness === "km" ? $dx * 1000 : $dx; // km to m

        // q = -k * (dT/dx)
        $result = $convertedConductivity * ($dT / $convertedThickness);

        if ($unitHeatFlow === "mW/m²") return $result * 1000; // W/m² to mW/m²
        return $result; // Default W/m²
    }

    /**
     * Calculate gravity anomaly (simplified Bouguer correction)
     * @param float $rho Density contrast (kg/m³ by default)
     * @param float $h Thickness of slab (m by default)
     * @param string $unitDensity Unit for density (default: "kg/m³", options: "g/cm³")
     * @param string $unitThickness Unit for thickness (default: "m", options: "km")
     * @param string $unitGravity Unit for gravity anomaly (default: "mGal", options: "Gal")
     * @return float|string Gravity anomaly or error message
     */
    public function gravityAnomaly($rho, $h, $unitDensity = "kg/m³", $unitThickness = "m", $unitGravity = "mGal") {
        if ($h <= 0) return "Error: Thickness must be positive";
        if (!is_numeric($rho) || !is_numeric($h)) return "Error: Inputs must be numeric";

        // Convert units to SI base (kg/m³, m)
        $convertedDensity = $unitDensity === "g/cm³" ? $rho * 1000 : $rho; // g/cm³ to kg/m³
        $convertedThickness = $unitThickness === "km" ? $h * 1000 : $h; // km to m

        // Δg = 2πGρh (in m/s²)
        $result = 2 * M_PI * self::G * $convertedDensity * $convertedThickness;

        if ($unitGravity === "mGal") return $result * 1e5; // m/s² to mGal (1 mGal = 10^-5 m/s²)
        return $result * 100; // m/s² to Gal (1 Gal = 0.01 m/s²)
    }

    /**
     * Calculate porosity of sediments
     * @param float $vPore Pore volume (m³ by default)
     * @param float $vTotal Total volume (m³ by default)
     * @param string $unitVolume Unit for volume (default: "m³", options: "cm³")
     * @return float|string Porosity (fraction) or error message
     */
    public function porosity($vPore, $vTotal, $unitVolume = "m³") {
        if ($vPore < 0 || $vTotal <= 0 || $vPore > $vTotal) return "Error: Pore volume must be non-negative, total volume must be positive, and pore volume must not exceed total volume";
        if (!is_numeric($vPore) || !is_numeric($vTotal)) return "Error: Inputs must be numeric";

        // Convert units if necessary (volume units cancel out in ratio)
        // φ = V_pore / V_total
        return $vPore / $vTotal; // Porosity as a fraction
    }

    /**
     * Calculate isostatic compensation depth (simplified Pratt model)
     * @param float $rhoCrust Density of crust (kg/m³ by default)
     * @param float $rhoMantle Density of mantle (kg/m³ by default)
     * @param float $hCrust Thickness of crust (m by default)
     * @param string $unitDensity Unit for density (default: "kg/m³", options: "g/cm³")
     * @param string $unitThickness Unit for thickness (default: "m", options: "km")
     * @param string $unitDepth Unit for depth (default: "m", options: "km")
     * @return float|string Depth of compensation or error message
     */
    public function isostaticCompensationDepth($rhoCrust, $rhoMantle, $hCrust, $unitDensity = "kg/m³", $unitThickness = "m", $unitDepth = "m") {
        if ($rhoCrust <= 0 || $rhoMantle <= 0 || $hCrust <= 0) return "Error: Densities and thickness must be positive";
        if ($rhoCrust >= $rhoMantle) return "Error: Crust density must be less than mantle density";
        if (!is_numeric($rhoCrust) || !is_numeric($rhoMantle) || !is_numeric($hCrust)) return "Error: Inputs must be numeric";

        // Convert units to SI base (kg/m³, m)
        $convertedCrustDensity = $unitDensity === "g/cm³" ? $rhoCrust * 1000 : $rhoCrust;
        $convertedMantleDensity = $unitDensity === "g/cm³" ? $rhoMantle * 1000 : $rhoMantle;
        $convertedThickness = $unitThickness === "km" ? $hCrust * 1000 : $hCrust; // km to m

        // d = h * (ρ_mantle / (ρ_mantle - ρ_crust))
        $result = $convertedThickness * ($convertedMantleDensity / ($convertedMantleDensity - $convertedCrustDensity));

        if ($unitDepth === "km") return $result / 1000; // m to km
        return $result; // Default m
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing GeoscienceCalculations:\n";
        echo "----------------------------------------\n";

        // Group 1: Atmospheric and Seismic Calculations
        echo "Group 1: Atmospheric and Seismic Calculations\n";
        echo "-------------------------\n";
        echo "// Test atmospheric pressure with P0=101325 Pa, h=1000 m\n";
        $result = $this->atmosphericPressure(101325, 1000);
        echo "atmosphericPressure(101325, 1000): $result Pa (Expected: ~89210)\n";
        assert(abs($result - 89210) < 100, "Test failed: atmosphericPressure(101325, 1000)");

        echo "// Test atmospheric pressure with P0=1013 hPa, h=1 km, unitPressure='hPa', unitHeight='km'\n";
        $result = $this->atmosphericPressure(1013, 1, "hPa", "km");
        echo "atmosphericPressure(1013, 1, 'hPa', 'km'): $result hPa (Expected: ~892.1)\n";
        assert(abs($result - 892.1) < 1, "Test failed: atmosphericPressure(1013, 1, 'hPa', 'km')");

        echo "// Test earthquake energy with magnitude=5\n";
        $result = $this->earthquakeEnergy(5);
        echo "earthquakeEnergy(5): $result J (Expected: ~2e12)\n";
        assert(abs($result - 2e12) < 1e11, "Test failed: earthquakeEnergy(5)");

        echo "// Test earthquake energy with magnitude=3, unitEnergy='kJ'\n";
        $result = $this->earthquakeEnergy(3, "kJ");
        echo "earthquakeEnergy(3, 'kJ'): $result kJ (Expected: ~2000000)\n";
        assert(abs($result - 2000000) < 100000, "Test failed: earthquakeEnergy(3, 'kJ')");

        // Group 2: Hydrostatic and Thermal Calculations
        echo "\nGroup 2: Hydrostatic and Thermal Calculations\n";
        echo "-------------------------\n";
        echo "// Test hydrostatic pressure with ρ=1000 kg/m³, h=10 m\n";
        $result = $this->hydrostaticPressure(1000, 10);
        echo "hydrostaticPressure(1000, 10): $result Pa (Expected: 98100)\n";
        assert(abs($result - 98100) < 100, "Test failed: hydrostaticPressure(1000, 10)");

        echo "// Test hydrostatic pressure with ρ=1 g/cm³, h=1 km, unitPressure='MPa'\n";
        $result = $this->hydrostaticPressure(1, 1, "g/cm³", "km", "MPa");
        echo "hydrostaticPressure(1, 1, 'g/cm³', 'km', 'MPa'): $result MPa (Expected: ~9.81)\n";
        assert(abs($result - 9.81) < 0.1, "Test failed: hydrostaticPressure(1, 1, 'g/cm³', 'km', 'MPa')");

        echo "// Test heat flow with k=2 W/m·K, dT=50 K, dx=1000 m\n";
        $result = $this->heatFlow(2, 50, 1000);
        echo "heatFlow(2, 50, 1000): $result W/m² (Expected: 0.1)\n";
        assert(abs($result - 0.1) < 0.01, "Test failed: heatFlow(2, 50, 1000)");

        echo "// Test heat flow with k=2000 mW/m·K, dT=50 K, dx=1 km, unitHeatFlow='mW/m²'\n";
        $result = $this->heatFlow(2000, 50, 1, "mW/m·K", "km", "mW/m²");
        echo "heatFlow(2000, 50, 1, 'mW/m·K', 'km', 'mW/m²'): $result mW/m² (Expected: 100)\n";
        assert(abs($result - 100) < 1, "Test failed: heatFlow(2000, 50, 1, 'mW/m·K', 'km', 'mW/m²')");

        // Group 3: Geophysical Calculations
        echo "\nGroup 3: Geophysical Calculations\n";
        echo "-------------------------\n";
        echo "// Test gravity anomaly with ρ=2000 kg/m³, h=100 m\n";
        $result = $this->gravityAnomaly(2000, 100);
        echo "gravityAnomaly(2000, 100): $result mGal (Expected: ~838)\n";
        assert(abs($result - 838) < 10, "Test failed: gravityAnomaly(2000, 100)");

        echo "// Test gravity anomaly with ρ=2 g/cm³, h=1 km, unitGravity='Gal'\n";
        $result = $this->gravityAnomaly(2, 1, "g/cm³", "km", "Gal");
        echo "gravityAnomaly(2, 1, 'g/cm³', 'km', 'Gal'): $result Gal (Expected: ~0.838)\n";
        assert(abs($result - 0.838) < 0.01, "Test failed: gravityAnomaly(2, 1, 'g/cm³', 'km', 'Gal')");

        echo "// Test porosity with V_pore=0.2 m³, V_total=1 m³\n";
        $result = $this->porosity(0.2, 1);
        echo "porosity(0.2, 1): $result (Expected: 0.2)\n";
        assert(abs($result - 0.2) < 0.01, "Test failed: porosity(0.2, 1)");

        echo "// Test isostatic compensation depth with ρ_crust=2700 kg/m³, ρ_mantle=3300 kg/m³, h=30000 m\n";
        $result = $this->isostaticCompensationDepth(2700, 3300, 30000);
        echo "isostaticCompensationDepth(2700, 3300, 30000): $result m (Expected: 165000)\n";
        assert(abs($result - 165000) < 1000, "Test failed: isostaticCompensationDepth(2700, 3300, 30000)");

        echo "// Test isostatic compensation depth with ρ_crust=2.7 g/cm³, ρ_mantle=3.3 g/cm³, h=30 km, unitDepth='km'\n";
        $result = $this->isostaticCompensationDepth(2.7, 3.3, 30, "g/cm³", "km", "km");
        echo "isostaticCompensationDepth(2.7, 3.3, 30, 'g/cm³', 'km', 'km'): $result km (Expected: ~165)\n";
        assert(abs($result - 165) < 1, "Test failed: isostaticCompensationDepth(2.7, 3.3, 30, 'g/cm³', 'km', 'km')");

        // Error Condition Tests
        echo "\nError Condition Tests\n";
        echo "-------------------------\n";
        echo "// Test atmosphericPressure with negative height\n";
        echo "atmosphericPressure(101325, -1000): " . $this->atmosphericPressure(101325, -1000) . " (Expected: Error: Surface pressure must be positive and height must be non-negative)\n";
        
        echo "// Test earthquakeEnergy with negative magnitude\n";
        echo "earthquakeEnergy(-1): " . $this->earthquakeEnergy(-1) . " (Expected: Error: Magnitude must be non-negative)\n";
        
        echo "// Test hydrostaticPressure with zero density\n";
        echo "hydrostaticPressure(0, 10): " . $this->hydrostaticPressure(0, 10) . " (Expected: Error: Density must be positive and depth must be non-negative)\n";
        
        echo "// Test heatFlow with zero thickness\n";
        echo "heatFlow(2, 50, 0): " . $this->heatFlow(2, 50, 0) . " (Expected: Error: Thermal conductivity and thickness must be positive)\n";
        
        echo "// Test gravityAnomaly with negative thickness\n";
        echo "gravityAnomaly(2000, -100): " . $this->gravityAnomaly(2000, -100) . " (Expected: Error: Thickness must be positive)\n";
        
        echo "// Test porosity with V_pore > V_total\n";
        echo "porosity(1.5, 1): " . $this->porosity(1.5, 1) . " (Expected: Error: Pore volume must be non-negative, total volume must be positive, and pore volume must not exceed total volume)\n";
        
        echo "// Test isostaticCompensationDepth with ρ_crust >= ρ_mantle\n";
        echo "isostaticCompensationDepth(3300, 3300, 30000): " . $this->isostaticCompensationDepth(3300, 3300, 30000) . " (Expected: Error: Crust density must be less than mantle density)\n";

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$geo = new GeoscienceCalculations();
$geo->runTests();
?>