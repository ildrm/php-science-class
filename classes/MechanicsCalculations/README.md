# PHP MechanicsCalculations Library

This library provides a set of functions for performing common calculations in solid mechanics, focusing on stress, strain, and related properties.  It supports various units for inputs and outputs, making it adaptable to different engineering scenarios.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `stress(f, a)` | Calculate stress | *σ = F / A*  (Stress = Force / Area) |
| `strain(deltaL, l0)` | Calculate strain | *ε = ΔL / L₀* (Strain = Change in Length / Original Length) |
| `youngsModulus(stress, strain)` | Calculate Young's modulus | *E = σ / ε* (Young's Modulus = Stress / Strain) |
| `shearStress(f, a)` | Calculate shear stress | *τ = F / A* (Shear Stress = Shear Force / Area) |
| `shearStrain(deltaX, h)` | Calculate shear strain | *γ = Δx / h* (Shear Strain = Lateral Displacement / Height) |
| `shearModulus(shearStress, shearStrain)` | Calculate shear modulus | *G = τ / γ* (Shear Modulus = Shear Stress / Shear Strain) |
| `momentOfInertiaRectangle(b, h)` | Calculate moment of inertia for a rectangular section | *I = bh³ / 12* (Moment of Inertia = (Width * Height³) / 12) |
| `bendingStress(m, c, i)` | Calculate bending stress | *σ = Mc / I* (Bending Stress = (Bending Moment * Distance from Neutral Axis) / Moment of Inertia) |


## Test Function

The `runTests()` function provides a series of tests to validate the functionality of the `MechanicsCalculations` class.  The tests are grouped by concept (stress/strain, shear properties, bending/inertia) for better organization.  Each test case calls a specific function with sample input values and prints the calculated result, which can be compared to the expected output for verification.  This testing framework helps ensure the accuracy and reliability of the calculations performed by the library.