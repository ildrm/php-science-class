# PHP ElectronicsCalculations Library

This library provides a set of functions for performing common calculations in electronics, covering circuit analysis, resistance, capacitance, inductance, impedance, power, and RC time constants.  It utilizes the `PhysicsCalculations` library for certain calculations like power, ensuring consistency and avoiding code duplication.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `resistanceOhmsLaw(v, i)` | Calculate resistance | *R = V / I* (Resistance = Voltage / Current). Leverages `PhysicsCalculations::ohmsLaw` for voltage calculations. |
| `kirchhoffCurrentLaw(currents)` | Apply Kirchhoff's Current Law (KCL) | ΣI<sub>in</sub> = ΣI<sub>out</sub> (Sum of currents entering a node equals the sum of currents leaving the node). |
| `kirchhoffVoltageLaw(voltages)` | Apply Kirchhoff's Voltage Law (KVL) | ΣV = 0 (The sum of voltages around any closed loop in a circuit is zero). |
| `seriesResistance(resistances)` | Calculate equivalent resistance in series | *R<sub>eq</sub> = R₁ + R₂ + ...* |
| `parallelResistance(resistances)` | Calculate equivalent resistance in parallel | *1/R<sub>eq</sub> = 1/R₁ + 1/R₂ + ...* |
| `seriesCapacitance(capacitances)` | Calculate equivalent capacitance in series | *1/C<sub>eq</sub> = 1/C₁ + 1/C₂ + ...* |
| `parallelCapacitance(capacitances)` | Calculate equivalent capacitance in parallel | *C<sub>eq</sub> = C₁ + C₂ + ...* |
| `inductorVoltage(l, di, dt)` | Calculate inductor voltage | *V<sub>L</sub> = L * di/dt* (Voltage across inductor = Inductance * Change in current / Change in time) |
| `capacitorCurrent(c, dv, dt)` | Calculate capacitor current | *I<sub>C</sub> = C * dv/dt* (Current through capacitor = Capacitance * Change in voltage / Change in time) |
| `rcTimeConstant(r, c)` | Calculate RC time constant | *τ = R * C* (Time constant = Resistance * Capacitance) |
| `power(v, i)` | Calculate power | *P = V * I* (Power = Voltage * Current). Uses `PhysicsCalculations::electricPower`. |
| `impedance(r, xl, xc)` | Calculate impedance | *Z = sqrt(R² + (X<sub>L</sub> - X<sub>C</sub>)²) (Impedance = Square root of (Resistance squared + (Inductive reactance - Capacitive reactance) squared))* |
| `inductiveReactance(f, l)` | Calculate inductive reactance | *X<sub>L</sub> = 2πfL* (Inductive reactance = 2 * Pi * Frequency * Inductance) |
| `capacitiveReactance(f, c)` | Calculate capacitive reactance | *X<sub>C</sub> = 1 / (2πfC)* (Capacitive reactance = 1 / (2 * Pi * Frequency * Capacitance)) |

## Test Function

The `runTests()` function is well-structured and provides a comprehensive set of tests for the `ElectronicsCalculations` library. It's organized into groups for basic circuit laws, resistive circuits, capacitive circuits, dynamic elements (inductors and capacitors), and AC circuits.

Key improvements in this version:

* **Organized Test Groups:**  Grouping tests by concept enhances readability and makes it easier to identify issues within specific areas of the library.
* **Comprehensive Inputs and Units:** Tests cover various input values and units, demonstrating the flexibility of the functions.
* **Clear Expected Values:** Expected values are clearly stated for each test case, facilitating quick verification of results.
* **Error Handling Tests:** Specific test cases are included to validate error handling for invalid inputs (e.g., zero current for resistance calculation, negative resistance values, etc.), ensuring the robustness of the functions.