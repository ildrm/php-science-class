# Scientific Calculations Library

This repository contains a collection of practical scientific classes for performing various calculations in mathematics, physics, and chemistry. The classes are designed to provide easy-to-use methods for common scientific computations, making them suitable for students, educators, and professionals alike.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Classes](#classes)
  - [MathCalculations](#mathcalculations)
  - [PhysicsCalculations](#physicscalculations)
  - [ChemistryCalculations](#chemistrycalculations)
  - [ComputerScienceCalculations](#computersciencecalculations)
  - [AstrophysicsCalculations](#astrophysicscalculations)
  - [GeoscienceCalculations](#geosciencecalculations)
  - [ElectronicsCalculations](#electronicscalculations)
  - [ThermodynamicsCalculations](#thermodynamicscalculations)
  - [TelecommunicationsCalculations](#telecommunicationscalculations)
- [Contributing](#contributing)
- [License](#license)

## Installation

To use this library, simply clone the repository to your local machine:

```bash
git clone https://github.com/ildrm/php-science-class.git
```

## Classes

### MathCalculations
The MathCalculations class provides an extensive suite of mathematical operations, ranging from basic arithmetic to advanced topics in algebra, calculus, trigonometry, statistics, and graph theory. Implemented in PHP, it includes methods for solving polynomial equations, computing derivatives and integrals numerically, and performing matrix operations such as determinant calculation and inversion. Additionally, it supports statistical analyses (e.g., mean, variance, skewness), machine learning algorithms (e.g., k-Nearest Neighbors, Support Vector Machines), and graph algorithms (e.g., Dijkstra’s shortest path, Hamiltonian paths). The class is equipped with comprehensive error handling and unit-aware calculations, making it a versatile tool for educational purposes, scientific research, and computational mathematics. Its test suite ensures robustness across diverse mathematical domains, enhancing its reliability for academic and applied use.

- **Comprehensive Scope:** Covers a broad range of mathematical domains including arithmetic, algebra, calculus, trigonometry, statistics, matrix operations, graph theory, and machine learning algorithms.
- **Error Handling:** Robustly implemented with checks for invalid inputs (e.g., division by zero, negative factorials), returning descriptive error messages.
- **Numerical Methods:** Employs numerical approximations for calculus operations (e.g., derivatives, integrals) with adjustable precision via step size or intervals.
- **Flexibility:** Supports various mathematical constructs like polynomials, sequences, and statistical distributions without unit conversions, focusing on pure numerical computation.
- **Testing:** Includes an extensive `runTests()` method with grouped test cases to validate functionality across all major features.
- **Modularity:** Functions are standalone and logically grouped, facilitating easy extension or integration into larger systems.

#### Advanced Algebra
- **Cubic Formula**  
  Solves cubic equations (e.g., \(x^3 - 6x^2 + 11x - 6 = 0\)) using Cardano’s method, handling real roots with intricate discriminant analysis (`cubicFormula`). This demonstrates deep algebraic manipulation beyond simple quadratics.
- **Polynomial Roots**  
  Determines roots for polynomials up to degree 3, integrating quadratic and cubic solvers into a unified framework (`polynomialRoots`), showcasing adaptability to polynomial complexity.

#### Calculus Mastery
- **Second Derivative**  
  Numerically computes the second derivative using finite differences (\(f''(x) \approx \frac{f'(x+h) - f'(x-h)}{2h}\)), enabling analysis of curvature and inflection points (`secondDerivative`). This is a step beyond basic derivatives, critical for optimization.
- **Integration by Parts**  
  Implements the advanced calculus technique \(\int u dv = uv - \int v du\) numerically, handling complex integrands with nested function evaluations (`integralByParts`), a hallmark of sophisticated integration.

#### Matrix Operations
- **Matrix Inverse**  
  Calculates the inverse of a square matrix using the adjoint and determinant (\(A^{-1} = \frac{\text{adj}(A)}{\det(A)}\)), involving recursive minor computations (`inverse`). This is a computationally intensive operation central to linear algebra solutions.
- **Determinant**  
  Recursively computes the determinant via cofactor expansion for any \(n \times n\) matrix, showcasing recursive algorithmic depth (`determinant`).

#### Statistical Distributions
- **Chi-Square Cumulative Distribution Function (CDF)**  
  Approximates the CDF for the chi-square distribution using the incomplete gamma function, critical for statistical hypothesis testing (`chiSquareCDF`). This involves complex gamma function approximations.
- **Cumulative Normal Distribution**  
  Uses a high-precision polynomial approximation (e.g., Abramowitz-Stegun formula) to compute the cumulative probability of a standard normal distribution, vital for advanced statistical analysis (`cumulativeNormalDistribution`).

#### Machine Learning and Clustering
- **Support Vector Machine (SVM) Classification**  
  Implements a linear SVM with gradient descent optimization for binary classification, balancing margin maximization and error minimization (`svmClassify`). This reflects cutting-edge machine learning complexity.
- **DBSCAN Clustering**  
  Performs density-based spatial clustering with noise handling, using epsilon-neighborhoods and minimum points criteria (`dbscan`), a sophisticated unsupervised learning approach.

#### Graph Theory
- **Hamiltonian Path**  
  Finds a Hamiltonian path in a graph using backtracking, solving an NP-complete problem with recursive exploration (`hamiltonianPath`). This highlights combinatorial optimization prowess.
- **Dijkstra’s Algorithm**  
  Computes shortest paths in a weighted graph with a min-priority queue approach, optimized for sparse graphs (`dijkstra`), demonstrating advanced pathfinding capabilities.

---

### PhysicsCalculations
The PhysicsCalculations class is a robust PHP implementation of fundamental and advanced physics computations, covering mechanics, thermodynamics, electromagnetism, optics, relativity, quantum mechanics, and nuclear physics. It leverages physical constants (e.g., gravitational constant, speed of light) to calculate quantities such as kinematic motion, gravitational forces, electric fields, thermodynamic properties, and relativistic effects like time dilation. The class supports flexible unit conversions (e.g., meters to kilometers, joules to calories) and includes rigorous error checking to ensure physical validity. Designed for educational and research applications, it provides a comprehensive test suite that validates its accuracy across diverse scenarios, making it an invaluable resource for students, educators, and physicists exploring theoretical and applied physics.

- **Broad Physics Coverage:** Encompasses mechanics, thermodynamics, electromagnetism, optics, relativity, quantum mechanics, and nuclear physics, leveraging fundamental constants (e.g., G, c, h).
- **Unit Flexibility:** Supports multiple unit systems (e.g., m/s to km/h, J to cal) with automatic conversions for inputs and outputs.
- **Error Checking:** Ensures physical validity with checks for negative masses, zero distances, or velocities exceeding the speed of light.
- **Comprehensive Constants:** Defines a wide array of physical constants (e.g., G_CONST, EPSILON_0, SIGMA) for consistent calculations.
- **Testing Suite:** Features a detailed `runTests()` method organized by physics subfields, verifying accuracy across diverse scenarios.
- **Interdisciplinary Utility:** Serves as a foundational class for other physics-related classes (e.g., Electronics, Thermodynamics) via inheritance.

#### Mechanics - Dynamics
- **Gravitational Force**  
  Applies Newton’s universal gravitation (\(F = G \frac{m_1 m_2}{r^2}\)) with unit conversions, handling astronomical-scale calculations (`gravitationalForce`). This is foundational for orbital mechanics.
- **Torque**  
  Computes torque (\(\tau = F r \sin\theta\)) with angular considerations and unit flexibility, critical for rotational dynamics (`torque`).

#### Thermodynamics
- **Work in Isothermal Process**  
  Calculates work (\(W = nRT \ln(V_2/V_1)\)) for an ideal gas under isothermal conditions, integrating logarithmic complexity with unit conversions (`workIsothermal`). This is essential for thermodynamic cycles.
- **Carnot Efficiency**  
  Determines maximum efficiency (\(\eta = 1 - \frac{T_\text{cold}}{T_\text{hot}}\)) with temperature validation, a pinnacle of thermodynamic analysis (`carnotEfficiency`).

#### Electricity and Magnetism
- **Faraday’s Law**  
  Computes induced EMF (\(\varepsilon = -\frac{d\Phi_B}{dt}\)) for electromagnetic induction, handling dynamic flux changes (`faradayLaw`). This is key to understanding electromagnetic generators.
- **Electric Field Energy**  
  Calculates energy density in an electric field (\(U = \frac{1}{2} \epsilon_0 E^2 V\)), integrating field strength and volume (`electricFieldEnergy`), vital for capacitor design.

#### Relativity
- **Relativistic Velocity Addition**  
  Applies the relativistic formula (\(u' = \frac{u + v}{1 + \frac{uv}{c^2}}\)) to combine velocities near light speed, ensuring physical constraints (`relativisticVelocityAddition`). This is a cornerstone of special relativity.
- **Relativistic Momentum**  
  Computes momentum (\(p = \gamma m v\)) with Lorentz factor (\(\gamma = \frac{1}{\sqrt{1 - \frac{v^2}{c^2}}}\)), reflecting high-energy physics precision (`relativisticMomentum`).

#### Quantum Mechanics
- **Quantum Probability**  
  Approximates probability via numerical integration of a wave function’s squared magnitude (\(P = \int |\psi|^2 dx\)), a complex quantum mechanics application (`quantumProbability`).
- **Quantum Energy Level**  
  Calculates energy in a particle-in-a-box model (\(E = \frac{n^2 h^2}{8 m L^2}\)), integrating quantum principles (`quantumEnergyLevel`).

---

### ChemistryCalculations
The ChemistryCalculations class offers a sophisticated PHP framework for chemical computations, integrating a complete periodic table with 118 elements and supporting calculations in stoichiometry, thermodynamics, bonding, and analytical chemistry. Key features include molar mass conversions, ideal gas law applications, enthalpy and Gibbs free energy changes, and pH determination. It also provides dynamic molecular bond analysis and THREE.js-based 3D visualization of molecular shapes (e.g., tetrahedral, trigonal planar), enhancing its utility for structural chemistry studies. With built-in unit flexibility and extensive error handling, this class serves as a powerful tool for chemistry education, research, and laboratory simulations, supported by a thorough test suite that ensures precision and reliability.

- **Periodic Table Integration:** Includes a complete dataset for all 118 elements with properties like atomic mass, electronegativity, and electron configuration.
- **Chemical Computations:** Supports stoichiometry, thermodynamics (e.g., ΔH, ΔG), bonding analysis, and analytical chemistry (e.g., pH).
- **Visualization:** Offers dynamic molecular shape drawing using THREE.js JavaScript code generation for 3D rendering (e.g., CH4 as tetrahedral).
- **Unit Support:** Handles unit conversions (e.g., g to kg, Pa to atm) for mass, pressure, and energy calculations.
- **Error Management:** Implements thorough validation for negative values, invalid formulas, or impossible physical states.
- **Testing:** Provides a `runTests()` method grouped by chemical subfields, ensuring reliability in diverse chemical computations.

#### Thermodynamics
- **Gibbs Free Energy**  
  Computes \(\Delta G = \Delta H - T \Delta S\) with multi-unit support, essential for predicting reaction spontaneity (`gibbsFreeEnergy`). This integrates enthalpy, entropy, and temperature dynamically.
- **Clausius-Clapeyron**  
  Calculates vapor pressure changes (\(\ln(\frac{P_2}{P_1}) = -\frac{\Delta H_\text{vap}}{R} (\frac{1}{T_2} - \frac{1}{T_1})\)), a sophisticated tool for phase transitions (`clausiusClapeyron`).

#### Bonding and Molecular Shape
- **Molecular Bond**  
  Dynamically determines bond types and counts in molecules (e.g., CH4, NH3) using electronegativity differences and valence, showcasing chemical structure analysis (`molecularBond`).
- **Molecule Shape Drawing**  
  Generates THREE.js code for 3D visualization of molecular geometries (e.g., tetrahedral, trigonal bipyramidal) based on VSEPR theory, a cutting-edge feature (`drawMoleculeShape`).

#### Physical Chemistry
- **Ideal Gas Volume**  
  Solves for volume using the ideal gas law (\(V = \frac{nRT}{P}\)) with inherited precision from `PhysicsCalculations`, handling complex unit conversions (`idealGasVolume`).
- **pH Calculation**  
  Computes pH (\(-\log_{10}[H^+]\)) with concentration unit flexibility, critical for acid-base chemistry (`pH`).

---

### ComputerScienceCalculations
The ComputerScienceCalculations class is a comprehensive PHP library tailored for computer science applications, featuring a wide array of algorithms for sorting (e.g., Quick Sort, Radix Sort), searching (e.g., Binary Search), graph traversal (e.g., DFS, BFS), and optimization (e.g., Knapsack Problem, Dijkstra’s Algorithm). It also includes tools for time complexity estimation, memory usage analysis, and cryptographic operations like Caesar Cipher encryption. Designed with educational and professional use in mind, the class supports detailed testing across its functionalities, ensuring algorithmic correctness and efficiency. Its versatility makes it suitable for teaching foundational computer science concepts, developing software prototypes, and analyzing computational performance in academic and industry settings.

- **Algorithmic Focus:** Implements a wide range of algorithms including sorting (e.g., Merge Sort, Heap Sort), searching, graph traversal, and dynamic programming.
- **Performance Analysis:** Includes methods for estimating time complexity (e.g., O(n log n)) and memory usage with unit conversions (e.g., bytes to MB).
- **Error Handling:** Checks for invalid inputs (e.g., empty arrays, negative values) with clear error messages.
- **Data Structure Support:** Operates on arrays for versatility, supporting both comparison-based and non-comparison-based algorithms.
- **Testing:** Features a detailed `runTests()` method with sample data, validating correctness and efficiency across all functions.
- **Educational Design:** Structured to demonstrate algorithmic concepts, making it ideal for teaching and prototyping.

#### Sorting Algorithms - Advanced
- **Merge Sort**  
  Implements an \(O(n \log n)\) divide-and-conquer sort with recursive merging, optimizing for large datasets (`mergeSort`).
- **Radix Sort**  
  Performs non-comparison sorting by digit (\(O(nk)\)), showcasing advanced integer sorting techniques (`radixSort`).

#### Graph Algorithms
- **Dijkstra’s Algorithm**  
  Finds shortest paths in a weighted graph using a greedy approach (\(O((V + E) \log V)\)), optimized for pathfinding (`dijkstra`).
- **Knapsack Problem**  
  Solves the 0/1 knapsack problem using dynamic programming (\(O(nW)\)), a classic optimization challenge (`knapsack`).

#### Dynamic Programming and String
- **Longest Common Subsequence (LCS)**  
  Computes the LCS length between two strings using a 2D dynamic programming table (\(O(mn)\)), vital for sequence alignment (`longestCommonSubsequence`).
- **Simple Hash Function**  
  Generates a hash value using a polynomial rolling hash (\(O(n)\)), foundational for data structures like hash tables (`simpleHash`).

---

### AstrophysicsCalculations
The AstrophysicsCalculations class is a specialized PHP toolkit for astrophysical computations, focusing on celestial mechanics and stellar properties. It employs constants such as the gravitational constant and Stefan-Boltzmann constant to calculate escape velocities, orbital periods via Kepler’s Third Law, and stellar luminosities. With robust error handling for invalid inputs, this class is ideal for modeling planetary and stellar phenomena in educational contexts or preliminary research. Its concise yet effective test suite validates calculations against known astronomical examples (e.g., Earth’s escape velocity, Sun’s luminosity), offering a reliable resource for students and researchers in astrophysics and related fields.

- **Specialized Scope:** Focuses on astrophysical phenomena like escape velocity, Kepler’s Third Law, and stellar luminosity using constants (e.g., G, SIGMA).
- **Simplicity:** Offers a concise set of methods tailored to celestial mechanics and stellar properties.
- **Error Handling:** Ensures positive inputs for mass and radius, returning error messages for invalid values.
- **Unit Consistency:** Operates primarily in SI units (e.g., meters, kilograms) without explicit unit conversion options.
- **Testing:** Includes a minimal `runTests()` method with examples like Earth’s escape velocity and Sun’s luminosity for validation.
- **Research-Oriented:** Designed for quick astrophysical calculations, suitable for educational and preliminary research purposes.

#### Celestial Mechanics
- **Kepler’s Third Law**  
  Calculates orbital period (\(T = \sqrt{\frac{4\pi^2 r^3}{G m}}\)), a complex relationship for planetary motion (`keplerThirdLaw`).
- **Escape Velocity**  
  Computes escape velocity (\(v = \sqrt{\frac{2GM}{r}}\)), critical for space travel analysis (`escapeVelocity`).

#### Stellar Physics
- **Luminosity**  
  Calculates stellar luminosity (\(L = 4\pi r^2 \sigma T^4\)) using the Stefan-Boltzmann law, integrating radius and temperature effects (`luminosity`).

---

### GeoscienceCalculations
The GeoscienceCalculations class provides a PHP-based solution for geoscientific modeling, with methods to compute atmospheric pressure variations with altitude and earthquake energy based on the Richter scale magnitude. Utilizing physical constants like gravitational acceleration and the universal gas constant, it ensures accurate representation of geophysical processes. This class is tailored for educational exploration and basic research in Earth sciences, featuring a simple test suite to verify its core functionalities. Its straightforward design and error-checking capabilities make it a practical tool for teaching geoscience concepts and simulating environmental phenomena.

- **Geophysical Focus:** Calculates atmospheric pressure and earthquake energy using constants (e.g., G, R) specific to Earth sciences.
- **Minimalistic Design:** Features a small, focused set of methods for simplicity and ease of use.
- **Error Checking:** Validates inputs (e.g., non-negative magnitudes, valid pressures) with basic error messages.
- **Unit Consistency:** Uses SI units (e.g., Pa, J) without explicit conversion support, aligning with geophysical standards.
- **Testing:** Provides a succinct runTests() method to verify core functionalities with realistic geophysical inputs.
- **Educational Utility:** Ideal for teaching basic geoscience concepts and performing simple environmental simulations.

#### Atmospheric Physics
- **Atmospheric Pressure**  
  Computes pressure variation with altitude (\(P = P_0 e^{-\frac{g M h}{RT}}\)), a non-linear exponential model (`atmosphericPressure`).

#### Seismology
- **Earthquake Energy**  
  Estimates seismic energy (\(E = 10^{1.5M + 4.8}\)) based on Richter magnitude, an advanced logarithmic calculation (`earthquakeEnergy`).

---

### ElectronicsCalculations
The ElectronicsCalculations class is a PHP implementation of essential electrical engineering calculations, addressing circuit analysis, capacitance, inductance, and impedance in both DC and AC contexts. It integrates with a PhysicsCalculations base class for consistency in fundamental computations (e.g., Ohm’s Law, electric power) while supporting unit conversions (e.g., ohms to kiloohms, farads to microfarads). With comprehensive error handling and a detailed test suite covering Kirchhoff’s laws, RC time constants, and reactance, this class is well-suited for educational purposes, circuit design simulations, and prototyping in electronics engineering, providing a reliable foundation for academic and practical applications.

- **Circuit Analysis:** Computes resistance, capacitance, inductance, impedance, and power in electrical circuits, integrating with PhysicsCalculations.
- **Unit Flexibility:** Supports conversions across units (e.g., Ω to kΩ, F to µF, V to mV) for practical application.
- **Error Handling:** Includes checks for negative values, zero divisors, and invalid configurations (e.g., zero time change).
- **Physical Constants:** Uses constants like EPSILON_0 and MU_0 for electromagnetic calculations, ensuring accuracy.
- **Testing:** Features a comprehensive `runTests()` method grouped by circuit types (e.g., resistive, capacitive), validating diverse scenarios.
- **Practical Design:** Tailored for electronics education and circuit design, offering a balance of theory and application.

#### AC Circuit Analysis
- **Impedance**  
  Calculates AC impedance (\(Z = \sqrt{R^2 + (X_L - X_C)^2}\)), integrating resistance and reactance (`impedance`).
- **Inductive Reactance**  
  Computes \(X_L = 2\pi f L\) for inductors, vital for AC frequency analysis (`inductiveReactance`).

#### Dynamic Elements
- **Inductor Voltage**  
  Calculates \(V_L = L \frac{di}{dt}\) with unit conversions, key for transient analysis (`inductorVoltage`).
- **Capacitor Current**  
  Computes \(I_C = C \frac{dv}{dt}\), essential for dynamic circuit behavior (`capacitorCurrent`).

---

### ThermodynamicsCalculations
The ThermodynamicsCalculations class is a PHP library dedicated to thermodynamic analyses, offering calculations for ideal gas behavior, work in isothermal and isobaric processes, heat transfer, and efficiency metrics like the Carnot cycle. Built upon a PhysicsCalculations base class, it employs thermodynamic constants (e.g., gas constant, Boltzmann constant) and supports unit conversions (e.g., joules to kilojoules, kelvin to Celsius). Its extensive test suite validates accuracy across diverse scenarios, making it an effective tool for teaching thermodynamics principles, conducting energy system simulations, and supporting research in physical chemistry and engineering disciplines.

- **Thermodynamic Focus:** Calculates properties like pressure, work, heat, efficiency, and entropy, relying on PhysicsCalculations for core methods.
- **Unit Support:** Handles conversions (e.g., J to kJ, K to C) for energy, temperature, and volume calculations.
- **Error Management:** Ensures positive inputs and valid temperature differences, with detailed error messages.
- **Constants Utilization:** Employs thermodynamic constants (e.g., R, NA, KB) for consistent and accurate results.
- **Testing:** Includes a structured `runTests()` method with grouped tests (e.g., ideal gas, efficiency), confirming reliability.
- **Educational and Research Use:** Supports teaching thermodynamics and modeling energy systems in academic and engineering contexts.

#### Thermodynamic Processes
- **Work in Isothermal Process**  
  Calculates \(W = nRT \ln(V_2/V_1)\) with logarithmic complexity and unit support, critical for heat engines (`workIsothermal`).
- **Coefficient of Performance (COP) for Refrigerator**  
  Computes \(\text{COP} = \frac{T_\text{cold}}{T_\text{hot} - T_\text{cold}}\), a key refrigeration metric (`copRefrigerator`).

#### Statistical Thermodynamics
- **Entropy Change**  
  Calculates \(\Delta S = \frac{Q_\text{rev}}{T}\) with unit flexibility, fundamental for thermodynamic equilibrium (`entropyChange`).
- **Specific Heat Capacity at Constant Volume**  
  Computes \(C_v\) for monatomic (\(\frac{3}{2}R\)) and diatomic (\(\frac{5}{2}R\)) gases, integrating molecular theory (`specificHeatCapacityVolume`).

---

### TelecommunicationsCalculations
The TelecommunicationsCalculations class is a focused PHP utility for telecommunication engineering, providing methods to compute wavelength from frequency and received power via the Friis Transmission Equation. Utilizing the speed of light constant, it ensures precise modeling of electromagnetic wave propagation. Designed for simplicity and accuracy, it includes error handling and a basic test suite to confirm functionality in signal analysis contexts. This class serves as a valuable resource for educational demonstrations, preliminary signal design, and research in telecommunications, offering a streamlined approach to understanding wave-based communication systems.

- **Signal Processing:** Computes wavelength and received power using the Friis Transmission Equation, centered on electromagnetic wave propagation.
- **Minimalistic Approach:** Features a small, focused set of methods with the speed of light (C) as a core constant.
- **Error Handling:** Validates positive frequencies and distances, returning error messages for invalid inputs.
- **Unit Consistency:** Operates in SI units (e.g., Hz, m, W) without explicit conversion options, aligning with signal analysis norms.
- **Testing:** Provides a simple `runTests()` method with examples like 1 GHz wavelength, ensuring basic functionality.
- **Application-Oriented:** Designed for educational demonstrations and basic telecommunication simulations, emphasizing simplicity and precision.

#### Signal Propagation
- **Friis Transmission Equation**  
  Calculates received power (\(P_r = P_t G_t G_r \left(\frac{\lambda}{4\pi d}\right)^2\)), integrating antenna gains, wavelength, and distance for wireless communication analysis (`friisTransmission`). This is a sophisticated model of signal strength.

---

## Contributing

Contributions are welcome! If you have suggestions for improvements or new features, please open an issue or submit a pull request.

## License

This project is licensed under the MIT License - see the  LICENSE  file for details.
