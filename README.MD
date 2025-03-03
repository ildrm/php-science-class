## Classes

### MathCalculations
The `MathCalculations` class provides an extensive suite of mathematical operations, ranging from basic arithmetic to advanced topics in algebra, calculus, trigonometry, statistics, and graph theory. Implemented in PHP, it includes methods for solving polynomial equations, computing derivatives and integrals numerically, and performing matrix operations such as determinant calculation and inversion. Additionally, it supports statistical analyses (e.g., mean, variance, skewness), machine learning algorithms (e.g., k-Nearest Neighbors, Support Vector Machines), and graph algorithms (e.g., Dijkstra’s shortest path, Hamiltonian paths). The class is equipped with comprehensive error handling and unit-aware calculations, making it a versatile tool for educational purposes, scientific research, and computational mathematics. Its test suite ensures robustness across diverse mathematical domains, enhancing its reliability for academic and applied use.

- **Comprehensive Scope:** Covers a broad range of mathematical domains including arithmetic, algebra, calculus, trigonometry, statistics, matrix operations, graph theory, and machine learning algorithms.
- **Error Handling:** Robustly implemented with checks for invalid inputs (e.g., division by zero, negative factorials), returning descriptive error messages.
- **Numerical Methods:** Employs numerical approximations for calculus operations (e.g., derivatives, integrals) with adjustable precision via step size or intervals.
- **Flexibility:** Supports various mathematical constructs like polynomials, sequences, and statistical distributions without unit conversions, focusing on pure numerical computation.
- **Testing:** Includes an extensive `runTests()` method with grouped test cases to validate functionality across all major features.
- **Modularity:** Functions are standalone and logically grouped, facilitating easy extension or integration into larger systems.

#### Advanced Algebra
- **Cubic Formula**  
  Solves cubic equations (e.g., $x^3 - 6x^2 + 11x - 6 = 0$) using Cardano’s method, handling real roots with intricate discriminant analysis (`cubicFormula`). This demonstrates deep algebraic manipulation beyond simple quadratics.
- **Polynomial Roots**  
  Determines roots for polynomials up to degree 3, integrating quadratic and cubic solvers into a unified framework (`polynomialRoots`), showcasing adaptability to polynomial complexity.

#### Calculus Mastery
- **Second Derivative**  
  Numerically computes the second derivative using finite differences ($f''(x) \approx \frac{f'(x+h) - f'(x-h)}{2h}$), enabling analysis of curvature and inflection points (`secondDerivative`). This is a step beyond basic derivatives, critical for optimization.
- **Integration by Parts**  
  Implements the advanced calculus technique $\int u \, dv = uv - \int v \, du$ numerically, handling complex integrands with nested function evaluations (`integralByParts`), a hallmark of sophisticated integration.

#### Matrix Operations
- **Matrix Inverse**  
  Calculates the inverse of a square matrix using the adjoint and determinant ($A^{-1} = \frac{\text{adj}(A)}{\det(A)}$), involving recursive minor computations (`inverse`). This is a computationally intensive operation central to linear algebra solutions.
- **Determinant**  
  Recursively computes the determinant via cofactor expansion for any $n \times n$ matrix, showcasing recursive algorithmic depth (`determinant`).

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
The `PhysicsCalculations` class is a robust PHP implementation of fundamental and advanced physics computations, covering mechanics, thermodynamics, electromagnetism, optics, relativity, quantum mechanics, and nuclear physics. It leverages physical constants (e.g., gravitational constant, speed of light) to calculate quantities such as kinematic motion, gravitational forces, electric fields, thermodynamic properties, and relativistic effects like time dilation. The class supports flexible unit conversions (e.g., meters to kilometers, joules to calories) and includes rigorous error checking to ensure physical validity. Designed for educational and research applications, it provides a comprehensive test suite that validates its accuracy across diverse scenarios, making it an invaluable resource for students, educators, and physicists exploring theoretical and applied physics.

- **Broad Physics Coverage:** Encompasses mechanics, thermodynamics, electromagnetism, optics, relativity, quantum mechanics, and nuclear physics, leveraging fundamental constants (e.g., $G$, $c$, $h$).
- **Unit Flexibility:** Supports multiple unit systems (e.g., m/s to km/h, J to cal) with automatic conversions for inputs and outputs.
- **Error Checking:** Ensures physical validity with checks for negative masses, zero distances, or velocities exceeding the speed of light.
- **Comprehensive Constants:** Defines a wide array of physical constants (e.g., $G_\text{CONST}$, $\epsilon_0$, $\sigma$) for consistent calculations.
- **Testing Suite:** Features a detailed `runTests()` method organized by physics subfields, verifying accuracy across diverse scenarios.
- **Interdisciplinary Utility:** Serves as a foundational class for other physics-related classes (e.g., Electronics, Thermodynamics) via inheritance.

#### Mechanics - Dynamics
- **Gravitational Force**  
  Applies Newton’s universal gravitation ($F = G \frac{m_1 m_2}{r^2}$) with unit conversions, handling astronomical-scale calculations (`gravitationalForce`). This is foundational for orbital mechanics.
