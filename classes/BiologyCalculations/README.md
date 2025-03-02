# PHP BiologyCalculations Library

This library provides a set of functions for performing common calculations in biology, focusing on population genetics, population dynamics, and enzyme kinetics. It uses fundamental constants such as the gas constant (R), Avogadro's number (NA), and the Boltzmann constant (K).

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `hardyWeinberg(p)` | Calculate Hardy-Weinberg equilibrium frequencies | Calculates the genotype frequencies (p², 2pq, q²) based on the frequency of allele A (p).  Assumes a two-allele system (A and a) in a population at Hardy-Weinberg equilibrium. |
| `logisticGrowth(r, n, k)` | Calculate logistic population growth rate | *dN/dt = rN(1 - N/K)* (Rate of population change = Intrinsic growth rate * Current population * (1 - Current population / Carrying capacity)) |
| `geneticDistance(seq1, seq2)` | Calculate genetic distance | Calculates the Hamming distance between two genetic sequences. This represents the number of differing positions between two aligned sequences of equal length. |
| `michaelisMenten(vmax, km, s)` | Apply Michaelis-Menten enzyme kinetics | *v = V<sub>max</sub>[S] / (K<sub>m</sub> + [S])* (Reaction velocity = Maximum reaction rate * Substrate concentration / (Michaelis constant + Substrate concentration)) |
| `mutationRate(mutations, generations, sites)` | Calculate mutation rate | Mutation rate = Number of mutations / (Number of generations * Number of sites) |
| `geneticDiversity(frequencies)` | Calculate genetic diversity | Calculates genetic diversity (1 - Σp<sub>i</sub>²) based on allele frequencies. This measure represents the probability that two randomly selected alleles from the population will be different. |


## Test Function

The `runTests()` function provides basic tests for each function in the library.  It calls each function with sample inputs and prints the calculated result to the console.  This allows for quick verification of the calculations.  However, the current tests lack assertions and thoroughness.


Here's how to improve the testing:

* **Add Assertions:** Use `assert()` statements to check that calculated results match expected values, providing more robust error detection.
* **Test Edge Cases:**  Include boundary conditions (e.g., p=0, p=1, n=0, n=k, identical sequences, zero mutations, etc.) and invalid inputs (e.g., negative values, non-numeric inputs, different sequence lengths) to ensure that error handling is correct.
* **Clearer Output:** Improve the output formatting to make it easier to understand the results of each test.