<?php

require_once 'PhysicsCalculations.php'; // For referencing higher-priority functions

class ElectronicsCalculations {
    const EPSILON_0 = 8.8541878128e-12; // Permittivity of free space (F/m)
    const MU_0 = 1.25663706212e-6; // Permeability of free space (H/m)

    private $physics;

    public function __construct() {
        $this->physics = new PhysicsCalculations();
    }

    /**
     * Calculate resistance using Ohm's Law (R = V / I)
     * Uses PhysicsCalculations::ohmsLaw for voltage calculation
     * @param float $v Voltage (V by default)
     * @param float $i Current (A by default)
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitResistance Unit for resistance (default: "Ω", options: "kΩ")
     * @return float|string Resistance or error message
     */
    public function resistanceOhmsLaw($v, $i, $unitVoltage = "V", $unitCurrent = "A", $unitResistance = "Ω") {
        if ($i <= 0) return "Error: Current must be positive";
        if ($v < 0) return "Error: Voltage cannot be negative";
        
        // Convert units to SI base (V and A)
        if ($unitVoltage === "mV") $v /= 1000; // mV to V
        if ($unitCurrent === "mA") $i /= 1000; // mA to A
        
        $result = $v / $i; // Resistance in Ω
        
        if ($unitResistance === "kΩ") return $result / 1000; // Ω to kΩ
        return $result; // Default Ω
    }

    /**
     * Calculate Kirchhoff's Current Law (KCL) - Sum of currents at a node
     * @param array $currents Array of currents (A by default, positive for incoming, negative for outgoing)
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @return float|string Sum of currents or error message
     */
    public function kirchhoffCurrentLaw($currents, $unitCurrent = "A") {
        if (!is_array($currents) || empty($currents)) return "Error: Currents array must be non-empty";
        
        $sum = 0;
        foreach ($currents as $current) {
            if (!is_numeric($current)) return "Error: All currents must be numeric";
            $convertedCurrent = $unitCurrent === "mA" ? $current / 1000 : $current; // mA to A
            $sum += $convertedCurrent;
        }
        
        if ($unitCurrent === "mA") return $sum * 1000; // A to mA
        return $sum; // Default A (should be ~0 for KCL)
    }

    /**
     * Calculate Kirchhoff's Voltage Law (KVL) - Sum of voltages around a loop
     * @param array $voltages Array of voltages (V by default, positive or negative based on direction)
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @return float|string Sum of voltages or error message
     */
    public function kirchhoffVoltageLaw($voltages, $unitVoltage = "V") {
        if (!is_array($voltages) || empty($voltages)) return "Error: Voltages array must be non-empty";
        
        $sum = 0;
        foreach ($voltages as $voltage) {
            if (!is_numeric($voltage)) return "Error: All voltages must be numeric";
            $convertedVoltage = $unitVoltage === "mV" ? $voltage / 1000 : $voltage; // mV to V
            $sum += $convertedVoltage;
        }
        
        if ($unitVoltage === "mV") return $sum * 1000; // V to mV
        return $sum; // Default V (should be ~0 for KVL)
    }

    /**
     * Calculate equivalent resistance in series (R_eq = R1 + R2 + ...)
     * @param array $resistances Array of resistances (Ω by default)
     * @param string $unitResistance Unit for resistance (default: "Ω", options: "kΩ")
     * @return float|string Equivalent resistance or error message
     */
    public function seriesResistance($resistances, $unitResistance = "Ω") {
        if (!is_array($resistances) || empty($resistances)) return "Error: Resistances array must be non-empty";
        
        $sum = 0;
        foreach ($resistances as $r) {
            if (!is_numeric($r) || $r < 0) return "Error: All resistances must be non-negative numbers";
            $convertedR = $unitResistance === "kΩ" ? $r * 1000 : $r; // kΩ to Ω
            $sum += $convertedR;
        }
        
        if ($unitResistance === "kΩ") return $sum / 1000; // Ω to kΩ
        return $sum; // Default Ω
    }

