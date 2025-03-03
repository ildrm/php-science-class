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

Below are detailed descriptions of each class in the PHP Science Class library, including their purpose, features, and advanced sub-topics with corrected mathematical expressions for GitHub rendering.

### MathCalculations
The `MathCalculations` class provides an extensive suite of mathematical operations, ranging from basic arithmetic (addition, subtraction, multiplication, division) to advanced topics in algebra, calculus, trigonometry, statistics, matrix operations, graph theory, and machine learning. Implemented in PHP, it includes methods for solving polynomial equations up to cubic order, numerically computing derivatives and integrals, and performing complex matrix operations such as determinant calculation and inversion. It also supports statistical analyses (e.g., mean, variance, skewness, kurtosis), machine learning algorithms (e.g., k-Nearest Neighbors, Support Vector Machines, Naive Bayes), and graph algorithms (e.g., Dijkstra’s shortest path, Hamiltonian paths, Eulerian circuits). The class is equipped with comprehensive error handling for invalid inputs (e.g., division by zero, negative factorials) and unit-aware calculations, making it a versatile tool for educational purposes, scientific research, and computational mathematics. Its extensive test suite, organized by mathematical domains, ensures robustness and reliability across diverse applications, enhancing its suitability for academic and professional use.

- **Comprehensive Scope:** Covers arithmetic, algebra, calculus, trigonometry, statistics, matrix operations, graph theory, and machine learning algorithms.
- **Error Handling:** Robustly implemented with checks for invalid inputs (e.g., division by zero, negative factorials), returning descriptive error messages.
- **Numerical Methods:** Employs numerical approximations for calculus operations (e.g., derivatives, integrals) with adjustable precision via step size or intervals.
- **Flexibility:** Supports various mathematical constructs like polynomials, sequences, and statistical distributions without unit conversions, focusing on pure numerical computation.
- **Testing:** Includes an extensive `runTests()` method with grouped test cases (e.g., Basic Operations, Algebra, Calculus) to validate functionality across all major features.
- **Modularity:** Functions are standalone and logically grouped, facilitating easy extension or integration into larger systems.

#### Advanced Algebra
- **Cubic Formula**  
  Solves cubic equations (e.g., $x^3 - 6x^2 + 11x - 6 = 0$) using Cardano’s method, handling real roots with intricate discriminant analysis (`cubicFormula`). This method involves calculating the discriminant $\Delta = \left(\frac{g^2}{4} + \frac{f^3}{27}\right)$ and determining roots via cube roots and trigonometric functions, demonstrating deep algebraic manipulation beyond simple quadratics.
- **Polynomial Roots**  
  Determines roots for polynomials up to degree 3, integrating quadratic ($ax^2 + bx + c = 0$) and cubic solvers into a unified framework (`polynomialRoots`). For quadratics, it uses $x = \frac{-b \pm \sqrt{b^2 - 4ac}}{2a}$, showcasing adaptability to polynomial complexity.

#### Calculus Mastery
- **Second Derivative**  
  Numerically computes the second derivative using finite differences ($f''(x) \approx \frac{f'(x+h) - f'(x-h)}{2h}$), enabling analysis of curvature and inflection points (`secondDerivative`). This builds on the first derivative approximation $f'(x) \approx \frac{f(x+h) - f(x-h)}{2h}$, critical for optimization and curve analysis.
- **Integration by Parts**  
  Implements the advanced calculus technique $\int u \, dv = uv - \int v \, du$ numerically, handling complex integrands with nested function evaluations (`integralByParts`). This method approximates the integral by discretizing the domain, a hallmark of sophisticated numerical integration.

#### Matrix Operations
- **Matrix Inverse**  
  Calculates the inverse of a square matrix using the adjoint and determinant ($A^{-1} = \frac{\text{adj}(A)}{\det(A)}$), involving recursive minor computations (`inverse`). For a 2x2 matrix $\begin{bmatrix} a & b \\ c & d \end{bmatrix}$, the inverse is $\frac{1}{ad - bc} \begin{bmatrix} d & -b \\ -c & a \end{bmatrix}$, demonstrating computational intensity central to linear algebra solutions.
- **Determinant**  
  Recursively computes the determinant via cofactor expansion for any $n \times n$ matrix, showcasing recursive algorithmic depth (`determinant`). For a 3x3 matrix $\begin{bmatrix} a & b & c \\ d & e & f \\ g & h & i \end{bmatrix}$, it’s $a(ei - fh) - b(di - fg) + c(dh - eg)$.

