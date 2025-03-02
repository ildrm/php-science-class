<?php

class MechanicsCalculations {
    const G = 9.81; // Gravitational acceleration (m/s²)

    /**
     * Calculate stress (σ = F / A)
     * @param float $f Force (N by default)
     * @param float $a Cross-sectional area (m² by default)
     * @param string $unitForce Unit for force (default: "N", options: "kN", "lbf")
     * @param string $unitArea Unit for area (default: "m²", options: "cm²", "in²")
     * @param string $unitStress Unit for stress (default: "Pa", options: "kPa", "MPa", "psi")
     * @return float|string Stress or error message
     */
    public function stress($f, $a, $unitForce = "N", $unitArea = "m²", $unitStress = "Pa") {
        if ($a <= 0) return "Error: Area must be positive";
        if ($f < 0) return "Error: Force cannot be negative";
        
        // Convert force to N
        if ($unitForce === "kN") $f *= 1000; // kN to N
        elseif ($unitForce === "lbf") $f *= 4.44822; // lbf to N
        
        // Convert area to m²
        if ($unitArea === "cm²") $a /= 10000; // cm² to m²
        elseif ($unitArea === "in²") $a *= 0.00064516; // in² to m²
        
        $result = $f / $a; // Stress in Pa
        
        // Convert stress to desired unit
        if ($unitStress === "kPa") return $result / 1000; // Pa to kPa
        elseif ($unitStress === "MPa") return $result / 1e6; // Pa to MPa
        elseif ($unitStress === "psi") return $result * 0.000145038; // Pa to psi
        return $result; // Default Pa
    }

    /**
     * Calculate strain (ε = ΔL / L₀)
     * @param float $deltaL Change in length (m by default)
     * @param float $l0 Original length (m by default)
     * @param string $unitLength Unit for length (default: "m", options: "mm", "in")
     * @return float|string Strain or error message
     */
    public function strain($deltaL, $l0, $unitLength = "m") {
        if ($l0 <= 0) return "Error: Original length must be positive";
        
        // Convert lengths to consistent units (m)
        if ($unitLength === "mm") {
            $deltaL /= 1000; // mm to m
            $l0 /= 1000;
        } elseif ($unitLength === "in") {
            $deltaL *= 0.0254; // in to m
            $l0 *= 0.0254;
        }
        
        return $deltaL / $l0; // Strain (unitless)
    }

    /**
     * Calculate Young's modulus (E = σ / ε)
     * @param float $stress Stress (Pa by default)
     * @param float $strain Strain (unitless)
     * @param string $unitStress Unit for stress (default: "Pa", options: "kPa", "MPa", "psi")
     * @param string $unitModulus Unit for modulus (default: "Pa", options: "GPa", "psi")
     * @return float|string Young's modulus or error message
     */
    public function youngsModulus($stress, $strain, $unitStress = "Pa", $unitModulus = "Pa") {
        if ($strain <= 0) return "Error: Strain must be positive";
        if ($stress < 0) return "Error: Stress cannot be negative";
        
        // Convert stress to Pa
        if ($unitStress === "kPa") $stress *= 1000; // kPa to Pa
        elseif ($unitStress === "MPa") $stress *= 1e6; // MPa to Pa
        elseif ($unitStress === "psi") $stress *= 6894.76; // psi to Pa
        
        $result = $stress / $strain; // Modulus in Pa
        
        // Convert modulus to desired unit
        if ($unitModulus === "GPa") return $result / 1e9; // Pa to GPa
        elseif ($unitModulus === "psi") return $result * 0.000145038; // Pa to psi
        return $result; // Default Pa
    }