- **Torque**  
  Computes torque ($\tau = F r \sin\theta$) with angular considerations and unit flexibility, critical for rotational dynamics (`torque`).

#### Thermodynamics
- **Work in Isothermal Process**  
  Calculates work ($W = nRT \ln\left(\frac{V_2}{V_1}\right)$) for an ideal gas under isothermal conditions, integrating logarithmic complexity with unit conversions (`workIsothermal`). This is essential for thermodynamic cycles.
- **Carnot Efficiency**  
  Determines maximum efficiency ($\eta = 1 - \frac{T_\text{cold}}{T_\text{hot}}$) with temperature validation, a pinnacle of thermodynamic analysis (`carnotEfficiency`).

#### Electricity and Magnetism
- **Faraday’s Law**  
  Computes induced EMF ($\varepsilon = -\frac{d\Phi_B}{dt}$) for electromagnetic induction, handling dynamic flux changes (`faradayLaw`). This is key to understanding electromagnetic generators.
- **Electric Field Energy**  
  Calculates energy density in an electric field ($U = \frac{1}{2} \epsilon_0 E^2 V$), integrating field strength and volume (`electricFieldEnergy`), vital for capacitor design.

#### Relativity
- **Relativistic Velocity Addition**  
  Applies the relativistic formula ($u' = \frac{u + v}{1 + \frac{uv}{c^2}}$) to combine velocities near light speed, ensuring physical constraints (`relativisticVelocityAddition`). This is a cornerstone of special relativity.
- **Relativistic Momentum**  
  Computes momentum ($p = \gamma m v$) with Lorentz factor ($\gamma = \frac{1}{\sqrt{1 - \frac{v^2}{c^2}}}$), reflecting high-energy physics precision (`relativisticMomentum`).

#### Quantum Mechanics
- **Quantum Probability**  
  Approximates probability via numerical integration of a wave function’s squared magnitude ($P = \int |\psi|^2 \, dx$), a complex quantum mechanics application (`quantumProbability`).
- **Quantum Energy Level**  
  Calculates energy in a particle-in-a-box model ($E = \frac{n^2 h^2}{8 m L^2}$), integrating quantum principles (`quantumEnergyLevel`).

---

### ChemistryCalculations
The `ChemistryCalculations` class offers a sophisticated PHP framework for chemical computations, integrating a complete periodic table with 118 elements and supporting calculations in stoichiometry, thermodynamics, bonding, and analytical chemistry. Key features include molar mass conversions, ideal gas law applications, enthalpy and Gibbs free energy changes, and pH determination. It also provides dynamic molecular bond analysis and THREE.js-based 3D visualization of molecular shapes (e.g., tetrahedral, trigonal planar), enhancing its utility for structural chemistry studies. With built-in unit flexibility and extensive error handling, this class serves as a powerful tool for chemistry education, research, and laboratory simulations, supported by a thorough test suite that ensures precision and reliability.

- **Periodic Table Integration:** Includes a complete dataset for all 118 elements with properties like atomic mass, electronegativity, and electron configuration.
- **Chemical Computations:** Supports stoichiometry, thermodynamics (e.g., $\Delta H$, $\Delta G$), bonding analysis, and analytical chemistry (e.g., pH).
- **Visualization:** Offers dynamic molecular shape drawing using THREE.js JavaScript code generation for 3D rendering (e.g., CH4 as tetrahedral).
- **Unit Support:** Handles unit conversions (e.g., g to kg, Pa to atm) for mass, pressure, and energy calculations.
- **Error Management:** Implements thorough validation for negative values, invalid formulas, or impossible physical states.
- **Testing:** Provides a `runTests()` method grouped by chemical subfields, ensuring reliability in diverse chemical computations.

#### Thermodynamics
- **Gibbs Free Energy**  
  Computes $\Delta G = \Delta H - T \Delta S$ with multi-unit support, essential for predicting reaction spontaneity (`gibbsFreeEnergy`). This integrates enthalpy, entropy, and temperature dynamically.
- **Clausius-Clapeyron**  
  Calculates vapor pressure changes ($\ln\left(\frac{P_2}{P_1}\right) = -\frac{\Delta H_\text{vap}}{R} \left(\frac{1}{T_2} - \frac{1}{T_1}\right)$), a sophisticated tool for phase transitions (`clausiusClapeyron`).

#### Bonding and Molecular Shape
- **Molecular Bond**  
  Dynamically determines bond types and counts in molecules (e.g., CH4, NH3) using electronegativity differences and valence, showcasing chemical structure analysis (`molecularBond`).
- **Molecule Shape Drawing**  
  Generates THREE.js code for 3D visualization of molecular geometries (e.g., tetrahedral, trigonal bipyramidal) based on VSEPR theory, a cutting-edge feature (`drawMoleculeShape`).

#### Physical Chemistry
- **Ideal Gas Volume**  
  Solves for volume using the ideal gas law ($V = \frac{nRT}{P}$) with inherited precision from `PhysicsCalculations`, handling complex unit conversions (`idealGasVolume`).
- **pH Calculation**  
  Computes pH ($-\log_{10}[H^+]$) with concentration unit flexibility, critical for acid-base chemistry (`pH`).