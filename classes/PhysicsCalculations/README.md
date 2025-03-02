# PHP PhysicsCalculations Library

This library provides a comprehensive set of physics calculations, covering mechanics (kinematics and dynamics), work and energy, thermodynamics, electricity and magnetism, waves and optics, relativity, quantum mechanics, and nuclear physics. It's designed to be flexible and handle various units, making it suitable for educational purposes, physics simulations, and engineering applications.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `finalVelocity(u, a, t)` | Calculate final velocity | *v = u + at* |
| `distance(u, a, t)` | Calculate distance | *s = ut + 0.5at²* |
| `finalVelocityWithDistance(u, a, s)` | Calculate final velocity with distance | *v² = u² + 2as* |
| `timeFromVelocity(u, v, a)` | Calculate time from velocity | *t = (v - u) / a* |
| `angularPosition(theta0, omega, alpha, t)` | Calculate angular position | *θ = θ₀ + ωt + 0.5αt²* |
| `angularVelocity(omega0, alpha, t)` | Calculate angular velocity | *ω = ω₀ + αt* |
| `force(m, a)` | Calculate force | *F = ma* |
| `weight(m, g)` | Calculate weight | *W = mg* |
| `gravitationalForce(m1, m2, r)` | Calculate gravitational force | *F = G * m₁ * m₂ / r²* |
| `momentum(m, v)` | Calculate momentum | *p = mv* |
| `angularMomentum(i, omega)` | Calculate angular momentum | *L = Iω* |
| `torque(f, r, theta)` | Calculate torque | *τ = F * r * sinθ* |
| `frictionForce(mu, n)` | Calculate friction force | *F = μN* |
| `fluidPressure(rho, h, g)` | Calculate fluid pressure | *P = ρgh* |
| `buoyantForce(rho, v, g)` | Calculate buoyant force | *F = ρVg* |
| `work(f, d, theta)` | Calculate work | *W = F * d * cosθ* |
| `kineticEnergy(m, v)` | Calculate kinetic energy | *KE = 0.5mv²* |
| `potentialEnergy(m, h, g)` | Calculate gravitational potential energy | *PE = mgh* |
| `springPotentialEnergy(k, x)` | Calculate spring potential energy | *PE = 0.5kx²* |
| `power(w, t)` | Calculate power | *P = W / t* |
| `springFrequency(k, m)` | Calculate spring frequency | *f = (1/2π) * sqrt(k/m)* |
| `pendulumFrequency(l, g)` | Calculate pendulum frequency | *f = (1/2π) * sqrt(g/L)* |
| `heat(m, c, deltaT)` | Calculate heat | *Q = mcΔT* |
| `firstLawOfThermodynamics(q, w)` | Calculate first law of thermodynamics | *ΔU = Q - W* |
| `idealGasPressure(n, t, v)` | Calculate ideal gas pressure | *P = nRT / V* |
| `workIsobaric(p, deltaV)` | Calculate isobaric work | *W = PΔV* |
| `workIsothermal(n, t, v1, v2)` | Calculate isothermal work | *W = nRT ln(V₂/V₁)* |
| `entropy(q, t)` | Calculate entropy | *S = Q / T* |
| `carnotEfficiency(tHot, tCold)` | Calculate Carnot efficiency | *η = 1 - T_cold / T_hot* |
| `secondLawEntropy(deltaS_system, deltaS_surroundings)` | Calculate total entropy change | *ΔS_total = ΔS_system + ΔS_surroundings* |
| `coulombForce(q1, q2, r)` | Calculate Coulomb force | *F = k * \|q₁ * q₂\| / r²* |
| `electricField(q, r)` | Calculate electric field | *E = k * q / r²* |
| `electricPotential(q, r)` | Calculate electric potential | *V = k * q / r* |
| `capacitance(q, v)` | Calculate capacitance | *C = Q / V* |
| `capacitorEnergy(c, v)` | Calculate capacitor energy | *U = 0.5CV²* |
| `ohmsLaw(i, r)` | Ohm's Law | *V = IR* |
| `electricPower(v, i)` | Calculate electric power | *P = VI* |
| `lorentzForce(q, v, b, theta)` | Calculate Lorentz force | *F = qvBsinθ* |
| `magneticFieldFromWire(i, r)` | Calculate magnetic field from wire | *B = μ₀I / 2πr* |
| `magneticForceBetweenWires(i1, i2, r)` | Calculate magnetic force between wires | *F/L = μ₀I₁I₂ / 2πr* |
| `gaussLawElectric(q)` | Gauss's law for electric field | *Φ_E = Q / ε₀* |
| `gaussLawMagnetic()` | Gauss's law for magnetic field | *Φ_B = 0* |
| `faradayLaw(deltaPhiB, deltaT)` | Faraday's law of induction | *ε = -dΦ_B/dt* |
| `electricFieldEnergy(e, v)` | Calculate electric field energy | *U = 0.5ε₀E²V* |
| `frequency(t)` | Calculate frequency | *f = 1 / T* |
| `wavelength(v, f)` | Calculate wavelength | *λ = v / f* |
| `dopplerEffect(f, v, vd, vs)` | Calculate Doppler effect frequency | *f' = f * (v ± v<sub>d</sub>) / (v ± v<sub>s</sub>)* |
| `lawOfReflection(thetaI)` | Law of reflection | *θᵢ = θᵣ* |
| `snellsLaw(n1, theta1, n2)` | Snell's law | *n₁sinθ₁ = n₂sinθ₂* |
| `mirrorFocalLength(do, di)` | Calculate mirror focal length | *1/f = 1/d<sub>o</sub> + 1/d<sub>i</sub>* |
| `magnification(di, do)` | Calculate magnification | *M = -di / do* |
| `soundIntensity(p, r)` | Calculate sound intensity | *I = P / 4πr²* |
| `soundLevel(i, i0)` | Calculate sound level | *β = 10 * log₁₀(I / I₀)* |
| `singleSlitDiffraction(lambda, w)` | Calculate single-slit diffraction | *sinθ = λ / w* |
| `lengthContraction(l0, v)` | Calculate length contraction | *L = L₀ * sqrt(1 - v²/c²)* |
| `timeDilation(t0, v)` | Calculate time dilation | *Δt = Δt₀ / sqrt(1 - v²/c²)* |
| `relativisticEnergy(m)` | Calculate relativistic energy | *E = mc²* |
| `relativisticMass(m0, v)` | Calculate relativistic mass | *m = m₀ / sqrt(1 - v²/c²)* |
| `relativisticMomentum(m, v)` | Calculate relativistic momentum | *p = γmv* |
| `relativisticVelocityAddition(u, v)` | Relativistic velocity addition | *u' = (u + v) / (1 + uv/c²)* |
| `photonEnergy(f)` | Calculate photon energy | *E = hf* |
| `deBroglieWavelength(p)` | Calculate de Broglie wavelength | *λ = h / p* |
| `quantumEnergyLevel(n, m, l)` | Calculate energy level in a quantum box | *E = n²h² / 8mL²* |
| `quantumProbability(psi, a, b, n)` | Calculate quantum probability | *P = ∫\|ψ\|²dx* (simple approximation) |
| `radioactiveDecay(n0, lambda, t)` | Calculate radioactive decay | *N = N₀ * e^(-λt)* |
| `nuclearBindingEnergy(deltaM)` | Calculate nuclear binding energy | *E = Δm * c²* |

## Test Function

The `runTests()` function provides a comprehensive suite of tests, grouped by physics area. Each test case calls a function with specific inputs and displays the result.  This allows for easy verification of the calculations and demonstrates how to use each function with different units. Error handling is also tested to ensure robustness.