    /**
     * Calculate shear stress (τ = F / A)
     * @param float $f Shear force (N by default)
     * @param float $a Area (m² by default)
     * @param string $unitForce Unit for force (default: "N", options: "kN", "lbf")
     * @param string $unitArea Unit for area (default: "m²", options: "cm²", "in²")
     * @param string $unitStress Unit for shear stress (default: "Pa", options: "kPa", "MPa", "psi")
     * @return float|string Shear stress or error message
     */
    public function shearStress($f, $a, $unitForce = "N", $unitArea = "m²", $unitStress = "Pa") {
        if ($a <= 0) return "Error: Area must be positive";
        if ($f < 0) return "Error: Force cannot be negative";
        
        // Convert force to N
        if ($unitForce === "kN") $f *= 1000; // kN to N
        elseif ($unitForce === "lbf") $f *= 4.44822; // lbf to N
        
        // Convert area to m²
        if ($unitArea === "cm²") $a /= 10000; // cm² to m²
        elseif ($unitArea === "in²") $a *= 0.00064516; // in² to m²
        
        $result = $f / $a; // Shear stress in Pa
        
        // Convert shear stress to desired unit
        if ($unitStress === "kPa") return $result / 1000; // Pa to kPa
        elseif ($unitStress === "MPa") return $result / 1e6; // Pa to MPa
        elseif ($unitStress === "psi") return $result * 0.000145038; // Pa to psi
        return $result; // Default Pa
    }

    /**
     * Calculate shear strain (γ = Δx / h)
     * @param float $deltaX Lateral displacement (m by default)
     * @param float $h Height (m by default)
     * @param string $unitLength Unit for length (default: "m", options: "mm", "in")
     * @return float|string Shear strain or error message
     */
    public function shearStrain($deltaX, $h, $unitLength = "m") {
        if ($h <= 0) return "Error: Height must be positive";
        
        // Convert lengths to consistent units (m)
        if ($unitLength === "mm") {
            $deltaX /= 1000; // mm to m
            $h /= 1000;
        } elseif ($unitLength === "in") {
            $deltaX *= 0.0254; // in to m
            $h *= 0.0254;
        }
        
        return $deltaX / $h; // Shear strain (unitless)
    }

    /**
     * Calculate shear modulus (G = τ / γ)
     * @param float $shearStress Shear stress (Pa by default)
     * @param float $shearStrain Shear strain (unitless)
     * @param string $unitStress Unit for shear stress (default: "Pa", options: "kPa", "MPa", "psi")
     * @param string $unitModulus Unit for shear modulus (default: "Pa", options: "GPa", "psi")
     * @return float|string Shear modulus or error message
     */
    public function shearModulus($shearStress, $shearStrain, $unitStress = "Pa", $unitModulus = "Pa") {
        if ($shearStrain <= 0) return "Error: Shear strain must be positive";
        if ($shearStress < 0) return "Error: Shear stress cannot be negative";
        
        // Convert shear stress to Pa
        if ($unitStress === "kPa") $shearStress *= 1000; // kPa to Pa
        elseif ($unitStress === "MPa") $shearStress *= 1e6; // MPa to Pa
        elseif ($unitStress === "psi") $shearStress *= 6894.76; // psi to Pa
        
        $result = $shearStress / $shearStrain; // Shear modulus in Pa
        
        // Convert shear modulus to desired unit
        if ($unitModulus === "GPa") return $result / 1e9; // Pa to GPa
        elseif ($unitModulus === "psi") return $result * 0.000145038; // Pa to psi
        return $result; // Default Pa
    }

    /**
     * Calculate moment of inertia for a rectangular section (I = bh³ / 12)
     * @param float $b Width (m by default)
     * @param float $h Height (m by default)
     * @param string $unitLength Unit for length (default: "m", options: "cm", "in")
     * @param string $unitInertia Unit for moment of inertia (default: "m⁴", options: "cm⁴", "in⁴")
     * @return float|string Moment of inertia or error message
     */
    public function momentOfInertiaRectangle($b, $h, $unitLength = "m", $unitInertia = "m⁴") {
        if ($b <= 0 || $h <= 0) return "Error: Width and height must be positive";
        
        // Convert lengths to m
        if ($unitLength === "cm") {
            $b /= 100; // cm to m
            $h /= 100;
        } elseif ($unitLength === "in") {
            $b *= 0.0254; // in to m
            $h *= 0.0254;
        }
        
        $result = ($b * pow($h, 3)) / 12; // Moment of inertia in m⁴
        
        // Convert moment of inertia to desired unit
        if ($unitInertia === "cm⁴") return $result * 1e8; // m⁴ to cm⁴
        elseif ($unitInertia === "in⁴") return $result * 2.402e4; // m⁴ to in⁴
        return $result; // Default m⁴
    }

