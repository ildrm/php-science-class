<?php

class BiologyCalculations {
    const R = 8.314; // Gas constant (J/mol·K)
    const NA = 6.02214076e23; // Avogadro's number (1/mol)
    const K = 1.380649e-23; // Boltzmann constant (J/K)

    /**
     * Hardy-Weinberg equilibrium frequencies
     * @param float $p Frequency of allele A
     * @return array Genotype frequencies [p², 2pq, q²]
     */
    public function hardyWeinberg($p) {
        if ($p < 0 || $p > 1) return "Error: Frequency must be between 0 and 1";
        $q = 1 - $p;
        return [pow($p, 2), 2 * $p * $q, pow($q, 2)];
    }

    /**
     * Logistic population growth rate
     * @param float $r Intrinsic growth rate
     * @param float $n Current population
     * @param float $k Carrying capacity
     * @return float Growth rate (dN/dt)
     */
    public function logisticGrowth($r, $n, $k) {
        if ($k <= 0 || $n < 0) return "Error: Values must be valid";
        return $r * $n * (1 - $n / $k);
    }

    /**
     * Genetic distance (Hamming distance)
     * @param string $seq1 First sequence
     * @param string $seq2 Second sequence
     * @return int|string Distance or error message
     */
    public function geneticDistance($seq1, $seq2) {
        if (strlen($seq1) != strlen($seq2)) return "Error: Sequence lengths must match";
        $distance = 0;
        for ($i = 0; $i < strlen($seq1); $i++) {
            if ($seq1[$i] != $seq2[$i]) $distance++;
        }
        return $distance;
    }

    /**
     * Michaelis-Menten enzyme kinetics
     * @param float $vmax Maximum reaction rate
     * @param float $km Michaelis constant
     * @param float $s Substrate concentration
     * @return float Reaction velocity
     */
    public function michaelisMenten($vmax, $km, $s) {
        if ($vmax < 0 || $km <= 0 || $s < 0) return "Error: Values must be valid";
        return $vmax * $s / ($km + $s);
    }

    /**
     * Calculate mutation rate
     * @param int $mutations Number of mutations
     * @param int $generations Number of generations
     * @param int $sites Number of sites
     * @return float Mutation rate
     */
    public function mutationRate($mutations, $generations, $sites) {
        if ($mutations < 0 || $generations <= 0 || $sites <= 0) return "Error: Values must be valid";
        return $mutations / ($generations * $sites);
    }

    /**
     * Calculate genetic diversity
     * @param array $frequencies Allele frequencies
     * @return float Genetic diversity
     */
    public function geneticDiversity($frequencies) {
        $sum = 0;
        foreach ($frequencies as $freq) {
            if ($freq < 0 || $freq > 1) return "Error: Frequency must be between 0 and 1";
            $sum += pow($freq, 2);
        }
        return 1 - $sum;
    }

    /**
     * Run tests for all functions
     * @return void
     */
    public function runTests() {
        echo "hardyWeinberg(0.7): " . json_encode($this->hardyWeinberg(0.7)) . "\n";
        echo "logisticGrowth(0.1, 50, 100): " . $this->logisticGrowth(0.1, 50, 100) . "\n";
        echo "geneticDistance('ATCG', 'ATGG'): " . $this->geneticDistance("ATCG", "ATGG") . "\n";
        echo "michaelisMenten(10, 2, 1): " . $this->michaelisMenten(10, 2, 1) . "\n";
        echo "mutationRate(10, 100, 1000): " . $this->mutationRate(10, 100, 1000) . "\n";
        echo "geneticDiversity([0.4, 0.3, 0.3]): " . $this->geneticDiversity([0.4, 0.3, 0.3]) . "\n";
    }
}

$bio = new BiologyCalculations();
$bio->runTests();
?>