# PHP ArchitectureCalculations Library

This library provides a set of functions tailored for architectural calculations, including areas, volumes, roof pitches, beam stresses, foundation settlements, and centers of mass. It leverages the `MathCalculations` class for underlying mathematical operations, making it suitable for architectural design and structural analysis applications.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `calculateRoomArea(length, width)` | Calculate the area of a rectangular room | Computes the area as *length × width*. |
| `calculateBuildingVolume(length, width, height)` | Calculate the volume of a rectangular building | Computes the volume as *length × width × height*. |
| `calculateRoofPitch(rise, run)` | Calculate the pitch of a roof | Computes the roof pitch angle in degrees as arctan(*rise / run*). Returns an error message if *run* is zero. |
| `calculateBeamStress(force, length, width, height)` | Calculate the load-bearing capacity of a beam | Computes simplified beam stress as *force / (width × height)*, ignoring length for simplicity. |
| `calculateFoundationSettlement(loads, settlements)` | Calculate foundation settlement | Uses linear regression to model settlement (*y = mx + b*) based on load data. |
| `calculateCenterOfMass(points)` | Calculate the center of mass | Computes the center of mass coordinates *[Σ(x × mass) / Σmass, Σ(y × mass) / Σmass]* for a set of points with masses. |

## Test Function

The `runTests()` function provides a comprehensive suite of tests for all functions within the `ArchitectureCalculations` class. Each test case demonstrates a typical usage of the function and prints the result to the console. Error cases and boundary conditions are included where applicable to ensure robustness. This systematic testing approach aims to validate the functionality of the library and provide examples of how to utilize each method correctly.