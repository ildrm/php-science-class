<?php

require_once 'MathCalculations.php';

class ArchitectureCalculations {
    private $math;

    public function __construct() {
        $this->math = new MathCalculations();
    }

    /**
     * Calculate the area of a rectangular room
     * @param float $length Length of the room
     * @param float $width Width of the room
     * @return float Area
     */
    public function calculateRoomArea($length, $width) {
        return $this->math->multiply($length, $width);
    }

    /**
     * Calculate the volume of a rectangular building
     * @param float $length Length of the building
     * @param float $width Width of the building
     * @param float $height Height of the building
     * @return float Volume
     */
    public function calculateBuildingVolume($length, $width, $height) {
        return $this->math->multiply($this->math->multiply($length, $width), $height);
    }

    /**
     * Calculate the pitch of a roof (rise/run in degrees)
     * @param float $rise Vertical rise
     * @param float $run Horizontal run
     * @return float|string Angle in degrees or error message
     */
    public function calculateRoofPitch($rise, $run) {
        $tanValue = $this->math->divide($rise, $run);
        if (is_string($tanValue)) return $tanValue;
        return $this->math->arctan($tanValue);
    }

    /**
     * Calculate the load-bearing capacity of a beam (simplified)
     * @param float $force Applied force (N)
     * @param float $length Beam length (m)
     * @param float $width Beam width (m)
     * @param float $height Beam height (m)
     * @return float|string Stress or error message
     */
    public function calculateBeamStress($force, $length, $width, $height) {
        $area = $this->math->multiply($width, $height);
        return $this->math->divide($force, $area);
    }

    /**
     * Calculate foundation settlement using linear regression
     * @param array $loads Array of loads over time
     * @param array $settlements Array of corresponding settlements
     * @return array|string Regression coefficients or error message
     */
    public function calculateFoundationSettlement($loads, $settlements) {
        return $this->math->linearRegression($loads, $settlements);
    }

    /**
     * Calculate the center of mass for a set of structural points
     * @param array $points Array of [x, y, mass] coordinates
     * @return array Center of mass [x, y]
     */
    public function calculateCenterOfMass($points) {
        $totalMass = 0;
        $xSum = 0;
        $ySum = 0;
        foreach ($points as $point) {
            [$x, $y, $mass] = $point;
            $totalMass += $mass;
            $xSum += $this->math->multiply($x, $mass);
            $ySum += $this->math->multiply($y, $mass);
        }
        return [
            $this->math->divide($xSum, $totalMass),
            $this->math->divide($ySum, $totalMass)
        ];
    }

    /**
     * Run tests for ArchitectureCalculations class
     * @return void
     */
    public function runTests() {
        echo "Start Testing ArchitectureCalculations:\n";
        echo "-------------------------\n";
        echo "// Test room area with length 5 and width 3\n";
        echo "calculateRoomArea(5, 3): " . $this->calculateRoomArea(5, 3) . "\n"; // Expected: 15
        echo "// Test building volume with length 5, width 3, height 2\n";
        echo "calculateBuildingVolume(5, 3, 2): " . $this->calculateBuildingVolume(5, 3, 2) . "\n"; // Expected: 30
        echo "// Test roof pitch with rise 4 and run 12\n";
        echo "calculateRoofPitch(4, 12): " . $this->calculateRoofPitch(4, 12) . "\n"; // Expected: ~18.43
        echo "// Test beam stress with force 1000N, length 2m, width 0.1m, height 0.2m\n";
        echo "calculateBeamStress(1000, 2, 0.1, 0.2): " . $this->calculateBeamStress(1000, 2, 0.1, 0.2) . "\n"; // Expected: 50000
        echo "// Test foundation settlement with loads [1,2,3] and settlements [2,4,6]\n";
        echo "calculateFoundationSettlement([1,2,3], [2,4,6]): " . json_encode($this->calculateFoundationSettlement([1, 2, 3], [2, 4, 6])) . "\n"; // Expected: [2, 0]
        echo "// Test center of mass for points [[1,2,1], [3,4,2], [5,6,3]]\n";
        echo "calculateCenterOfMass([[1,2,1], [3,4,2], [5,6,3]]): " . json_encode($this->calculateCenterOfMass([[1, 2, 1], [3, 4, 2], [5, 6, 3]])) . "\n"; // Expected: [3.5, 4.5]
        echo "-------------------------\n";
        echo "End of Tests\n";
    }
}

$arch = new ArchitectureCalculations();
$arch->runTests();
?>