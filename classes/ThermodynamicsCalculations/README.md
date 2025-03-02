# PHP ThermodynamicsCalculations Library

This library provides functions for performing thermodynamic calculations, including ideal gas law calculations, work and heat transfer, engine efficiency, coefficient of performance, entropy changes, and specific heat capacities. It leverages the `PhysicsCalculations` library for certain functions, promoting code reusability and consistency.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `idealGasPressure(n, t, v)` | Calculate ideal gas pressure | *P = nRT/V* (Pressure = Number of moles * Ideal Gas Constant * Temperature / Volume). Uses the `PhysicsCalculations` library. |
| `workIsothermal(n, t, v1, v2)` | Calculate work in an isothermal process | *W = nRT ln(V₂/V₁)* (Work = Number of moles * Ideal Gas Constant * Temperature * Natural Logarithm of (Final Volume / Initial Volume)) |
| `heatTransferred(deltaU, w)` | Calculate heat transferred | *Q = ΔU + W* (Heat transferred = Change in internal energy + Work done) |
| `efficiencyHeatEngine(tHot, tCold)` | Calculate the efficiency of a heat engine | *η = 1 - (T<sub>cold</sub> / T<sub>hot</sub>)* (Efficiency = 1 - (Temperature of cold reservoir / Temperature of hot reservoir)) |
| `copRefrigerator(tHot, tCold)` | Calculate coefficient of performance for a refrigerator | *COP = T<sub>cold</sub> / (T<sub>hot</sub> - T<sub>cold</sub>)* (Coefficient of Performance = Temperature of cold reservoir / (Temperature of hot reservoir - Temperature of cold reservoir)) |
| `entropyChange(qRev, t)` | Calculate entropy change | *ΔS = Q<sub>rev</sub> / T* (Entropy change = Reversible heat transfer / Temperature) |
| `specificHeatCapacityVolume(gasType)` | Calculate specific heat capacity at constant volume | For a monatomic ideal gas: *C<sub>v</sub> = (3/2)R*. For a diatomic ideal gas: *C<sub>v</sub> = (5/2)R*.  (R = Ideal Gas Constant) |
| `specificHeatCapacityPressure(cv)` | Calculate specific heat capacity at constant pressure | *C<sub>p</sub> = C<sub>v</sub> + R* (Specific heat at constant pressure = Specific heat at constant volume + Ideal Gas Constant) |

## Test Function

The `runTests()` function in this library demonstrates a good approach to testing by:

* **Grouping Tests:** Organizing tests into logical groups (Ideal Gas Law, Work and Heat, Efficiency and COP, Entropy and Specific Heat) improves readability and helps isolate issues.
* **Comprehensive Test Cases:** Each function is tested with various inputs, including different units (e.g., Celsius and Kelvin for temperature, liters and cubic meters for volume), to ensure that unit conversions are handled correctly.
* **Clear Expected Values:**  Expected values are provided for each test case, making it easy to verify the correctness of the calculations.
* **Error Handling:** Test cases with invalid inputs (e.g., zero volume, temperatures where T_cold > T_hot) are included to demonstrate the error handling mechanisms of the functions.

This structured and comprehensive testing strategy contributes to the reliability and maintainability of the library.  The clear output and explicit expected values make it easy to understand the tests and identify any discrepancies.
content_copy
download
Use code with caution.
Markdown