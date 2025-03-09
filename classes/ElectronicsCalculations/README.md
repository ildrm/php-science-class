# PHP ElectronicsCalculations Library

This library provides a set of functions for performing common calculations in electronics, covering circuit analysis, resistance, capacitance, inductance, impedance, power, RC time constants, nodal and mesh analysis, Thevenin equivalents, transient responses, and AC power calculations. It utilizes the `PhysicsCalculations` library for certain calculations like power, ensuring consistency and avoiding code duplication.

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
| `nodalAnalysisSingleNode(currents, conductance)` | Calculate node voltage using nodal analysis | *V = ΣI / G* (Node voltage = Sum of currents / Total conductance at the node) |
| `meshAnalysisSingleLoop(voltageSource, resistances)` | Calculate loop current using mesh analysis | *I = V / ΣR* (Loop current = Voltage source / Total resistance in the loop) |
| `theveninVoltage(v)` | Calculate Thevenin equivalent voltage | *V<sub>Th</sub> = V<sub>oc</sub>* (Thevenin voltage = Open-circuit voltage) |
| `theveninResistance(resistances)` | Calculate Thevenin equivalent resistance | *R<sub>Th</sub> = R<sub>eq</sub>* (Thevenin resistance = Equivalent series resistance) |
| `rcTransientResponse(vSource, r, c, t)` | Calculate capacitor voltage during RC charging | *V<sub>C</sub>(t) = V<sub>s</sub> * (1 - e^(-t/RC))* (Capacitor voltage = Source voltage * (1 - e^(-time / RC))) |
| `resonantFrequency(l, c)` | Calculate resonant frequency of an RLC series circuit | *f₀ = 1 / (2π√(LC))* (Resonant frequency = 1 / (2 * Pi * Square root of (Inductance * Capacitance))) |
| `realPowerAC(v, i, pf)` | Calculate real power in an AC circuit | *P = V * I * cosφ* (Real power = Voltage * Current * Power factor) |
| `reactivePowerAC(v, i, pf)` | Calculate reactive power in an AC circuit | *Q = V * I * sinφ* (Reactive power = Voltage * Current * sin(power factor angle)) |
| `apparentPowerAC(v, i)` | Calculate apparent power in an AC circuit | *S = V * I* (Apparent power = Voltage * Current) |

## Test Function

The `runTests()` function is well-structured and provides a comprehensive set of tests for the `ElectronicsCalculations` library. It's organized into groups for basic circuit laws, resistive circuits, capacitive circuits, dynamic elements (inductors and capacitors), AC circuits, and advanced circuit analysis.

Key improvements in this version:

* **Organized Test Groups:** Grouping tests by concept enhances readability and makes it easier to identify issues within specific areas of the library.
* **Comprehensive Inputs and Units:** Tests cover various input values and units, demonstrating the flexibility of the functions.
* **Clear Expected Values:** Expected values are clearly stated for each test case, facilitating quick verification of results.
* **Error Handling Tests:** Specific test cases are included to validate error handling for invalid inputs (e.g., zero current for resistance calculation, negative resistance values, etc.), ensuring the robustness of the functions.
* **New Advanced Analysis Tests:** Added test cases for nodal analysis, mesh analysis, Thevenin equivalents, transient response, resonant frequency, and AC power calculations to ensure coverage of advanced topics.