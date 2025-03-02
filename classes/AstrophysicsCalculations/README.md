# PHP AstrophysicsCalculations Library

This library provides a set of functions for performing astrophysics calculations, including escape velocity, Kepler's third law, and stellar luminosity.  It uses fundamental constants such as the gravitational constant (G), the speed of light (C), and the Stefan-Boltzmann constant (σ).

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `escapeVelocity(m, r)` | Calculate escape velocity | *v<sub>e</sub> = sqrt(2GM/r)*  (Escape Velocity = Square root of (2 * Gravitational Constant * Mass / Radius)) |
| `keplerThirdLaw(m, r)` | Apply Kepler's third law | *T = sqrt((4π²r³)/(GM))* (Period = Square root of ((4 * Pi squared * Radius cubed) / (Gravitational Constant * Mass))) |
| `luminosity(r, t)` | Calculate stellar luminosity | *L = 4πr²σT⁴* (Luminosity = 4 * Pi * Radius squared * Stefan-Boltzmann Constant * Temperature to the fourth power) |

## Test Function

The `runTests()` function provides basic tests for each function in the library.  It calls each function with sample inputs and prints the calculated result to the console. This allows for a quick verification of the calculations.  However, it is recommended to expand the test suite to include more comprehensive test cases, including edge cases and invalid inputs, to ensure the robustness of the library.  Example expanded tests would include tests with zero or negative mass and radius and extremely large values that might cause overflow or underflow.  Adding assertions to check for expected output values would further improve the test quality.