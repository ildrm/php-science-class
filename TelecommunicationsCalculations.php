<?php

class TelecommunicationsCalculations {
    const C = 299792458; // Speed of light (m/s)

    /**
     * Calculate wavelength
     * @param float $f Frequency (Hz)
     * @return float Wavelength (m)
     */
    public function wavelength($f) {
        if ($f <= 0) return "Error: Frequency must be positive";
        return self::C / $f;
    }

    /**
     * Friis Transmission Equation for received power
     * @param float $pt Transmitted power (W)
     * @param float $gt Transmitter antenna gain
     * @param float $gr Receiver antenna gain
     * @param float $d Distance (m)
     * @param float $f Frequency (Hz)
     * @return float Received power (W)
     */
    public function friisTransmission($pt, $gt, $gr, $d, $f) {
        $lambda = $this->wavelength($f);
        return $pt * $gt * $gr * pow($lambda, 2) / (pow(4 * M_PI * $d, 2));
    }

    /**
     * Run tests for all functions
     * @return void
     */
    public function runTests() {
        echo "wavelength(1e9): " . $this->wavelength(1e9) . "\n";
        echo "friisTransmission(10, 1, 1, 100, 1e9): " . $this->friisTransmission(10, 1, 1, 100, 1e9) . "\n";
    }
}

$tele = new TelecommunicationsCalculations();
$tele->runTests();
?>