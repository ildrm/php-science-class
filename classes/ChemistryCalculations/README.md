# PHP ChemistryCalculations Library

This library provides a collection of functions for performing chemistry-related calculations, including periodic table lookups, stoichiometry, thermodynamics, bonding analysis, and basic analytical chemistry.  It leverages the `PhysicsCalculations` library for certain calculations like ideal gas volume and incorporates a complete periodic table dataset for element property access.  The library also includes a function for visualizing simple molecule shapes using THREE.js.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `getAtomicMass(identifier)` | Get atomic mass of an element | Retrieves the atomic mass of an element based on its atomic number or symbol. |
| `getElectronegativity(identifier)` | Get electronegativity of an element | Retrieves the electronegativity of an element. |
| `getOrbitals(identifier)` | Get electron orbitals of an element | Retrieves the electron configuration of an element. |
| `molarMassToMass(n, molarMass)` | Calculate mass from moles | *m = n * M* (Mass = Moles * Molar Mass) |
| `massToMoles(mass, molarMass)` | Calculate moles from mass | *n = m / M* (Moles = Mass / Molar Mass) |
| `molesToParticles(n)` | Calculate number of particles | *N = n * N<sub>A</sub>* (Number of Particles = Moles * Avogadro's Number) |
| `molarConcentration(n, v)` | Calculate molar concentration | *C = n / V* (Concentration = Moles / Volume) |
| `stoichiometry(knownMoles, coeffKnown, coeffUnknown)` | Calculate amount of substance from stoichiometric coefficients | *n<sub>unknown</sub> = n<sub>known</sub> * (coeff<sub>unknown</sub> / coeff<sub>known</sub>)* |
| `idealGasVolume(n, t, p)` | Calculate ideal gas volume | *V = nRT / P* (Volume = Moles * Gas Constant * Temperature / Pressure), utilizes `PhysicsCalculations::idealGasPressure` |
| `enthalpyChange(products, reactants)` | Calculate enthalpy change | *ΔH = ΣH<sub>products</sub> - ΣH<sub>reactants</sub>* |
| `entropyChange(products, reactants)` | Calculate entropy change | *ΔS = ΣS<sub>products</sub> - ΣS<sub>reactants</sub>* |
| `gibbsFreeEnergy(deltaH, t, deltaS)` | Calculate Gibbs free energy | *ΔG = ΔH - TΔS* |
| `atomicBond(element1, element2)` | Determine atomic bond type | Predicts the bond type (ionic, polar covalent, nonpolar covalent) between two elements based on electronegativity difference. |
| `molecularBond(formula)` | Determine molecular bond characteristics | Analyzes a molecular formula to determine bond types and number of bonds, assuming simple bonding rules. |
| `clausiusClapeyron(p1, t1, t2, deltaHvap)` | Calculate vapor pressure using Clausius-Clapeyron equation | *ln(P₂/P₁) = -ΔH<sub>vap</sub>/R * (1/T₂ - 1/T₁)* |
| `pH(hConcentration)` | Calculate pH | *pH = -log₁₀[H⁺]* |
| `drawMoleculeShape(formula)` | Draw molecule shape | Generates JavaScript code using THREE.js to visualize a simplified 3D model of a molecule based on its formula and VSEPR theory. |


## Test Function

The `runTests()` function thoroughly tests the functionality of the `ChemistryCalculations` class. It's organized into groups: Periodic Table, General Chemistry, Thermodynamics, Bonding/Shape, and Physical/Analytical Chemistry. Each test demonstrates a function call with example inputs and prints the expected result for easy validation.  The molecule shape drawing function outputs JavaScript, so its result is not directly displayed in the test output.


## Periodic Table (ASCII Representation)

This simplified periodic table shows element symbols and atomic numbers.  Due to formatting limitations in ASCII, the full layout of the periodic table cannot be accurately represented.  Lanthanides and Actinides are omitted for brevity.

```
H                                                  He
Li Be                               B  C  N  O  F  Ne
Na Mg                               Al Si P  S  Cl Ar
K  Ca Sc Ti V  Cr Mn Fe Co Ni Cu Zn Ga Ge As Se Br Kr
Rb Sr Y  Zr Nb Mo Tc Ru Rh Pd Ag Cd In Sn Sb Te I  Xe
Cs Ba La Hf Ta W  Re Os Ir Pt Au Hg Tl Pb Bi Po At Rn
Fr Ra Ac Rf Db Sg Bh Hs Mt Ds Rg Cn Nh Fl Mc Lv Ts Og

         La Ce Pr Nd Pm Sm Eu Gd Tb Dy Ho Er Tm Yb Lu
         Ac Th Pa U  Np Pu Am Cm Bk Cf Es Fm Md No Lr
```