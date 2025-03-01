<?php

class PhysicsCalculations {
    const G = 9.81; // Gravitational acceleration (m/s²)
    const G_CONST = 6.67430e-11; // Gravitational constant (m³/kg·s²)
    const C = 299792458; // Speed of light in vacuum (m/s)
    const K = 8.9875517923e9; // Coulomb constant (N·m²/C²)
    const MU_0 = 1.25663706212e-6; // Magnetic permeability of vacuum (H/m)
    const EPSILON_0 = 8.8541878128e-12; // Electric permittivity of vacuum (F/m)
    const H = 6.62607015e-34; // Planck constant (J·s)
    const KB = 1.380649e-23; // Boltzmann constant (J/K)
    const R = 8.314462618; // Gas constant (J/mol·K)
    const NA = 6.02214076e23; // Avogadro's number (1/mol)
    const SIGMA = 5.670374419e-8; // Stefan-Boltzmann constant (W/m²·K⁴)
    const RY = 1.097373156e7; // Rydberg constant (1/m)
    const ALPHA = 7.2973525693e-3; // Fine-structure constant
    const ME = 9.1093837015e-31; // Electron mass (kg)
    const MP = 1.67262192369e-27; // Proton mass (kg)

    // Mechanics - Kinematics
    /**
     * Calculate final velocity (v = u + at)
     * @param float $u Initial velocity (m/s by default)
     * @param float $a Acceleration (m/s² by default)
     * @param float $t Time (s by default)
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h", "ft/s")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @return float|string Final velocity or error message
     */
    public function finalVelocity($u, $a, $t, $unitVelocity = "m/s", $unitAcceleration = "m/s²", $unitTime = "s") {
        if ($t < 0) return "Error: Time cannot be negative";
        if ($unitTime === "min") $t *= 60; // Convert minutes to seconds
        if ($unitAcceleration === "ft/s²") $a /= 3.28084; // Convert ft/s² to m/s²
        $result = $u + $a * $t; // Velocity in m/s
        if ($unitVelocity === "km/h") return $result * 3.6; // m/s to km/h
        if ($unitVelocity === "ft/s") return $result * 3.28084; // m/s to ft/s
        return $result; // Default m/s
    }

    /**
     * Calculate distance (s = ut + 0.5at²)
     * @param float $u Initial velocity (m/s by default)
     * @param float $a Acceleration (m/s² by default)
     * @param float $t Time (s by default)
     * @param string $unitDistance Unit for distance (default: "m", options: "km", "ft")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @return float|string Distance or error message
     */
    public function distance($u, $a, $t, $unitDistance = "m", $unitVelocity = "m/s", $unitAcceleration = "m/s²", $unitTime = "s") {
        if ($t < 0) return "Error: Time cannot be negative";
        if ($unitTime === "min") $t *= 60; // Convert minutes to seconds
        if ($unitVelocity === "km/h") $u /= 3.6; // Convert km/h to m/s
        if ($unitAcceleration === "ft/s²") $a /= 3.28084; // Convert ft/s² to m/s²
        $result = $u * $t + 0.5 * $a * pow($t, 2); // Distance in m
        if ($unitDistance === "km") return $result / 1000; // m to km
        if ($unitDistance === "ft") return $result * 3.28084; // m to ft
        return $result; // Default m
    }

    /**
     * Calculate final velocity with distance (v² = u² + 2as)
     * @param float $u Initial velocity (m/s by default)
     * @param float $a Acceleration (m/s² by default)
     * @param float $s Distance (m by default)
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h", "ft/s")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitDistance Unit for distance (default: "m", options: "km")
     * @return float|string Final velocity or error message
     */
    public function finalVelocityWithDistance($u, $a, $s, $unitVelocity = "m/s", $unitAcceleration = "m/s²", $unitDistance = "m") {
        if ($unitVelocity === "km/h") $u /= 3.6; // km/h to m/s
        if ($unitAcceleration === "ft/s²") $a /= 3.28084; // ft/s² to m/s²
        if ($unitDistance === "km") $s *= 1000; // km to m
        $v2 = pow($u, 2) + 2 * $a * $s;
        if ($v2 < 0) return "Error: Value under square root is negative";
        $result = sqrt($v2); // Velocity in m/s
        if ($unitVelocity === "km/h") return $result * 3.6; // m/s to km/h
        if ($unitVelocity === "ft/s") return $result * 3.28084; // m/s to ft/s
        return $result; // Default m/s
    }

    /**
     * Calculate time from velocity (t = (v - u) / a)
     * @param float $u Initial velocity (m/s by default)
     * @param float $v Final velocity (m/s by default)
     * @param float $a Acceleration (m/s² by default)
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @return float|string Time or error message
     */
    public function timeFromVelocity($u, $v, $a, $unitVelocity = "m/s", $unitAcceleration = "m/s²", $unitTime = "s") {
        if ($a == 0) return "Error: Acceleration cannot be zero";
        if ($unitVelocity === "km/h") {
            $u /= 3.6; // km/h to m/s
            $v /= 3.6;
        }
        if ($unitAcceleration === "ft/s²") $a /= 3.28084; // ft/s² to m/s²
        $result = ($v - $u) / $a; // Time in s
        if ($unitTime === "min") return $result / 60; // s to min
        return $result; // Default s
    }

    /**
     * Calculate angular position (θ = θ₀ + ωt + 0.5αt²)
     * @param float $theta0 Initial angle (rad by default)
     * @param float $omega Initial angular velocity (rad/s by default)
     * @param float $alpha Angular acceleration (rad/s² by default)
     * @param float $t Time (s by default)
     * @param string $unitAngle Unit for angle (default: "rad", options: "deg")
     * @param string $unitAngularVelocity Unit for angular velocity (default: "rad/s", options: "deg/s")
     * @param string $unitAngularAcceleration Unit for angular acceleration (default: "rad/s²", options: "deg/s²")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @return float|string Angular position or error message
     */
    public function angularPosition($theta0, $omega, $alpha, $t, $unitAngle = "rad", $unitAngularVelocity = "rad/s", $unitAngularAcceleration = "rad/s²", $unitTime = "s") {
        if ($t < 0) return "Error: Time cannot be negative";
        if ($unitAngle === "deg") $theta0 *= M_PI / 180; // deg to rad
        if ($unitAngularVelocity === "deg/s") $omega *= M_PI / 180; // deg/s to rad/s
        if ($unitAngularAcceleration === "deg/s²") $alpha *= M_PI / 180; // deg/s² to rad/s²
        if ($unitTime === "min") $t *= 60; // min to s
        $result = $theta0 + $omega * $t + 0.5 * $alpha * pow($t, 2); // Angle in rad
        if ($unitAngle === "deg") return $result * 180 / M_PI; // rad to deg
        return $result; // Default rad
    }

    /**
     * Calculate angular velocity (ω = ω₀ + αt)
     * @param float $omega0 Initial angular velocity (rad/s by default)
     * @param float $alpha Angular acceleration (rad/s² by default)
     * @param float $t Time (s by default)
     * @param string $unitAngularVelocity Unit for angular velocity (default: "rad/s", options: "deg/s")
     * @param string $unitAngularAcceleration Unit for angular acceleration (default: "rad/s²", options: "deg/s²")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @return float|string Angular velocity or error message
     */
    public function angularVelocity($omega0, $alpha, $t, $unitAngularVelocity = "rad/s", $unitAngularAcceleration = "rad/s²", $unitTime = "s") {
        if ($t < 0) return "Error: Time cannot be negative";
        if ($unitAngularVelocity === "deg/s") $omega0 *= M_PI / 180; // deg/s to rad/s
        if ($unitAngularAcceleration === "deg/s²") $alpha *= M_PI / 180; // deg/s² to rad/s²
        if ($unitTime === "min") $t *= 60; // min to s
        $result = $omega0 + $alpha * $t; // Angular velocity in rad/s
        if ($unitAngularVelocity === "deg/s") return $result * 180 / M_PI; // rad/s to deg/s
        return $result; // Default rad/s
    }