    /**
     * Calculate equivalent resistance in parallel (1/R_eq = 1/R1 + 1/R2 + ...)
     * @param array $resistances Array of resistances (Ω by default)
     * @param string $unitResistance Unit for resistance (default: "Ω", options: "kΩ")
     * @return float|string Equivalent resistance or error message
     */
    public function parallelResistance($resistances, $unitResistance = "Ω") {
        if (!is_array($resistances) || empty($resistances)) return "Error: Resistances array must be non-empty";
        
        $reciprocalSum = 0;
        foreach ($resistances as $r) {
            if (!is_numeric($r) || $r <= 0) return "Error: All resistances must be positive numbers";
            $convertedR = $unitResistance === "kΩ" ? $r * 1000 : $r; // kΩ to Ω
            $reciprocalSum += 1 / $convertedR;
        }
        
        $result = 1 / $reciprocalSum; // Resistance in Ω
        
        if ($unitResistance === "kΩ") return $result / 1000; // Ω to kΩ
        return $result; // Default Ω
    }

    /**
     * Calculate capacitance in series (1/C_eq = 1/C1 + 1/C2 + ...)
     * @param array $capacitances Array of capacitances (F by default)
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF", "nF")
     * @return float|string Equivalent capacitance or error message
     */
    public function seriesCapacitance($capacitances, $unitCapacitance = "F") {
        if (!is_array($capacitances) || empty($capacitances)) return "Error: Capacitances array must be non-empty";
        
        $reciprocalSum = 0;
        foreach ($capacitances as $c) {
            if (!is_numeric($c) || $c <= 0) return "Error: All capacitances must be positive numbers";
            $convertedC = $unitCapacitance === "µF" ? $c * 1e-6 : ($unitCapacitance === "nF" ? $c * 1e-9 : $c); // µF or nF to F
            $reciprocalSum += 1 / $convertedC;
        }
        
        $result = 1 / $reciprocalSum; // Capacitance in F
        
        if ($unitCapacitance === "µF") return $result * 1e6; // F to µF
        elseif ($unitCapacitance === "nF") return $result * 1e9; // F to nF
        return $result; // Default F
    }

    /**
     * Calculate capacitance in parallel (C_eq = C1 + C2 + ...)
     * @param array $capacitances Array of capacitances (F by default)
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF", "nF")
     * @return float|string Equivalent capacitance or error message
     */
    public function parallelCapacitance($capacitances, $unitCapacitance = "F") {
        if (!is_array($capacitances) || empty($capacitances)) return "Error: Capacitances array must be non-empty";
        
        $sum = 0;
        foreach ($capacitances as $c) {
            if (!is_numeric($c) || $c < 0) return "Error: All capacitances must be non-negative numbers";
            $convertedC = $unitCapacitance === "µF" ? $c * 1e-6 : ($unitCapacitance === "nF" ? $c * 1e-9 : $c); // µF or nF to F
            $sum += $convertedC;
        }
        
        if ($unitCapacitance === "µF") return $sum * 1e6; // F to µF
        elseif ($unitCapacitance === "nF") return $sum * 1e9; // F to nF
        return $sum; // Default F
    }

    /**
     * Calculate inductor voltage (V_L = L * di/dt)
     * @param float $l Inductance (H by default)
     * @param float $di Change in current (A by default)
     * @param float $dt Change in time (s by default)
     * @param string $unitInductance Unit for inductance (default: "H", options: "mH")
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitTime Unit for time (default: "s", options: "ms")
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @return float|string Voltage across inductor or error message
     */
    public function inductorVoltage($l, $di, $dt, $unitInductance = "H", $unitCurrent = "A", $unitTime = "s", $unitVoltage = "V") {
        if ($dt <= 0) return "Error: Time change must be positive";
        if ($l < 0) return "Error: Inductance cannot be negative";
        
        // Convert units to SI base (H, A, s)
        if ($unitInductance === "mH") $l /= 1000; // mH to H
        if ($unitCurrent === "mA") $di /= 1000; // mA to A
        if ($unitTime === "ms") $dt /= 1000; // ms to s
        
        $result = $l * ($di / $dt); // Voltage in V
        
        if ($unitVoltage === "mV") return $result * 1000; // V to mV
        return $result; // Default V
    }

