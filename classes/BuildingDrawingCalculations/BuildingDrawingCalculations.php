<?php

require_once 'MathCalculations.php';

class BuildingDrawingCalculations {
    private $math;

    public function __construct() {
        $this->math = new MathCalculations();
    }

    /**
     * Calculate total wall length from a set of corner points
     * @param array $points Array of [x, y] coordinates defining the perimeter
     * @return float Total wall length
     */
    public function calculateWallLength($points) {
        $totalLength = 0;
        $n = count($points);
        for ($i = 0; $i < $n; $i++) {
            $point1 = $points[$i];
            $point2 = $points[($i + 1) % $n];
            $totalLength += $this->math->euclideanDistance($point1, $point2);
        }
        return $totalLength;
    }

    /**
     * Calculate floor area from a set of corner points (polygon)
     * @param array $points Array of [x, y] coordinates defining the floor perimeter
     * @return float Floor area
     */
    public function calculateFloorArea($points) {
        $n = count($points);
        $area = 0;
        for ($i = 0; $i < $n; $i++) {
            $j = ($i + 1) % $n;
            $area += $this->math->multiply($points[$i][0], $points[$j][1]);
            $area -= $this->math->multiply($points[$j][0], $points[$i][1]);
        }
        return $this->math->divide($this->math->absoluteValue($area), 2);
    }

    /**
     * Calculate roof slope angle from rise and run
     * @param float $rise Vertical rise of the roof
     * @param float $run Horizontal run of the roof
     * @return float|string Angle in degrees or error message
     */
    public function calculateRoofSlope($rise, $run) {
        $tanValue = $this->math->divide($rise, $run);
        if (is_string($tanValue)) return $tanValue;
        return $this->math->arctan($tanValue);
    }

    /**
     * Calculate concrete volume for a foundation slab
     * @param float $length Length of the slab
     * @param float $width Width of the slab
     * @param float $thickness Thickness of the slab
     * @return float Volume in cubic units
     */
    public function calculateConcreteVolume($length, $width, $thickness) {
        return $this->math->multiply($this->math->multiply($length, $width), $thickness);
    }

    /**
     * Calculate number of bricks needed for a wall
     * @param float $wallLength Length of the wall
     * @param float $wallHeight Height of the wall
     * @param float $brickLength Length of one brick (default: 0.2m)
     * @param float $brickHeight Height of one brick (default: 0.1m)
     * @return int|string Number of bricks or error message
     */
    public function calculateBrickCount($wallLength, $wallHeight, $brickLength = 0.2, $brickHeight = 0.1) {
        $wallArea = $this->math->multiply($wallLength, $wallHeight);
        $brickArea = $this->math->multiply($brickLength, $brickHeight);
        $count = $this->math->divide($wallArea, $brickArea);
        if (is_string($count)) return $count;
        return (int)ceil($count);
    }

    /**
     * Calculate window area for glazing estimation
     * @param float $width Width of the window
     * @param float $height Height of the window
     * @return float Window area
     */
    public function calculateWindowArea($width, $height) {
        return $this->math->multiply($width, $height);
    }

    /**
     * Calculate roof surface area for a gable roof
     * @param float $baseWidth Width of the building base
     * @param float $baseLength Length of the building base
     * @param float $roofHeight Height of the roof peak
     * @return float Roof surface area
     */
    public function calculateGableRoofArea($baseWidth, $baseLength, $roofHeight) {
        $slopeLength = $this->math->squareRoot($this->math->add(
            $this->math->power($baseWidth / 2, 2),
            $this->math->power($roofHeight, 2)
        ));
        return $this->math->multiply(2, $this->math->multiply($slopeLength, $baseLength));
    }

    /**
     * Calculate number of roof tiles needed
     * @param float $roofArea Total roof surface area
     * @param float $tileWidth Width of one tile (default: 0.3m)
     * @param float $tileLength Length of one tile (default: 0.4m)
     * @return int|string Number of tiles or error message
     */
    public function calculateRoofTileCount($roofArea, $tileWidth = 0.3, $tileLength = 0.4) {
        $tileArea = $this->math->multiply($tileWidth, $tileLength);
        $count = $this->math->divide($roofArea, $tileArea);
        if (is_string($count)) return $count;
        return (int)ceil($count);
    }

    /**
     * Calculate stair riser height
     * @param float $totalHeight Total height of the staircase
     * @param int $stepCount Number of steps
     * @return float|string Riser height or error message
     */
    public function calculateStairRiserHeight($totalHeight, $stepCount) {
        return $this->math->divide($totalHeight, $stepCount);
    }

    /**
     * Calculate stair tread depth (run)
     * @param float $totalRun Total horizontal length of the staircase
     * @param int $stepCount Number of steps
     * @return float|string Tread depth or error message
     */
    public function calculateStairTreadDepth($totalRun, $stepCount) {
        return $this->math->divide($totalRun, $stepCount - 1); // One less tread than risers
    }

    /**
     * Calculate rebar weight for concrete reinforcement
     * @param float $length Length of rebar (m)
     * @param float $diameter Diameter of rebar (mm)
     * @param float $density Steel density (default: 7850 kg/m³)
     * @return float Weight in kg
     */
    public function calculateRebarWeight($length, $diameter, $density = 7850) {
        $radius = $this->math->divide($diameter, 2000); // Convert mm to m and divide by 2
        $area = $this->math->multiply(M_PI, $this->math->power($radius, 2));
        $volume = $this->math->multiply($area, $length);
        return $this->math->multiply($volume, $density);
    }

