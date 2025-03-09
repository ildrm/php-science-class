# PHP BuildingDrawingCalculations Library

This library provides a comprehensive set of functions for building drawing calculations, covering wall lengths, floor areas, roof slopes, material estimates, structural analysis, and more. It leverages the `MathCalculations` class for underlying mathematical operations, making it suitable for architectural drafting, structural design, and construction planning.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `calculateWallLength(points)` | Calculate total wall length | Computes the perimeter length of a polygon defined by points: *Σ√((xᵢ₊₁ - xᵢ)² + (yᵢ₊₁ - yᵢ)²)*. |
| `calculateFloorArea(points)` | Calculate floor area | Computes the area of a polygon using the shoelace formula: *½ \|Σ(xᵢyᵢ₊₁ - xᵢ₊₁yᵢ)\|*. |
| `calculateRoofSlope(rise, run)` | Calculate roof slope angle | Computes the roof slope angle in degrees: *arctan(rise / run)*. Returns an error if *run* is zero. |
| `calculateConcreteVolume(length, width, thickness)` | Calculate concrete volume | Computes the volume of a rectangular slab: *length × width × thickness*. |
| `calculateBrickCount(wallLength, wallHeight, brickLength, brickHeight)` | Calculate number of bricks | Computes the number of bricks: *ceil((wallLength × wallHeight) / (brickLength × brickHeight))*. |
| `calculateWindowArea(width, height)` | Calculate window area | Computes the area of a rectangular window: *width × height*. |
| `calculateGableRoofArea(baseWidth, baseLength, roofHeight)` | Calculate gable roof surface area | Computes the area of a gable roof: *2 × baseLength × √((baseWidth/2)² + roofHeight²)*. |
| `calculateRoofTileCount(roofArea, tileWidth, tileLength)` | Calculate number of roof tiles | Computes the number of tiles: *ceil(roofArea / (tileWidth × tileLength))*. |
| `calculateStairRiserHeight(totalHeight, stepCount)` | Calculate stair riser height | Computes the riser height: *totalHeight / stepCount*. |
| `calculateStairTreadDepth(totalRun, stepCount)` | Calculate stair tread depth | Computes the tread depth: *totalRun / (stepCount - 1)*. |
| `calculateRebarWeight(length, diameter, density)` | Calculate rebar weight | Computes the weight: *π × (diameter/2000)² × length × density*. |
| `calculateBeamDeflection(load, length, youngsModulus, momentOfInertia)` | Calculate beam deflection | Computes the deflection at center: *(5 × load × length⁴) / (384 × youngsModulus × momentOfInertia)*. |
| `calculateColumnLoadCapacity(youngsModulus, momentOfInertia, length)` | Calculate column load capacity | Computes the critical load (Euler): *(π² × youngsModulus × momentOfInertia) / length²*. |
| `calculatePaintVolume(surfaceArea, coverageRate)` | Calculate paint volume | Computes the liters of paint needed: *surfaceArea / coverageRate*. |
| `calculateFootingArea(load, soilBearingCapacity)` | Calculate footing area | Computes the required footing area: *load / soilBearingCapacity*. |

## Test Function

The `runTests()` function provides a comprehensive suite of tests for all functions within the `BuildingDrawingCalculations` class. Each test case demonstrates a typical usage of the function and prints the result to the console. Error cases and boundary conditions are included where applicable to ensure robustness. This systematic testing approach aims to validate the functionality of the library and provide examples of how to utilize each method correctly.