    /**
     * Calculate bending stress (σ = Mc / I)
     * @param float $m Bending moment (N·m by default)
     * @param float $c Distance from neutral axis (m by default)
     * @param float $i Moment of inertia (m⁴ by default)
     * @param string $unitMoment Unit for moment (default: "N·m", options: "kN·m", "lbf·ft")
     * @param string $unitLength Unit for length (default: "m", options: "cm", "in")
     * @param string $unitInertia Unit for moment of inertia (default: "m⁴", options: "cm⁴", "in⁴")
     * @param string $unitStress Unit for bending stress (default: "Pa", options: "kPa", "MPa", "psi")
     * @return float|string Bending stress or error message
     */
    public function bendingStress($m, $c, $i, $unitMoment = "N·m", $unitLength = "m", $unitInertia = "m⁴", $unitStress = "Pa") {
        if ($i <= 0) return "Error: Moment of inertia must be positive";
        if ($c < 0) return "Error: Distance cannot be negative";
        
        // Convert moment to N·m
        if ($unitMoment === "kN·m") $m *= 1000; // kN·m to N·m
        elseif ($unitMoment === "lbf·ft") $m *= 1.35582; // lbf·ft to N·m
        
        // Convert length to m
        if ($unitLength === "cm") $c /= 100; // cm to m
        elseif ($unitLength === "in") $c *= 0.0254; // in to m
        
        // Convert moment of inertia to m⁴
        if ($unitInertia === "cm⁴") $i /= 1e8; // cm⁴ to m⁴
        elseif ($unitInertia === "in⁴") $i /= 2.402e4; // in⁴ to m⁴
        
        $result = ($m * $c) / $i; // Bending stress in Pa
        
        // Convert bending stress to desired unit
        if ($unitStress === "kPa") return $result / 1000; // Pa to kPa
        elseif ($unitStress === "MPa") return $result / 1e6; // Pa to MPa
        elseif ($unitStress === "psi") return $result * 0.000145038; // Pa to psi
        return $result; // Default Pa
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing MechanicsCalculations:\n";
        echo "----------------------------------------\n";

        // Group 1: Stress and Strain
        echo "Group 1: Stress and Strain\n";
        echo "-------------------------\n";
        echo "// Test stress with F=1000 N, A=0.01 m²\n";
        echo "stress(1000, 0.01): " . $this->stress(1000, 0.01) . "\n"; // Expected: 100000 Pa
        echo "// Test strain with ΔL=0.002 m, L₀=1 m\n";
        echo "strain(0.002, 1): " . $this->strain(0.002, 1) . "\n"; // Expected: 0.002
        echo "// Test Young's modulus with σ=500000 Pa, ε=0.005\n";
        echo "youngsModulus(500000, 0.005): " . $this->youngsModulus(500000, 0.005) . "\n"; // Expected: 100000000 Pa

        // Group 2: Shear Properties
        echo "\nGroup 2: Shear Properties\n";
        echo "-------------------------\n";
        echo "// Test shear stress with F=500 N, A=0.02 m²\n";
        echo "shearStress(500, 0.02): " . $this->shearStress(500, 0.02) . "\n"; // Expected: 25000 Pa
        echo "// Test shear strain with Δx=0.001 m, h=0.5 m\n";
        echo "shearStrain(0.001, 0.5): " . $this->shearStrain(0.001, 0.5) . "\n"; // Expected: 0.002
        echo "// Test shear modulus with τ=25000 Pa, γ=0.002\n";
        echo "shearModulus(25000, 0.002): " . $this->shearModulus(25000, 0.002) . "\n"; // Expected: 12500000 Pa

        // Group 3: Bending and Inertia
        echo "\nGroup 3: Bending and Inertia\n";
        echo "-------------------------\n";
        echo "// Test moment of inertia for rectangle with b=0.1 m, h=0.2 m\n";
        echo "momentOfInertiaRectangle(0.1, 0.2): " . $this->momentOfInertiaRectangle(0.1, 0.2) . "\n"; // Expected: 0.00006667 m⁴
        echo "// Test bending stress with M=1000 N·m, c=0.1 m, I=0.00006667 m⁴\n";
        echo "bendingStress(1000, 0.1, 0.00006667): " . $this->bendingStress(1000, 0.1, 0.00006667) . "\n"; // Expected: ~1500000 Pa

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$mech = new MechanicsCalculations();
$mech->runTests();
?>