#### Statistical Distributions
- **Chi-Square Cumulative Distribution Function (CDF)**  
  Approximates the CDF for the chi-square distribution using the incomplete gamma function $\Gamma(s, x) = \int_0^x t^{s-1} e^{-t} \, dt$, critical for statistical hypothesis testing (`chiSquareCDF`). The CDF is $F(x; k) = \frac{\gamma(k/2, x/2)}{\Gamma(k/2)}$, involving complex gamma approximations.
- **Cumulative Normal Distribution**  
  Uses a high-precision polynomial approximation (e.g., Abramowitz-Stegun formula) to compute the cumulative probability of a standard normal distribution $\Phi(z) = \frac{1}{\sqrt{2\pi}} \int_{-\infty}^z e^{-t^2/2} \, dt$, vital for advanced statistical analysis (`cumulativeNormalDistribution`).

#### Machine Learning and Clustering
- **Support Vector Machine (SVM) Classification**  
  Implements a linear SVM with gradient descent optimization for binary classification, balancing margin maximization and error minimization (`svmClassify`). It optimizes $w$ and $b$ in $y_i(w \cdot x_i + b) \geq 1$, reflecting cutting-edge machine learning complexity.
- **DBSCAN Clustering**  
  Performs density-based spatial clustering with noise handling, using epsilon-neighborhoods and minimum points criteria (`dbscan`). It identifies core points where $|N_\epsilon(x)| \geq \text{MinPts}$, a sophisticated unsupervised learning approach.

#### Graph Theory
- **Hamiltonian Path**  
  Finds a Hamiltonian path in a graph using backtracking, solving an NP-complete problem with recursive exploration (`hamiltonianPath`). This ensures each vertex is visited exactly once, highlighting combinatorial optimization prowess.
- **Dijkstra’s Algorithm**  
  Computes shortest paths in a weighted graph with a min-priority queue approach, optimized for sparse graphs with complexity $O((V + E) \log V)$ (`dijkstra`). It minimizes $d[u] + c(u,v)$ for each vertex $v$.

---

### PhysicsCalculations
The `PhysicsCalculations` class is a robust PHP implementation of fundamental and advanced physics computations, covering mechanics (kinematics and dynamics), thermodynamics, electromagnetism, optics, relativity, quantum mechanics, and nuclear physics. It leverages physical constants (e.g., gravitational constant $G = 6.67430 \times 10^{-11} \, \text{m}^3 \text{kg}^{-1} \text{s}^{-2}$, speed of light $c = 299792458 \, \text{m/s}$) to calculate quantities such as motion parameters, forces, electric fields, thermodynamic properties, and relativistic effects. The class supports flexible unit conversions (e.g., meters to kilometers, joules to calories) and includes rigorous error checking for physical validity (e.g., non-negative masses, non-zero distances). Designed for educational and research applications, its comprehensive test suite, organized by physics subfields, validates accuracy across diverse scenarios, making it an invaluable resource for students, educators, and physicists exploring theoretical and applied physics.

- **Broad Physics Coverage:** Encompasses mechanics, thermodynamics, electromagnetism, optics, relativity, quantum mechanics, and nuclear physics, leveraging constants like $G$, $c$, and $h$.
- **Unit Flexibility:** Supports multiple unit systems (e.g., m/s to km/h, J to cal) with automatic conversions for inputs and outputs.
- **Error Checking:** Ensures physical validity with checks for negative masses, zero distances, or velocities exceeding $c$.
- **Comprehensive Constants:** Defines constants like $G_\text{CONST}$, $\epsilon_0 = 8.8541878128 \times 10^{-12} \, \text{F/m}$, $\sigma = 5.670374419 \times 10^{-8} \, \text{W/m}^2\text{K}^4$ for consistent calculations.
- **Testing Suite:** Features a detailed `runTests()` method organized by subfields (e.g., Mechanics, Thermodynamics), verifying accuracy across scenarios.
- **Interdisciplinary Utility:** Serves as a foundational class for other physics-related classes (e.g., `ElectronicsCalculations`, `ThermodynamicsCalculations`) via inheritance.

#### Mechanics - Dynamics
- **Gravitational Force**  
  Applies Newton’s universal gravitation ($F = G \frac{m_1 m_2}{r^2}$) with unit conversions, handling astronomical-scale calculations (`gravitationalForce`). For Earth ($m_1 = 5.972 \times 10^{24} \, \text{kg}$, $r = 6371 \, \text{km}$), it computes surface gravity.