    /**
     * Calculate capacitor current (I_C = C * dv/dt)
     * @param float $c Capacitance (F by default)
     * @param float $dv Change in voltage (V by default)
     * @param float $dt Change in time (s by default)
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF")
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @param string $unitTime Unit for time (default: "s", options: "ms")
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @return float|string Current through capacitor or error message
     */
    public function capacitorCurrent($c, $dv, $dt, $unitCapacitance = "F", $unitVoltage = "V", $unitTime = "s", $unitCurrent = "A") {
        if ($dt <= 0) return "Error: Time change must be positive";
        if ($c < 0) return "Error: Capacitance cannot be negative";
        
        // Convert units to SI base (F, V, s)
        if ($unitCapacitance === "µF") $c /= 1e6; // µF to F
        if ($unitVoltage === "mV") $dv /= 1000; // mV to V
        if ($unitTime === "ms") $dt /= 1000; // ms to s
        
        $result = $c * ($dv / $dt); // Current in A
        
        if ($unitCurrent === "mA") return $result * 1000; // A to mA
        return $result; // Default A
    }

    /**
     * Calculate RC time constant (τ = R * C)
     * @param float $r Resistance (Ω by default)
     * @param float $c Capacitance (F by default)
     * @param string $unitResistance Unit for resistance (default: "Ω", options: "kΩ")
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF")
     * @param string $unitTime Unit for time constant (default: "s", options: "ms")
     * @return float|string Time constant or error message
     */
    public function rcTimeConstant($r, $c, $unitResistance = "Ω", $unitCapacitance = "F", $unitTime = "s") {
        if ($r <= 0 || $c <= 0) return "Error: Resistance and capacitance must be positive";
        
        // Convert units to SI base (Ω, F)
        if ($unitResistance === "kΩ") $r *= 1000; // kΩ to Ω
        if ($unitCapacitance === "µF") $c /= 1e6; // µF to F
        
        $result = $r * $c; // Time constant in s
        
        if ($unitTime === "ms") return $result * 1000; // s to ms
        return $result; // Default s
    }

    /**
     * Calculate power in a circuit (P = V * I)
     * Uses PhysicsCalculations::electricPower for consistency
     * @param float $v Voltage (V by default)
     * @param float $i Current (A by default)
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitPower Unit for power (default: "W", options: "mW")
     * @return float|string Power or error message
     */
    public function power($v, $i, $unitVoltage = "V", $unitCurrent = "A", $unitPower = "W") {
        return $this->physics->electricPower($v, $i, $unitVoltage, $unitCurrent, $unitPower);
    }

    /**
     * Calculate impedance in an AC circuit (Z = √(R² + (X_L - X_C)²))
     * @param float $r Resistance (Ω by default)
     * @param float $xl Inductive reactance (Ω by default)
     * @param float $xc Capacitive reactance (Ω by default)
     * @param string $unitResistance Unit for resistance (default: "Ω", options: "kΩ")
     * @param string $unitImpedance Unit for impedance (default: "Ω", options: "kΩ")
     * @return float|string Impedance or error message
     */
    public function impedance($r, $xl, $xc, $unitResistance = "Ω", $unitImpedance = "Ω") {
        if ($r < 0 || $xl < 0 || $xc < 0) return "Error: Resistance and reactances must be non-negative";
        
        // Convert resistance to Ω
        if ($unitResistance === "kΩ") {
            $r *= 1000; // kΩ to Ω
            $xl *= 1000;
            $xc *= 1000;
        }
        
        $result = sqrt(pow($r, 2) + pow($xl - $xc, 2)); // Impedance in Ω
        
        if ($unitImpedance === "kΩ") return $result / 1000; // Ω to kΩ
        return $result; // Default Ω
    }

