MathCalculations - PHP Science Class
====================================

`MathCalculations` is a comprehensive PHP class designed for performing a wide range of mathematical computations. Initially focused on basic operations, algebra, calculus, and statistics, it has been expanded to include advanced topics such as differential equations, linear algebra, numerical methods, and more. This class is ideal for educational purposes, scientific computing, and prototyping mathematical models in PHP.

Features
--------

* **171 Methods:** Covers basic arithmetic, algebra, calculus, trigonometry, statistics, graph theory, and advanced mathematical domains.
* **New Topics:** Includes Differential Equations, Linear Algebra (e.g., eigenvalues), Probability and Statistics, Numerical Methods, Complex Analysis, Optimization, Discrete Mathematics, Mathematical Modeling, Vector Calculus, Fourier and Laplace Transforms, Control Theory, and Finite Element Methods.
* **Namespace Support:** Defined under the `MathCalculations` namespace for better organization.
* **Error Handling:** Standardized with exceptions for critical errors and `null` returns for invalid results.
* **Testing:** Built-in `runTests()` method to verify functionality across all methods.
* **PHPDoc Comments:** Comprehensive documentation for all methods.

Installation
------------

To use `MathCalculations`, simply include the PHP file in your project. If using a PSR-4 autoloader, place it in the appropriate namespace directory.

``

Usage
-----

Instantiate the class and call its methods. Below is an example demonstrating basic operations and a new advanced feature:

    add(5, 3); // Outputs: 8
    echo $calc->quadraticFormula(1, -3, 2)[0]; // Outputs: 2 (one root of x^2 - 3x + 2 = 0)
    
    // Advanced: Solving a Differential Equation (dy/dx = -y)
    $ode = function($x, $y) { return -$y; };
    $solution = $calc->solveFirstOrderODE($ode, 0, 1, 1, 0.1);
    echo end($solution)[1]; // Outputs: ~0.368 (approximate value at x=1)
    
    // Run all tests
    $calc->runTests();
    

Functionality Overview
----------------------

The class is organized into 23 test groups, covering:

* **Basic Operations:** Addition, subtraction, multiplication, division
* **Algebra:** Quadratic/cubic equations, GCD, LCM, polynomial roots
* **Calculus:** Derivatives, integrals, limits
* **Trigonometry:** Sine, cosine, tangent, inverse functions
* **Exponential/Logarithmic:** e^x, ln(x), log base 10
* **Series/Sequences:** Arithmetic, geometric, Fibonacci, Taylor series
* **Matrix Operations:** Addition, multiplication, determinant, inverse
* **Statistics:** Mean, variance, distributions (Poisson, normal)
* **Similarity Functions:** Euclidean, cosine, Jaccard similarity
* **Machine Learning:** KNN, linear regression, SVM, clustering
* **Graph Theory:** Shortest path, MST, Hamiltonian/Eulerian paths
* **Differential Equations:** Euler method, RK4 for ODEs
* **Linear Algebra:** Eigenvalues, eigenvectors
* **Probability/Statistics:** Binomial probability, expected value
* **Numerical Methods:** Newton, bisection methods
* **Complex Analysis:** Complex addition, multiplication
* **Optimization:** Gradient descent, linear programming
* **Discrete Mathematics:** Power set, reflexive relations
* **Mathematical Modeling:** Exponential, logistic growth
* **Vector Calculus:** Gradient, divergence
* **Fourier/Laplace Transforms:** DFT, numerical Laplace
* **Control Theory:** Step response, frequency response
* **Finite Element Methods:** 1D FEM solver

List of Functions
-----------------

Below is a complete list of all 171 functions available in the `MathCalculations` class:

