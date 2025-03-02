# PHP GeoscienceCalculations Library

This library provides a set of functions for performing geoscience-related calculations, currently including atmospheric pressure calculation with altitude and earthquake energy estimation based on Richter magnitude. It uses fundamental constants such as gravitational acceleration (G) and the ideal gas constant (R).

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `atmosphericPressure(p0, h)` | Calculate atmospheric pressure with altitude | *P = P₀ * exp(-gMh/RT)* (Pressure at height h = Surface pressure * exp(-gravitational acceleration * molar mass of Earth's air * height / (ideal gas constant * temperature))). Uses a simplified temperature profile assuming a constant temperature of 288 K. |
| `earthquakeEnergy(magnitude)` | Calculate earthquake energy from Richter magnitude | *E = 10<sup>(1.5M + 4.8)</sup>* (Energy in Joules = 10 raised to the power of (1.5 * Richter Magnitude + 4.8)).  This is an empirical relationship. |


## Test Function

The `runTests()` function provides a basic test for each function. It calls the functions with sample inputs and prints the results.  However, it currently lacks assertions and robust error handling checks.

Here's how to improve the testing:

* **Add Assertions:** Use `assert()` statements to formally check calculated results against expected values.
* **Test Edge Cases:** Include tests with boundary conditions (e.g., h=0, magnitude=0) and invalid inputs (e.g., negative height, negative pressure, non-numeric inputs) to validate error handling.
* **More Descriptive Output:**  Provide more context in the test output, including expected values.