    /**
     * Calculate beam deflection (simplified, uniformly distributed load)
     * @param float $load Load per unit length (N/m)
     * @param float $length Beam length (m)
     * @param float $youngsModulus Young's modulus (Pa)
     * @param float $momentOfInertia Moment of inertia (m⁴)
     * @return float|string Deflection at center (m) or error message
     */
    public function calculateBeamDeflection($load, $length, $youngsModulus, $momentOfInertia) {
        $numerator = $this->math->multiply(5, $this->math->multiply($load, $this->math->power($length, 4)));
        $denominator = $this->math->multiply(384, $this->math->multiply($youngsModulus, $momentOfInertia));
        return $this->math->divide($numerator, $denominator);
    }

    /**
     * Calculate column load capacity (simplified Euler buckling)
     * @param float $youngsModulus Young's modulus (Pa)
     * @param float $momentOfInertia Moment of inertia (m⁴)
     * @param float $length Column length (m)
     * @return float|string Critical load (N) or error message
     */
    public function calculateColumnLoadCapacity($youngsModulus, $momentOfInertia, $length) {
        $numerator = $this->math->multiply(M_PI * M_PI, $this->math->multiply($youngsModulus, $momentOfInertia));
        $denominator = $this->math->power($length, 2);
        return $this->math->divide($numerator, $denominator);
    }

    /**
     * Calculate paint coverage area
     * @param float $surfaceArea Total surface area to paint (m²)
     * @param float $coverageRate Paint coverage rate (m²/L, default: 10)
     * @return float|string Liters of paint needed or error message
     */
    public function calculatePaintVolume($surfaceArea, $coverageRate = 10) {
        return $this->math->divide($surfaceArea, $coverageRate);
    }

    /**
     * Calculate footing area for a column
     * @param float $load Load on column (N)
     * @param float $soilBearingCapacity Soil bearing capacity (Pa, N/m²)
     * @return float|string Footing area (m²) or error message
     */
    public function calculateFootingArea($load, $soilBearingCapacity) {
        return $this->math->divide($load, $soilBearingCapacity);
    }

    /**
     * Run tests for BuildingDrawingCalculations class
     * @return void
     */
    public function runTests() {
        echo "Start Testing BuildingDrawingCalculations:\n";
        echo "-------------------------\n";
        echo "// Test wall length for points [[0,0], [4,0], [4,3], [0,3]]\n";
        $points = [[0, 0], [4, 0], [4, 3], [0, 3]];
        echo "calculateWallLength: " . $this->calculateWallLength($points) . "\n"; // Expected: 14
        echo "// Test floor area for points [[0,0], [4,0], [4,3], [0,3]]\n";
        echo "calculateFloorArea: " . $this->calculateFloorArea($points) . "\n"; // Expected: 12
        echo "// Test roof slope with rise 3 and run 12\n";
        echo "calculateRoofSlope(3, 12): " . $this->calculateRoofSlope(3, 12) . "\n"; // Expected: ~14.04
        echo "// Test concrete volume for slab 5m x 3m x 0.2m\n";
        echo "calculateConcreteVolume(5, 3, 0.2): " . $this->calculateConcreteVolume(5, 3, 0.2) . "\n"; // Expected: 3
        echo "// Test brick count for wall 4m x 2.5m\n";
        echo "calculateBrickCount(4, 2.5): " . $this->calculateBrickCount(4, 2.5) . "\n"; // Expected: 500
        echo "// Test window area for 1.2m x 1.5m\n";
        echo "calculateWindowArea(1.2, 1.5): " . $this->calculateWindowArea(1.2, 1.5) . "\n"; // Expected: 1.8
        echo "// Test gable roof area for 6m x 10m base, 3m height\n";
        echo "calculateGableRoofArea(6, 10, 3): " . $this->calculateGableRoofArea(6, 10, 3) . "\n"; // Expected: ~67.08
        echo "// Test roof tile count for 67m² roof\n";
        echo "calculateRoofTileCount(67): " . $this->calculateRoofTileCount(67) . "\n"; // Expected: 558
        echo "// Test stair riser height for 2.4m height, 12 steps\n";
        echo "calculateStairRiserHeight(2.4, 12): " . $this->calculateStairRiserHeight(2.4, 12) . "\n"; // Expected: 0.2
        echo "// Test stair tread depth for 3m run, 12 steps\n";
        echo "calculateStairTreadDepth(3, 12): " . $this->calculateStairTreadDepth(3, 12) . "\n"; // Expected: ~0.27
        echo "// Test rebar weight for 10m length, 12mm diameter\n";
        echo "calculateRebarWeight(10, 12): " . $this->calculateRebarWeight(10, 12) . "\n"; // Expected: ~8.88
        echo "// Test beam deflection for 1000N/m, 4m, 2e11Pa, 0.0001m⁴\n";
        echo "calculateBeamDeflection(1000, 4, 2e11, 0.0001): " . $this->calculateBeamDeflection(1000, 4, 2e11, 0.0001) . "\n"; // Expected: ~0.00013
        echo "// Test column load capacity for 2e11Pa, 0.0001m⁴, 3m\n";
        echo "calculateColumnLoadCapacity(2e11, 0.0001, 3): " . $this->calculateColumnLoadCapacity(2e11, 0.0001, 3) . "\n"; // Expected: ~2.19e6
        echo "// Test paint volume for 50m² surface\n";
        echo "calculatePaintVolume(50): " . $this->calculatePaintVolume(50) . "\n"; // Expected: 5
        echo "// Test footing area for 100000N load, 200000Pa soil capacity\n";
        echo "calculateFootingArea(100000, 200000): " . $this->calculateFootingArea(100000, 200000) . "\n"; // Expected: 0.5
        echo "-------------------------\n";
        echo "End of Tests\n";
    }
}

$building = new BuildingDrawingCalculations();
$building->runTests();
?>