- **Torque**  
  Computes torque ($\tau = F r \sin\theta$) with angular considerations and unit flexibility (e.g., N·m to lbf·ft), critical for rotational dynamics (`torque`). This models lever arms and rotational forces.

#### Thermodynamics
- **Work in Isothermal Process**  
  Calculates work ($W = nRT \ln\left(\frac{V_2}{V_1}\right)$) for an ideal gas under isothermal conditions, integrating logarithmic complexity with unit conversions (e.g., J to cal) (`workIsothermal`). This is essential for thermodynamic cycles like the Carnot cycle.
- **Carnot Efficiency**  
  Determines maximum efficiency ($\eta = 1 - \frac{T_\text{cold}}{T_\text{hot}}$) with temperature validation in Kelvin, a pinnacle of thermodynamic analysis (`carnotEfficiency`). For $T_\text{hot} = 400 \, \text{K}$, $T_\text{cold} = 300 \, \text{K}$, $\eta = 0.25$.

#### Electricity and Magnetism
- **Faraday’s Law**  
  Computes induced EMF ($\varepsilon = -\frac{d\Phi_B}{dt}$) for electromagnetic induction, handling dynamic flux changes (`faradayLaw`). For a coil with $\Phi_B = B A \cos(\omega t)$, it derives $\varepsilon = B A \omega \sin(\omega t)$.
- **Electric Field Energy**  
  Calculates energy density in an electric field ($U = \frac{1}{2} \epsilon_0 E^2 V$), integrating field strength and volume with units (e.g., J to µJ) (`electricFieldEnergy`), vital for capacitor design.

