# PHP MathCalculations Library

This library provides a comprehensive set of mathematical functions for PHP, covering various areas such as basic arithmetic, algebra, calculus, trigonometry, statistics, linear algebra, and graph theory.  It is designed for both general-purpose mathematical computations and specialized applications in scientific computing, data analysis, and algorithm development.

## Function Reference

| Function Name | Function Description | Function Scientific Description |
|---|---|---|
| `add(a, b)` | Add two numbers |  Addition operation: *a + b* |
| `subtract(a, b)` | Subtract two numbers | Subtraction operation: *a - b* |
| `multiply(a, b)` | Multiply two numbers | Multiplication operation: *a * b* |
| `divide(a, b)` | Divide two numbers | Division operation: *a / b*. Returns an error message if *b* is zero. |
| `quadraticFormula(a, b, c)` | Solve quadratic equation | Finds the roots of a quadratic equation of the form *ax² + bx + c = 0* using the quadratic formula. |
| `absoluteValue(x)` | Absolute value of a number | Computes the absolute value \|x\| of a number *x*. |
| `power(base, exponent)` | Power function | Calculates *base<sup>exponent</sup>*. |
| `squareRoot(x)` | Square root of a number | Computes the square root √x of a number *x*. Returns an error message if *x* is negative. |
| `cubicFormula(a, b, c, d)` | Solve cubic equation | Finds the real roots of a cubic equation of the form *ax³ + bx² + cx + d = 0*. |
| `polynomialRoots(coefficients)` | Find roots of polynomial | Finds roots of a polynomial up to the third degree, by automatically delegating to `quadraticFormula` or `cubicFormula`. Returns null for higher-degree polynomials. |
| `lcm(a, b)` | Least Common Multiple | Computes the least common multiple of two integers *a* and *b*. |
| `gcd(a, b)` | Greatest Common Divisor | Computes the greatest common divisor of two integers *a* and *b*. |
| `derivative(function, point, h)` | Numerical derivative |  Approximates the derivative of a function at a given point using the central difference method. |
| `integral(function, lowerBound, upperBound, n)` | Definite integral | Approximates the definite integral of a function using the trapezoidal rule. |
| `limit(function, point, h)` | Limit of a function | Approximates the limit of a function as it approaches a given point. |
| `secondDerivative(function, point, h)` | Second numerical derivative | Approximates the second derivative of a function at a given point using the central difference method applied twice. |
| `meanValueTheorem(f, a, b)` | Mean Value Theorem | Calculates the average rate of change of a function over an interval [a, b]. |
| `sin(angle)` | Sine function | Computes the sine of an angle (in degrees). |
| `cos(angle)` | Cosine function | Computes the cosine of an angle (in degrees). |
| `tan(angle)` | Tangent function | Computes the tangent of an angle (in degrees). |
| `sec(angle)` | Secant function | Computes the secant of an angle (in degrees). |
| `cosec(angle)` | Cosecant function | Computes the cosecant of an angle (in degrees). |
| `cot(angle)` | Cotangent function | Computes the cotangent of an angle (in degrees). |
| `arcsin(value)` | Arcsine function | Computes the arcsine (in degrees) of a value. |
| `arccos(value)` | Arccosine function | Computes the arccosine (in degrees) of a value. |
| `arctan(value)` | Arctangent function | Computes the arctangent (in degrees) of a value. |
| `exponential(x)` | Exponential function | Computes *e<sup>x</sup>*. |
| `logarithm(x, base)` | Logarithm | Computes the logarithm of *x* with the specified base. |
| `naturalLog(x)` | Natural logarithm | Computes the natural logarithm (base *e*) of *x*. |
| `logBase10(x)` | Base-10 logarithm | Computes the base-10 logarithm of *x*. |
| `arithmeticSequence(firstTerm, commonDifference, n)` | Arithmetic sequence | Computes the nth term of an arithmetic sequence. |
| `geometricSequence(firstTerm, commonRatio, n)` | Geometric sequence | Computes the nth term of a geometric sequence. |
| `fibonacci(n)` | Fibonacci sequence | Computes the nth Fibonacci number. |
| `taylorSeriesExponential(x, n)` | Taylor series for e^x | Approximates *e<sup>x</sup>* using the first *n* terms of its Taylor series expansion. |
| `taylorSeriesSin(x, n)` | Taylor series for sin(x) | Approximates sin(*x*) using the first *n* terms of its Taylor series expansion. *x* is in radians. |
| `taylorSeriesCos(x, n)` | Taylor series for cos(x) | Approximates cos(*x*) using the first *n* terms of its Taylor series expansion. *x* is in radians. |
| `factorial(n)` | Factorial | Computes the factorial of *n*. |
| `matrixAddition(matrixA, matrixB)` | Matrix addition | Adds two matrices. |
| `matrixMultiplication(matrixA, matrixB)` | Matrix multiplication | Multiplies two matrices. |
| `transpose(matrix)` | Matrix transpose | Transposes a matrix. |
| `determinant(matrix)` | Matrix determinant | Calculates the determinant of a square matrix. |
| `inverse(matrix)` | Matrix inverse | Calculates the inverse of a square matrix. |
| `combination(n, r)` | Combination | Calculates combinations (nCr). |
| `permutation(n, r)` | Permutation | Calculates permutations (nPr). |
| `mean(numbers)` | Mean | Calculates the arithmetic mean of a set of numbers. |
| `varianceSample(numbers)` | Sample variance | Calculates the sample variance of a set of numbers. |
| `standardDeviation(numbers)` | Standard deviation | Calculates the sample standard deviation of a set of numbers. |
| `median(numbers)` | Median | Calculates the median of a set of numbers. |
| `mode(numbers)` | Mode | Calculates the mode of a set of numbers. |
| `range(numbers)` | Range | Calculates the range of a set of numbers. |
| `poissonDistribution(k, lambda)` | Poisson Distribution | Calculates the probability mass function of a Poisson distribution. |
| `standardNormalDistribution(z)` | Standard normal distribution | Calculates the probability density function of the standard normal distribution. |
| `cumulativeNormalDistribution(z)` | Cumulative normal distribution | Calculates the cumulative distribution function of the standard normal distribution. |
| `chiSquareCDF(x, k)` | Chi-squared CDF | Calculates the cumulative distribution function of the chi-squared distribution. |
| `gammainc(x, a)` | Incomplete Gamma function | Calculates the normalized lower incomplete gamma function. |
| `lowerGamma(x, a)` | Lower incomplete gamma function | Calculates the lower incomplete gamma function. |
| `gamma(z)` | Gamma function | Calculates an approximation of the gamma function using Lanczos approximation. |
| `integralByParts(u, dv, a, b)` | Integration by parts | Evaluates the definite integral of a function using integration by parts. |
| `skewness(numbers)` | Skewness | Measures the asymmetry of the probability distribution of a dataset. |
| `kurtosis(numbers)` | Kurtosis | Measures the "tailedness" of the probability distribution of a dataset. |
| `interquartileRange(numbers)` | Interquartile Range | Calculates the difference between the 75th and 25th percentiles. |
| `euclideanDistance(vector1, vector2)` | Euclidean distance | Computes the Euclidean distance between two vectors. |
| `manhattanDistance(vector1, vector2)` | Manhattan distance | Computes the Manhattan distance between two vectors. |
| `chebyshevDistance(vector1, vector2)` | Chebyshev distance | Computes the Chebyshev distance between two vectors. |
| `minkowskiDistance(vector1, vector2, p)` | Minkowski distance | Computes the Minkowski distance between two vectors. |
| `cosineDistance(vector1, vector2)` | Cosine distance | Computes the cosine distance between two vectors. |
| `cosineSimilarity(vector1, vector2)` | Cosine similarity | Computes the cosine similarity between two vectors. |
| `jaccardSimilarity(set1, set2)` | Jaccard similarity | Computes the Jaccard similarity between two sets. |
| `pearsonSimilarity(vector1, vector2)` | Pearson similarity | Computes the Pearson correlation coefficient between two vectors. |
| `dotProductSimilarity(vector1, vector2)` | Dot Product similarity | Computes the dot product of two vectors. |
| `linearRegression(x, y)` | Linear Regression | Calculates linear regression coefficients (y = mx + b). |
| `knnClassify(data, point, k)` | k-Nearest Neighbors | Classifies data point based on k nearest neighbors. |
| `svmClassify(data, point)` | Support Vector Machine | Classifies using simplified linear SVM. |
| `dbscan(data, eps, minPts)` | DBSCAN Clustering | Clusters data points based on DBSCAN algorithm. |
| `kMeans(data, k, maxIterations)` | K-Means Clustering | Clusters data using k-Means. |
| `leastSquares(x, y)` | Least Squares | Solves least squares for linear regression. |
| `svrPredict(data, point, epsilon)` | SVR Prediction | Predicts using linear SVR. |
| `naiveBayesClassify(data, point)` | Naive Bayes Classification | Classifies data using Gaussian Naive Bayes. |
| `outerProduct(vector1, vector2)` | Outer Product | Computes outer product of two vectors. |
| `identityMatrix(size)` | Identity Matrix | Creates an identity matrix. |
| `diagonalMatrix(diagonalValues)` | Diagonal Matrix | Creates diagonal matrix with specified values. |
| `upperTriangularMatrix(matrix)` | Upper Triangular Matrix | Converts to upper triangular form. |
| `lowerTriangularMatrix(matrix)` | Lower Triangular Matrix | Converts to lower triangular form. |
| `onesMatrix(rows, cols)` | Ones Matrix | Creates matrix filled with ones. |
| `hermitianMatrix(matrix)` | Hermitian Matrix | Creates Hermitian matrix (transpose for real values). |
| `areEquivalentMatrices(matrix1, matrix2)` | Matrix Equivalence | Checks if two matrices are equal. |
| `adjointMatrix(matrix)` | Adjoint Matrix | Calculates adjoint of a matrix. |
| `rowMatrix(vector)` | Row Matrix | Creates a row matrix from a vector. |
| `columnMatrix(vector)` | Column Matrix | Creates a column matrix from a vector. |
| `isSquareMatrix(matrix)` | Square Matrix Check | Checks if a matrix is square. |
| `zeroMatrix(rows, cols)` | Zero Matrix | Creates a zero matrix. |
| `isSymmetricMatrix(matrix)` | Symmetric Matrix Check | Checks if a matrix is symmetric. |
| `isOrthogonalMatrix(matrix)` | Orthogonal Matrix Check | Checks if a matrix is orthogonal. |
| `isConnectedGraph(adjacencyList)` | Connected Graph Check | Checks if a graph is connected using DFS. |
| `isDisconnectedGraph(adjacencyList)` | Disconnected Graph Check | Checks if a graph is disconnected. |
| `bfsGraph(start, adjacencyList)` | Breadth-First Search | Performs BFS traversal on a graph. |
| `hamiltonianPath(adjacencyList)` | Hamiltonian Path | Finds a Hamiltonian Path in the graph. |
| `eulerianCircuit(adjacencyList)` | Eulerian Circuit | Finds an Eulerian Circuit in the graph. |
| `isTree(adjacencyList)` | Tree Check | Checks if a graph is a tree. |
| `dijkstra(graph, start)` | Dijkstra's Algorithm | Finds shortest paths in a graph using Dijkstra's algorithm. |


## Test Function

The `runTests()` function provides a comprehensive suite of tests for all functions within the `MathCalculations` class.  It's organized into groups based on mathematical categories (Basic Operations, Algebra, Calculus, etc.) for clarity and easier debugging.  Each test case demonstrates a typical usage of the function and prints the result to the console.  Error cases and boundary conditions are included where applicable to ensure robustness.  This systematic testing approach aims to validate the functionality of the library and provide examples of how to utilize each method correctly.