    /**
     * Calculate inductive reactance (X_L = 2πfL)
     * @param float $f Frequency (Hz by default)
     * @param float $l Inductance (H by default)
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @param string $unitInductance Unit for inductance (default: "H", options: "mH")
     * @param string $unitReactance Unit for reactance (default: "Ω", options: "kΩ")
     * @return float|string Inductive reactance or error message
     */
    public function inductiveReactance($f, $l, $unitFrequency = "Hz", $unitInductance = "H", $unitReactance = "Ω") {
        if ($f <= 0 || $l <= 0) return "Error: Frequency and inductance must be positive";
        
        // Convert units to SI base (Hz, H)
        if ($unitFrequency === "kHz") $f *= 1000; // kHz to Hz
        if ($unitInductance === "mH") $l /= 1000; // mH to H
        
        $result = 2 * M_PI * $f * $l; // Reactance in Ω
        
        if ($unitReactance === "kΩ") return $result / 1000; // Ω to kΩ
        return $result; // Default Ω
    }

    /**
     * Calculate capacitive reactance (X_C = 1 / (2πfC))
     * @param float $f Frequency (Hz by default)
     * @param float $c Capacitance (F by default)
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF")
     * @param string $unitReactance Unit for reactance (default: "Ω", options: "kΩ")
     * @return float|string Capacitive reactance or error message
     */
    public function capacitiveReactance($f, $c, $unitFrequency = "Hz", $unitCapacitance = "F", $unitReactance = "Ω") {
        if ($f <= 0 || $c <= 0) return "Error: Frequency and capacitance must be positive";
        
        // Convert units to SI base (Hz, F)
        if ($unitFrequency === "kHz") $f *= 1000; // kHz to Hz
        if ($unitCapacitance === "µF") $c /= 1e6; // µF to F
        
        $result = 1 / (2 * M_PI * $f * $c); // Reactance in Ω
        
        if ($unitReactance === "kΩ") return $result / 1000; // Ω to kΩ
        return $result; // Default Ω
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing ElectronicsCalculations:\n";
        echo "----------------------------------------\n";
    
        // Group 1: Basic Circuit Laws
        echo "Group 1: Basic Circuit Laws\n";
        echo "-------------------------\n";
        echo "// Test resistance using Ohm's Law with V=10 V, I=2 A\n";
        echo "resistanceOhmsLaw(10, 2): " . $this->resistanceOhmsLaw(10, 2) . " Ω (Expected: 5)\n";
        echo "// Test resistance using Ohm's Law with V=500 mV, I=100 mA, unitResistance='kΩ'\n";
        echo "resistanceOhmsLaw(500, 100, 'mV', 'mA', 'kΩ'): " . $this->resistanceOhmsLaw(500, 100, 'mV', 'mA', 'kΩ') . " kΩ (Expected: 0.005)\n";
        echo "// Test KCL with currents [2, -1, -1] A\n";
        echo "kirchhoffCurrentLaw([2, -1, -1]): " . $this->kirchhoffCurrentLaw([2, -1, -1]) . " A (Expected: 0)\n";
        echo "// Test KCL with currents [200, -100, -100] mA\n";
        echo "kirchhoffCurrentLaw([200, -100, -100], 'mA'): " . $this->kirchhoffCurrentLaw([200, -100, -100], 'mA') . " mA (Expected: 0)\n";
        echo "// Test KVL with voltages [5, -3, -2] V\n";
        echo "kirchhoffVoltageLaw([5, -3, -2]): " . $this->kirchhoffVoltageLaw([5, -3, -2]) . " V (Expected: 0)\n";
        echo "// Test KVL with voltages [5000, -3000, -2000] mV\n";
        echo "kirchhoffVoltageLaw([5000, -3000, -2000], 'mV'): " . $this->kirchhoffVoltageLaw([5000, -3000, -2000], 'mV') . " mV (Expected: 0)\n";
    
        // Group 2: Resistive Circuits
        echo "\nGroup 2: Resistive Circuits\n";
        echo "-------------------------\n";
        echo "// Test series resistance with [10, 20, 30] Ω\n";
        echo "seriesResistance([10, 20, 30]): " . $this->seriesResistance([10, 20, 30]) . " Ω (Expected: 60)\n";
        echo "// Test series resistance with [1, 2, 3] kΩ, unitResistance='kΩ'\n";
        echo "seriesResistance([1, 2, 3], 'kΩ'): " . $this->seriesResistance([1, 2, 3], 'kΩ') . " kΩ (Expected: 6)\n";
        echo "// Test parallel resistance with [10, 20] Ω\n";
        echo "parallelResistance([10, 20]): " . $this->parallelResistance([10, 20]) . " Ω (Expected: ~6.6667)\n";
        echo "// Test parallel resistance with [1, 2] kΩ, unitResistance='kΩ'\n";
        echo "parallelResistance([1, 2], 'kΩ'): " . $this->parallelResistance([1, 2], 'kΩ') . " kΩ (Expected: ~0.6667)\n";
    
        // Group 3: Capacitive Circuits
        echo "\nGroup 3: Capacitive Circuits\n";
        echo "-------------------------\n";
        echo "// Test series capacitance with [1e-6, 2e-6] F\n";
        echo "seriesCapacitance([1e-6, 2e-6]): " . $this->seriesCapacitance([1e-6, 2e-6]) . " F (Expected: ~6.6667e-7)\n";
        echo "// Test series capacitance with [1, 2] µF, unitCapacitance='µF'\n";
        echo "seriesCapacitance([1, 2], 'µF'): " . $this->seriesCapacitance([1, 2], 'µF') . " µF (Expected: ~0.6667)\n";
        echo "// Test parallel capacitance with [1e-6, 2e-6] F\n";
        echo "parallelCapacitance([1e-6, 2e-6]): " . $this->parallelCapacitance([1e-6, 2e-6]) . " F (Expected: 3e-6)\n";
        echo "// Test parallel capacitance with [1, 2] nF, unitCapacitance='nF'\n";
        echo "parallelCapacitance([1, 2], 'nF'): " . $this->parallelCapacitance([1, 2], 'nF') . " nF (Expected: 3)\n";
    
        // Group 4: Dynamic Elements
        echo "\nGroup 4: Dynamic Elements\n";
        echo "-------------------------\n";
        echo "// Test inductor voltage with L=0.1 H, ΔI=2 A, Δt=0.5 s\n";
        echo "inductorVoltage(0.1, 2, 0.5): " . $this->inductorVoltage(0.1, 2, 0.5) . " V (Expected: 0.4)\n";
        echo "// Test inductor voltage with L=100 mH, ΔI=100 mA, Δt=10 ms, unitVoltage='mV'\n";
        echo "inductorVoltage(100, 100, 10, 'mH', 'mA', 'ms', 'mV'): " . $this->inductorVoltage(100, 100, 10, 'mH', 'mA', 'ms', 'mV') . " mV (Expected: 1000)\n";
        echo "// Test capacitor current with C=1e-6 F, ΔV=10 V, Δt=0.001 s\n";
        echo "capacitorCurrent(1e-6, 10, 0.001): " . $this->capacitorCurrent(1e-6, 10, 0.001) . " A (Expected: 0.01)\n";
        echo "// Test capacitor current with C=10 µF, ΔV=100 mV, Δt=1 ms, unitCurrent='mA'\n";
        echo "capacitorCurrent(10, 100, 1, 'µF', 'mV', 'ms', 'mA'): " . $this->capacitorCurrent(10, 100, 1, 'µF', 'mV', 'ms', 'mA') . " mA (Expected: 1)\n";
        echo "// Test RC time constant with R=1000 Ω, C=1e-6 F\n";
        echo "rcTimeConstant(1000, 1e-6): " . $this->rcTimeConstant(1000, 1e-6) . " s (Expected: 0.001)\n";
        echo "// Test RC time constant with R=1 kΩ, C=1000 µF, unitTime='ms'\n";
        echo "rcTimeConstant(1, 1000, 'kΩ', 'µF', 'ms'): " . $this->rcTimeConstant(1, 1000, 'kΩ', 'µF', 'ms') . " ms (Expected: 1000)\n";
    
        // Group 5: AC Circuits
        echo "\nGroup 5: AC Circuits\n";
        echo "-------------------------\n";
        echo "// Test power with V=10 V, I=2 A\n";
        echo "power(10, 2): " . $this->power(10, 2) . " W (Expected: 20)\n";
        echo "// Test power with V=500 mV, I=100 mA, unitPower='mW'\n";
        echo "power(500, 100, 'mV', 'mA', 'mW'): " . $this->power(500, 100, 'mV', 'mA', 'mW') . " mW (Expected: 50)\n";
        echo "// Test impedance with R=10 Ω, X_L=5 Ω, X_C=2 Ω\n";
        echo "impedance(10, 5, 2): " . $this->impedance(10, 5, 2) . " Ω (Expected: ~10.4403)\n";
        echo "// Test impedance with R=1 kΩ, X_L=0.5 kΩ, X_C=0.2 kΩ, unitImpedance='kΩ'\n";
        echo "impedance(1, 0.5, 0.2, 'kΩ', 'kΩ'): " . $this->impedance(1, 0.5, 0.2, 'kΩ', 'kΩ') . " kΩ (Expected: ~1.0440)\n";
        echo "// Test inductive reactance with f=60 Hz, L=0.1 H\n";
        echo "inductiveReactance(60, 0.1): " . $this->inductiveReactance(60, 0.1) . " Ω (Expected: ~37.6991)\n";
        echo "// Test inductive reactance with f=1 kHz, L=100 mH, unitReactance='kΩ'\n";
        echo "inductiveReactance(1, 100, 'kHz', 'mH', 'kΩ'): " . $this->inductiveReactance(1, 100, 'kHz', 'mH', 'kΩ') . " kΩ (Expected: ~0.6283)\n";
        echo "// Test capacitive reactance with f=60 Hz, C=1e-6 F\n";
        echo "capacitiveReactance(60, 1e-6): " . $this->capacitiveReactance(60, 1e-6) . " Ω (Expected: ~2652.5824)\n";
        echo "// Test capacitive reactance with f=1 kHz, C=10 µF, unitReactance='kΩ'\n";
        echo "capacitiveReactance(1, 10, 'kHz', 'µF', 'kΩ'): " . $this->capacitiveReactance(1, 10, 'kHz', 'µF', 'kΩ') . " kΩ (Expected: ~0.0159)\n";
    
        // Error Condition Tests
        echo "\nError Condition Tests\n";
        echo "-------------------------\n";
        echo "// Test resistanceOhmsLaw with I=0 A\n";
        echo "resistanceOhmsLaw(10, 0): " . $this->resistanceOhmsLaw(10, 0) . " (Expected: Error: Current must be positive)\n";
        echo "// Test kirchhoffCurrentLaw with non-numeric current\n";
        echo "kirchhoffCurrentLaw([2, 'a', -1]): " . $this->kirchhoffCurrentLaw([2, 'a', -1]) . " (Expected: Error: All currents must be numeric)\n";
        echo "// Test seriesResistance with negative resistance\n";
        echo "seriesResistance([10, -20, 30]): " . $this->seriesResistance([10, -20, 30]) . " (Expected: Error: All resistances must be non-negative numbers)\n";
        echo "// Test parallelResistance with zero resistance\n";
        echo "parallelResistance([10, 0]): " . $this->parallelResistance([10, 0]) . " (Expected: Error: All resistances must be positive numbers)\n";
        echo "// Test inductorVoltage with Δt=0\n";
        echo "inductorVoltage(0.1, 2, 0): " . $this->inductorVoltage(0.1, 2, 0) . " (Expected: Error: Time change must be positive)\n";
        echo "// Test capacitorCurrent with C= -1e-6 F\n";
        echo "capacitorCurrent(-1e-6, 10, 0.001): " . $this->capacitorCurrent(-1e-6, 10, 0.001) . " (Expected: Error: Capacitance cannot be negative)\n";
    
        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$elec = new ElectronicsCalculations();
$elec->runTests();
?>