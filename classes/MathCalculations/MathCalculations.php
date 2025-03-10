<?php

namespace MathCalculations;

class MathCalculations
{
    // Existing 111 methods (with minor fixes)
    // Basic Operations
    /**
     * Add two numbers
     * @param float $a First number
     * @param float $b Second number
     * @return float Sum
     */
    public function add(float $a, float $b): float
    {
        return $a + $b;
    }

    /**
     * Subtract two numbers
     * @param float $a First number
     * @param float $b Second number
     * @return float Difference
     */
    public function subtract(float $a, float $b): float
    {
        return $a - $b;
    }

    /**
     * Multiply two numbers
     * @param float $a First number
     * @param float $b Second number
     * @return float Product
     */
    public function multiply(float $a, float $b): float
    {
        return $a * $b;
    }

    /**
     * Divide two numbers
     * @param float $a Dividend
     * @param float $b Divisor
     * @return float|null Quotient or null if division by zero
     * @throws \InvalidArgumentException If divisor is zero
     */
    public function divide(float $a, float $b): ?float
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("Division by zero is not possible");
        }
        return $a / $b;
    }

    // Algebra
    /**
     * Solve quadratic equation ax^2 + bx + c = 0
     * @param float $a Coefficient of x^2
     * @param float $b Coefficient of x
     * @param float $c Constant term
     * @return array|null Roots or null if no real roots
     * @throws \InvalidArgumentException If a is zero
     */
    public function quadraticFormula(float $a, float $b, float $c): ?array
    {
        if ($a == 0) {
            throw new \InvalidArgumentException("Coefficient 'a' cannot be zero");
        }
        $discriminant = ($b * $b) - (4 * $a * $c);
        if ($discriminant < 0) {
            return null; // No real roots
        }
        $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
        $x2 = (-$b - sqrt($discriminant)) / (2 * $a);
        return [$x1, $x2];
    }

    /**
     * Absolute value of a number
     * @param float $x Number
     * @return float Absolute value
     */
    public function absoluteValue(float $x): float
    {
        return abs($x);
    }

    /**
     * Power function (x^y)
     * @param float $base Base
     * @param float $exponent Exponent
     * @return float Result
     */
    public function power(float $base, float $exponent): float
    {
        return pow($base, $exponent);
    }

    /**
     * Square root of a number
     * @param float $x Number
     * @return float|null Square root or null if negative
     * @throws \InvalidArgumentException If number is negative
     */
    public function squareRoot(float $x): ?float
    {
        if ($x < 0) {
            throw new \InvalidArgumentException("Square root of a negative number is not possible");
        }
        return sqrt($x);
    }

    /**
     * Solve cubic equation ax^3 + bx^2 + cx + d = 0
     * @param float $a Coefficient of x^3
     * @param float $b Coefficient of x^2
     * @param float $c Coefficient of x
     * @param float $d Constant term
     * @return array Roots
     */
    public function cubicFormula(float $a, float $b, float $c, float $d): array
    {
        if ($a == 0) {
            $roots = $this->quadraticFormula($b, $c, $d);
            if ($roots === null) {
                return [$this->divide(-$d, $c)];
            }
            return $roots;
        }
        $f = ((3 * $c / $a) - ($b * $b / ($a * $a))) / 3;
        $g = ((2 * $b * $b * $b / ($a * $a * $a)) - (9 * $b * $c / ($a * $a)) + (27 * $d / $a)) / 27;
        $h = ($g * $g / 4) + ($f * $f * $f / 27);

        if ($h > 0) {
            $R = -$g / 2 + sqrt($h);
            $S = ($R < 0) ? -pow(-$R, 1/3) : pow($R, 1/3);
            $T = -$g / 2 - sqrt($h);
            $U = ($T < 0) ? -pow(-$T, 1/3) : pow($T, 1/3);
            return [($S + $U) - ($b / (3 * $a))];
        } elseif ($f == 0 && $g == 0 && $h == 0) {
            $x = -pow($d / $a, 1/3);
            return [$x];
        } else {
            $i = sqrt((($g * $g) / 4) - $h);
            $j = pow($i, 1/3);
            $k = acos(-$g / (2 * $i));
            $L = -$j;
            $M = cos($k / 3);
            $N = sqrt(3) * sin($k / 3);
            $P = -($b / (3 * $a));
            return [
                2 * $j * cos($k / 3) - ($b / (3 * $a)),
                $L * ($M + $N) + $P,
                $L * ($M - $N) + $P
            ];
        }
    }

    /**
     * Find roots of a polynomial
     * @param array $coefficients Polynomial coefficients
     * @return array|null Roots or null if degree > 3
     */
    public function polynomialRoots(array $coefficients): ?array
    {
        $degree = count($coefficients) - 1;
        if ($degree == 2) {
            return $this->quadraticFormula($coefficients[0], $coefficients[1], $coefficients[2]);
        } elseif ($degree == 3) {
            return $this->cubicFormula($coefficients[0], $coefficients[1], $coefficients[2], $coefficients[3]);
        }
        return null;
    }

    /**
     * Least Common Multiple (LCM)
     * @param int $a First integer
     * @param int $b Second integer
     * @return int LCM
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function lcm(int $a, int $b): int
    {
        if ($a == 0 || $b == 0) {
            throw new \InvalidArgumentException("LCM of zero is undefined");
        }
        return abs($a * $b) / $this->gcd($a, $b);
    }

    /**
     * Greatest Common Divisor (GCD)
     * @param int $a First integer
     * @param int $b Second integer
     * @return int GCD
     */
    public function gcd(int $a, int $b): int
    {
        $a = abs($a);
        $b = abs($b);
        while ($b != 0) {
            $temp = $b;
            $b = $a % $b;
            $a = $temp;
        }
        return $a;
    }

    // Calculus
    /**
     * Numerical derivative of a function
     * @param callable $function Function to differentiate
     * @param float $point Point of evaluation
     * @param float $h Step size
     * @return float Derivative
     */
    public function derivative(callable $function, float $point, float $h = 1e-5): float
    {
        return ($function($point + $h) - $function($point - $h)) / (2 * $h);
    }

    /**
     * Definite integral of a function
     * @param callable $function Function to integrate
     * @param float $lowerBound Lower limit
     * @param float $upperBound Upper limit
     * @param int $n Number of intervals
     * @return float Integral value
     */
    public function integral(callable $function, float $lowerBound, float $upperBound, int $n = 1000): float
    {
        if ($lowerBound == $upperBound) return 0;
        $h = ($upperBound - $lowerBound) / $n;
        $sum = 0.5 * ($function($lowerBound) + $function($upperBound));
        for ($i = 1; $i < $n; $i++) {
            $sum += $function($lowerBound + $i * $h);
        }
        return $sum * $h;
    }

    /**
     * Limit of a function
     * @param callable $function Function
     * @param float $point Point of evaluation
     * @param float $h Step size
     * @return float Limit value
     */
    public function limit(callable $function, float $point, float $h = 1e-5): float
    {
        return $function($point + $h);
    }

    /**
     * Second numerical derivative of a function
     * @param callable $function Function to differentiate
     * @param float $point Point of evaluation
     * @param float $h Step size
     * @return float Second derivative
     */
    public function secondDerivative(callable $function, float $point, float $h = 1e-5): float
    {
        return ($this->derivative($function, $point + $h) - $this->derivative($function, $point - $h)) / (2 * $h);
    }

    /**
     * Mean Value Theorem
     * @param callable $f Function
     * @param float $a Lower bound
     * @param float $b Upper bound
     * @return float|null Average rate of change or null if invalid interval
     * @throws \InvalidArgumentException If interval is invalid
     */
    public function meanValueTheorem(callable $f, float $a, float $b): ?float
    {
        if ($a == $b) {
            throw new \InvalidArgumentException("Invalid interval");
        }
        return ($f($b) - $f($a)) / ($b - $a);
    }

    // Trigonometric Functions
    /**
     * Sine function (degrees)
     * @param float $angle Angle in degrees
     * @return float Sine value
     */
    public function sin(float $angle): float
    {
        return sin(deg2rad($angle));
    }

    /**
     * Cosine function (degrees)
     * @param float $angle Angle in degrees
     * @return float Cosine value
     */
    public function cos(float $angle): float
    {
        return cos(deg2rad($angle));
    }

    /**
     * Tangent function (degrees)
     * @param float $angle Angle in degrees
     * @return float|null Tangent value or null if undefined
     * @throws \InvalidArgumentException If tangent is undefined
     */
    public function tan(float $angle): ?float
    {
        $tan = tan(deg2rad($angle));
        if (is_infinite($tan)) {
            throw new \InvalidArgumentException("Tangent is undefined at this angle");
        }
        return $tan;
    }

    /**
     * Secant function (degrees)
     * @param float $angle Angle in degrees
     * @return float|null Secant value or null if undefined
     * @throws \InvalidArgumentException If secant is undefined
     */
    public function sec(float $angle): ?float
    {
        $cos = $this->cos($angle);
        if ($cos == 0) {
            throw new \InvalidArgumentException("Secant is undefined at this angle");
        }
        return 1 / $cos;
    }

    /**
     * Cosecant function (degrees)
     * @param float $angle Angle in degrees
     * @return float|null Cosecant value or null if undefined
     * @throws \InvalidArgumentException If cosecant is undefined
     */
    public function cosec(float $angle): ?float
    {
        $sin = $this->sin($angle);
        if ($sin == 0) {
            throw new \InvalidArgumentException("Cosecant is undefined at this angle");
        }
        return 1 / $sin;
    }

    /**
     * Cotangent function (degrees)
     * @param float $angle Angle in degrees
     * @return float|null Cotangent value or null if undefined
     * @throws \InvalidArgumentException If cotangent is undefined
     */
    public function cot(float $angle): ?float
    {
        $tan = $this->tan($angle);
        if ($tan === null || $tan == 0) {
            throw new \InvalidArgumentException("Cotangent is undefined at this angle");
        }
        return 1 / $tan;
    }

    /**
     * Arcsine function (to degrees)
     * @param float $value Value
     * @return float|null Angle in degrees or null if invalid
     * @throws \InvalidArgumentException If value is out of range
     */
    public function arcsin(float $value): ?float
    {
        if ($value < -1 || $value > 1) {
            throw new \InvalidArgumentException("Value must be between -1 and 1");
        }
        return rad2deg(asin($value));
    }

    /**
     * Arccosine function (to degrees)
     * @param float $value Value
     * @return float|null Angle in degrees or null if invalid
     * @throws \InvalidArgumentException If value is out of range
     */
    public function arccos(float $value): ?float
    {
        if ($value < -1 || $value > 1) {
            throw new \InvalidArgumentException("Value must be between -1 and 1");
        }
        return rad2deg(acos($value));
    }

    /**
     * Arctangent function (to degrees)
     * @param float $value Value
     * @return float Angle in degrees
     */
    public function arctan(float $value): float
    {
        return rad2deg(atan($value));
    }

    // Exponential and Logarithmic Functions
    /**
     * Exponential function (e^x)
     * @param float $x Exponent
     * @return float Exponential value
     */
    public function exponential(float $x): float
    {
        return exp($x);
    }

    /**
     * Logarithm with custom base
     * @param float $x Number
     * @param float $base Base (default: e)
     * @return float|null Logarithm value or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function logarithm(float $x, float $base = M_E): ?float
    {
        if ($x <= 0) {
            throw new \InvalidArgumentException("Logarithm of zero or negative number is undefined");
        }
        if ($base <= 0 || $base == 1) {
            throw new \InvalidArgumentException("Base must be positive and not equal to 1");
        }
        return log($x, $base);
    }

    /**
     * Natural logarithm (ln)
     * @param float $x Number
     * @return float|null Natural logarithm value or null if invalid
     * @throws \InvalidArgumentException If input is invalid
     */
    public function naturalLog(float $x): ?float
    {
        if ($x <= 0) {
            throw new \InvalidArgumentException("Natural logarithm of zero or negative number is undefined");
        }
        return log($x);
    }

    /**
     * Base-10 logarithm
     * @param float $x Number
     * @return float|null Base-10 logarithm value or null if invalid
     * @throws \InvalidArgumentException If input is invalid
     */
    public function logBase10(float $x): ?float
    {
        if ($x <= 0) {
            throw new \InvalidArgumentException("Base-10 logarithm of zero or negative number is undefined");
        }
        return log10($x);
    }

    // Series and Sequences
    /**
     * Arithmetic sequence
     * @param float $firstTerm First term
     * @param float $commonDifference Common difference
     * @param int $n Term number
     * @return float|null Nth term or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function arithmeticSequence(float $firstTerm, float $commonDifference, int $n): ?float
    {
        if ($n < 1) {
            throw new \InvalidArgumentException("'n' must be positive");
        }
        return $firstTerm + ($n - 1) * $commonDifference;
    }

    /**
     * Geometric sequence
     * @param float $firstTerm First term
     * @param float $commonRatio Common ratio
     * @param int $n Term number
     * @return float|null Nth term or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function geometricSequence(float $firstTerm, float $commonRatio, int $n): ?float
    {
        if ($n < 1) {
            throw new \InvalidArgumentException("'n' must be positive");
        }
        return $firstTerm * pow($commonRatio, $n - 1);
    }

    /**
     * Fibonacci sequence
     * @param int $n Term number
     * @return int|null Nth term or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function fibonacci(int $n): ?int
    {
        if ($n < 0) {
            throw new \InvalidArgumentException("'n' must be non-negative");
        }
        if ($n == 0) return 0;
        if ($n == 1) return 1;
        $a = 0;
        $b = 1;
        for ($i = 2; $i <= $n; $i++) {
            $temp = $a + $b;
            $a = $b;
            $b = $temp;
        }
        return $b;
    }

    // Taylor Series
    /**
     * Taylor series for e^x
     * @param float $x Value
     * @param int $n Number of terms
     * @return float|null Approximation or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function taylorSeriesExponential(float $x, int $n): ?float
    {
        if ($n < 0) {
            throw new \InvalidArgumentException("'n' must be non-negative");
        }
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += $this->power($x, $i) / $this->factorial($i);
        }
        return $sum;
    }

    /**
     * Taylor series for sin(x)
     * @param float $x Value in radians
     * @param int $n Number of terms
     * @return float|null Approximation or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function taylorSeriesSin(float $x, int $n): ?float
    {
        if ($n < 0) {
            throw new \InvalidArgumentException("'n' must be non-negative");
        }
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += ($this->power(-1, $i) * $this->power($x, 2 * $i + 1)) / $this->factorial(2 * $i + 1);
        }
        return $sum;
    }

    /**
     * Taylor series for cos(x)
     * @param float $x Value in radians
     * @param int $n Number of terms
     * @return float|null Approximation or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function taylorSeriesCos(float $x, int $n): ?float
    {
        if ($n < 0) {
            throw new \InvalidArgumentException("'n' must be non-negative");
        }
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += ($this->power(-1, $i) * $this->power($x, 2 * $i)) / $this->factorial(2 * $i);
        }
        return $sum;
    }

    /**
     * Factorial of a number
     * @param int $n Number
     * @return int|null Factorial or null if invalid
     * @throws \InvalidArgumentException If n is invalid
     */
    public function factorial(int $n): ?int
    {
        if (!is_int($n) || $n < 0) {
            throw new \InvalidArgumentException("'n' must be a non-negative integer");
        }
        if ($n === 0) return 1;
        $result = 1;
        for ($i = 1; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }

    // Matrix Operations
    /**
     * Matrix addition
     * @param array $matrixA First matrix
     * @param array $matrixB Second matrix
     * @return array|null Result matrix or null if dimensions mismatch
     * @throws \InvalidArgumentException If dimensions mismatch
     */
    public function matrixAddition(array $matrixA, array $matrixB): ?array
    {
        if (count($matrixA) != count($matrixB) || count($matrixA[0]) != count($matrixB[0])) {
            throw new \InvalidArgumentException("Matrix dimensions must match");
        }
        $result = [];
        for ($i = 0; $i < count($matrixA); $i++) {
            for ($j = 0; $j < count($matrixA[$i]); $j++) {
                $result[$i][$j] = $matrixA[$i][$j] + $matrixB[$i][$j];
            }
        }
        return $result;
    }

    /**
     * Matrix multiplication
     * @param array $matrixA First matrix
     * @param array $matrixB Second matrix
     * @return array|null Result matrix or null if dimensions mismatch
     * @throws \InvalidArgumentException If dimensions mismatch
     */
    public function matrixMultiplication(array $matrixA, array $matrixB): ?array
    {
        if (count($matrixA[0]) != count($matrixB)) {
            throw new \InvalidArgumentException("Number of columns in first matrix must equal number of rows in second matrix");
        }
        $result = [];
        for ($i = 0; $i < count($matrixA); $i++) {
            for ($j = 0; $j < count($matrixB[0]); $j++) {
                $result[$i][$j] = 0;
                for ($k = 0; $k < count($matrixB); $k++) {
                    $result[$i][$j] += $matrixA[$i][$k] * $matrixB[$k][$j];
                }
            }
        }
        return $result;
    }

    /**
     * Matrix transpose
     * @param array $matrix Input matrix
     * @return array Transposed matrix
     */
    public function transpose(array $matrix): array
    {
        $result = [];
        for ($i = 0; $i < count($matrix[0]); $i++) {
            for ($j = 0; $j < count($matrix); $j++) {
                $result[$i][$j] = $matrix[$j][$i];
            }
        }
        return $result;
    }

    /**
     * Matrix determinant
     * @param array $matrix Square matrix
     * @return float Determinant
     * @throws \InvalidArgumentException If matrix is invalid
     */
    public function determinant(array $matrix): float
    {
        if (!is_array($matrix) || empty($matrix)) {
            throw new \InvalidArgumentException("Matrix is empty or invalid");
        }
        $rows = count($matrix);
        if ($rows != count($matrix[0])) {
            throw new \InvalidArgumentException("Matrix must be square");
        }
        
        if ($rows == 1) {
            return $matrix[0][0];
        }
        if ($rows == 2) {
            return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
        }

        $det = 0;
        for ($i = 0; $i < $rows; $i++) {
            $det += ($i % 2 == 0 ? 1 : -1) * $matrix[0][$i] * $this->determinant($this->minor($matrix, 0, $i));
        }
        return $det;
    }

    /**
     * Matrix minor
     * @param array $matrix Input matrix
     * @param int $row Row to exclude
     * @param int $col Column to exclude
     * @return array Minor matrix
     */
    private function minor(array $matrix, int $row, int $col): array
    {
        $minor = [];
        for ($i = 0; $i < count($matrix); $i++) {
            if ($i != $row) {
                $minorRow = [];
                for ($j = 0; $j < count($matrix[$i]); $j++) {
                    if ($j != $col) {
                        $minorRow[] = $matrix[$i][$j];
                    }
                }
                $minor[] = $minorRow;
            }
        }
        return $minor;
    }

    /**
     * Matrix inverse
     * @param array $matrix Input matrix
     * @return array|null Inverse matrix or null if no inverse
     * @throws \InvalidArgumentException If matrix is invalid
     */
    public function inverse(array $matrix): ?array
    {
        $det = $this->determinant($matrix);
        if ($det == 0) return null; // No inverse
        $adjoint = $this->adjoint($matrix);
        $inverse = [];
        for ($i = 0; $i < count($matrix); $i++) {
            for ($j = 0; $j < count($matrix); $j++) {
                $inverse[$i][$j] = $adjoint[$i][$j] / $det;
            }
        }
        return $inverse;
    }

    /**
     * Matrix adjoint
     * @param array $matrix Input matrix
     * @return array Adjoint matrix
     */
    private function adjoint(array $matrix): array
    {
        $adjoint = [];
        for ($i = 0; $i < count($matrix); $i++) {
            for ($j = 0; $j < count($matrix); $j++) {
                $adjoint[$j][$i] = ($i + $j) % 2 == 0 ? $this->determinant($this->minor($matrix, $i, $j)) : -$this->determinant($this->minor($matrix, $i, $j));
            }
        }
        return $adjoint;
    }

    // Statistical Functions
    /**
     * Combination (nCr)
     * @param int $n Total items
     * @param int $r Items to choose
     * @return float|null Combination value or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function combination(int $n, int $r): ?float
    {
        if ($r > $n || $n < 0 || $r < 0) {
            throw new \InvalidArgumentException("Invalid inputs");
        }
        return $this->factorial($n) / ($this->factorial($r) * $this->factorial($n - $r));
    }

    /**
     * Permutation (nPr)
     * @param int $n Total items
     * @param int $r Items to arrange
     * @return float|null Permutation value or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function permutation(int $n, int $r): ?float
    {
        if ($r > $n || $n < 0 || $r < 0) {
            throw new \InvalidArgumentException("Invalid inputs");
        }
        return $this->factorial($n) / $this->factorial($n - $r);
    }

    /**
     * Mean of numbers
     * @param array $numbers Array of numbers
     * @return float|null Mean or null if array is empty
     * @throws \InvalidArgumentException If array is empty
     */
    public function mean(array $numbers): ?float
    {
        if (empty($numbers)) {
            throw new \InvalidArgumentException("Array is empty");
        }
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Sample variance
     * @param array $numbers Array of numbers
     * @return float|null Variance or null if insufficient data
     * @throws \InvalidArgumentException If insufficient data
     */
    public function varianceSample(array $numbers): ?float
    {
        if (count($numbers) < 2) {
            throw new \InvalidArgumentException("At least two values are required");
        }
        $mean = $this->mean($numbers);
        $squaredDiffs = array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $numbers);
        return array_sum($squaredDiffs) / (count($numbers) - 1);
    }

    /**
     * Sample standard deviation
     * @param array $numbers Array of numbers
     * @return float|null Standard deviation or null if invalid
     * @throws \InvalidArgumentException If insufficient data
     */
    public function standardDeviation(array $numbers): ?float
    {
        $variance = $this->varianceSample($numbers);
        return sqrt($variance);
    }

    /**
     * Median of numbers
     * @param array $numbers Array of numbers
     * @return float|null Median or null if array is empty
     * @throws \InvalidArgumentException If array is empty
     */
    public function median(array $numbers): ?float
    {
        if (empty($numbers)) {
            throw new \InvalidArgumentException("Array is empty");
        }
        sort($numbers);
        $count = count($numbers);
        $middle = floor(($count - 1) / 2);
        if ($count % 2) {
            return $numbers[$middle];
        } else {
            return ($numbers[$middle] + $numbers[$middle + 1]) / 2;
        }
    }

    /**
     * Mode of numbers
     * @param array $numbers Array of numbers
     * @return mixed|null Mode or null if array is empty
     * @throws \InvalidArgumentException If array is empty
     */
    public function mode(array $numbers)
    {
        if (empty($numbers)) {
            throw new \InvalidArgumentException("Array is empty");
        }
        $values = array_count_values($numbers);
        return array_search(max($values), $values);
    }

    /**
     * Range of numbers
     * @param array $numbers Array of numbers
     * @return float|null Range or null if array is empty
     * @throws \InvalidArgumentException If array is empty
     */
    public function range(array $numbers): ?float
    {
        if (empty($numbers)) {
            throw new \InvalidArgumentException("Array is empty");
        }
        return max($numbers) - min($numbers);
    }

    // Statistical Distributions
    /**
     * Poisson distribution
     * @param int $k Number of occurrences
     * @param float $lambda Average rate
     * @return float|null Probability or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function poissonDistribution(int $k, float $lambda): ?float
    {
        if ($k < 0 || $lambda <= 0) {
            throw new \InvalidArgumentException("Invalid inputs");
        }
        return ($this->power($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * Standard normal distribution
     * @param float $z Z-score
     * @return float Probability density
     */
    public function standardNormalDistribution(float $z): float
    {
        return (1 / sqrt(2 * M_PI)) * exp(-0.5 * pow($z, 2));
    }

    /**
     * Cumulative normal distribution
     * @param float $z Z-score
     * @return float Cumulative probability
     */
    public function cumulativeNormalDistribution(float $z): float
    {
        $a1 = 0.254829592;
        $a2 = -0.284496736;
        $a3 = 1.421413741;
        $a4 = -1.453152027;
        $a5 = 1.061405429;
        $p = 0.3275911;

        $sign = 1;
        if ($z < 0) $sign = -1;
        $z = abs($z) / sqrt(2.0);

        $t = 1.0 / (1.0 + $p * $z);
        $y = 1.0 - (((($a5 * $t + $a4) * $t + $a3) * $t + $a2) * $t + $a1) * $t * exp(-$z * $z);

        return 0.5 * (1.0 + $sign * $y);
    }

    /**
     * Chi-square cumulative distribution function (CDF)
     * @param float $x Value
     * @param int $k Degrees of freedom
     * @return float|null CDF value or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function chiSquareCDF(float $x, int $k): ?float
    {
        if ($x < 0 || $k < 1) {
            throw new \InvalidArgumentException("Invalid inputs");
        }
        if ($x == 0) return 0.0;
        return $this->gammainc($x / 2, $k / 2);
    }

    /**
     * Incomplete gamma function
     * @param float $x Value
     * @param float $a Shape parameter
     * @return float Incomplete gamma value
     */
    public function gammainc(float $x, float $a): float
    {
        $g = $this->gamma($a);
        return $this->lowerGamma($x, $a) / $g;
    }

    /**
     * Gamma function approximation
     * @param float $z Value
     * @return float Gamma value
     */
    public function gamma(float $z): float
    {
        $coefficients = [1, 0.5772156649015329, -0.6558780715202538, -0.0420026350340952,
                        0.1665386113822915, -0.0421977345555443, -0.00962197152787697,
                        0.007218943246663, -0.0011651675918591, -0.0002152416741149,
                        0.0001280502823882, -0.0000201348547807, -0.0000012504934821];
        $y = $z - 1;
        $sum = $coefficients[0];
        for ($i = 1; $i < count($coefficients); $i++) {
            $sum += $coefficients[$i] / ($y + $i);
        }
        $t = $y + count($coefficients) - 0.5;
        return sqrt(2 * M_PI) * pow($t, $y + 0.5) * exp(-$t) * $sum;
    }

    /**
     * Lower incomplete gamma function
     * @param float $x Value
     * @param float $a Shape parameter
     * @return float Lower gamma value
     */
    public function lowerGamma(float $x, float $a): float
    {
        $sum = 1.0 / $a;
        $term = $sum;
        for ($n = 1; $n < 100; $n++) {
            $term *= $x / ($a + $n);
            $sum += $term;
            if (abs($term) < abs($sum) * 1e-15) break;
        }
        return pow($x, $a) * exp(-$x) * $sum;
    }

    /**
     * Integration by parts
     * @param callable $u Function u
     * @param callable $dv Derivative of v
     * @param float $a Lower bound
     * @param float $b Upper bound
     * @return float Integral value
     */
    public function integralByParts(callable $u, callable $dv, float $a, float $b): float
    {
        $v = function($x) use ($dv, $a) { return $this->integral($dv, $a, $x); };
        $du = function($x) use ($u) { return $this->derivative($u, $x); };
        return ($u($b) * $v($b) - $u($a) * $v($a)) - $this->integral(function($x) use ($du, $v) {
            return $du($x) * $v($x);
        }, $a, $b);
    }

    /**
     * Skewness
     * @param array $numbers Array of numbers
     * @return float|null Skewness or null if invalid
     * @throws \InvalidArgumentException If insufficient data
     */
    public function skewness(array $numbers): ?float
    {
        if (count($numbers) < 2) {
            throw new \InvalidArgumentException("At least two values are required");
        }
        $mean = $this->mean($numbers);
        $n = count($numbers);
        $m3 = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 3);
        }, $numbers)) / $n;
        $stdDev = $this->standardDeviation($numbers);
        if ($stdDev == 0) {
            throw new \InvalidArgumentException("Standard deviation is zero");
        }
        return $n * $m3 / pow($stdDev, 3);
    }

    /**
     * Excess kurtosis
     * @param array $numbers Array of numbers
     * @return float|null Kurtosis or null if invalid
     * @throws \InvalidArgumentException If insufficient data
     */
    public function kurtosis(array $numbers): ?float
    {
        if (count($numbers) < 2) {
            throw new \InvalidArgumentException("At least two values are required");
        }
        $mean = $this->mean($numbers);
        $n = count($numbers);
        $m4 = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 4);
        }, $numbers)) / $n;
        $stdDev = $this->standardDeviation($numbers);
        if ($stdDev == 0) {
            throw new \InvalidArgumentException("Standard deviation is zero");
        }
        return $n * $m4 / pow($stdDev, 4) - 3;
    }

    /**
     * Interquartile range
     * @param array $numbers Array of numbers
     * @return float|null IQR or null if invalid
     * @throws \InvalidArgumentException If insufficient data
     */
    public function interquartileRange(array $numbers): ?float
    {
        if (count($numbers) < 4) {
            throw new \InvalidArgumentException("At least four values are required");
        }
        sort($numbers);
        $q1 = $this->median(array_slice($numbers, 0, floor(count($numbers) / 2)));
        $q3 = $this->median(array_slice($numbers, ceil(count($numbers) / 2)));
        return $q3 - $q1;
    }

    /**
     * Euclidean distance between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Distance or null if vectors mismatch
     * @throws \InvalidArgumentException If vector lengths mismatch
     */
    public function euclideanDistance(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += pow($vector1[$i] - $vector2[$i], 2);
        }
        return sqrt($sum);
    }

    /**
     * Manhattan distance between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Distance or null if vectors mismatch
     * @throws \InvalidArgumentException If vector lengths mismatch
     */
    public function manhattanDistance(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += abs($vector1[$i] - $vector2[$i]);
        }
        return $sum;
    }

    /**
     * Chebyshev distance between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Distance or null if vectors mismatch
     * @throws \InvalidArgumentException If vector lengths mismatch
     */
    public function chebyshevDistance(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $maxDiff = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $diff = abs($vector1[$i] - $vector2[$i]);
            $maxDiff = max($maxDiff, $diff);
        }
        return $maxDiff;
    }

    /**
     * Minkowski distance between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @param int $p Order (e.g., 1 for Manhattan, 2 for Euclidean)
     * @return float|null Distance or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function minkowskiDistance(array $vector1, array $vector2, int $p = 2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        if ($p <= 0) {
            throw new \InvalidArgumentException("'p' must be positive");
        }
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += pow(abs($vector1[$i] - $vector2[$i]), $p);
        }
        return pow($sum, 1 / $p);
    }

    /**
     * Cosine distance between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Cosine distance (1 - cosine similarity) or null if invalid
     * @throws \InvalidArgumentException If vectors mismatch
     */
    public function cosineDistance(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $similarity = $this->cosineSimilarity($vector1, $vector2);
        return 1 - $similarity;
    }

    // Similarity Functions
    /**
     * Cosine similarity between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Cosine similarity (0 to 1) or null if invalid
     * @throws \InvalidArgumentException If vectors are invalid
     */
    public function cosineSimilarity(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $dotProduct = 0;
        $norm1 = 0;
        $norm2 = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $dotProduct += $vector1[$i] * $vector2[$i];
            $norm1 += pow($vector1[$i], 2);
            $norm2 += pow($vector2[$i], 2);
        }
        $norm1 = sqrt($norm1);
        $norm2 = sqrt($norm2);
        if ($norm1 == 0 || $norm2 == 0) {
            throw new \InvalidArgumentException("Zero vector cannot be computed");
        }
        return $dotProduct / ($norm1 * $norm2);
    }

    /**
     * Jaccard similarity between two sets
     * @param array $set1 First set
     * @param array $set2 Second set
     * @return float|null Jaccard similarity (0 to 1) or null if invalid
     * @throws \InvalidArgumentException If sets are empty
     */
    public function jaccardSimilarity(array $set1, array $set2): ?float
    {
        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));
        if ($union == 0) {
            throw new \InvalidArgumentException("Sets are empty");
        }
        return $intersection / $union;
    }

    /**
     * Pearson similarity (linear correlation)
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Pearson correlation coefficient (-1 to 1) or null if invalid
     * @throws \InvalidArgumentException If vectors are invalid
     */
    public function pearsonSimilarity(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $n = count($vector1);
        if ($n == 0) {
            throw new \InvalidArgumentException("Vectors are empty");
        }

        $mean1 = array_sum($vector1) / $n;
        $mean2 = array_sum($vector2) / $n;

        $numerator = 0;
        $denom1 = 0;
        $denom2 = 0;
        for ($i = 0; $i < $n; $i++) {
            $diff1 = $vector1[$i] - $mean1;
            $diff2 = $vector2[$i] - $mean2;
            $numerator += $diff1 * $diff2;
            $denom1 += pow($diff1, 2);
            $denom2 += pow($diff2, 2);
        }
        $denominator = sqrt($denom1 * $denom2);
        if ($denominator == 0) {
            throw new \InvalidArgumentException("Variance is zero");
        }
        return $numerator / $denominator;
    }

    /**
     * Dot product similarity
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|null Dot product or null if vectors mismatch
     * @throws \InvalidArgumentException If vector lengths mismatch
     */
    public function dotProductSimilarity(array $vector1, array $vector2): ?float
    {
        if (count($vector1) != count($vector2)) {
            throw new \InvalidArgumentException("Vector lengths must match");
        }
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += $vector1[$i] * $vector2[$i];
        }
        return $sum;
    }

    // Linear Regression
    /**
     * Calculate linear regression coefficients (y = mx + b)
     * @param array $x Independent values
     * @param array $y Dependent values
     * @return array|null Coefficients [slope, intercept] or null if invalid
     * @throws \InvalidArgumentException If data is invalid
     */
    public function linearRegression(array $x, array $y): ?array
    {
        if (count($x) != count($y) || empty($x)) {
            throw new \InvalidArgumentException("Invalid data");
        }
        $n = count($x);
        $sumX = array_sum($x);
        $sumY = array_sum($y);
        $sumXY = 0;
        $sumXX = 0;
        for ($i = 0; $i < $n; $i++) {
            $sumXY += $x[$i] * $y[$i];
            $sumXX += pow($x[$i], 2);
        }
        $m = ($n * $sumXY - $sumX * $sumY) / ($n * $sumXX - pow($sumX, 2));
        $b = ($sumY - $m * $sumX) / $n;
        return ['slope' => $m, 'intercept' => $b];
    }

    // K-Nearest Neighbors (KNN)
    /**
     * Classify using KNN
     * @param array $data Training data ([features, label])
     * @param array $point New point to classify (features)
     * @param int $k Number of neighbors
     * @return mixed|null Predicted label or null if invalid
     * @throws \InvalidArgumentException If data is invalid
     */
    public function knnClassify(array $data, array $point, int $k = 3)
    {
        if (empty($data) || $k < 1 || count($point) != count($data[0][0])) {
            throw new \InvalidArgumentException("Invalid data");
        }
        $distances = [];
        foreach ($data as $index => $row) {
            $features = $row[0];
            $label = $row[1];
            $dist = $this->euclideanDistance($features, $point);
            $distances[] = ['distance' => $dist, 'label' => $label];
        }
        usort($distances, function($a, $b) { return $a['distance'] <=> $b['distance']; });
        $nearest = array_slice($distances, 0, $k);
        $votes = array_count_values(array_column($nearest, 'label'));
        arsort($votes);
        return key($votes);
    }

    // Simple Linear SVM
    /**
     * Classify using linear SVM (assumes linear separability)
     * @param array $data Training data ([features, label])
     * @param array $point New point
     * @return int|null Label (1 or -1) or null if invalid
     * @throws \InvalidArgumentException If data is invalid
     */
    public function svmClassify(array $data, array $point): ?int
    {
        if (empty($data) || count($point) != count($data[0][0])) {
            throw new \InvalidArgumentException("Invalid data");
        }
        $w = array_fill(0, count($point), 0);
        $b = 0;
        $learningRate = 0.01;
        $iterations = 100;
        for ($iter = 0; $iter < $iterations; $iter++) {
            foreach ($data as $row) {
                $x = $row[0];
                $y = $row[1] == 1 ? 1 : -1;
                $prediction = $this->dotProductSimilarity($w, $x) + $b;
                if ($y * $prediction <= 1) {
                    for ($i = 0; $i < count($w); $i++) {
                        $w[$i] += $learningRate * ($y * $x[$i] - 2 * $w[$i] / $iterations);
                    }
                    $b += $learningRate * $y;
                }
            }
        }
        $result = $this->dotProductSimilarity($w, $point) + $b;
        return $result >= 0 ? 1 : -1;
    }

    // DBSCAN
    /**
     * Cluster using DBSCAN
     * @param array $data Data points (array of vectors)
     * @param float $eps Maximum distance
     * @param int $minPts Minimum points for core
     * @return array|null Clusters or null if invalid
     * @throws \InvalidArgumentException If data is invalid
     */
    public function dbscan(array $data, float $eps, int $minPts): ?array
    {
        if (empty($data)) {
            throw new \InvalidArgumentException("Data is empty");
        }
        $clusters = [];
        $visited = array_fill(0, count($data), false);
        $noise = [];
        $clusterLabel = 0;

        for ($i = 0; $i < count($data); $i++) {
            if ($visited[$i]) continue;
            $visited[$i] = true;
            $neighbors = $this->findNeighbors($data, $i, $eps);
            if (count($neighbors) < $minPts) {
                $noise[] = $i;
            } else {
                $clusters[$clusterLabel] = [$i];
                $this->expandCluster($data, $neighbors, $i, $clusterLabel, $eps, $minPts, $visited, $clusters);
                $clusterLabel++;
            }
        }
        return ['clusters' => $clusters, 'noise' => $noise];
    }

    private function findNeighbors(array $data, int $index, float $eps): array
    {
        $neighbors = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($i != $index && $this->euclideanDistance($data[$index], $data[$i]) <= $eps) {
                $neighbors[] = $i;
            }
        }
        return $neighbors;
    }

    private function expandCluster(array $data, array &$neighbors, int $index, int $clusterLabel, float $eps, int $minPts, array &$visited, array &$clusters): void
    {
        foreach ($neighbors as $neighbor) {
            if (!$visited[$neighbor]) {
                $visited[$neighbor] = true;
                $newNeighbors = $this->findNeighbors($data, $neighbor, $eps);
                if (count($newNeighbors) >= $minPts) {
                    $neighbors = array_unique(array_merge($neighbors, $newNeighbors));
                }
                $clusters[$clusterLabel][] = $neighbor;
            }
        }
    }

    // k-Means
    /**
     * Cluster using k-Means
     * @param array $data Data points (array of vectors)
     * @param int $k Number of clusters
     * @param int $maxIterations Maximum iterations
     * @return array|null Clusters or null if invalid
     * @throws \InvalidArgumentException If data or k is invalid
     */
    public function kMeans(array $data, int $k, int $maxIterations = 100): ?array
    {
        if (empty($data) || $k < 1 || $k > count($data)) {
            throw new \InvalidArgumentException("Invalid data or 'k'");
        }
        $centroids = array_slice($data, 0, $k);
        for ($iter = 0; $iter < $maxIterations; $iter++) {
            $clusters = array_fill(0, $k, []);
            foreach ($data as $point) {
                $distances = array_map(function($centroid) use ($point) {
                    return $this->euclideanDistance($point, $centroid);
                }, $centroids);
                $clusterIdx = array_search(min($distances), $distances);
                $clusters[$clusterIdx][] = $point;
            }
            $newCentroids = [];
            foreach ($clusters as $cluster) {
                if (empty($cluster)) continue;
                $newCentroid = array_map(function($i) use ($cluster) {
                    return array_sum(array_column($cluster, $i)) / count($cluster);
                }, range(0, count($cluster[0]) - 1));
                $newCentroids[] = $newCentroid;
            }
            if ($newCentroids == $centroids) break;
            $centroids = $newCentroids;
        }
        return ['centroids' => $centroids, 'clusters' => $clusters];
    }

    // Least Squares
    /**
     * Solve least squares for linear regression
     * @param array $x Independent values
     * @param array $y Dependent values
     * @return array|null Coefficients [slope, intercept] or null if invalid
     */
    public function leastSquares(array $x, array $y): ?array
    {
        return $this->linearRegression($x, $y);
    }

    // Support Vector Regression (SVR)
    /**
     * Predict using simple linear SVR
     * @param array $data Training data ([features, value])
     * @param array $point New point
     * @param float $epsilon Error margin
     * @return float|null Predicted value or null if invalid
     * @throws \InvalidArgumentException If data is invalid
     */
    public function svrPredict(array $data, array $point, float $epsilon = 0.1): ?float
    {
        if (empty($data) || count($point) != count($data[0][0])) {
            throw new \InvalidArgumentException("Invalid data");
        }
        $w = array_fill(0, count($point), 0);
        $b = 0;
        $learningRate = 0.01;
        $iterations = 100;
        for ($iter = 0; $iter < $iterations; $iter++) {
            foreach ($data as $row) {
                $x = $row[0];
                $y = $row[1];
                $prediction = $this->dotProductSimilarity($w, $x) + $b;
                $error = $prediction - $y;
                if (abs($error) > $epsilon) {
                    $sign = $error > 0 ? 1 : -1;
                    for ($i = 0; $i < count($w); $i++) {
                        $w[$i] -= $learningRate * $sign * $x[$i];
                    }
                    $b -= $learningRate * $sign;
                }
            }
        }
        return $this->dotProductSimilarity($w, $point) + $b;
    }

    // Naive Bayes (Gaussian)
    /**
     * Classify using Gaussian Naive Bayes
     * @param array $data Training data ([features, label])
     * @param array $point New point
     * @return string|int|null Predicted label or null if invalid
     * @throws \InvalidArgumentException If data is invalid
     */
    public function naiveBayesClassify(array $data, array $point)
    {
        if (empty($data) || count($point) != count($data[0][0])) {
            throw new \InvalidArgumentException("Invalid data");
        }
        $classes = array_unique(array_column($data, 1));
        $stats = [];
        foreach ($classes as $class) {
            $classData = array_filter($data, function($row) use ($class) { return $row[1] == $class; });
            $stats[$class] = [
                'prior' => count($classData) / count($data),
                'means' => array_map(function($i) use ($classData) {
                    return array_sum(array_column(array_column($classData, 0), $i)) / count($classData);
                }, range(0, count($point) - 1)),
                'vars' => array_map(function($i) use ($classData) {
                    $mean = array_sum(array_column(array_column($classData, 0), $i)) / count($classData);
                    return array_sum(array_map(function($row) use ($mean, $i) {
                        return pow($row[0][$i] - $mean, 2);
                    }, $classData)) / (count($classData) - 1);
                }, range(0, count($point) - 1))
            ];
        }
        $probs = [];
        foreach ($classes as $class) {
            $prob = log($stats[$class]['prior']);
            for ($i = 0; $i < count($point); $i++) {
                $mean = $stats[$class]['means'][$i];
                $var = $stats[$class]['vars'][$i];
                if ($var == 0) $var = 1e-6; // Prevent division by zero
                $prob += -0.5 * log(2 * M_PI * $var) - pow($point[$i] - $mean, 2) / (2 * $var);
            }
            $probs[$class] = $prob;
        }
        arsort($probs);
        return key($probs);
    }

    // Additional Matrix Operations
    /**
     * Outer product of two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return array Result matrix
     */
    public function outerProduct(array $vector1, array $vector2): array
    {
        $result = [];
        for ($i = 0; $i < count($vector1); $i++) {
            for ($j = 0; $j < count($vector2); $j++) {
                $result[$i][$j] = $vector1[$i] * $vector2[$j];
            }
        }
        return $result;
    }

    /**
     * Create identity matrix
     * @param int $size Matrix size
     * @return array|null Identity matrix or null if invalid
     * @throws \InvalidArgumentException If size is invalid
     */
    public function identityMatrix(int $size): ?array
    {
        if ($size < 1) {
            throw new \InvalidArgumentException("Size must be positive");
        }
        $result = [];
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $result[$i][$j] = ($i == $j) ? 1 : 0;
            }
        }
        return $result;
    }

    /**
     * Create diagonal matrix
     * @param array $diagonalValues Diagonal values
     * @return array Diagonal matrix
     */
    public function diagonalMatrix(array $diagonalValues): array
    {
        $size = count($diagonalValues);
        $result = [];
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size; $j++) {
                $result[$i][$j] = ($i == $j) ? $diagonalValues[$i] : 0;
            }
        }
        return $result;
    }

    /**
     * Convert to upper triangular matrix
     * @param array $matrix Input matrix
     * @return array|null Upper triangular matrix or null if invalid
     * @throws \InvalidArgumentException If matrix is not square
     */
    public function upperTriangularMatrix(array $matrix): ?array
    {
        if (!$this->isSquareMatrix($matrix)) {
            throw new \InvalidArgumentException("Matrix must be square");
        }
        $result = $matrix;
        for ($i = 0; $i < count($matrix); $i++) {
            for ($j = 0; $j < $i; $j++) {
                $result[$i][$j] = 0;
            }
        }
        return $result;
    }

    /**
     * Convert to lower triangular matrix
     * @param array $matrix Input matrix
     * @return array|null Lower triangular matrix or null if invalid
     * @throws \InvalidArgumentException If matrix is not square
     */
    public function lowerTriangularMatrix(array $matrix): ?array
    {
        if (!$this->isSquareMatrix($matrix)) {
            throw new \InvalidArgumentException("Matrix must be square");
        }
        $result = $matrix;
        for ($i = 0; $i < count($matrix); $i++) {
            for ($j = $i + 1; $j < count($matrix); $j++) {
                $result[$i][$j] = 0;
            }
        }
        return $result;
    }

    /**
     * Create ones matrix
     * @param int $rows Number of rows
     * @param int $cols Number of columns
     * @return array|null Ones matrix or null if invalid
     * @throws \InvalidArgumentException If dimensions are invalid
     */
    public function onesMatrix(int $rows, int $cols): ?array
    {
        if ($rows < 1 || $cols < 1) {
            throw new \InvalidArgumentException("Dimensions must be positive");
        }
        $result = [];
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $result[$i][$j] = 1;
            }
        }
        return $result;
    }

    /**
     * Calculate Hermitian matrix (simplified for real numbers)
     * @param array $matrix Input matrix
     * @return array|null Hermitian matrix or null if invalid
     * @throws \InvalidArgumentException If matrix is not square
     */
    public function hermitianMatrix(array $matrix): ?array
    {
        if (!$this->isSquareMatrix($matrix)) {
            throw new \InvalidArgumentException("Matrix must be square");
        }
        return $this->transpose($matrix); // For real numbers, Hermitian is transpose
    }

    /**
     * Check if two matrices are equivalent
     * @param array $matrix1 First matrix
     * @param array $matrix2 Second matrix
     * @return bool True if equivalent, false otherwise
     */
    public function areEquivalentMatrices(array $matrix1, array $matrix2): bool
    {
        if (count($matrix1) != count($matrix2) || count($matrix1[0]) != count($matrix2[0])) return false;
        for ($i = 0; $i < count($matrix1); $i++) {
            for ($j = 0; $j < count($matrix1[0]); $j++) {
                if ($matrix1[$i][$j] != $matrix2[$i][$j]) return false;
            }
        }
        return true;
    }

    /**
     * Adjoint matrix
     * @param array $matrix Input matrix
     * @return array Adjoint matrix
     */
    public function adjointMatrix(array $matrix): array
    {
        return $this->adjoint($matrix);
    }

    /**
     * Create row matrix
     * @param array $vector Input vector
     * @return array Row matrix
     */
    public function rowMatrix(array $vector): array
    {
        return [$vector];
    }

    /**
     * Create column matrix
     * @param array $vector Input vector
     * @return array Column matrix
     */
    public function columnMatrix(array $vector): array
    {
        $result = [];
        foreach ($vector as $value) {
            $result[] = [$value];
        }
        return $result;
    }

    /**
     * Check if matrix is square
     * @param array $matrix Input matrix
     * @return bool True if square, false otherwise
     */
    public function isSquareMatrix(array $matrix): bool
    {
        if (empty($matrix) || !is_array($matrix)) return false;
        $rows = count($matrix);
        return $rows == count($matrix[0]);
    }

    /**
     * Create zero matrix
     * @param int $rows Number of rows
     * @param int $cols Number of columns
     * @return array|null Zero matrix or null if invalid
     * @throws \InvalidArgumentException If dimensions are invalid
     */
    public function zeroMatrix(int $rows, int $cols): ?array
    {
        if ($rows < 1 || $cols < 1) {
            throw new \InvalidArgumentException("Dimensions must be positive");
        }
        $result = [];
        for ($i = 0; $i < $rows; $i++) {
            for ($j = 0; $j < $cols; $j++) {
                $result[$i][$j] = 0;
            }
        }
        return $result;
    }

    /**
     * Check if matrix is symmetric
     * @param array $matrix Input matrix
     * @return bool True if symmetric, false otherwise
     */
    public function isSymmetricMatrix(array $matrix): bool
    {
        if (!$this->isSquareMatrix($matrix)) return false;
        $transpose = $this->transpose($matrix);
        return $this->areEquivalentMatrices($matrix, $transpose);
    }

    // Graph Theory
    /**
     * Find shortest path using Dijkstra's algorithm
     * @param array $graph Adjacency list with weights
     * @param int $start Starting node
     * @param int $end Ending node
     * @return array|null Path and distance or null if no path
     * @throws \InvalidArgumentException If nodes are invalid
     */
    public function shortestPathDijkstra(array $graph, int $start, int $end): ?array
    {
        if (!isset($graph[$start]) || !isset($graph[$end])) {
            throw new \InvalidArgumentException("Invalid start or end node");
        }
        $distances = [];
        $previous = [];
        $queue = new \SplPriorityQueue();
        foreach (array_keys($graph) as $vertex) {
            $distances[$vertex] = INF;
            $previous[$vertex] = null;
        }
        $distances[$start] = 0;
        $queue->insert($start, 0);

        while (!$queue->isEmpty()) {
            $current = $queue->extract();
            if ($current === $end) break;
            foreach ($graph[$current] as $neighbor => $weight) {
                $alt = $distances[$current] + $weight;
                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $previous[$neighbor] = $current;
                    $queue->insert($neighbor, -$alt);
                }
            }
        }
        if ($distances[$end] === INF) return null;
        $path = [];
        $u = $end;
        while ($u !== null) {
            array_unshift($path, $u);
            $u = $previous[$u];
        }
        return ['path' => $path, 'distance' => $distances[$end]];
    }

    /**
     * Find minimum spanning tree using Kruskal's algorithm
     * @param array $graph Edge list with weights
     * @return array|null MST edges or null if invalid
     * @throws \InvalidArgumentException If graph is invalid
     */
    public function minimumSpanningTreeKruskal(array $graph): ?array
    {
        if (empty($graph)) {
            throw new \InvalidArgumentException("Graph is empty");
        }
        $parent = [];
        $rank = [];
        $mst = [];
        $edges = [];

        foreach ($graph as $u => $neighbors) {
            foreach ($neighbors as $v => $weight) {
                $edges[] = ['u' => $u, 'v' => $v, 'weight' => $weight];
            }
        }
        usort($edges, function($a, $b) { return $a['weight'] <=> $b['weight']; });

        foreach (array_keys($graph) as $vertex) {
            $parent[$vertex] = $vertex;
            $rank[$vertex] = 0;
        }

        foreach ($edges as $edge) {
            $uRoot = $this->findRoot($parent, $edge['u']);
            $vRoot = $this->findRoot($parent, $edge['v']);
            if ($uRoot != $vRoot) {
                $mst[] = $edge;
                $this->union($parent, $rank, $uRoot, $vRoot);
            }
        }
        return $mst;
    }

    private function findRoot(array &$parent, $i)
    {
        if ($parent[$i] != $i) {
            $parent[$i] = $this->findRoot($parent, $parent[$i]);
        }
        return $parent[$i];
    }

    private function union(array &$parent, array &$rank, $x, $y): void
    {
        $xRoot = $this->findRoot($parent, $x);
        $yRoot = $this->findRoot($parent, $y);
        if ($rank[$xRoot] < $rank[$yRoot]) {
            $parent[$xRoot] = $yRoot;
        } elseif ($rank[$xRoot] > $rank[$yRoot]) {
            $parent[$yRoot] = $xRoot;
        } else {
            $parent[$yRoot] = $xRoot;
            $rank[$xRoot]++;
        }
    }

    /**
     * Find Hamiltonian path
     * @param array $graph Adjacency list
     * @return array|null Hamiltonian path or null if none
     */
    public function hamiltonianPath(array $graph): ?array
    {
        if (empty($graph)) return null;
        $vertices = array_keys($graph);
        $path = [$vertices[0]];
        $visited = [$vertices[0] => true];
        if ($this->hamiltonianPathUtil($graph, $path, $visited, count($vertices))) {
            return $path;
        }
        return null;
    }

    private function hamiltonianPathUtil(array $graph, array &$path, array &$visited, int $n): bool
    {
        if (count($path) == $n) return true;
        $current = end($path);
        foreach ($graph[$current] as $next => $weight) {
            if (!isset($visited[$next])) {
                $path[] = $next;
                $visited[$next] = true;
                if ($this->hamiltonianPathUtil($graph, $path, $visited, $n)) {
                    return true;
                }
                array_pop($path);
                unset($visited[$next]);
            }
        }
        return false;
    }

    /**
     * Find Eulerian circuit
     * @param array $graph Adjacency list
     * @return array|null Eulerian circuit or null if none
     */
    public function eulerianCircuit(array $graph): ?array
    {
        if (empty($graph)) return null;
        $degrees = [];
        foreach ($graph as $vertex => $neighbors) {
            $degrees[$vertex] = count($neighbors);
            foreach ($neighbors as $n => $w) {
                $degrees[$n] = isset($degrees[$n]) ? $degrees[$n] + 1 : 1;
            }
        }
        foreach ($degrees as $degree) {
            if ($degree % 2 != 0) return null; // All vertices must have even degree
        }
        $circuit = [];
        $tempGraph = $graph;
        $this->eulerianCircuitUtil($tempGraph, array_keys($graph)[0], $circuit);
        return array_reverse($circuit);
    }

    private function eulerianCircuitUtil(array &$graph, $u, array &$circuit): void
    {
        while (!empty($graph[$u])) {
            $v = key($graph[$u]);
            unset($graph[$u][$v]);
            unset($graph[$v][$u]);
            $this->eulerianCircuitUtil($graph, $v, $circuit);
        }
        $circuit[] = $u;
    }

    // NEW FUNCTIONS FOR REQUESTED TOPICS

    // Differential Equations
    /**
     * Solve first-order ODE using Euler method: dy/dx = f(x, y)
     * @param callable $f Differential equation function
     * @param float $x0 Initial x
     * @param float $y0 Initial y
     * @param float $xEnd End x
     * @param float $h Step size
     * @return array Points [x, y]
     */
    public function solveFirstOrderODE(callable $f, float $x0, float $y0, float $xEnd, float $h = 0.1): array
    {
        $points = [[$x0, $y0]];
        $x = $x0;
        $y = $y0;
        while ($x < $xEnd) {
            $y += $h * $f($x, $y);
            $x += $h;
            $points[] = [$x, $y];
        }
        return $points;
    }

    /**
     * Solve second-order ODE using Runge-Kutta 4 (RK4)
     * @param callable $f Second derivative function d^2y/dx^2 = f(x, y, dy/dx)
     * @param float $x0 Initial x
     * @param float $y0 Initial y
     * @param float $dy0 Initial dy/dx
     * @param float $xEnd End x
     * @param float $h Step size
     * @return array Points [x, y, dy/dx]
     */
    public function solveSecondOrderODE(callable $f, float $x0, float $y0, float $dy0, float $xEnd, float $h = 0.1): array
    {
        $points = [[$x0, $y0, $dy0]];
        $x = $x0;
        $y = $y0;
        $v = $dy0; // dy/dx
        while ($x < $xEnd) {
            $k1v = $h * $f($x, $y, $v);
            $k1y = $h * $v;
            $k2v = $h * $f($x + $h/2, $y + $k1y/2, $v + $k1v/2);
            $k2y = $h * ($v + $k1v/2);
            $k3v = $h * $f($x + $h/2, $y + $k2y/2, $v + $k2v/2);
            $k3y = $h * ($v + $k2v/2);
            $k4v = $h * $f($x + $h, $y + $k3y, $v + $k3v);
            $k4y = $h * ($v + $k3v);
            $y += ($k1y + 2*$k2y + 2*$k3y + $k4y) / 6;
            $v += ($k1v + 2*$k2v + 2*$k3v + $k4v) / 6;
            $x += $h;
            $points[] = [$x, $y, $v];
        }
        return $points;
    }

    // Linear Algebra (Additional)
    /**
     * Calculate eigenvalues of a 2x2 matrix (simplified)
     * @param array $matrix 2x2 matrix
     * @return array|null Eigenvalues or null if invalid
     * @throws \InvalidArgumentException If matrix is invalid
     */
    public function eigenvalues(array $matrix): ?array
    {
        if (count($matrix) != 2 || count($matrix[0]) != 2) {
            throw new \InvalidArgumentException("Matrix must be 2x2");
        }
        $a = $matrix[0][0];
        $b = $matrix[0][1];
        $c = $matrix[1][0];
        $d = $matrix[1][1];
        $trace = $a + $d;
        $det = $a * $d - $b * $c;
        $discriminant = $trace * $trace - 4 * $det;
        if ($discriminant < 0) return null; // Complex eigenvalues not handled
        $lambda1 = ($trace + sqrt($discriminant)) / 2;
        $lambda2 = ($trace - sqrt($discriminant)) / 2;
        return [$lambda1, $lambda2];
    }

    /**
     * Calculate eigenvectors of a 2x2 matrix
     * @param array $matrix 2x2 matrix
     * @return array|null Eigenvectors or null if invalid
     * @throws \InvalidArgumentException If matrix is invalid
     */
    public function eigenvectors(array $matrix): ?array
    {
        $eigenvalues = $this->eigenvalues($matrix);
        if ($eigenvalues === null) return null;
        $a = $matrix[0][0];
        $b = $matrix[0][1];
        $c = $matrix[1][0];
        $d = $matrix[1][1];
        $vectors = [];
        foreach ($eigenvalues as $lambda) {
            $m = [$a - $lambda, $b, $c, $d - $lambda];
            if ($b != 0) {
                $v = [-$m[1], $m[0]];
            } else {
                $v = [$m[2], -$m[3]];
            }
            $norm = sqrt($v[0] * $v[0] + $v[1] * $v[1]);
            $vectors[] = [$v[0] / $norm, $v[1] / $norm];
        }
        return $vectors;
    }

    // Probability and Statistics (Additional)
    /**
     * Calculate binomial probability P(X = k)
     * @param int $n Number of trials
     * @param int $k Number of successes
     * @param float $p Probability of success
     * @return float|null Probability or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function binomialProbability(int $n, int $k, float $p): ?float
    {
        if ($n < 0 || $k < 0 || $k > $n || $p < 0 || $p > 1) {
            throw new \InvalidArgumentException("Invalid inputs");
        }
        return $this->combination($n, $k) * pow($p, $k) * pow(1 - $p, $n - $k);
    }

    /**
     * Calculate expected value of a discrete distribution
     * @param array $values Values
     * @param array $probabilities Probabilities
     * @return float|null Expected value or null if invalid
     * @throws \InvalidArgumentException If inputs are invalid
     */
    public function expectedValue(array $values, array $probabilities): ?float
    {
        if (count($values) != count($probabilities) || array_sum($probabilities) != 1) {
            throw new \InvalidArgumentException("Invalid distribution");
        }
        $sum = 0;
        for ($i = 0; $i < count($values); $i++) {
            $sum += $values[$i] * $probabilities[$i];
        }
        return $sum;
    }

    // Numerical Methods
    /**
     * Newton's method for root finding
     * @param callable $f Function
     * @param callable $df Derivative of function
     * @param float $x0 Initial guess
     * @param float $tolerance Tolerance
     * @param int $maxIterations Max iterations
     * @return float|null Root or null if not found
     */
    public function newtonMethod(callable $f, callable $df, float $x0, float $tolerance = 1e-6, int $maxIterations = 100): ?float
    {
        $x = $x0;
        for ($i = 0; $i < $maxIterations; $i++) {
            $fx = $f($x);
            $dfx = $df($x);
            if (abs($dfx) < 1e-10) return null; // Avoid division by near-zero
            $xNew = $x - $fx / $dfx;
            if (abs($xNew - $x) < $tolerance) return $xNew;
            $x = $xNew;
        }
        return null;
    }

    /**
     * Bisection method for root finding
     * @param callable $f Function
     * @param float $a Lower bound
     * @param float $b Upper bound
     * @param float $tolerance Tolerance
     * @param int $maxIterations Max iterations
     * @return float|null Root or null if not found
     * @throws \InvalidArgumentException If bounds are invalid
     */
    public function bisectionMethod(callable $f, float $a, float $b, float $tolerance = 1e-6, int $maxIterations = 100): ?float
    {
        if ($f($a) * $f($b) >= 0) {
            throw new \InvalidArgumentException("Function must have opposite signs at bounds");
        }
        $c = $a;
        for ($i = 0; $i < $maxIterations; $i++) {
            $c = ($a + $b) / 2;
            $fc = $f($c);
            if (abs($fc) < $tolerance || ($b - $a) / 2 < $tolerance) return $c;
            if ($fc * $f($a) > 0) {
                $a = $c;
            } else {
                $b = $c;
            }
        }
        return $c;
    }

    // Complex Analysis
    /**
     * Add two complex numbers
     * @param array $z1 First complex number [real, imag]
     * @param array $z2 Second complex number [real, imag]
     * @return array Sum [real, imag]
     */
    public function complexAdd(array $z1, array $z2): array
    {
        return [$z1[0] + $z2[0], $z1[1] + $z2[1]];
    }

    /**
     * Multiply two complex numbers
     * @param array $z1 First complex number [real, imag]
     * @param array $z2 Second complex number [real, imag]
     * @return array Product [real, imag]
     */
    public function complexMultiply(array $z1, array $z2): array
    {
        $real = $z1[0] * $z2[0] - $z1[1] * $z2[1];
        $imag = $z1[0] * $z2[1] + $z1[1] * $z2[0];
        return [$real, $imag];
    }

    // Optimization
    /**
     * Gradient descent for minimization
     * @param callable $f Function to minimize
     * @param callable $grad Gradient of function
     * @param array $x0 Initial guess
     * @param float $learningRate Learning rate
     * @param float $tolerance Tolerance
     * @param int $maxIterations Max iterations
     * @return array|null Minimum point or null if not converged
     */
    public function gradientDescent(callable $f, callable $grad, array $x0, float $learningRate = 0.01, float $tolerance = 1e-6, int $maxIterations = 1000): ?array
    {
        $x = $x0;
        for ($i = 0; $i < $maxIterations; $i++) {
            $gradient = $grad($x);
            $xNew = [];
            for ($j = 0; $j < count($x); $j++) {
                $xNew[$j] = $x[$j] - $learningRate * $gradient[$j];
            }
            if ($this->euclideanDistance($x, $xNew) < $tolerance) return $xNew;
            $x = $xNew;
        }
        return null;
    }

    /**
     * Linear programming (simplified Simplex method placeholder)
     * @param array $c Objective coefficients
     * @param array $A Constraint matrix
     * @param array $b Constraint bounds
     * @return array|null Optimal solution or null
     */
    public function linearProgramming(array $c, array $A, array $b): ?array
    {
        // Placeholder: Simplified for demonstration (actual Simplex is complex)
        return null;
    }

    // Discrete Mathematics
    /**
     * Generate power set
     * @param array $set Input set
     * @return array Power set
     */
    public function powerSet(array $set): array
    {
        $powerSet = [[]];
        foreach ($set as $element) {
            foreach ($powerSet as $subset) {
                $powerSet[] = array_merge($subset, [$element]);
            }
        }
        return $powerSet;
    }

    /**
     * Check if relation is reflexive
     * @param array $set Set of elements
     * @param array $relation Relation as pairs [[a, b], ...]
     * @return bool True if reflexive
     */
    public function isReflexive(array $set, array $relation): bool
    {
        foreach ($set as $element) {
            if (!in_array([$element, $element], $relation)) return false;
        }
        return true;
    }

    // Mathematical Modeling
    /**
     * Exponential growth model
     * @param float $initialValue Initial value
     * @param float $growthRate Growth rate
     * @param float $time Time
     * @return float Value at time t
     */
    public function exponentialGrowth(float $initialValue, float $growthRate, float $time): float
    {
        return $initialValue * exp($growthRate * $time);
    }

    /**
     * Logistic growth model
     * @param float $initialValue Initial value
     * @param float $carryingCapacity Carrying capacity
     * @param float $growthRate Growth rate
     * @param float $time Time
     * @return float Value at time t
     */
    public function logisticGrowth(float $initialValue, float $carryingCapacity, float $growthRate, float $time): float
    {
        return $carryingCapacity / (1 + (($carryingCapacity - $initialValue) / $initialValue) * exp(-$growthRate * $time));
    }

    // Vector Calculus
    /**
     * Gradient of a scalar function (numerical)
     * @param callable $f Scalar function
     * @param array $point Point [x, y, ...]
     * @param float $h Step size
     * @return array Gradient vector
     */
    public function gradient(callable $f, array $point, float $h = 1e-5): array
    {
        $grad = [];
        for ($i = 0; $i < count($point); $i++) {
            $pointPlus = $point;
            $pointMinus = $point;
            $pointPlus[$i] += $h;
            $pointMinus[$i] -= $h;
            $grad[$i] = ($f($pointPlus) - $f($pointMinus)) / (2 * $h);
        }
        return $grad;
    }

    /**
     * Divergence of a vector field (numerical)
     * @param array $f Vector field functions [f1, f2, ...]
     * @param array $point Point [x, y, ...]
     * @param float $h Step size
     * @return float Divergence
     */
    public function divergence(array $f, array $point, float $h = 1e-5): float
    {
        $div = 0;
        for ($i = 0; $i < count($point); $i++) {
            $pointPlus = $point;
            $pointMinus = $point;
            $pointPlus[$i] += $h;
            $pointMinus[$i] -= $h;
            $div += ($f[$i]($pointPlus) - $f[$i]($pointMinus)) / (2 * $h);
        }
        return $div;
    }

    // Fourier and Laplace Transforms
    /**
     * Discrete Fourier Transform (simplified)
     * @param array $signal Input signal
     * @return array Complex coefficients
     */
    public function fourierTransform(array $signal): array
    {
        $N = count($signal);
        $X = [];
        for ($k = 0; $k < $N; $k++) {
            $sum = [0, 0]; // [real, imag]
            for ($n = 0; $n < $N; $n++) {
                $angle = -2 * M_PI * $k * $n / $N;
                $real = cos($angle);
                $imag = sin($angle);
                $sum[0] += $signal[$n] * $real;
                $sum[1] += $signal[$n] * $imag;
            }
            $X[$k] = $sum;
        }
        return $X;
    }

    /**
     * Laplace Transform (symbolic placeholder)
     * @param callable $f Function of t
     * @param float $s Complex frequency
     * @return float|null Transform value or null
     */
    public function laplaceTransform(callable $f, float $s): ?float
    {
        // Numerical approximation using integral
        return $this->integral(function($t) use ($f, $s) {
            return $f($t) * exp(-$s * $t);
        }, 0, INF, 1000);
    }

    // Control Theory
    /**
     * Calculate step response of a first-order system
     * @param float $k Gain
     * @param float $tau Time constant
     * @param float $t Time
     * @return float Response
     */
    public function stepResponse(float $k, float $tau, float $t): float
    {
        if ($tau <= 0) return 0;
        return $k * (1 - exp(-$t / $tau));
    }

    /**
     * Calculate frequency response (magnitude)
     * @param float $k Gain
     * @param float $tau Time constant
     * @param float $omega Frequency
     * @return float Magnitude
     */
    public function frequencyResponse(float $k, float $tau, float $omega): float
    {
        return $k / sqrt(1 + pow($omega * $tau, 2));
    }

    // Finite Element Methods
    /**
     * Solve 1D FEM for u'' = f(x) (simplified)
     * @param callable $f Source function
     * @param array $nodes Node positions
     * @param array $boundaryConditions [u(0), u(L)]
     * @return array Solution at nodes
     */
    public function solveFEM(callable $f, array $nodes, array $boundaryConditions): array
    {
        $n = count($nodes) - 1;
        $A = $this->zeroMatrix($n + 1, $n + 1);
        $b = array_fill(0, $n + 1, 0);
        $h = $nodes[1] - $nodes[0]; // Assume uniform spacing

        for ($i = 1; $i < $n; $i++) {
            $A[$i][$i-1] = -1 / $h;
            $A[$i][$i] = 2 / $h;
            $A[$i][$i+1] = -1 / $h;
            $b[$i] = $f($nodes[$i]);
        }
        $A[0][0] = 1;
        $A[$n][$n] = 1;
        $b[0] = $boundaryConditions[0];
        $b[$n] = $boundaryConditions[1];

        return $this->solveLinearSystem($A, $b); // Placeholder for actual solver
    }

    /**
     * Solve linear system Ax = b (simplified Gaussian elimination)
     * @param array $A Matrix
     * @param array $b Vector
     * @return array|null Solution or null
     */
    public function solveLinearSystem(array $A, array $b): ?array
    {
        $n = count($A);
        $augmented = [];
        for ($i = 0; $i < $n; $i++) {
            $augmented[$i] = array_merge($A[$i], [$b[$i]]);
        }
        for ($i = 0; $i < $n; $i++) {
            $pivot = $augmented[$i][$i];
            if (abs($pivot) < 1e-10) return null;
            for ($j = $i; $j <= $n; $j++) {
                $augmented[$i][$j] /= $pivot;
            }
            for ($k = 0; $k < $n; $k++) {
                if ($k != $i) {
                    $factor = $augmented[$k][$i];
                    for ($j = $i; $j <= $n; $j++) {
                        $augmented[$k][$j] -= $factor * $augmented[$i][$j];
                    }
                }
            }
        }
        $x = [];
        for ($i = 0; $i < $n; $i++) {
            $x[$i] = $augmented[$i][$n];
        }
        return $x;
    }

    // Test Method
    /**
     * Run all tests
     */
    public function runTests(): void
    {
        echo "Running Tests...\n";

        // Group 1: Basic Operations
        echo "\nGroup 1: Basic Operations\n";
        echo "add(5, 3) = " . $this->add(5, 3) . " (Expected: 8)\n";
        echo "subtract(10, 4) = " . $this->subtract(10, 4) . " (Expected: 6)\n";
        echo "multiply(6, 7) = " . $this->multiply(6, 7) . " (Expected: 42)\n";
        try {
            echo "divide(15, 3) = " . $this->divide(15, 3) . " (Expected: 5)\n";
            echo "divide(10, 0) = ";
            $this->divide(10, 0);
        } catch (\InvalidArgumentException $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }

        // Group 2: Algebra
        echo "\nGroup 2: Algebra\n";
        $roots = $this->quadraticFormula(1, -3, 2);
        echo "quadraticFormula(1, -3, 2) = [" . implode(", ", $roots) . "] (Expected: [2, 1])\n";
        echo "absoluteValue(-5) = " . $this->absoluteValue(-5) . " (Expected: 5)\n";
        echo "power(2, 3) = " . $this->power(2, 3) . " (Expected: 8)\n";
        try {
            echo "squareRoot(16) = " . $this->squareRoot(16) . " (Expected: 4)\n";
            echo "squareRoot(-4) = ";
            $this->squareRoot(-4);
        } catch (\InvalidArgumentException $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }
        $cubicRoots = $this->cubicFormula(1, -6, 11, -6);
        echo "cubicFormula(1, -6, 11, -6) = [" . implode(", ", $cubicRoots) . "] (Expected: [1, 2, 3])\n";
        $polyRoots = $this->polynomialRoots([1, -3, 2]);
        echo "polynomialRoots([1, -3, 2]) = [" . implode(", ", $polyRoots) . "] (Expected: [2, 1])\n";
        echo "lcm(12, 18) = " . $this->lcm(12, 18) . " (Expected: 36)\n";
        echo "gcd(48, 18) = " . $this->gcd(48, 18) . " (Expected: 6)\n";

        // Group 3: Calculus
        echo "\nGroup 3: Calculus\n";
        $f = function($x) { return $x * $x; };
        echo "derivative(x^2 at x=2) = " . $this->derivative($f, 2) . " (Expected: ~4)\n";
        echo "integral(x^2 from 0 to 1) = " . $this->integral($f, 0, 1) . " (Expected: ~0.333)\n";
        echo "limit(x^2 at x=2) = " . $this->limit($f, 2) . " (Expected: ~4)\n";
        echo "secondDerivative(x^2 at x=2) = " . $this->secondDerivative($f, 2) . " (Expected: ~2)\n";
        echo "meanValueTheorem(x^2 from 0 to 2) = " . $this->meanValueTheorem($f, 0, 2) . " (Expected: 2)\n";

        // Group 4: Trigonometric Functions
        echo "\nGroup 4: Trigonometric Functions\n";
        echo "sin(30) = " . $this->sin(30) . " (Expected: 0.5)\n";
        echo "cos(60) = " . $this->cos(60) . " (Expected: 0.5)\n";
        try {
            echo "tan(45) = " . $this->tan(45) . " (Expected: 1)\n";
            echo "tan(90) = ";
            $this->tan(90);
        } catch (\InvalidArgumentException $e) {
            echo "Exception: " . $e->getMessage() . "\n";
        }
        echo "arcsin(0.5) = " . $this->arcsin(0.5) . " (Expected: 30)\n";

        // Group 5: Exponential and Logarithmic Functions
        echo "\nGroup 5: Exponential and Logarithmic Functions\n";
        echo "exponential(1) = " . $this->exponential(1) . " (Expected: ~2.718)\n";
        echo "logarithm(100, 10) = " . $this->logarithm(100, 10) . " (Expected: 2)\n";
        echo "naturalLog(2.718) = " . $this->naturalLog(2.718) . " (Expected: ~1)\n";
        echo "logBase10(1000) = " . $this->logBase10(1000) . " (Expected: 3)\n";

        // Group 6: Series and Sequences
        echo "\nGroup 6: Series and Sequences\n";
        echo "arithmeticSequence(2, 3, 4) = " . $this->arithmeticSequence(2, 3, 4) . " (Expected: 11)\n";
        echo "geometricSequence(2, 2, 3) = " . $this->geometricSequence(2, 2, 3) . " (Expected: 8)\n";
        echo "fibonacci(6) = " . $this->fibonacci(6) . " (Expected: 8)\n";
        echo "taylorSeriesExponential(1, 5) = " . $this->taylorSeriesExponential(1, 5) . " (Expected: ~2.708)\n";
        echo "taylorSeriesSin(deg2rad(30), 5) = " . $this->taylorSeriesSin(deg2rad(30), 5) . " (Expected: ~0.5)\n";

        // Group 7: Matrix Operations
        echo "\nGroup 7: Matrix Operations\n";
        $matrixA = [[1, 2], [3, 4]];
        $matrixB = [[5, 6], [7, 8]];
        $addResult = $this->matrixAddition($matrixA, $matrixB);
        echo "matrixAddition = [" . implode(", ", array_map('json_encode', $addResult)) . "] (Expected: [[6,8],[10,12]])\n";
        $multResult = $this->matrixMultiplication($matrixA, $matrixB);
        echo "matrixMultiplication = [" . implode(", ", array_map('json_encode', $multResult)) . "] (Expected: [[19,22],[43,50]])\n";
        $transpose = $this->transpose($matrixA);
        echo "transpose = [" . implode(", ", array_map('json_encode', $transpose)) . "] (Expected: [[1,3],[2,4]])\n";
        echo "determinant([[1,2],[3,4]]) = " . $this->determinant($matrixA) . " (Expected: -2)\n";
        $inverse = $this->inverse($matrixA);
        echo "inverse = [" . implode(", ", array_map('json_encode', $inverse)) . "] (Expected: [[-2,1],[1.5,-0.5]])\n";

        // Group 8: Statistical Functions
        echo "\nGroup 8: Statistical Functions\n";
        echo "combination(5, 2) = " . $this->combination(5, 2) . " (Expected: 10)\n";
        echo "permutation(5, 2) = " . $this->permutation(5, 2) . " (Expected: 20)\n";
        $numbers = [1, 2, 3, 4, 5];
        echo "mean([1,2,3,4,5]) = " . $this->mean($numbers) . " (Expected: 3)\n";
        echo "varianceSample([1,2,3,4,5]) = " . $this->varianceSample($numbers) . " (Expected: 2.5)\n";
        echo "median([1,2,3,4,5]) = " . $this->median($numbers) . " (Expected: 3)\n";
        echo "poissonDistribution(2, 1) = " . $this->poissonDistribution(2, 1) . " (Expected: ~0.183)\n";
        echo "standardNormalDistribution(0) = " . $this->standardNormalDistribution(0) . " (Expected: ~0.399)\n";

        // Group 9: Similarity Functions
        echo "\nGroup 9: Similarity Functions\n";
        $v1 = [1, 2, 3];
        $v2 = [4, 5, 6];
        echo "euclideanDistance([1,2,3], [4,5,6]) = " . $this->euclideanDistance($v1, $v2) . " (Expected: ~5.196)\n";
        echo "cosineSimilarity([1,2,3], [4,5,6]) = " . $this->cosineSimilarity($v1, $v2) . " (Expected: ~0.974)\n";
        echo "jaccardSimilarity([1,2,3], [2,3,4]) = " . $this->jaccardSimilarity([1,2,3], [2,3,4]) . " (Expected: 0.5)\n";

        // Group 10: Machine Learning
        echo "\nGroup 10: Machine Learning\n";
        $data = [[[1, 2], 0], [[2, 3], 1], [[3, 4], 1]];
        $point = [2, 2];
        echo "knnClassify = " . $this->knnClassify($data, $point, 2) . " (Expected: 1)\n";
        $regression = $this->linearRegression([1, 2, 3], [2, 4, 6]);
        echo "linearRegression = [slope: {$regression['slope']}, intercept: {$regression['intercept']}] (Expected: [2, 0])\n";

        // Group 11: Graph Theory
        echo "\nGroup 11: Graph Theory\n";
        $graph = [0 => [1 => 4, 2 => 1], 1 => [0 => 4, 2 => 2], 2 => [0 => 1, 1 => 2]];
        $path = $this->shortestPathDijkstra($graph, 0, 1);
        echo "shortestPathDijkstra = " . json_encode($path) . " (Expected: {'path': [0,2,1], 'distance': 3})\n";
        $mst = $this->minimumSpanningTreeKruskal($graph);
        echo "minimumSpanningTreeKruskal = " . json_encode($mst) . " (Expected: ~2 edges with total weight 3)\n";

        // Group 12: Differential Equations
        echo "\nGroup 12: Differential Equations\n";
        $ode = function($x, $y) { return -$y; }; // dy/dx = -y
        $solution = $this->solveFirstOrderODE($ode, 0, 1, 1);
        echo "solveFirstOrderODE at x=1 = " . end($solution)[1] . " (Expected: ~0.368)\n";
        $ode2 = function($x, $y, $v) { return -$v - $y; }; // y'' = -y' - y
        $solution2 = $this->solveSecondOrderODE($ode2, 0, 1, 0, 1);
        echo "solveSecondOrderODE at x=1 = " . end($solution2)[1] . " (Expected: ~0.5)\n";

        // Group 13: Linear Algebra (Additional)
        echo "\nGroup 13: Linear Algebra (Additional)\n";
        $matrix = [[2, 1], [1, 2]];
        $evals = $this->eigenvalues($matrix);
        echo "eigenvalues = [" . implode(", ", $evals) . "] (Expected: [3, 1])\n";
        $evecs = $this->eigenvectors($matrix);
        echo "eigenvectors = [" . implode(", ", array_map('json_encode', $evecs)) . "] (Expected: ~[[0.707,0.707],[-0.707,0.707]])\n";

        // Group 14: Probability and Statistics (Additional)
        echo "\nGroup 14: Probability and Statistics (Additional)\n";
        echo "binomialProbability(5, 2, 0.5) = " . $this->binomialProbability(5, 2, 0.5) . " (Expected: 0.3125)\n";
        echo "expectedValue([1,2,3], [0.2,0.5,0.3]) = " . $this->expectedValue([1,2,3], [0.2,0.5,0.3]) . " (Expected: 2.1)\n";

        // Group 15: Numerical Methods
        echo "\nGroup 15: Numerical Methods\n";
        $fRoot = function($x) { return $x * $x - 4; };
        $dfRoot = function($x) { return 2 * $x; };
        echo "newtonMethod(x^2-4, x0=1) = " . $this->newtonMethod($fRoot, $dfRoot, 1) . " (Expected: ~2)\n";
        echo "bisectionMethod(x^2-4, 1, 3) = " . $this->bisectionMethod($fRoot, 1, 3) . " (Expected: ~2)\n";

        // Group 16: Complex Analysis
        echo "\nGroup 16: Complex Analysis\n";
        $z1 = [1, 2];
        $z2 = [3, 4];
        $sum = $this->complexAdd($z1, $z2);
        echo "complexAdd([1,2], [3,4]) = [" . implode(", ", $sum) . "] (Expected: [4,6])\n";
        $product = $this->complexMultiply($z1, $z2);
        echo "complexMultiply([1,2], [3,4]) = [" . implode(", ", $product) . "] (Expected: [-5,10])\n";

        // Group 17: Optimization
        echo "\nGroup 17: Optimization\n";
        $fOpt = function($x) { return $x[0] * $x[0] + $x[1] * $x[1]; };
        $gradOpt = function($x) { return [2 * $x[0], 2 * $x[1]]; };
        $min = $this->gradientDescent($fOpt, $gradOpt, [1, 1]);
        echo "gradientDescent(x^2+y^2, [1,1]) = [" . implode(", ", $min) . "] (Expected: ~[0,0])\n";

        // Group 18: Discrete Mathematics
        echo "\nGroup 18: Discrete Mathematics\n";
        $ps = $this->powerSet([1, 2]);
        echo "powerSet([1,2]) = [" . implode(", ", array_map('json_encode', $ps)) . "] (Expected: [[],[1],[2],[1,2]])\n";
        echo "isReflexive([1,2], [[1,1],[2,2]]) = " . ($this->isReflexive([1,2], [[1,1],[2,2]]) ? "true" : "false") . " (Expected: true)\n";

        // Group 19: Mathematical Modeling
        echo "\nGroup 19: Mathematical Modeling\n";
        echo "exponentialGrowth(1, 0.1, 2) = " . $this->exponentialGrowth(1, 0.1, 2) . " (Expected: ~1.221)\n";
        echo "logisticGrowth(1, 10, 0.5, 2) = " . $this->logisticGrowth(1, 10, 0.5, 2) . " (Expected: ~7.31)\n";

        // Group 20: Vector Calculus
        echo "\nGroup 20: Vector Calculus\n";
        $fVec = function($x) { return $x[0] * $x[0] + $x[1] * $x[1]; };
        $grad = $this->gradient($fVec, [1, 1]);
        echo "gradient(x^2+y^2 at [1,1]) = [" . implode(", ", $grad) . "] (Expected: ~[2,2])\n";
        $field = [function($x) { return $x[0]; }, function($x) { return $x[1]; }];
        echo "divergence([x,y] at [1,1]) = " . $this->divergence($field, [1, 1]) . " (Expected: ~2)\n";

        // Group 21: Fourier and Laplace Transforms
        echo "\nGroup 21: Fourier and Laplace Transforms\n";
        $ft = $this->fourierTransform([1, 0, -1, 0]);
        echo "fourierTransform([1,0,-1,0]) = [" . implode(", ", array_map('json_encode', $ft)) . "] (Expected: ~[[0,0],[2,0],[0,0],[2,0]])\n";
        $fLap = function($t) { return 1; };
        echo "laplaceTransform(1, s=1) = " . $this->laplaceTransform($fLap, 1) . " (Expected: ~1)\n";

        // Group 22: Control Theory
        echo "\nGroup 22: Control Theory\n";
        echo "stepResponse(1, 1, 1) = " . $this->stepResponse(1, 1, 1) . " (Expected: ~0.632)\n";
        echo "frequencyResponse(1, 1, 1) = " . $this->frequencyResponse(1, 1, 1) . " (Expected: ~0.707)\n";

        // Group 23: Finite Element Methods
        echo "\nGroup 23: Finite Element Methods\n";
        $fFem = function($x) { return -1; };
        $nodes = [0, 0.5, 1];
        $bc = [0, 0];
        $femSol = $this->solveFEM($fFem, $nodes, $bc);
        echo "solveFEM(u''=-1) = [" . implode(", ", $femSol) . "] (Expected: [0,0.125,0])\n";

        echo "\nTests Completed.\n";
    }
}

// Usage
$calc = new MathCalculations();
$calc->runTests();