#### Relativity
- **Relativistic Velocity Addition**  
  Applies the relativistic formula ($u' = \frac{u + v}{1 + \frac{uv}{c^2}}$) to combine velocities near light speed, ensuring $u' < c$ (`relativisticVelocityAddition`). For $u = v = 0.5c$, $u' \approx 0.8c$.
- **Relativistic Momentum**  
  Computes momentum ($p = \gamma m v$) with Lorentz factor ($\gamma = \frac{1}{\sqrt{1 - \frac{v^2}{c^2}}}$), reflecting high-energy physics precision (`relativisticMomentum`). At $v = 0.9c$, $\gamma \approx 2.294$.

#### Quantum Mechanics
- **Quantum Probability**  
  Approximates probability via numerical integration of a wave function’s squared magnitude ($P = \int |\psi|^2 \, dx$), a complex quantum mechanics application (`quantumProbability`). For $\psi(x) = \sin(x)$, it computes probability over $[0, \pi]$.
- **Quantum Energy Level**  
  Calculates energy in a particle-in-a-box model ($E = \frac{n^2 h^2}{8 m L^2}$), integrating quantum principles with constants like $h = 6.62607015 \times 10^{-34} \, \text{J·s}$ (`quantumEnergyLevel`).

---

### ChemistryCalculations
The `ChemistryCalculations` class offers a sophisticated PHP framework for chemical computations, integrating a complete periodic table with 118 elements and properties (e.g., atomic mass, electronegativity, electron configuration). It supports calculations in stoichiometry (e.g., molar conversions), thermodynamics (e.g., enthalpy, Gibbs free energy), bonding analysis, and analytical chemistry (e.g., pH). Key features include ideal gas law applications, dynamic molecular bond analysis, and THREE.js-based 3D visualization of molecular shapes (e.g., tetrahedral for CH₄, trigonal planar for BF₃), enhancing structural chemistry studies. With built-in unit flexibility (e.g., g to kg, Pa to atm) and extensive error handling (e.g., negative values, invalid formulas), it’s a powerful tool for chemistry education, research, and laboratory simulations. Its thorough test suite, grouped by subfields, ensures precision and reliability across diverse chemical computations.

- **Periodic Table Integration:** Includes data for all 118 elements with properties like atomic mass (e.g., H: 1.00794 u), electronegativity, and electron configuration.
- **Chemical Computations:** Supports stoichiometry, thermodynamics (e.g., $\Delta H$, $\Delta G$), bonding, and analytical chemistry (e.g., pH).
- **Visualization:** Generates THREE.js code for 3D molecular shapes (e.g., CH₄ as tetrahedral), leveraging VSEPR theory.
- **Unit Support:** Handles conversions (e.g., g to kg, Pa to atm, J/mol to kJ/mol) for mass, pressure, and energy.
- **Error Management:** Validates inputs (e.g., non-negative moles, valid formulas), returning detailed error messages.
- **Testing:** Provides a `runTests()` method grouped by subfields (e.g., Thermodynamics, Bonding), ensuring reliability.

#### Thermodynamics
- **Gibbs Free Energy**  
  Computes $\Delta G = \Delta H - T \Delta S$ with multi-unit support (e.g., J/mol, kJ/mol, K, °C), essential for predicting reaction spontaneity (`gibbsFreeEnergy`). For $\Delta H = 40 \, \text{kJ/mol}$, $T = 298 \, \text{K}$, $\Delta S = 20 \, \text{J/mol·K}$, $\Delta G \approx 34 \, \text{kJ/mol}$.
- **Clausius-Clapeyron**  
  Calculates vapor pressure changes ($\ln\left(\frac{P_2}{P_1}\right) = -\frac{\Delta H_\text{vap}}{R} \left(\frac{1}{T_2} - \frac{1}{T_1}\right)$), a sophisticated tool for phase transitions (`clausiusClapeyron`). For water at $T_1 = 373 \, \text{K}$, $P_1 = 100 \, \text{kPa}$, $\Delta H_\text{vap} = 40.67 \, \text{kJ/mol}$, it predicts $P_2$.

#### Bonding and Molecular Shape
- **Molecular Bond**  
  Dynamically determines bond types and counts (e.g., CH₄: 4 C-H bonds) using electronegativity differences ($\Delta EN$) and valence, showcasing chemical structure analysis (`molecularBond`). For NaCl, $\Delta EN > 1.7$ indicates ionic bonding.
- **Molecule Shape Drawing**  
  Generates THREE.js code for 3D visualization of molecular geometries (e.g., tetrahedral for CH₄, trigonal bipyramidal for PF₅) based on VSEPR theory, a cutting-edge feature (`drawMoleculeShape`).

#### Physical Chemistry
- **Ideal Gas Volume**  
  Solves for volume using the ideal gas law ($V = \frac{nRT}{P}$) with inherited precision from `PhysicsCalculations`, handling unit conversions (e.g., m³ to L) (`idealGasVolume`). For $n = 1 \, \text{mol}$, $T = 298 \, \text{K}$, $P = 101325 \, \text{Pa}$, $V \approx 0.0244 \, \text{m}^3$.
- **pH Calculation**  
  Computes pH ($-\log_{10}[H^+]$) with concentration unit flexibility (e.g., mol/L to mmol/L), critical for acid-base chemistry (`pH`). For $[H^+] = 0.001 \, \text{mol/L}$, pH = 3.

---

### ComputerScienceCalculations
The `ComputerScienceCalculations` class is a comprehensive PHP library tailored for computer science applications, featuring a wide array of algorithms for sorting (e.g., Quick Sort, Radix Sort), searching (e.g., Binary Search), graph traversal (e.g., DFS, BFS), and optimization (e.g., Knapsack Problem, Dijkstra’s Algorithm). It includes tools for time complexity estimation (e.g., $O(n \log n)$), memory usage analysis (e.g., bytes to MB), and cryptographic operations (e.g., Caesar Cipher). Designed for educational and professional use, its detailed test suite validates correctness and efficiency across functionalities, making it suitable for teaching foundational concepts, developing prototypes, and analyzing performance in academic and industry settings.

- **Algorithmic Focus:** Implements sorting, searching, graph traversal, and dynamic programming algorithms.
- **Performance Analysis:** Estimates time complexity (e.g., $O(n \log n)$) and memory usage with unit conversions.
- **Error Handling:** Checks for invalid inputs (e.g., empty arrays, negative values) with clear error messages.
- **Data Structure Support:** Uses arrays for versatility, supporting comparison-based and non-comparison-based algorithms.
- **Testing:** Features a detailed `runTests()` method with sample data (e.g., sorting arrays, graph traversals), validating correctness and efficiency.
- **Educational Design:** Structured to demonstrate algorithmic concepts, ideal for teaching and prototyping.

#### Sorting Algorithms - Advanced
- **Merge Sort**  
  Implements an $O(n \log n)$ divide-and-conquer sort with recursive merging, optimizing for large datasets (`mergeSort`). It splits an array into halves, sorts, and merges them efficiently.
- **Radix Sort**  
  Performs non-comparison sorting by digit with complexity $O(nk)$, showcasing advanced integer sorting techniques (`radixSort`). For base-10 numbers, it processes each digit iteratively.

#### Graph Algorithms
- **Dijkstra’s Algorithm**  
  Finds shortest paths in a weighted graph using a greedy approach ($O((V + E) \log V)$), optimized for pathfinding (`dijkstra`). For a graph with weights, it minimizes $d[u] + c(u,v)$.
- **Knapsack Problem**  
  Solves the 0/1 knapsack problem using dynamic programming ($O(nW)$), a classic optimization challenge (`knapsack`). For items with weights and values, it maximizes value within a capacity $W$.

#### Dynamic Programming and String
- **Longest Common Subsequence (LCS)**  
  Computes the LCS length between two strings using a 2D dynamic programming table ($O(mn)$), vital for sequence alignment (`longestCommonSubsequence`). For "ABCD" and "ACDF", LCS length is 3 ("ACD").
- **Simple Hash Function**  
  Generates a hash value using a polynomial rolling hash ($O(n)$), foundational for data structures like hash tables (`simpleHash`). For a string $s$, it computes $h(s) = \sum s[i] \cdot p^i \mod m$.

---

### AstrophysicsCalculations
The `AstrophysicsCalculations` class is a specialized PHP toolkit for astrophysical computations, focusing on celestial mechanics and stellar properties. It employs constants like the gravitational constant ($G = 6.67430 \times 10^{-11} \, \text{m}^3 \text{kg}^{-1} \text{s}^{-2}$) and Stefan-Boltzmann constant ($\sigma = 5.670374419 \times 10^{-8} \, \text{W/m}^2\text{K}^4$) to calculate escape velocities, orbital periods via Kepler’s Third Law, and stellar luminosities. With robust error handling for invalid inputs (e.g., negative masses), it’s ideal for modeling planetary and stellar phenomena in educational contexts or preliminary research. Its concise test suite validates calculations against known examples (e.g., Earth’s escape velocity, Sun’s luminosity), offering reliability for astrophysics studies.

- **Specialized Scope:** Focuses on escape velocity, Kepler’s Third Law, and stellar luminosity using constants like $G$ and $\sigma$.
- **Simplicity:** Offers a concise set of methods tailored to celestial mechanics and stellar properties.
- **Error Handling:** Ensures positive inputs for mass and radius, returning error messages for invalid values.
- **Unit Consistency:** Operates in SI units (e.g., meters, kilograms) without explicit conversion options.
- **Testing:** Includes a minimal `runTests()` method with examples like Earth’s escape velocity (11.2 km/s) and Sun’s luminosity.
- **Research-Oriented:** Designed for quick astrophysical calculations, suitable for education and preliminary research.

#### Celestial Mechanics
- **Kepler’s Third Law**  
  Calculates orbital period ($T = \sqrt{\frac{4\pi^2 r^3}{G m}}$), a complex relationship for planetary motion (`keplerThirdLaw`). For Earth ($r = 1.496 \times 10^{11} \, \text{m}$, $m = 1.989 \times 10^{30} \, \text{kg}$), $T \approx 365.25 \, \text{days}$.
- **Escape Velocity**  
  Computes escape velocity ($v = \sqrt{\frac{2GM}{r}}$), critical for space travel analysis (`escapeVelocity`). For Earth ($M = 5.972 \times 10^{24} \, \text{kg}$, $r = 6371 \, \text{km}$), $v \approx 11.2 \, \text{km/s}$.

#### Stellar Physics
- **Luminosity**  
  Calculates stellar luminosity ($L = 4\pi r^2 \sigma T^4$) using the Stefan-Boltzmann law, integrating radius and temperature effects (`luminosity`). For the Sun ($r = 6.96 \times 10^8 \, \text{m}$, $T = 5778 \, \text{K}$), $L \approx 3.828 \times 10^{26} \, \text{W}$.

---

### GeoscienceCalculations
The `GeoscienceCalculations` class provides a PHP-based solution for geoscientific modeling, computing atmospheric pressure variations with altitude and earthquake energy based on Richter scale magnitude. It uses constants like gravitational acceleration ($g = 9.81 \, \text{m/s}^2$) and the universal gas constant ($R = 8.314462618 \, \text{J/mol·K}$) for accurate geophysical processes. Tailored for educational exploration and basic research, its simple test suite verifies core functionalities with realistic inputs. With straightforward design and error checking, it’s a practical tool for teaching geoscience concepts and simulating environmental phenomena.

- **Geophysical Focus:** Calculates atmospheric pressure and earthquake energy using constants like $g$ and $R$.
- **Minimalistic Design:** Features a focused set of methods for simplicity and ease of use.
- **Error Checking:** Validates inputs (e.g., non-negative magnitudes, valid pressures) with basic error messages.
- **Unit Consistency:** Uses SI units (e.g., Pa, J) without conversion support, aligning with geophysical standards.
- **Testing:** Provides a succinct `runTests()` method with realistic geophysical inputs (e.g., pressure at 1 km altitude).
- **Educational Utility:** Ideal for teaching geoscience concepts and simple environmental simulations.

#### Atmospheric Physics
- **Atmospheric Pressure**  
  Computes pressure variation with altitude ($P = P_0 e^{-\frac{g M h}{RT}}$), a non-linear exponential model (`atmosphericPressure`). For $P_0 = 101325 \, \text{Pa}$, $h = 1000 \, \text{m}$, $T = 288 \, \text{K}$, $P \approx 89.9 \, \text{kPa}$.

#### Seismology
- **Earthquake Energy**  
  Estimates seismic energy ($E = 10^{1.5M + 4.8}$) based on Richter magnitude, an advanced logarithmic calculation (`earthquakeEnergy`). For $M = 5$, $E \approx 2 \times 10^{12} \, \text{J}$.

---

### ElectronicsCalculations
The `ElectronicsCalculations` class is a PHP implementation of essential electrical engineering calculations, addressing circuit analysis (resistance, capacitance, inductance, impedance) in DC and AC contexts. Integrated with `PhysicsCalculations` for consistency (e.g., Ohm’s Law $V = IR$), it supports unit conversions (e.g., $\Omega$ to k$\Omega$, F to µF). With comprehensive error handling and a detailed test suite covering Kirchhoff’s laws, RC time constants, and reactance, it’s well-suited for educational purposes, circuit design simulations, and prototyping, providing a reliable foundation for academic and practical applications.

- **Circuit Analysis:** Computes resistance, capacitance, inductance, impedance, and power, integrating with `PhysicsCalculations`.
- **Unit Flexibility:** Supports conversions (e.g., $\Omega$ to k$\Omega$, F to µF, V to mV) for practical use.
- **Error Handling:** Checks for negative values, zero divisors, and invalid configurations (e.g., zero time change).
- **Physical Constants:** Uses $\epsilon_0$ and $\mu_0$ for electromagnetic calculations, ensuring accuracy.
- **Testing:** Features a comprehensive `runTests()` method grouped by circuit types (e.g., resistive, capacitive), validating diverse scenarios.
- **Practical Design:** Tailored for electronics education and circuit design, balancing theory and application.

#### AC Circuit Analysis
- **Impedance**  
  Calculates AC impedance ($Z = \sqrt{R^2 + (X_L - X_C)^2}$), integrating resistance and reactance (`impedance`). For $R = 10 \, \Omega$, $X_L = 5 \, \Omega$, $X_C = 2 \, \Omega$, $Z \approx 10.44 \, \Omega$.
- **Inductive Reactance**  
  Computes $X_L = 2\pi f L$ for inductors, vital for AC frequency analysis (`inductiveReactance`). For $f = 50 \, \text{Hz}$, $L = 0.1 \, \text{H}$, $X_L \approx 31.4 \, \Omega$.

#### Dynamic Elements
- **Inductor Voltage**  
  Calculates $V_L = L \frac{di}{dt}$ with unit conversions (e.g., V to mV), key for transient analysis (`inductorVoltage`). For $L = 0.1 \, \text{H}$, $\frac{di}{dt} = 2 \, \text{A/s}$, $V_L = 0.2 \, \text{V}$.
- **Capacitor Current**  
  Computes $I_C = C \frac{dv}{dt}$, essential for dynamic circuit behavior (`capacitorCurrent`). For $C = 10 \, \mu\text{F}$, $\frac{dv}{dt} = 100 \, \text{V/s}$, $I_C = 1 \, \text{mA}$.

---

### ThermodynamicsCalculations
The `ThermodynamicsCalculations` class is a PHP library for thermodynamic analyses, calculating ideal gas behavior, work in isothermal and isobaric processes, heat transfer, and efficiency metrics like the Carnot cycle. Built upon `PhysicsCalculations`, it uses constants (e.g., $R = 8.314462618 \, \text{J/mol·K}$, $k_B = 1.380649 \times 10^{-23} \, \text{J/K}$) and supports unit conversions (e.g., J to kJ, K to °C). Its extensive test suite validates accuracy, making it effective for teaching thermodynamics, energy system simulations, and research in physical chemistry and engineering.

- **Thermodynamic Focus:** Calculates pressure, work, heat, efficiency, and entropy, relying on `PhysicsCalculations`.
- **Unit Support:** Handles conversions (e.g., J to kJ, K to °C) for energy, temperature, and volume.
- **Error Management:** Ensures positive inputs and valid temperature differences, with detailed error messages.
- **Constants Utilization:** Uses $R$, $N_A$, $k_B$ for consistent results.
- **Testing:** Includes a structured `runTests()` method with grouped tests (e.g., ideal gas, efficiency), confirming reliability.
- **Educational and Research Use:** Supports teaching thermodynamics and modeling energy systems.

#### Thermodynamic Processes
- **Work in Isothermal Process**  
  Calculates $W = nRT \ln\left(\frac{V_2}{V_1}\right)$ with logarithmic complexity and unit support, critical for heat engines (`workIsothermal`). For $n = 1 \, \text{mol}$, $T = 300 \, \text{K}$, $V_2/V_1 = 2$, $W \approx 1728 \, \text{J}$.
- **Coefficient of Performance (COP) for Refrigerator**  
  Computes $\text{COP} = \frac{T_\text{cold}}{T_\text{hot} - T_\text{cold}}$, a key refrigeration metric (`copRefrigerator`). For $T_\text{cold} = 263 \, \text{K}$, $T_\text{hot} = 298 \, \text{K}$, $\text{COP} \approx 7.51$.

#### Statistical Thermodynamics
- **Entropy Change**  
  Calculates $\Delta S = \frac{Q_\text{rev}}{T}$ with unit flexibility (e.g., J/K to cal/K), fundamental for thermodynamic equilibrium (`entropyChange`). For $Q_\text{rev} = 1000 \, \text{J}$, $T = 300 \, \text{K}$, $\Delta S \approx 3.33 \, \text{J/K}$.
- **Specific Heat Capacity at Constant Volume**  
  Computes $C_v$ for monatomic ($\frac{3}{2}R$) and diatomic ($\frac{5}{2}R$) gases, integrating molecular theory (`specificHeatCapacityVolume`). For monatomic gas, $C_v \approx 12.47 \, \text{J/mol·K}$.

---

### TelecommunicationsCalculations
The `TelecommunicationsCalculations` class is a focused PHP utility for telecommunication engineering, computing wavelength from frequency and received power via the Friis Transmission Equation. Using the speed of light ($c = 299792458 \, \text{m/s}$), it ensures precise modeling of electromagnetic wave propagation. With error handling and a basic test suite (e.g., 1 GHz wavelength), it’s a valuable resource for educational demonstrations, signal design, and telecommunications research, emphasizing simplicity and precision.

- **Signal Processing:** Computes wavelength and received power using the Friis Transmission Equation.
- **Minimalistic Approach:** Features a small set of methods with $c$ as a core constant.
- **Error Handling:** Validates positive frequencies and distances, returning error messages.
- **Unit Consistency:** Uses SI units (e.g., Hz, m, W) without conversion options, aligning with signal analysis norms.
- **Testing:** Provides a simple `runTests()` method with examples like 1 GHz wavelength.
- **Application-Oriented:** Designed for educational demonstrations and basic telecommunication simulations.

#### Signal Propagation
- **Friis Transmission Equation**  
  Calculates received power ($P_r = P_t G_t G_r \left(\frac{\lambda}{4\pi d}\right)^2$), integrating antenna gains, wavelength, and distance for wireless communication analysis (`friisTransmission`). For $P_t = 1 \, \text{W}$, $G_t = G_r = 1$, $\lambda = 0.3 \, \text{m}$, $d = 10 \, \text{m}$, $P_r \approx 7.16 \times 10^{-5} \, \text{W}$.

---

## Contributing

Contributions are welcome! If you have suggestions for improvements or new features, please open an issue or submit a pull request.

## License

This project is licensed under the MIT License - see the  LICENSE  file for details.