    // Mechanics - Dynamics
    /**
     * Calculate force (F = ma)
     * @param float $m Mass (kg by default)
     * @param float $a Acceleration (m/s² by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @return float|string Force or error message
     */
    public function force($m, $a, $unitMass = "kg", $unitAcceleration = "m/s²", $unitForce = "N") {
        if ($m < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitAcceleration === "ft/s²") $a /= 3.28084; // ft/s² to m/s²
        $result = $m * $a; // Force in N
        if ($unitForce === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    /**
     * Calculate weight (W = mg)
     * @param float $m Mass (kg by default)
     * @param float $g Gravitational acceleration (m/s² by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitWeight Unit for weight (default: "N", options: "lbf")
     * @return float|string Weight or error message
     */
    public function weight($m, $g = self::G, $unitMass = "kg", $unitAcceleration = "m/s²", $unitWeight = "N") {
        if ($m < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitAcceleration === "ft/s²") $g /= 3.28084; // ft/s² to m/s²
        $result = $m * $g; // Weight in N
        if ($unitWeight === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    /**
     * Calculate gravitational force (F = G * m1 * m2 / r²)
     * @param float $m1 Mass of first object (kg by default)
     * @param float $m2 Mass of second object (kg by default)
     * @param float $r Distance between objects (m by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitDistance Unit for distance (default: "m", options: "km")
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @return float|string Force or error message
     */
    public function gravitationalForce($m1, $m2, $r, $unitMass = "kg", $unitDistance = "m", $unitForce = "N") {
        if ($m1 < 0 || $m2 < 0) return "Error: Mass cannot be negative";
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitMass === "g") {
            $m1 /= 1000; // g to kg
            $m2 /= 1000;
        }
        if ($unitDistance === "km") $r *= 1000; // km to m
        $result = self::G_CONST * $m1 * $m2 / pow($r, 2); // Force in N
        if ($unitForce === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    /**
     * Calculate momentum (p = mv)
     * @param float $m Mass (kg by default)
     * @param float $v Velocity (m/s by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @param string $unitMomentum Unit for momentum (default: "kg·m/s", options: "g·cm/s")
     * @return float|string Momentum or error message
     */
    public function momentum($m, $v, $unitMass = "kg", $unitVelocity = "m/s", $unitMomentum = "kg·m/s") {
        if ($m < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        $result = $m * $v; // Momentum in kg·m/s
        if ($unitMomentum === "g·cm/s") return $result * 100000; // kg·m/s to g·cm/s
        return $result; // Default kg·m/s
    }

    /**
     * Calculate angular momentum (L = Iω)
     * @param float $i Moment of inertia (kg·m² by default)
     * @param float $omega Angular velocity (rad/s by default)
     * @param string $unitMomentOfInertia Unit for moment of inertia (default: "kg·m²", options: "g·cm²")
     * @param string $unitAngularVelocity Unit for angular velocity (default: "rad/s", options: "deg/s")
     * @param string $unitAngularMomentum Unit for angular momentum (default: "kg·m²/s", options: "g·cm²/s")
     * @return float|string Angular momentum or error message
     */
    public function angularMomentum($i, $omega, $unitMomentOfInertia = "kg·m²", $unitAngularVelocity = "rad/s", $unitAngularMomentum = "kg·m²/s") {
        if ($i < 0) return "Error: Moment of inertia cannot be negative";
        if ($unitMomentOfInertia === "g·cm²") $i /= 100000; // g·cm² to kg·m²
        if ($unitAngularVelocity === "deg/s") $omega *= M_PI / 180; // deg/s to rad/s
        $result = $i * $omega; // Angular momentum in kg·m²/s
        if ($unitAngularMomentum === "g·cm²/s") return $result * 100000; // kg·m²/s to g·cm²/s
        return $result; // Default kg·m²/s
    }

    /**
     * Calculate torque (τ = F * r * sinθ)
     * @param float $f Force (N by default)
     * @param float $r Distance from axis (m by default)
     * @param float $theta Angle (degrees by default)
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitAngle Unit for angle (default: "deg", options: "rad")
     * @param string $unitTorque Unit for torque (default: "N·m", options: "lbf·ft")
     * @return float|string Torque or error message
     */
    public function torque($f, $r, $theta, $unitForce = "N", $unitDistance = "m", $unitAngle = "deg", $unitTorque = "N·m") {
        if ($f < 0 || $r < 0) return "Error: Force and distance must be non-negative";
        if ($unitForce === "lbf") $f /= 0.224809; // lbf to N
        if ($unitDistance === "cm") $r /= 100; // cm to m
        if ($unitAngle === "rad") $theta = rad2deg($theta); // rad to deg
        $result = $f * $r * sin(deg2rad($theta)); // Torque in N·m
        if ($unitTorque === "lbf·ft") return $result * 0.737562; // N·m to lbf·ft
        return $result; // Default N·m
    }

    /**
     * Calculate friction force (F = μN)
     * @param float $mu Friction coefficient (unitless)
     * @param float $n Normal force (N by default)
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @return float|string Friction force or error message
     */
    public function frictionForce($mu, $n, $unitForce = "N") {
        if ($mu < 0 || $n < 0) return "Error: Friction coefficient and normal force must be non-negative";
        $result = $mu * $n; // Force in N
        if ($unitForce === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    /**
     * Calculate fluid pressure (P = ρgh)
     * @param float $rho Density (kg/m³ by default)
     * @param float $h Depth (m by default)
     * @param float $g Gravitational acceleration (m/s² by default)
     * @param string $unitDensity Unit for density (default: "kg/m³", options: "g/cm³")
     * @param string $unitDepth Unit for depth (default: "m", options: "cm")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "atm")
     * @return float|string Pressure or error message
     */
    public function fluidPressure($rho, $h, $g = self::G, $unitDensity = "kg/m³", $unitDepth = "m", $unitAcceleration = "m/s²", $unitPressure = "Pa") {
        if ($rho < 0 || $h < 0) return "Error: Density and depth must be non-negative";
        if ($unitDensity === "g/cm³") $rho *= 1000; // g/cm³ to kg/m³
        if ($unitDepth === "cm") $h /= 100; // cm to m
        if ($unitAcceleration === "ft/s²") $g /= 3.28084; // ft/s² to m/s²
        $result = $rho * $g * $h; // Pressure in Pa
        if ($unitPressure === "atm") return $result / 101325; // Pa to atm
        return $result; // Default Pa
    }

    /**
     * Calculate buoyant force (F = ρVg)
     * @param float $rho Density (kg/m³ by default)
     * @param float $v Volume (m³ by default)
     * @param float $g Gravitational acceleration (m/s² by default)
     * @param string $unitDensity Unit for density (default: "kg/m³", options: "g/cm³")
     * @param string $unitVolume Unit for volume (default: "m³", options: "L")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @return float|string Buoyant force or error message
     */
    public function buoyantForce($rho, $v, $g = self::G, $unitDensity = "kg/m³", $unitVolume = "m³", $unitAcceleration = "m/s²", $unitForce = "N") {
        if ($rho < 0 || $v < 0) return "Error: Density and volume must be non-negative";
        if ($unitDensity === "g/cm³") $rho *= 1000; // g/cm³ to kg/m³
        if ($unitVolume === "L") $v /= 1000; // L to m³
        if ($unitAcceleration === "ft/s²") $g /= 3.28084; // ft/s² to m/s²
        $result = $rho * $v * $g; // Force in N
        if ($unitForce === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    // Work and Energy
    /**
     * Calculate work (W = F * d * cosθ)
     * @param float $f Force (N by default)
     * @param float $d Displacement (m by default)
     * @param float $theta Angle (degrees by default)
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @param string $unitDistance Unit for distance (default: "m", options: "ft")
     * @param string $unitAngle Unit for angle (default: "deg", options: "rad")
     * @param string $unitWork Unit for work (default: "J", options: "ft·lbf")
     * @return float|string Work or error message
     */
    public function work($f, $d, $theta, $unitForce = "N", $unitDistance = "m", $unitAngle = "deg", $unitWork = "J") {
        if ($f < 0 || $d < 0) return "Error: Force and displacement must be non-negative";
        if ($unitForce === "lbf") $f /= 0.224809; // lbf to N
        if ($unitDistance === "ft") $d /= 3.28084; // ft to m
        if ($unitAngle === "rad") $theta = rad2deg($theta); // rad to deg
        $result = $f * $d * cos(deg2rad($theta)); // Work in J
        if ($unitWork === "ft·lbf") return $result * 0.737562; // J to ft·lbf
        return $result; // Default J
    }

    /**
     * Calculate kinetic energy (KE = 0.5mv²)
     * @param float $m Mass (kg by default)
     * @param float $v Velocity (m/s by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @param string $unitEnergy Unit for energy (default: "J", options: "cal")
     * @return float|string Kinetic energy or error message
     */
    public function kineticEnergy($m, $v, $unitMass = "kg", $unitVelocity = "m/s", $unitEnergy = "J") {
        if ($m < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        $result = 0.5 * $m * pow($v, 2); // Energy in J
        if ($unitEnergy === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate gravitational potential energy (PE = mgh)
     * @param float $m Mass (kg by default)
     * @param float $h Height (m by default)
     * @param float $g Gravitational acceleration (m/s² by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitHeight Unit for height (default: "m", options: "ft")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitEnergy Unit for energy (default: "J", options: "cal")
     * @return float|string Potential energy or error message
     */
    public function potentialEnergy($m, $h, $g = self::G, $unitMass = "kg", $unitHeight = "m", $unitAcceleration = "m/s²", $unitEnergy = "J") {
        if ($m < 0 || $h < 0) return "Error: Mass and height must be non-negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitHeight === "ft") $h /= 3.28084; // ft to m
        if ($unitAcceleration === "ft/s²") $g /= 3.28084; // ft/s² to m/s²
        $result = $m * $g * $h; // Energy in J
        if ($unitEnergy === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate spring potential energy (PE = 0.5kx²)
     * @param float $k Spring constant (N/m by default)
     * @param float $x Displacement from equilibrium (m by default)
     * @param string $unitSpringConstant Unit for spring constant (default: "N/m", options: "lbf/ft")
     * @param string $unitDisplacement Unit for displacement (default: "m", options: "cm")
     * @param string $unitEnergy Unit for energy (default: "J", options: "cal")
     * @return float|string Potential energy or error message
     */
    public function springPotentialEnergy($k, $x, $unitSpringConstant = "N/m", $unitDisplacement = "m", $unitEnergy = "J") {
        if ($k < 0) return "Error: Spring constant cannot be negative";
        if ($unitSpringConstant === "lbf/ft") $k *= 14.5939; // lbf/ft to N/m
        if ($unitDisplacement === "cm") $x /= 100; // cm to m
        $result = 0.5 * $k * pow($x, 2); // Energy in J
        if ($unitEnergy === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate power (P = W / t)
     * @param float $w Work (J by default)
     * @param float $t Time (s by default)
     * @param string $unitWork Unit for work (default: "J", options: "cal")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @param string $unitPower Unit for power (default: "W", options: "hp")
     * @return float|string Power or error message
     */
    public function power($w, $t, $unitWork = "J", $unitTime = "s", $unitPower = "W") {
        if ($t <= 0) return "Error: Time must be positive";
        if ($unitWork === "cal") $w *= 4.184; // cal to J
        if ($unitTime === "min") $t *= 60; // min to s
        $result = $w / $t; // Power in W
        if ($unitPower === "hp") return $result / 745.7; // W to hp
        return $result; // Default W
    }

    /**
     * Calculate spring frequency (f = (1/2π) * sqrt(k/m))
     * @param float $k Spring constant (N/m by default)
     * @param float $m Mass (kg by default)
     * @param string $unitSpringConstant Unit for spring constant (default: "N/m", options: "lbf/ft")
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @return float|string Frequency or error message
     */
    public function springFrequency($k, $m, $unitSpringConstant = "N/m", $unitMass = "kg", $unitFrequency = "Hz") {
        if ($k <= 0 || $m <= 0) return "Error: Spring constant and mass must be positive";
        if ($unitSpringConstant === "lbf/ft") $k *= 14.5939; // lbf/ft to N/m
        if ($unitMass === "g") $m /= 1000; // g to kg
        $result = (1 / (2 * M_PI)) * sqrt($k / $m); // Frequency in Hz
        if ($unitFrequency === "kHz") return $result / 1000; // Hz to kHz
        return $result; // Default Hz
    }

    /**
     * Calculate pendulum frequency (f = (1/2π) * sqrt(g/L))
     * @param float $l Pendulum length (m by default)
     * @param float $g Gravitational acceleration (m/s² by default)
     * @param string $unitLength Unit for length (default: "m", options: "cm")
     * @param string $unitAcceleration Unit for acceleration (default: "m/s²", options: "ft/s²")
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @return float|string Frequency or error message
     */
    public function pendulumFrequency($l, $g = self::G, $unitLength = "m", $unitAcceleration = "m/s²", $unitFrequency = "Hz") {
        if ($l <= 0) return "Error: Length must be positive";
        if ($unitLength === "cm") $l /= 100; // cm to m
        if ($unitAcceleration === "ft/s²") $g /= 3.28084; // ft/s² to m/s²
        $result = (1 / (2 * M_PI)) * sqrt($g / $l); // Frequency in Hz
        if ($unitFrequency === "kHz") return $result / 1000; // Hz to kHz
        return $result; // Default Hz
    }

    // Thermodynamics
    /**
     * Calculate heat (Q = mcΔT)
     * @param float $m Mass (kg by default)
     * @param float $c Specific heat (J/kg·K by default)
     * @param float $deltaT Temperature change (K by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitSpecificHeat Unit for specific heat (default: "J/kg·K", options: "cal/g·°C")
     * @param string $unitTemperature Unit for temperature change (default: "K", options: "C")
     * @param string $unitHeat Unit for heat (default: "J", options: "cal")
     * @return float|string Heat or error message
     */
    public function heat($m, $c, $deltaT, $unitMass = "kg", $unitSpecificHeat = "J/kg·K", $unitTemperature = "K", $unitHeat = "J") {
        if ($m < 0 || $c < 0) return "Error: Mass and specific heat must be non-negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitSpecificHeat === "cal/g·°C") $c *= 4184; // cal/g·°C to J/kg·K
        if ($unitTemperature === "C") $deltaT = $deltaT; // ΔT in C is same as K for differences
        $result = $m * $c * $deltaT; // Heat in J
        if ($unitHeat === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate first law of thermodynamics (ΔU = Q - W)
     * @param float $q Heat added (J by default)
     * @param float $w Work done (J by default)
     * @param string $unitHeat Unit for heat (default: "J", options: "cal")
     * @param string $unitWork Unit for work (default: "J", options: "cal")
     * @param string $unitEnergy Unit for internal energy (default: "J", options: "cal")
     * @return float Internal energy change
     */
    public function firstLawOfThermodynamics($q, $w, $unitHeat = "J", $unitWork = "J", $unitEnergy = "J") {
        if ($unitHeat === "cal") $q *= 4.184; // cal to J
        if ($unitWork === "cal") $w *= 4.184; // cal to J
        $result = $q - $w; // Energy in J
        if ($unitEnergy === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate pressure in an ideal gas (P = nRT / V)
     * @param float $n Number of moles (mol)
     * @param float $t Temperature (K by default)
     * @param float $v Volume (m³ by default)
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "atm", "bar")
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @param string $unitVolume Unit for volume (default: "m³", options: "L")
     * @return float|string Pressure or error message
     */
    public function idealGasPressure($n, $t, $v, $unitPressure = "Pa", $unitTemperature = "K", $unitVolume = "m³") {
        if ($n < 0 || $t < 0 || $v <= 0) return "Error: Inputs must be valid";
        if ($unitTemperature === "C") $t += 273.15; // Convert Celsius to Kelvin
        if ($unitVolume === "L") $v /= 1000; // Convert liters to m³
        $pressure = $n * self::R * $t / $v; // Pressure in Pa
        if ($unitPressure === "atm") return $pressure / 101325; // Pa to atm
        if ($unitPressure === "bar") return $pressure / 100000; // Pa to bar
        return $pressure; // Default Pa
    }

    /**
     * Calculate work in isobaric process (W = PΔV)
     * @param float $p Pressure (Pa by default)
     * @param float $deltaV Volume change (m³ by default)
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "atm")
     * @param string $unitVolume Unit for volume (default: "m³", options: "L")
     * @param string $unitWork Unit for work (default: "J", options: "cal")
     * @return float|string Work or error message
     */
    public function workIsobaric($p, $deltaV, $unitPressure = "Pa", $unitVolume = "m³", $unitWork = "J") {
        if ($p < 0) return "Error: Pressure cannot be negative";
        if ($unitPressure === "atm") $p *= 101325; // atm to Pa
        if ($unitVolume === "L") $deltaV /= 1000; // L to m³
        $result = $p * $deltaV; // Work in J
        if ($unitWork === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate work in isothermal process (W = nRT ln(V₂/V₁))
     * @param float $n Number of moles (mol)
     * @param float $t Temperature (K by default)
     * @param float $v1 Initial volume (m³ by default)
     * @param float $v2 Final volume (m³ by default)
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @param string $unitVolume Unit for volume (default: "m³", options: "L")
     * @param string $unitWork Unit for work (default: "J", options: "cal")
     * @return float|string Work or error message
     */
    public function workIsothermal($n, $t, $v1, $v2, $unitTemperature = "K", $unitVolume = "m³", $unitWork = "J") {
        if ($n < 0 || $t < 0 || $v1 <= 0 || $v2 <= 0) return "Error: Inputs must be valid";
        if ($unitTemperature === "C") $t += 273.15; // C to K
        if ($unitVolume === "L") {
            $v1 /= 1000; // L to m³
            $v2 /= 1000;
        }
        $result = $n * self::R * $t * log($v2 / $v1); // Work in J
        if ($unitWork === "cal") return $result / 4.184; // J to cal
        return $result; // Default J
    }

    /**
     * Calculate entropy (S = Q / T)
     * @param float $q Heat (J by default)
     * @param float $t Temperature (K by default)
     * @param string $unitHeat Unit for heat (default: "J", options: "cal")
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @param string $unitEntropy Unit for entropy (default: "J/K", options: "cal/K")
     * @return float|string Entropy or error message
     */
    public function entropy($q, $t, $unitHeat = "J", $unitTemperature = "K", $unitEntropy = "J/K") {
        if ($t <= 0) return "Error: Temperature must be positive";
        if ($unitHeat === "cal") $q *= 4.184; // cal to J
        if ($unitTemperature === "C") $t += 273.15; // C to K
        $result = $q / $t; // Entropy in J/K
        if ($unitEntropy === "cal/K") return $result / 4.184; // J/K to cal/K
        return $result; // Default J/K
    }

    /**
     * Calculate Carnot efficiency (η = 1 - T_cold / T_hot)
     * @param float $tHot Hot reservoir temperature (K by default)
     * @param float $tCold Cold reservoir temperature (K by default)
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @return float|string Efficiency or error message
     */
    public function carnotEfficiency($tHot, $tCold, $unitTemperature = "K") {
        if ($unitTemperature === "C") {
            $tHot += 273.15; // C to K
            $tCold += 273.15;
        }
        if ($tHot <= $tCold || $tHot <= 0 || $tCold <= 0) return "Error: Temperatures must be valid";
        return 1 - $tCold / $tHot; // Efficiency (unitless)
    }

    /**
     * Calculate total entropy for second law (ΔS_total = ΔS_system + ΔS_surroundings)
     * @param float $deltaS_system System entropy change (J/K by default)
     * @param float $deltaS_surroundings Surroundings entropy change (J/K by default)
     * @param string $unitEntropy Unit for entropy (default: "J/K", options: "cal/K")
     * @return float Total entropy change
     */
    public function secondLawEntropy($deltaS_system, $deltaS_surroundings, $unitEntropy = "J/K") {
        $result = $deltaS_system + $deltaS_surroundings; // Entropy in J/K
        if ($unitEntropy === "cal/K") return $result / 4.184; // J/K to cal/K
        return $result; // Default J/K
    }

    // Electricity and Magnetism
    /**
     * Calculate Coulomb force (F = k * |q1 * q2| / r²)
     * @param float $q1 First charge (C by default)
     * @param float $q2 Second charge (C by default)
     * @param float $r Distance (m by default)
     * @param string $unitCharge Unit for charge (default: "C", options: "µC")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @return float|string Force or error message
     */
    public function coulombForce($q1, $q2, $r, $unitCharge = "C", $unitDistance = "m", $unitForce = "N") {
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitCharge === "µC") {
            $q1 *= 1e-6; // µC to C
            $q2 *= 1e-6;
        }
        if ($unitDistance === "cm") $r /= 100; // cm to m
        $result = self::K * abs($q1 * $q2) / pow($r, 2); // Force in N
        if ($unitForce === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    /**
     * Calculate electric field (E = k * q / r²)
     * @param float $q Charge (C by default)
     * @param float $r Distance (m by default)
     * @param string $unitCharge Unit for charge (default: "C", options: "µC")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitField Unit for electric field (default: "N/C", options: "V/m")
     * @return float|string Electric field or error message
     */
    public function electricField($q, $r, $unitCharge = "C", $unitDistance = "m", $unitField = "N/C") {
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitCharge === "µC") $q *= 1e-6; // µC to C
        if ($unitDistance === "cm") $r /= 100; // cm to m
        $result = self::K * $q / pow($r, 2); // Field in N/C
        if ($unitField === "V/m") return $result; // N/C = V/m in SI
        return $result; // Default N/C
    }

    /**
     * Calculate electric potential (V = k * q / r)
     * @param float $q Charge (C by default)
     * @param float $r Distance (m by default)
     * @param string $unitCharge Unit for charge (default: "C", options: "µC")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitPotential Unit for potential (default: "V", options: "mV")
     * @return float|string Electric potential or error message
     */
    public function electricPotential($q, $r, $unitCharge = "C", $unitDistance = "m", $unitPotential = "V") {
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitCharge === "µC") $q *= 1e-6; // µC to C
        if ($unitDistance === "cm") $r /= 100; // cm to m
        $result = self::K * $q / $r; // Potential in V
        if ($unitPotential === "mV") return $result * 1000; // V to mV
        return $result; // Default V
    }

    /**
     * Calculate capacitance (C = Q / V)
     * @param float $q Charge (C by default)
     * @param float $v Voltage (V by default)
     * @param string $unitCharge Unit for charge (default: "C", options: "µC")
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF")
     * @return float|string Capacitance or error message
     */
    public function capacitance($q, $v, $unitCharge = "C", $unitVoltage = "V", $unitCapacitance = "F") {
        if ($v == 0) return "Error: Voltage cannot be zero";
        if ($unitCharge === "µC") $q *= 1e-6; // µC to C
        if ($unitVoltage === "mV") $v /= 1000; // mV to V
        $result = $q / $v; // Capacitance in F
        if ($unitCapacitance === "µF") return $result * 1e6; // F to µF
        return $result; // Default F
    }

    /**
     * Calculate capacitor energy (U = 0.5CV²)
     * @param float $c Capacitance (F by default)
     * @param float $v Voltage (V by default)
     * @param string $unitCapacitance Unit for capacitance (default: "F", options: "µF")
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @param string $unitEnergy Unit for energy (default: "J", options: "µJ")
     * @return float|string Energy or error message
     */
    public function capacitorEnergy($c, $v, $unitCapacitance = "F", $unitVoltage = "V", $unitEnergy = "J") {
        if ($c < 0) return "Error: Capacitance cannot be negative";
        if ($unitCapacitance === "µF") $c /= 1e6; // µF to F
        if ($unitVoltage === "mV") $v /= 1000; // mV to V
        $result = 0.5 * $c * pow($v, 2); // Energy in J
        if ($unitEnergy === "µJ") return $result * 1e6; // J to µJ
        return $result; // Default J
    }

    /**
     * Ohm's Law (V = IR)
     * @param float $i Current (A by default)
     * @param float $r Resistance (Ω by default)
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitResistance Unit for resistance (default: "Ω", options: "kΩ")
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @return float|string Voltage or error message
     */
    public function ohmsLaw($i, $r, $unitCurrent = "A", $unitResistance = "Ω", $unitVoltage = "V") {
        if ($r < 0) return "Error: Resistance cannot be negative";
        if ($unitCurrent === "mA") $i /= 1000; // mA to A
        if ($unitResistance === "kΩ") $r *= 1000; // kΩ to Ω
        $result = $i * $r; // Voltage in V
        if ($unitVoltage === "mV") return $result * 1000; // V to mV
        return $result; // Default V
    }

    /**
     * Calculate electric power (P = VI)
     * @param float $v Voltage (V by default)
     * @param float $i Current (A by default)
     * @param string $unitVoltage Unit for voltage (default: "V", options: "mV")
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitPower Unit for power (default: "W", options: "mW")
     * @return float Power
     */
    public function electricPower($v, $i, $unitVoltage = "V", $unitCurrent = "A", $unitPower = "W") {
        if ($unitVoltage === "mV") $v /= 1000; // mV to V
        if ($unitCurrent === "mA") $i /= 1000; // mA to A
        $result = $v * $i; // Power in W
        if ($unitPower === "mW") return $result * 1000; // W to mW
        return $result; // Default W
    }

    /**
     * Calculate Lorentz force (F = qvBsinθ)
     * @param float $q Charge (C by default)
     * @param float $v Velocity (m/s by default)
     * @param float $b Magnetic field (T by default)
     * @param float $theta Angle (degrees by default)
     * @param string $unitCharge Unit for charge (default: "C", options: "µC")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @param string $unitMagneticField Unit for magnetic field (default: "T", options: "mT")
     * @param string $unitAngle Unit for angle (default: "deg", options: "rad")
     * @param string $unitForce Unit for force (default: "N", options: "lbf")
     * @return float|string Force or error message
     */
    public function lorentzForce($q, $v, $b, $theta, $unitCharge = "C", $unitVelocity = "m/s", $unitMagneticField = "T", $unitAngle = "deg", $unitForce = "N") {
        if ($v < 0 || $b < 0) return "Error: Velocity and magnetic field must be non-negative";
        if ($unitCharge === "µC") $q *= 1e-6; // µC to C
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        if ($unitMagneticField === "mT") $b /= 1000; // mT to T
        if ($unitAngle === "rad") $theta = rad2deg($theta); // rad to deg
        $result = $q * $v * $b * sin(deg2rad($theta)); // Force in N
        if ($unitForce === "lbf") return $result * 0.224809; // N to lbf
        return $result; // Default N
    }

    /**
     * Calculate magnetic field from wire (B = μ₀I / 2πr)
     * @param float $i Current (A by default)
     * @param float $r Distance (m by default)
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitMagneticField Unit for magnetic field (default: "T", options: "mT")
     * @return float|string Magnetic field or error message
     */
    public function magneticFieldFromWire($i, $r, $unitCurrent = "A", $unitDistance = "m", $unitMagneticField = "T") {
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitCurrent === "mA") $i /= 1000; // mA to A
        if ($unitDistance === "cm") $r /= 100; // cm to m
        $result = self::MU_0 * $i / (2 * M_PI * $r); // Field in T
        if ($unitMagneticField === "mT") return $result * 1000; // T to mT
        return $result; // Default T
    }

    /**
     * Calculate magnetic force between two wires (F/L = μ₀I₁I₂ / 2πr)
     * @param float $i1 Current in first wire (A by default)
     * @param float $i2 Current in second wire (A by default)
     * @param float $r Distance (m by default)
     * @param string $unitCurrent Unit for current (default: "A", options: "mA")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitForcePerLength Unit for force per length (default: "N/m", options: "lbf/ft")
     * @return float|string Force per unit length or error message
     */
    public function magneticForceBetweenWires($i1, $i2, $r, $unitCurrent = "A", $unitDistance = "m", $unitForcePerLength = "N/m") {
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitCurrent === "mA") {
            $i1 /= 1000; // mA to A
            $i2 /= 1000;
        }
        if ($unitDistance === "cm") $r /= 100; // cm to m
        $result = self::MU_0 * $i1 * $i2 / (2 * M_PI * $r); // Force per length in N/m
        if ($unitForcePerLength === "lbf/ft") return $result * 0.0685218; // N/m to lbf/ft
        return $result; // Default N/m
    }

    /**
     * Gauss's law for electric field (Φ_E = Q / ε₀)
     * @param float $q Enclosed charge (C by default)
     * @param string $unitCharge Unit for charge (default: "C", options: "µC")
     * @param string $unitFlux Unit for electric flux (default: "N·m²/C", options: "V·m")
     * @return float Electric flux
     */
    public function gaussLawElectric($q, $unitCharge = "C", $unitFlux = "N·m²/C") {
        if ($unitCharge === "µC") $q *= 1e-6; // µC to C
        $result = $q / self::EPSILON_0; // Flux in N·m²/C
        if ($unitFlux === "V·m") return $result; // N·m²/C = V·m in SI
        return $result; // Default N·m²/C
    }

    /**
     * Gauss's law for magnetic field (Φ_B = 0)
     * @param string $unitFlux Unit for magnetic flux (default: "Wb", options: "T·m²")
     * @return float Magnetic flux (always 0)
     */
    public function gaussLawMagnetic($unitFlux = "Wb") {
        $result = 0; // Flux in Wb (always zero due to no magnetic monopoles)
        if ($unitFlux === "T·m²") return $result; // Wb = T·m² in SI
        return $result; // Default Wb
    }

    /**
     * Faraday's law of induction (ε = -dΦ_B/dt)
     * @param float $deltaPhiB Change in magnetic flux (Wb by default)
     * @param float $deltaT Change in time (s by default)
     * @param string $unitFlux Unit for flux (default: "Wb", options: "T·m²")
     * @param string $unitTime Unit for time (default: "s", options: "ms")
     * @param string $unitEMF Unit for electromotive force (default: "V", options: "mV")
     * @return float|string Electromotive force or error message
     */
    public function faradayLaw($deltaPhiB, $deltaT, $unitFlux = "Wb", $unitTime = "s", $unitEMF = "V") {
        if ($deltaT <= 0) return "Error: Time must be positive";
        if ($unitFlux === "T·m²") $deltaPhiB = $deltaPhiB; // T·m² = Wb
        if ($unitTime === "ms") $deltaT /= 1000; // ms to s
        $result = -$deltaPhiB / $deltaT; // EMF in V
        if ($unitEMF === "mV") return $result * 1000; // V to mV
        return $result; // Default V
    }

    /**
     * Calculate electric field energy (U = 0.5ε₀E²V)
     * @param float $e Electric field strength (N/C by default)
     * @param float $v Volume (m³ by default)
     * @param string $unitField Unit for electric field (default: "N/C", options: "V/m")
     * @param string $unitVolume Unit for volume (default: "m³", options: "cm³")
     * @param string $unitEnergy Unit for energy (default: "J", options: "µJ")
     * @return float|string Energy or error message
     */
    public function electricFieldEnergy($e, $v, $unitField = "N/C", $unitVolume = "m³", $unitEnergy = "J") {
        if ($v < 0) return "Error: Volume cannot be negative";
        if ($unitField === "V/m") $e = $e; // N/C = V/m in SI
        if ($unitVolume === "cm³") $v /= 1e6; // cm³ to m³
        $result = 0.5 * self::EPSILON_0 * pow($e, 2) * $v; // Energy in J
        if ($unitEnergy === "µJ") return $result * 1e6; // J to µJ
        return $result; // Default J
    }

    // Waves and Optics
    /**
     * Calculate frequency (f = 1 / T)
     * @param float $t Period (s by default)
     * @param string $unitPeriod Unit for period (default: "s", options: "ms")
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @return float|string Frequency or error message
     */
    public function frequency($t, $unitPeriod = "s", $unitFrequency = "Hz") {
        if ($t <= 0) return "Error: Period must be positive";
        if ($unitPeriod === "ms") $t /= 1000; // ms to s
        $result = 1 / $t; // Frequency in Hz
        if ($unitFrequency === "kHz") return $result / 1000; // Hz to kHz
        return $result; // Default Hz
    }

    /**
     * Calculate wavelength (λ = v / f)
     * @param float $v Wave speed (m/s by default)
     * @param float $f Frequency (Hz by default)
     * @param string $unitSpeed Unit for speed (default: "m/s", options: "km/h")
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @param string $unitWavelength Unit for wavelength (default: "m", options: "nm")
     * @return float|string Wavelength or error message
     */
    public function wavelength($v, $f, $unitSpeed = "m/s", $unitFrequency = "Hz", $unitWavelength = "m") {
        if ($f <= 0) return "Error: Frequency must be positive";
        if ($unitSpeed === "km/h") $v /= 3.6; // km/h to m/s
        if ($unitFrequency === "kHz") $f *= 1000; // kHz to Hz
        $result = $v / $f; // Wavelength in m
        if ($unitWavelength === "nm") return $result * 1e9; // m to nm
        return $result; // Default m
    }

    /**
     * Calculate Doppler effect frequency (f' = f * (v ± vd) / (v ± vs))
     * @param float $f Source frequency (Hz by default)
     * @param float $v Wave speed (m/s by default)
     * @param float $vd Detector velocity (m/s by default, positive toward source)
     * @param float $vs Source velocity (m/s by default, positive toward detector)
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "kHz")
     * @param string $unitSpeed Unit for speed (default: "m/s", options: "km/h")
     * @return float|string Observed frequency or error message
     */
    public function dopplerEffect($f, $v, $vd, $vs, $unitFrequency = "Hz", $unitSpeed = "m/s") {
        if ($v - $vs == 0) return "Error: Denominator is zero";
        if ($unitSpeed === "km/h") {
            $v /= 3.6; // km/h to m/s
            $vd /= 3.6;
            $vs /= 3.6;
        }
        $result = $f * ($v + $vd) / ($v - $vs); // Frequency in Hz
        if ($unitFrequency === "kHz") return $result / 1000; // Hz to kHz
        return $result; // Default Hz
    }

    /**
     * Law of reflection (θᵢ = θᵣ)
     * @param float $thetaI Incident angle (degrees by default)
     * @param string $unitAngle Unit for angle (default: "deg", options: "rad")
     * @return float Reflected angle
     */
    public function lawOfReflection($thetaI, $unitAngle = "deg") {
        if ($unitAngle === "rad") return rad2deg($thetaI); // rad to deg
        return $thetaI; // Default deg
    }

    /**
     * Snell's law (n₁sinθ₁ = n₂sinθ₂)
     * @param float $n1 Refractive index of first medium
     * @param float $theta1 Incident angle (degrees by default)
     * @param float $n2 Refractive index of second medium
     * @param string $unitAngle Unit for angle (default: "deg", options: "rad")
     * @return float|string Refracted angle or error message
     */
    public function snellsLaw($n1, $theta1, $n2, $unitAngle = "deg") {
        if ($n1 <= 0 || $n2 <= 0) return "Error: Refractive indices must be positive";
        if ($unitAngle === "rad") $theta1 = rad2deg($theta1); // rad to deg
        $sinTheta2 = $n1 * sin(deg2rad($theta1)) / $n2;
        if ($sinTheta2 > 1 || $sinTheta2 < -1) return "Error: Refraction angle impossible (total internal reflection)";
        $result = rad2deg(asin($sinTheta2)); // Angle in deg
        if ($unitAngle === "rad") return deg2rad($result); // deg to rad
        return $result; // Default deg
    }

    /**
     * Calculate mirror focal length (1/f = 1/do + 1/di)
     * @param float $do Object distance (m by default)
     * @param float $di Image distance (m by default)
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @return float|string Focal length or error message
     */
    public function mirrorFocalLength($do, $di, $unitDistance = "m") {
        if ($do == 0 || $di == 0) return "Error: Distances cannot be zero";
        if ($unitDistance === "cm") {
            $do /= 100; // cm to m
            $di /= 100;
        }
        $result = 1 / (1 / $do + 1 / $di); // Focal length in m
        if ($unitDistance === "cm") return $result * 100; // m to cm
        return $result; // Default m
    }

    /**
     * Calculate magnification (M = -di / do)
     * @param float $di Image distance (m by default)
     * @param float $do Object distance (m by default)
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @return float|string Magnification or error message
     */
    public function magnification($di, $do, $unitDistance = "m") {
        if ($do == 0) return "Error: Object distance cannot be zero";
        if ($unitDistance === "cm") {
            $di /= 100; // cm to m
            $do /= 100;
        }
        return -$di / $do; // Magnification (unitless)
    }

    /**
     * Calculate sound intensity (I = P / 4πr²)
     * @param float $p Sound power (W by default)
     * @param float $r Distance (m by default)
     * @param string $unitPower Unit for power (default: "W", options: "mW")
     * @param string $unitDistance Unit for distance (default: "m", options: "cm")
     * @param string $unitIntensity Unit for intensity (default: "W/m²", options: "mW/cm²")
     * @return float|string Intensity or error message
     */
    public function soundIntensity($p, $r, $unitPower = "W", $unitDistance = "m", $unitIntensity = "W/m²") {
        if ($r <= 0) return "Error: Distance must be positive";
        if ($unitPower === "mW") $p /= 1000; // mW to W
        if ($unitDistance === "cm") $r /= 100; // cm to m
        $result = $p / (4 * M_PI * pow($r, 2)); // Intensity in W/m²
        if ($unitIntensity === "mW/cm²") return $result * 100; // W/m² to mW/cm²
        return $result; // Default W/m²
    }

    /**
     * Calculate sound level (β = 10 * log10(I / I₀))
     * @param float $i Intensity (W/m² by default)
     * @param float $i0 Reference intensity (W/m² by default, 1e-12)
     * @param string $unitIntensity Unit for intensity (default: "W/m²", options: "mW/cm²")
     * @return float|string Sound level or error message
     */
    public function soundLevel($i, $i0 = 1e-12, $unitIntensity = "W/m²") {
        if ($i < 0 || $i0 <= 0) return "Error: Intensities must be valid";
        if ($unitIntensity === "mW/cm²") $i /= 100; // mW/cm² to W/m²
        return 10 * log10($i / $i0); // Sound level in dB (unitless)
    }

    /**
     * Calculate single-slit diffraction (sinθ = λ / w)
     * @param float $lambda Wavelength (m by default)
     * @param float $w Slit width (m by default)
     * @param string $unitWavelength Unit for wavelength (default: "m", options: "nm")
     * @param string $unitWidth Unit for slit width (default: "m", options: "µm")
     * @param string $unitAngle Unit for angle (default: "deg", options: "rad")
     * @return float|string First minimum angle or error message
     */
    public function singleSlitDiffraction($lambda, $w, $unitWavelength = "m", $unitWidth = "m", $unitAngle = "deg") {
        if ($w <= 0) return "Error: Slit width must be positive";
        if ($unitWavelength === "nm") $lambda /= 1e9; // nm to m
        if ($unitWidth === "µm") $w /= 1e6; // µm to m
        $result = rad2deg(asin($lambda / $w)); // Angle in degrees
        if ($unitAngle === "rad") return deg2rad($result); // deg to rad
        return $result; // Default deg
    }

    // Relativity
    /**
     * Calculate length contraction (L = L₀ * sqrt(1 - v²/c²))
     * @param float $l0 Proper length (m by default)
     * @param float $v Velocity (m/s by default)
     * @param string $unitLength Unit for length (default: "m", options: "km")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @return float|string Contracted length or error message
     */
    public function lengthContraction($l0, $v, $unitLength = "m", $unitVelocity = "m/s") {
        if ($v >= self::C) return "Error: Velocity cannot exceed or equal speed of light";
        if ($l0 < 0) return "Error: Length cannot be negative";
        if ($unitLength === "km") $l0 *= 1000; // km to m
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        $result = $l0 * sqrt(1 - pow($v, 2) / pow(self::C, 2)); // Length in m
        if ($unitLength === "km") return $result / 1000; // m to km
        return $result; // Default m
    }

    /**
     * Calculate time dilation (Δt = Δt₀ / sqrt(1 - v²/c²))
     * @param float $t0 Proper time (s by default)
     * @param float $v Velocity (m/s by default)
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @return float|string Dilated time or error message
     */
    public function timeDilation($t0, $v, $unitTime = "s", $unitVelocity = "m/s") {
        if ($v >= self::C) return "Error: Velocity cannot exceed or equal speed of light";
        if ($t0 < 0) return "Error: Time cannot be negative";
        if ($unitTime === "min") $t0 *= 60; // min to s
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        $result = $t0 / sqrt(1 - pow($v, 2) / pow(self::C, 2)); // Time in s
        if ($unitTime === "min") return $result / 60; // s to min
        return $result; // Default s
    }

    /**
     * Calculate relativistic energy (E = mc²)
     * @param float $m Mass (kg by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitEnergy Unit for energy (default: "J", options: "MeV")
     * @return float|string Energy or error message
     */
    public function relativisticEnergy($m, $unitMass = "kg", $unitEnergy = "J") {
        if ($m < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        $result = $m * pow(self::C, 2); // Energy in J
        if ($unitEnergy === "MeV") return $result / (1.60217662e-13); // J to MeV
        return $result; // Default J
    }

    /**
     * Calculate relativistic mass (m = m₀ / sqrt(1 - v²/c²))
     * @param float $m0 Rest mass (kg by default)
     * @param float $v Velocity (m/s by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @return float|string Relativistic mass or error message
     */
    public function relativisticMass($m0, $v, $unitMass = "kg", $unitVelocity = "m/s") {
        if ($v >= self::C) return "Error: Velocity cannot exceed or equal speed of light";
        if ($m0 < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m0 /= 1000; // g to kg
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        $result = $m0 / sqrt(1 - pow($v, 2) / pow(self::C, 2)); // Mass in kg
        if ($unitMass === "g") return $result * 1000; // kg to g
        return $result; // Default kg
    }

    /**
     * Calculate relativistic momentum (p = γmv)
     * @param float $m Rest mass (kg by default)
     * @param float $v Velocity (m/s by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @param string $unitMomentum Unit for momentum (default: "kg·m/s", options: "g·cm/s")
     * @return float|string Relativistic momentum or error message
     */
    public function relativisticMomentum($m, $v, $unitMass = "kg", $unitVelocity = "m/s", $unitMomentum = "kg·m/s") {
        if ($v >= self::C) return "Error: Velocity cannot exceed or equal speed of light";
        if ($m < 0) return "Error: Mass cannot be negative";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitVelocity === "km/h") $v /= 3.6; // km/h to m/s
        $gamma = 1 / sqrt(1 - pow($v, 2) / pow(self::C, 2));
        $result = $gamma * $m * $v; // Momentum in kg·m/s
        if ($unitMomentum === "g·cm/s") return $result * 100000; // kg·m/s to g·cm/s
        return $result; // Default kg·m/s
    }

    /**
     * Relativistic velocity addition (u' = (u + v) / (1 + uv/c²))
     * @param float $u First velocity (m/s by default)
     * @param float $v Second velocity (m/s by default)
     * @param string $unitVelocity Unit for velocity (default: "m/s", options: "km/h")
     * @return float|string Combined velocity or error message
     */
    public function relativisticVelocityAddition($u, $v, $unitVelocity = "m/s") {
        if (abs($u) >= self::C || abs($v) >= self::C) return "Error: Velocities cannot exceed or equal speed of light";
        if ($unitVelocity === "km/h") {
            $u /= 3.6; // km/h to m/s
            $v /= 3.6;
        }
        $result = ($u + $v) / (1 + ($u * $v) / pow(self::C, 2)); // Velocity in m/s
        if ($unitVelocity === "km/h") return $result * 3.6; // m/s to km/h
        return $result; // Default m/s
    }

    // Quantum Mechanics
    /**
     * Calculate photon energy (E = hf)
     * @param float $f Frequency (Hz by default)
     * @param string $unitFrequency Unit for frequency (default: "Hz", options: "THz")
     * @param string $unitEnergy Unit for energy (default: "J", options: "eV")
     * @return float|string Energy or error message
     */
    public function photonEnergy($f, $unitFrequency = "Hz", $unitEnergy = "J") {
        if ($f < 0) return "Error: Frequency cannot be negative";
        if ($unitFrequency === "THz") $f *= 1e12; // THz to Hz
        $result = self::H * $f; // Energy in J
        if ($unitEnergy === "eV") return $result / 1.60217662e-19; // J to eV
        return $result; // Default J
    }

    /**
     * Calculate de Broglie wavelength (λ = h / p)
     * @param float $p Momentum (kg·m/s by default)
     * @param string $unitMomentum Unit for momentum (default: "kg·m/s", options: "g·cm/s")
     * @param string $unitWavelength Unit for wavelength (default: "m", options: "nm")
     * @return float|string Wavelength or error message
     */
    public function deBroglieWavelength($p, $unitMomentum = "kg·m/s", $unitWavelength = "m") {
        if ($p <= 0) return "Error: Momentum must be positive";
        if ($unitMomentum === "g·cm/s") $p /= 100000; // g·cm/s to kg·m/s
        $result = self::H / $p; // Wavelength in m
        if ($unitWavelength === "nm") return $result * 1e9; // m to nm
        return $result; // Default m
    }

    /**
     * Calculate energy level in a quantum box (E = n²h² / 8mL²)
     * @param int $n Quantum level
     * @param float $m Mass (kg by default)
     * @param float $l Box length (m by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "g")
     * @param string $unitLength Unit for length (default: "m", options: "nm")
     * @param string $unitEnergy Unit for energy (default: "J", options: "eV")
     * @return float|string Energy or error message
     */
    public function quantumEnergyLevel($n, $m, $l, $unitMass = "kg", $unitLength = "m", $unitEnergy = "J") {
        if ($n < 1 || $m <= 0 || $l <= 0) return "Error: Inputs must be valid";
        if ($unitMass === "g") $m /= 1000; // g to kg
        if ($unitLength === "nm") $l /= 1e9; // nm to m
        $result = pow($n, 2) * pow(self::H, 2) / (8 * $m * pow($l, 2)); // Energy in J
        if ($unitEnergy === "eV") return $result / 1.60217662e-19; // J to eV
        return $result; // Default J
    }

    /**
     * Calculate quantum probability (P = ∫|ψ|²dx, simple approximation)
     * @param callable $psi Wave function
     * @param float $a Lower bound (m by default)
     * @param float $b Upper bound (m by default)
     * @param int $n Number of approximation points
     * @param string $unitLength Unit for bounds (default: "m", options: "nm")
     * @return float|string Probability or error message
     */
    public function quantumProbability($psi, $a, $b, $n = 1000, $unitLength = "m") {
        if ($a >= $b) return "Error: Invalid interval";
        if ($unitLength === "nm") {
            $a /= 1e9; // nm to m
            $b /= 1e9;
        }
        $h = ($b - $a) / $n;
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $x = $a + $i * $h;
            $sum += pow(abs($psi($x)), 2) * $h;
        }
        return $sum; // Probability (unitless)
    }

    // Nuclear Physics
    /**
     * Calculate radioactive decay (N = N₀ * e^(-λt))
     * @param float $n0 Initial amount (kg or particles by default)
     * @param float $lambda Decay constant (1/s by default)
     * @param float $t Time (s by default)
     * @param string $unitAmount Unit for amount (default: "kg", options: "g")
     * @param string $unitDecayConstant Unit for decay constant (default: "1/s", options: "1/min")
     * @param string $unitTime Unit for time (default: "s", options: "min")
     * @return float|string Remaining amount or error message
     */
    public function radioactiveDecay($n0, $lambda, $t, $unitAmount = "kg", $unitDecayConstant = "1/s", $unitTime = "s") {
        if ($n0 < 0 || $lambda < 0 || $t < 0) return "Error: Inputs must be non-negative";
        if ($unitAmount === "g") $n0 /= 1000; // g to kg
        if ($unitDecayConstant === "1/min") $lambda *= 60; // 1/min to 1/s
        if ($unitTime === "min") $t *= 60; // min to s
        $result = $n0 * exp(-$lambda * $t); // Amount in kg or particles
        if ($unitAmount === "g") return $result * 1000; // kg to g
        return $result; // Default kg or particles
    }

    /**
     * Calculate nuclear binding energy (E = Δm * c²)
     * @param float $deltaM Mass defect (kg by default)
     * @param string $unitMass Unit for mass (default: "kg", options: "u")
     * @param string $unitEnergy Unit for energy (default: "J", options: "MeV")
     * @return float|string Energy or error message
     */
    public function nuclearBindingEnergy($deltaM, $unitMass = "kg", $unitEnergy = "J") {
        if ($deltaM < 0) return "Error: Mass defect must be non-negative";
        if ($unitMass === "u") $deltaM *= 1.66053906660e-27; // u (atomic mass unit) to kg
        $result = $deltaM * pow(self::C, 2); // Energy in J
        if ($unitEnergy === "MeV") return $result / 1.60217662e-13; // J to MeV
        return $result; // Default J
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing PhysicsCalculations:\n";
        echo "----------------------------------------\n";

        // Group 1: Mechanics - Kinematics
        echo "Group 1: Mechanics - Kinematics\n";
        echo "-------------------------\n";
        echo "// Test final velocity with u=2 m/s, a=3 m/s², t=4 s\n";
        echo "finalVelocity(2, 3, 4): " . $this->finalVelocity(2, 3, 4) . "\n"; // Expected: 14
        echo "// Test distance with u=2 m/s, a=3 m/s², t=4 s\n";
        echo "distance(2, 3, 4): " . $this->distance(2, 3, 4) . "\n"; // Expected: 32
        echo "// Test final velocity with distance u=2 m/s, a=3 m/s², s=5 m\n";
        echo "finalVelocityWithDistance(2, 3, 5): " . $this->finalVelocityWithDistance(2, 3, 5) . "\n"; // Expected: ~5.74
        echo "// Test time from velocity with u=2 m/s, v=8 m/s, a=3 m/s²\n";
        echo "timeFromVelocity(2, 8, 3): " . $this->timeFromVelocity(2, 8, 3) . "\n"; // Expected: 2
        echo "// Test angular position with θ₀=0 rad, ω=2 rad/s, α=1 rad/s², t=2 s\n";
        echo "angularPosition(0, 2, 1, 2): " . $this->angularPosition(0, 2, 1, 2) . "\n"; // Expected: 6
        echo "// Test angular velocity with ω₀=2 rad/s, α=1 rad/s², t=2 s\n";
        echo "angularVelocity(2, 1, 2): " . $this->angularVelocity(2, 1, 2) . "\n"; // Expected: 4

        // Group 2: Mechanics - Dynamics
        echo "\nGroup 2: Mechanics - Dynamics\n";
        echo "-------------------------\n";
        echo "// Test force with m=5 kg, a=2 m/s²\n";
        echo "force(5, 2): " . $this->force(5, 2) . "\n"; // Expected: 10
        echo "// Test weight with m=10 kg (default g=9.81 m/s²)\n";
        echo "weight(10): " . $this->weight(10) . "\n"; // Expected: 98.1
        echo "// Test gravitational force with m1=5 kg, m2=10 kg, r=2 m\n";
        echo "gravitationalForce(5, 10, 2): " . $this->gravitationalForce(5, 10, 2) . "\n"; // Expected: ~8.34e-11
        echo "// Test momentum with m=2 kg, v=3 m/s\n";
        echo "momentum(2, 3): " . $this->momentum(2, 3) . "\n"; // Expected: 6
        echo "// Test angular momentum with I=1.5 kg·m², ω=2 rad/s\n";
        echo "angularMomentum(1.5, 2): " . $this->angularMomentum(1.5, 2) . "\n"; // Expected: 3
        echo "// Test torque with F=10 N, r=2 m, θ=90°\n";
        echo "torque(10, 2, 90): " . $this->torque(10, 2, 90) . "\n"; // Expected: 20
        echo "// Test friction force with μ=0.3, N=98.1 N\n";
        echo "frictionForce(0.3, 98.1): " . $this->frictionForce(0.3, 98.1) . "\n"; // Expected: 29.43
        echo "// Test fluid pressure with ρ=1000 kg/m³, h=10 m\n";
        echo "fluidPressure(1000, 10): " . $this->fluidPressure(1000, 10) . "\n"; // Expected: 98100
        echo "// Test buoyant force with ρ=1000 kg/m³, V=0.01 m³\n";
        echo "buoyantForce(1000, 0.01): " . $this->buoyantForce(1000, 0.01) . "\n"; // Expected: 98.1

        // Group 3: Work and Energy
        echo "\nGroup 3: Work and Energy\n";
        echo "-------------------------\n";
        echo "// Test work with F=10 N, d=2 m, θ=0°\n";
        echo "work(10, 2, 0): " . $this->work(10, 2, 0) . "\n"; // Expected: 20
        echo "// Test kinetic energy with m=2 kg, v=3 m/s\n";
        echo "kineticEnergy(2, 3): " . $this->kineticEnergy(2, 3) . "\n"; // Expected: 9
        echo "// Test potential energy with m=2 kg, h=10 m\n";
        echo "potentialEnergy(2, 10): " . $this->potentialEnergy(2, 10) . "\n"; // Expected: 196.2
        echo "// Test spring potential energy with k=100 N/m, x=0.1 m\n";
        echo "springPotentialEnergy(100, 0.1): " . $this->springPotentialEnergy(100, 0.1) . "\n"; // Expected: 0.5
        echo "// Test power with W=20 J, t=4 s\n";
        echo "power(20, 4): " . $this->power(20, 4) . "\n"; // Expected: 5
        echo "// Test spring frequency with k=100 N/m, m=1 kg\n";
        echo "springFrequency(100, 1): " . $this->springFrequency(100, 1) . "\n"; // Expected: ~1.59
        echo "// Test pendulum frequency with L=1 m\n";
        echo "pendulumFrequency(1): " . $this->pendulumFrequency(1) . "\n"; // Expected: ~0.498

        // Group 4: Thermodynamics
        echo "\nGroup 4: Thermodynamics\n";
        echo "-------------------------\n";
        echo "// Test heat with m=1 kg, c=4186 J/kg·K, ΔT=10 K\n";
        echo "heat(1, 4186, 10): " . $this->heat(1, 4186, 10) . "\n"; // Expected: 41860
        echo "// Test first law of thermodynamics with Q=100 J, W=40 J\n";
        echo "firstLawOfThermodynamics(100, 40): " . $this->firstLawOfThermodynamics(100, 40) . "\n"; // Expected: 60
        echo "// Test ideal gas pressure with n=1 mol, T=300 K, V=0.025 m³\n";
        echo "idealGasPressure(1, 300, 0.025): " . $this->idealGasPressure(1, 300, 0.025) . "\n"; // Expected: ~99735.14
        echo "// Test isobaric work with P=100000 Pa, ΔV=0.01 m³\n";
        echo "workIsobaric(100000, 0.01): " . $this->workIsobaric(100000, 0.01) . "\n"; // Expected: 1000
        echo "// Test isothermal work with n=1 mol, T=300 K, V₁=0.025 m³, V₂=0.05 m³\n";
        echo "workIsothermal(1, 300, 0.025, 0.05): " . $this->workIsothermal(1, 300, 0.025, 0.05) . "\n"; // Expected: ~1728.64
        echo "// Test entropy with Q=1000 J, T=300 K\n";
        echo "entropy(1000, 300): " . $this->entropy(1000, 300) . "\n"; // Expected: ~3.33
        echo "// Test Carnot efficiency with T_hot=400 K, T_cold=300 K\n";
        echo "carnotEfficiency(400, 300): " . $this->carnotEfficiency(400, 300) . "\n"; // Expected: 0.25
        echo "// Test second law entropy with ΔS_system=2 J/K, ΔS_surroundings=1 J/K\n";
        echo "secondLawEntropy(2, 1): " . $this->secondLawEntropy(2, 1) . "\n"; // Expected: 3

        // Group 5: Electricity and Magnetism
        echo "\nGroup 5: Electricity and Magnetism\n";
        echo "-------------------------\n";
        echo "// Test Coulomb force with q1=1e-6 C, q2=2e-6 C, r=0.1 m\n";
        echo "coulombForce(1e-6, 2e-6, 0.1): " . $this->coulombForce(1e-6, 2e-6, 0.1) . "\n"; // Expected: 0.17955
        echo "// Test electric field with q=1e-6 C, r=0.1 m\n";
        echo "electricField(1e-6, 0.1): " . $this->electricField(1e-6, 0.1) . "\n"; // Expected: 89975.52
        echo "// Test electric potential with q=1e-6 C, r=0.1 m\n";
        echo "electricPotential(1e-6, 0.1): " . $this->electricPotential(1e-6, 0.1) . "\n"; // Expected: 8997.55
        echo "// Test capacitance with Q=1e-6 C, V=2 V\n";
        echo "capacitance(1e-6, 2): " . $this->capacitance(1e-6, 2) . "\n"; // Expected: 5e-7
        echo "// Test capacitor energy with C=1e-6 F, V=10 V\n";
        echo "capacitorEnergy(1e-6, 10): " . $this->capacitorEnergy(1e-6, 10) . "\n"; // Expected: 5e-5
        echo "// Test Ohm's law with I=2 A, R=5 Ω\n";
        echo "ohmsLaw(2, 5): " . $this->ohmsLaw(2, 5) . "\n"; // Expected: 10
        echo "// Test electric power with V=10 V, I=2 A\n";
        echo "electricPower(10, 2): " . $this->electricPower(10, 2) . "\n"; // Expected: 20
        echo "// Test Lorentz force with q=1e-6 C, v=2 m/s, B=0.5 T, θ=90°\n";
        echo "lorentzForce(1e-6, 2, 0.5, 90): " . $this->lorentzForce(1e-6, 2, 0.5, 90) . "\n"; // Expected: 1e-6
        echo "// Test magnetic field from wire with I=2 A, r=0.1 m\n";
        echo "magneticFieldFromWire(2, 0.1): " . $this->magneticFieldFromWire(2, 0.1) . "\n"; // Expected: 4e-6
        echo "// Test magnetic force between wires with I₁=2 A, I₂=3 A, r=0.1 m\n";
        echo "magneticForceBetweenWires(2, 3, 0.1): " . $this->magneticForceBetweenWires(2, 3, 0.1) . "\n"; // Expected: 1.2e-5
        echo "// Test Gauss's law for electric field with Q=1e-6 C\n";
        echo "gaussLawElectric(1e-6): " . $this->gaussLawElectric(1e-6) . "\n"; // Expected: ~1.13e5
        echo "// Test Gauss's law for magnetic field\n";
        echo "gaussLawMagnetic(): " . $this->gaussLawMagnetic() . "\n"; // Expected: 0
        echo "// Test Faraday's law with ΔΦ_B=0.01 Wb, Δt=0.1 s\n";
        echo "faradayLaw(0.01, 0.1): " . $this->faradayLaw(0.01, 0.1) . "\n"; // Expected: -0.1
        echo "// Test electric field energy with E=1000 N/C, V=0.001 m³\n";
        echo "electricFieldEnergy(1000, 0.001): " . $this->electricFieldEnergy(1000, 0.001) . "\n"; // Expected: ~4.43e-6

        // Group 6: Waves and Optics
        echo "\nGroup 6: Waves and Optics\n";
        echo "-------------------------\n";
        echo "// Test frequency with T=0.5 s\n";
        echo "frequency(0.5): " . $this->frequency(0.5) . "\n"; // Expected: 2
        echo "// Test wavelength with v=340 m/s, f=170 Hz\n";
        echo "wavelength(340, 170): " . $this->wavelength(340, 170) . "\n"; // Expected: 2
        echo "// Test Doppler effect with f=100 Hz, v=340 m/s, vd=0 m/s, vs=34 m/s\n";
        echo "dopplerEffect(100, 340, 0, 34): " . $this->dopplerEffect(100, 340, 0, 34) . "\n"; // Expected: ~111.11
        echo "// Test law of reflection with θᵢ=45°\n";
        echo "lawOfReflection(45): " . $this->lawOfReflection(45) . "\n"; // Expected: 45
        echo "// Test Snell's law with n₁=1, θ₁=30°, n₂=1.5\n";
        echo "snellsLaw(1, 30, 1.5): " . $this->snellsLaw(1, 30, 1.5) . "\n"; // Expected: ~19.47
        echo "// Test mirror focal length with do=10 m, di=5 m\n";
        echo "mirrorFocalLength(10, 5): " . $this->mirrorFocalLength(10, 5) . "\n"; // Expected: ~3.33
        echo "// Test magnification with di=5 m, do=10 m\n";
        echo "magnification(5, 10): " . $this->magnification(5, 10) . "\n"; // Expected: -0.5
        echo "// Test sound intensity with P=10 W, r=1 m\n";
        echo "soundIntensity(10, 1): " . $this->soundIntensity(10, 1) . "\n"; // Expected: ~0.796
        echo "// Test sound level with I=1e-6 W/m²\n";
        echo "soundLevel(1e-6): " . $this->soundLevel(1e-6) . "\n"; // Expected: 60
        echo "// Test single-slit diffraction with λ=5e-7 m, w=1e-6 m\n";
        echo "singleSlitDiffraction(5e-7, 1e-6): " . $this->singleSlitDiffraction(5e-7, 1e-6) . "\n"; // Expected: 30

        // Group 7: Relativity
        echo "\nGroup 7: Relativity\n";
        echo "-------------------------\n";
        echo "// Test length contraction with L₀=10 m, v=1.5e8 m/s\n";
        echo "lengthContraction(10, 1.5e8): " . $this->lengthContraction(10, 1.5e8) . "\n"; // Expected: ~8.66
        echo "// Test time dilation with Δt₀=1 s, v=1.5e8 m/s\n";
        echo "timeDilation(1, 1.5e8): " . $this->timeDilation(1, 1.5e8) . "\n"; // Expected: ~1.15
        echo "// Test relativistic energy with m=0.001 kg\n";
        echo "relativisticEnergy(0.001): " . $this->relativisticEnergy(0.001) . "\n"; // Expected: ~8.99e13
        echo "// Test relativistic mass with m₀=0.001 kg, v=1.5e8 m/s\n";
        echo "relativisticMass(0.001, 1.5e8): " . $this->relativisticMass(0.001, 1.5e8) . "\n"; // Expected: ~0.001154
        echo "// Test relativistic momentum with m=0.001 kg, v=1.5e8 m/s\n";
        echo "relativisticMomentum(0.001, 1.5e8): " . $this->relativisticMomentum(0.001, 1.5e8) . "\n"; // Expected: ~1.732e5
        echo "// Test relativistic velocity addition with u=1e8 m/s, v=1e8 m/s\n";
        echo "relativisticVelocityAddition(1e8, 1e8): " . $this->relativisticVelocityAddition(1e8, 1e8) . "\n"; // Expected: ~1.98e8

        // Group 8: Quantum Mechanics
        echo "\nGroup 8: Quantum Mechanics\n";
        echo "-------------------------\n";
        echo "// Test photon energy with f=5e14 Hz\n";
        echo "photonEnergy(5e14): " . $this->photonEnergy(5e14) . "\n"; // Expected: ~3.31e-19
        echo "// Test de Broglie wavelength with p=1e-34 kg·m/s\n";
        echo "deBroglieWavelength(1e-34): " . $this->deBroglieWavelength(1e-34) . "\n"; // Expected: 6.62607015
        echo "// Test quantum energy level with n=1, m=9.11e-31 kg, L=1e-9 m\n";
        echo "quantumEnergyLevel(1, 9.11e-31, 1e-9): " . $this->quantumEnergyLevel(1, 9.11e-31, 1e-9) . "\n"; // Expected: ~6.02e-20
        $psi = function($x) { return sin($x); };
        echo "// Test quantum probability with ψ=sin(x), a=0 m, b=π m\n";
        echo "quantumProbability(sin(x), 0, pi): " . $this->quantumProbability($psi, 0, M_PI) . "\n"; // Expected: ~1.57

        // Group 9: Nuclear Physics
        echo "\nGroup 9: Nuclear Physics\n";
        echo "-------------------------\n";
        echo "// Test radioactive decay with N₀=1 kg, λ=0.1 1/s, t=5 s\n";
        echo "radioactiveDecay(1, 0.1, 5): " . $this->radioactiveDecay(1, 0.1, 5) . "\n"; // Expected: ~0.6065
        echo "// Test nuclear binding energy with Δm=1e-27 kg\n";
        echo "nuclearBindingEnergy(1e-27): " . $this->nuclearBindingEnergy(1e-27) . "\n"; // Expected: ~8.99e-11

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$physics = new PhysicsCalculations();
$physics->runTests();
?>