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

The `MathCalculations` class provides a comprehensive library of mathematical functions, covering a wide range of areas:

- **Basic Arithmetic:** Addition, subtraction, multiplication, division.
- **Algebra:**  Solving quadratic and cubic equations, finding roots of polynomials, absolute value, power, square root, LCM, and GCD.
- **Calculus:** Numerical derivatives, definite integrals, limits, and second derivatives.  Also includes functions related to the Mean Value Theorem.
- **Trigonometry:** Sine, cosine, tangent, secant, cosecant, cotangent, and their inverse functions (arcsin, arccos, arctan).  Angles are handled in degrees for user convenience.
- **Exponential and Logarithmic Functions:** Exponential function (e^x), logarithms with custom bases, natural logarithm (ln), and base-10 logarithm.
- **Series and Sequences:** Arithmetic and geometric sequences, Fibonacci sequence, Taylor series expansions for common functions (e^x, sin(x), cos(x)), and factorial.
- **Matrix Operations:** Matrix addition, multiplication, transpose, determinant, inverse, adjoint, outer product, creation of identity, diagonal, zero, ones, upper triangular, and lower triangular matrices.  Includes checks for matrix equivalence, symmetry, and orthogonality.
- **Statistical Functions:** Combination, permutation, mean, sample variance, standard deviation, median, mode, range, skewness, kurtosis, interquartile range.  Includes statistical distributions like Poisson, standard normal, cumulative normal, and Chi-squared CDF.
- **Distance and Similarity Measures:** Euclidean distance, Manhattan distance, Chebyshev distance, Minkowski distance, cosine distance, cosine similarity, Jaccard similarity, Pearson correlation, and dot product similarity.
- **Machine Learning Algorithms (Simplified):** Linear regression, k-Nearest Neighbors (KNN), linear Support Vector Machine (SVM), DBSCAN clustering, k-Means clustering, Support Vector Regression (SVR), and Gaussian Naive Bayes.
- **Graph Operations:**  Checks for graph connectivity, performs Breadth-First Search (BFS), Depth-First Search (DFS), finds Hamiltonian paths and Eulerian circuits, checks if a graph is a tree, and implements Dijkstra's algorithm for shortest paths.

### PhysicsCalculations

The `PhysicsCalculations` class offers a wide array of functions for solving physics problems:

- **Mechanics (Kinematics):**  Final velocity, distance, time, angular position, and angular velocity calculations.
- **Mechanics (Dynamics):** Force, weight, gravitational force, momentum, angular momentum, torque, friction, fluid pressure, and buoyant force.
- **Work and Energy:** Work, kinetic energy, potential energy (gravitational, spring), power, and frequency (spring, pendulum).
- **Thermodynamics:** Heat, first law of thermodynamics, ideal gas law (delegated to `ChemistryCalculations`), work (isobaric, isothermal), entropy, Carnot efficiency, and total entropy change.
- **Electricity and Magnetism:** Coulomb's law, electric field, electric potential, capacitance, capacitor energy, Ohm's law, electric power, Lorentz force, magnetic field (from wire), magnetic force between wires, Gauss's law (electric and magnetic), Faraday's law, and electric field energy.
- **Waves and Optics:** Frequency, wavelength, Doppler effect, law of reflection, Snell's law, mirror/lens focal length, magnification, sound intensity, sound level, and single-slit diffraction.
- **Relativity:** Length contraction, time dilation, relativistic energy, relativistic mass, relativistic momentum, and relativistic velocity addition.
- **Quantum Mechanics:** Photon energy, de Broglie wavelength, energy levels in a quantum box, and a simplified quantum probability calculation.
- **Nuclear Physics:** Radioactive decay and nuclear binding energy.

### ChemistryCalculations

The `ChemistryCalculations` class provides functions for various chemistry-related computations:

- **Periodic Table Access:**  Retrieve atomic mass, electronegativity, and electron configuration for any element.
- **General Chemistry:**  Molar mass conversions, mole calculations, particle number calculations, molar concentration, and stoichiometry.
- **Thermodynamics:** Enthalpy change, entropy change, and Gibbs free energy.  Uses `PhysicsCalculations` for ideal gas calculations.
- **Bonding:** Determine atomic bond type (ionic, polar covalent, nonpolar covalent) and analyze molecular bonds.
- **Physical Chemistry:** Clausius-Clapeyron equation for vapor pressure.
- **Analytical Chemistry:** pH calculations.
- **Molecule Visualization:** Generate JavaScript code for visualizing molecule shapes in 3D using THREE.js.  This functionality provides a basic way to visualize molecular structures based on simplified VSEPR theory.

## Contributing

Contributions are welcome! If you have suggestions for improvements or new features, please open an issue or submit a pull request.

## License

This project is licensed under the MIT License - see the  LICENSE  file for details.
