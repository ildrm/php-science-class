# PHP GeoscienceCalculations Library

This library provides a set of functions for performing geoscience-related calculations, including atmospheric pressure with altitude, earthquake energy based on Richter magnitude, hydrostatic pressure in fluids, heat flow through the Earth's crust, gravity anomalies, sediment porosity, and isostatic compensation depth. It uses fundamental constants such as gravitational acceleration (G), the universal gas constant (R), and molar mass of air for accurate calculations.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `atmosphericPressure(p0, h)` | Calculate atmospheric pressure with altitude | *P = P₀ * exp(-gMh/RT)* (Pressure at height h = Surface pressure * exp(-gravitational acceleration * molar mass of Earth's air * height / (ideal gas constant * temperature))). Uses a constant temperature of 288 K for simplicity. Supports units like Pa/hPa and m/km. |
| `earthquakeEnergy(magnitude)` | Calculate earthquake energy from Richter magnitude | *E = 10^(1.5M + 4.8)* (Energy in Joules = 10 raised to the power of (1.5 * Richter Magnitude + 4.8)). Empirical relationship. Supports units like J/kJ. |
| `hydrostaticPressure(rho, h)` | Calculate hydrostatic pressure in a fluid column | *P = ρgh* (Pressure = Density * Gravitational acceleration * Depth). Supports units like kg/m³ or g/cm³ for density, m or km for depth, and Pa or MPa for pressure. |
| `heatFlow(k, dT, dx)` | Calculate heat flow through the Earth's crust (Fourier's Law) | *q = k * (dT/dx)* (Heat flow = Thermal conductivity * Temperature gradient). Supports units like W/m·K or mW/m·K for conductivity, m or km for thickness, and W/m² or mW/m² for heat flow. |
| `gravityAnomaly(rho, h)` | Calculate gravity anomaly (simplified Bouguer correction) | *Δg = 2πGρh* (Gravity anomaly = 2 * Pi * Gravitational constant * Density contrast * Thickness). Supports units like kg/m³ or g/cm³ for density, m or km for thickness, and mGal or Gal for gravity anomaly. |
| `porosity(vPore, vTotal)` | Calculate porosity of sediments | *φ = V_pore / V_total* (Porosity = Pore volume / Total volume). Returns porosity as a fraction. Supports units like m³ or cm³ for volumes (units cancel out in ratio). |
| `isostaticCompensationDepth(rhoCrust, rhoMantle, hCrust)` | Calculate depth of isostatic compensation (simplified Pratt model) | *d = h * (ρ_mantle / (ρ_mantle - ρ_crust))* (Depth of compensation = Crust thickness * (Mantle density / (Mantle density - Crust density))). Supports units like kg/m³ or g/cm³ for density, m or km for thickness, and m or km for depth. |

## Test Function

The `runTests()` function provides a comprehensive set of tests for the `GeoscienceCalculations` library. It is organized into groups for atmospheric/seismic calculations, hydrostatic/thermal calculations, and geophysical calculations.

Key improvements in this version:

* **Organized Test Groups:** Tests are grouped by concept (e.g., atmospheric/seismic, hydrostatic/thermal, geophysical), enhancing readability and making it easier to identify issues in specific areas.
* **Assertions Added:** Each test includes an `assert()` statement to formally check calculated results against expected values, with a small tolerance for floating-point errors.
* **Comprehensive Inputs and Units:** Tests cover various input values and units, demonstrating the flexibility of the functions.
* **Clear Expected Values:** Expected values are clearly stated for each test case, facilitating quick verification of results.
* **Error Handling Tests:** Specific test cases are included to validate error handling for invalid inputs (e.g., negative height, zero density, non-numeric inputs), ensuring the robustness of the functions.