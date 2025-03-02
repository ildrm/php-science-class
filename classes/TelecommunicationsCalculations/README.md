# PHP TelecommunicationsCalculations Library

This library provides functions for performing calculations related to telecommunications, currently including wavelength calculation and the Friis transmission equation for received power.  It utilizes the speed of light (C) as a fundamental constant.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `wavelength(f)` | Calculate wavelength | *λ = c / f* (Wavelength = Speed of Light / Frequency) |
| `friisTransmission(pt, gt, gr, d, f)` | Calculate received power using Friis Transmission Equation | *P<sub>r</sub> = P<sub>t</sub>G<sub>t</sub>G<sub>r</sub>λ² / (4πd)²* (Received Power = Transmitted Power * Transmitter Gain * Receiver Gain * Wavelength squared / (4 * Pi * Distance) squared) |


## Test Function

The `runTests()` function provides basic tests for the included functions. It calls each function with sample inputs and prints the results. However, it lacks assertions and comprehensive testing for edge cases and error conditions.

Here's how to improve the tests:

* **Add Assertions:**  Include `assert()` statements to verify calculated values against expected outcomes, strengthening error detection.
* **Test Edge Cases:**  Test boundary conditions like zero frequency, zero distance, and very large values to ensure correct handling of these cases.  Also, test with negative inputs to ensure appropriate error messages are returned.
* **Test Invalid Inputs:** Test with invalid input types (e.g., strings instead of numbers) to verify error handling.
* **Improved Output:**  Make the output more descriptive by including expected values and units for better readability.  Separate test cases visually for better clarity.