| Function Name | Function Description | Function Scientific Description |
| --- | --- | --- |
| `add` | Add two numbers | a + b |
| `subtract` | Subtract two numbers | a - b |
| `multiply` | Multiply two numbers | a * b |
| `divide` | Divide two numbers | a / b |
| `quadraticFormula` | Solve quadratic equation | ax² + bx + c = 0 |
| `absoluteValue` | Absolute value of a number | \|x\| |
| `power` | Power function | x^y |
| `squareRoot` | Square root of a number | √x  |
| `cubicFormula` | Solve cubic equation | ax³ + bx² + cx + d = 0 |
| `polynomialRoots` | Find roots of a polynomial | Solves polynomials up to degree 3 |
| `lcm` | Least Common Multiple | LCM(a, b) |
| `gcd` | Greatest Common Divisor | GCD(a, b) |
| `derivative` | Numerical derivative | f'(x) ≈ (f(x+h) - f(x-h)) / (2h) |
| `integral` | Definite integral | ∫[a,b] f(x) dx (Trapezoidal rule) |
| `limit` | Limit of a function | lim[x→a] f(x) |
| `secondDerivative` | Second numerical derivative | f''(x) ≈ (f'(x+h) - f'(x-h)) / (2h) |
| `meanValueTheorem` | Mean Value Theorem | (f(b) - f(a)) / (b - a) |
| `sin` | Sine function (degrees) | sin(θ) |
| `cos` | Cosine function (degrees) | cos(θ) |
| `tan` | Tangent function (degrees) | tan(θ) |
| `sec` | Secant function (degrees) | sec(θ) = 1/cos(θ) |
| `cosec` | Cosecant function (degrees) | csc(θ) = 1/sin(θ) |
| `cot` | Cotangent function (degrees) | cot(θ) = 1/tan(θ) |
| `arcsin` | Arcsine function (to degrees) | sin⁻¹(x) |
| `arccos` | Arccosine function (to degrees) | cos⁻¹(x) |
| `arctan` | Arctangent function (to degrees) | tan⁻¹(x) |
| `exponential` | Exponential function | e^x |
| `logarithm` | Logarithm with custom base | log_b(x) |
| `naturalLog` | Natural logarithm | ln(x) |
| `logBase10` | Base-10 logarithm | log₁₀(x) |
| `arithmeticSequence` | Arithmetic sequence | a_n = a_1 + (n-1)d |
| `geometricSequence` | Geometric sequence | a_n = a_1 * r^(n-1) |
| `fibonacci` | Fibonacci sequence | F(n) = F(n-1) + F(n-2) |
| `taylorSeriesExponential` | Taylor series for e^x | e^x ≈ Σ[x^n / n!] |
| `taylorSeriesSin` | Taylor series for sin(x) | sin(x) ≈ Σ[(-1)^n * x^(2n+1) / (2n+1)!] |
| `taylorSeriesCos` | Taylor series for cos(x) | cos(x) ≈ Σ[(-1)^n * x^(2n) / (2n)!] |
| `factorial` | Factorial of a number | n!  |
| `matrixAddition` | Matrix addition | A + B |
| `matrixMultiplication` | Matrix multiplication | A * B |
| `transpose` | Matrix transpose | A^T |
| `determinant` | Matrix determinant | det(A) |
| `inverse` | Matrix inverse | A⁻¹ |
| `outerProduct` | Outer product of vectors | u ⊗ v |
| `identityMatrix` | Create identity matrix | I_n |
| `diagonalMatrix` | Create diagonal matrix | diag(d_1, ..., d_n) |
| `upperTriangularMatrix` | Upper triangular matrix | U (zeros below diagonal) |
| `lowerTriangularMatrix` | Lower triangular matrix | L (zeros above diagonal) |
| `onesMatrix` | Create ones matrix | J (all elements 1) |
| `hermitianMatrix` | Hermitian matrix (real case) | A* = A^T |
| `areEquivalentMatrices` | Check matrix equivalence | A = B |
| `adjointMatrix` | Adjoint matrix | adj(A) |
| `rowMatrix` | Create row matrix | [v] |
| `columnMatrix` | Create column matrix | [v]^T |
| `isSquareMatrix` | Check if matrix is square | Rows = Columns |
| `zeroMatrix` | Create zero matrix | 0 (all elements 0) |
| `isSymmetricMatrix` | Check if matrix is symmetric | A = A^T |
| `combination` | Combination | C(n, r) = n! / (r!(n-r)!) |
| `permutation` | Permutation | P(n, r) = n! / (n-r)! |
| `mean` | Mean of numbers | μ = Σx_i / n |
| `varianceSample` | Sample variance | s² = Σ(x_i - μ)² / (n-1) |
| `standardDeviation` | Sample standard deviation | s = √s² |
| `median` | Median of numbers | Middle value of sorted list |
| `mode` | Mode of numbers | Most frequent value |
| `range` | Range of numbers | max - min |
| `poissonDistribution` | Poisson distribution | P(k) = (λ^k * e^(-λ)) / k! |
| `standardNormalDistribution` | Standard normal distribution | φ(z) = (1/√(2π)) * e^(-z²/2) |
| `cumulativeNormalDistribution` | Cumulative normal distribution | Φ(z) = ∫[-∞,z] φ(t) dt |
| `chiSquareCDF` | Chi-square CDF | F(x; k) = γ(k/2, x/2) / Γ(k/2) |
| `gammainc` | Incomplete gamma function | γ(a, x) / Γ(a) |
| `gamma` | Gamma function | Γ(z) = ∫[0,∞] t^(z-1) e^(-t) dt |
| `lowerGamma` | Lower incomplete gamma | γ(a, x) = ∫[0,x] t^(a-1) e^(-t) dt |
| `integralByParts` | Integration by parts | ∫u dv = uv - ∫v du |
| `skewness` | Skewness | γ₁ = (Σ(x_i - μ)³ / n) / σ³ |
| `kurtosis` | Excess kurtosis | γ₂ = (Σ(x_i - μ)⁴ / n) / σ⁴ - 3 |
| `interquartileRange` | Interquartile range | IQR = Q₃ - Q₁ |
| `euclideanDistance` | Euclidean distance | d = √Σ(x_i - y_i)² |
| `manhattanDistance` | Manhattan distance | d = Σ\|x_i - y_i\| |
| `chebyshevDistance` | Chebyshev distance | d = max\|x_i - y_i\| |
| `minkowskiDistance` | Minkowski distance | d = (Σ\|x_i - y_i\|^p)^(1/p) |
| `cosineDistance` | Cosine distance | d = 1 - cos(θ) |
| `cosineSimilarity` | Cosine similarity | cos(θ) = (x·y) / (\|x\| * \|y\|) |
| `jaccardSimilarity` | Jaccard similarity | J(A, B) = \|A ∩ B\| / \|A ∪ B\| |
| `pearsonSimilarity` | Pearson similarity | ρ = Σ(x_i - μ_x)(y_i - μ_y) / √(Σ(x_i - μ_x)² * Σ(y_i - μ_y)²) |
| `dotProductSimilarity` | Dot product similarity | x·y = Σx_i * y_i |
| `linearRegression` | Linear regression | y = mx + b |
| `knnClassify` | K-Nearest Neighbors | Majority vote of k nearest points |
| `svmClassify` | Linear SVM classification | sign(w·x + b) |
| `dbscan` | DBSCAN clustering | Density-based spatial clustering |
| `kMeans` | k-Means clustering | Minimize Σ\|x_i - μ_j\|² |
| `leastSquares` | Least squares regression | min Σ(y_i - (mx_i + b))² |
| `svrPredict` | Support Vector Regression | w·x + b with ε-insensitive loss |
| `naiveBayesClassify` | Gaussian Naive Bayes | P(C\|x) ∝ P(C) * ΠP(x_i\|C) |
| `shortestPathDijkstra` | Shortest path (Dijkstra) | Min Σw(e) from s to t |
| `minimumSpanningTreeKruskal` | MST (Kruskal) | Min Σw(e) spanning all vertices |
| `hamiltonianPath` | Hamiltonian path | Path visiting each vertex once |
| `eulerianCircuit` | Eulerian circuit | Circuit traversing each edge once |
| `solveFirstOrderODE` | Solve first-order ODE | dy/dx = f(x,y) (Euler method) |
| `solveSecondOrderODE` | Solve second-order ODE | d²y/dx² = f(x,y,dy/dx) (RK4) |
| `eigenvalues` | Eigenvalues of 2x2 matrix | λ where det(A - λI) = 0 |
| `eigenvectors` | Eigenvectors of 2x2 matrix | v where Av = λv |
| `binomialProbability` | Binomial probability | P(X=k) = C(n,k) * p^k * (1-p)^(n-k) |
| `expectedValue` | Expected value | E[X] = Σx_i * P(x_i) |
| `newtonMethod` | Newton's method | x_{n+1} = x_n - f(x_n) / f'(x_n) |
| `bisectionMethod` | Bisection method | c = (a+b)/2 until f(c) ≈ 0 |
| `complexAdd` | Add complex numbers | (a + bi) + (c + di) = (a+c) + (b+d)i |
| `complexMultiply` | Multiply complex numbers | (a + bi)(c + di) = (ac-bd) + (ad+bc)i |
| `gradientDescent` | Gradient descent | x_{n+1} = x_n - η∇f(x_n) |
| `linearProgramming` | Linear programming | max c·x s.t. Ax ≤ b (placeholder) |
| `powerSet` | Generate power set | P(S) = set of all subsets |
| `isReflexive` | Check if relation is reflexive | (a,a) ∈ R ∀a ∈ S |
| `exponentialGrowth` | Exponential growth | P(t) = P_0 * e^(rt) |
| `logisticGrowth` | Logistic growth | P(t) = K / (1 + (K-P_0)/P_0 * e^(-rt)) |
| `gradient` | Gradient of scalar function | ∇f = [∂f/∂x, ∂f/∂y, ...] |
| `divergence` | Divergence of vector field | ∇·F = ∂F_x/∂x + ∂F_y/∂y + ... |
| `fourierTransform` | Discrete Fourier Transform | X_k = Σx_n * e^(-2πi kn/N) |
| `laplaceTransform` | Laplace Transform | L{f(t)} = ∫[0,∞] f(t) e^(-st) dt |
| `stepResponse` | Step response | y(t) = K(1 - e^(-t/τ)) |
| `frequencyResponse` | Frequency response magnitude | \|H(jω)\| = K / √(1 + (ωτ)²) |
| `solveFEM` | Solve 1D FEM | Solves u'' = f(x) with boundary conditions |
| `solveLinearSystem` | Solve linear system | Ax = b (Gaussian elimination) |

Limitations
-----------

* Some advanced methods (e.g., `linearProgramming`, `fourierTransform`) are simplified or placeholders due to PHP’s limitations.
* Floating-point precision may affect results in certain calculations.
* Complex numerical methods may require external libraries for production use.

Contributing
------------

Contributions are welcome! Feel free to submit pull requests or open issues on the [GitHub repository](https://github.com/ildrm/php-science-class) to suggest improvements, add new features, or fix bugs.

License
-------

This project is open-source and available under the MIT License. See the LICENSE file for details.
