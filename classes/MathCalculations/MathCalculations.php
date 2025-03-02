<?php

class MathCalculations {
    // Basic Operations
    /**
     * Add two numbers
     * @param float $a First number
     * @param float $b Second number
     * @return float Sum
     */
    public function add($a, $b) {
        return $a + $b;
    }

    /**
     * Subtract two numbers
     * @param float $a First number
     * @param float $b Second number
     * @return float Difference
     */
    public function subtract($a, $b) {
        return $a - $b;
    }

    /**
     * Multiply two numbers
     * @param float $a First number
     * @param float $b Second number
     * @return float Product
     */
    public function multiply($a, $b) {
        return $a * $b;
    }

    /**
     * Divide two numbers
     * @param float $a Dividend
     * @param float $b Divisor
     * @return float|string Quotient or error message
     */
    public function divide($a, $b) {
        if ($b == 0) {
            return "Error: Division by zero is not possible";
        }
        return $a / $b;
    }

    // Algebra
    /**
     * Solve quadratic equation ax^2 + bx + c = 0
     * @param float $a Coefficient of x^2
     * @param float $b Coefficient of x
     * @param float $c Constant term
     * @return array|string|null Roots or error message
     */
    public function quadraticFormula($a, $b, $c) {
        if ($a == 0) {
            return "Error: Coefficient 'a' cannot be zero";
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
    public function absoluteValue($x) {
        return abs($x);
    }

    /**
     * Power function (x^y)
     * @param float $base Base
     * @param float $exponent Exponent
     * @return float Result
     */
    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

    /**
     * Square root of a number
     * @param float $x Number
     * @return float|string Square root or error message
     */
    public function squareRoot($x) {
        if ($x < 0) {
            return "Error: Square root of a negative number is not possible";
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
    public function cubicFormula($a, $b, $c, $d) {
        if ($a == 0) {
            return $this->quadraticFormula($b, $c, $d) ?? [$this->divide(-$d, $c)];
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
    public function polynomialRoots($coefficients) {
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
     */
    public function lcm($a, $b) {
        return abs($a * $b) / $this->gcd($a, $b);
    }

    /**
     * Greatest Common Divisor (GCD)
     * @param int $a First integer
     * @param int $b Second integer
     * @return int GCD
     */
    public function gcd($a, $b) {
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
    public function derivative($function, $point, $h = 1e-5) {
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
    public function integral($function, $lowerBound, $upperBound, $n = 1000) {
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
    public function limit($function, $point, $h = 1e-5) {
        return $function($point + $h);
    }

    /**
     * Second numerical derivative of a function
     * @param callable $function Function to differentiate
     * @param float $point Point of evaluation
     * @param float $h Step size
     * @return float Second derivative
     */
    public function secondDerivative($function, $point, $h = 1e-5) {
        return ($this->derivative($function, $point + $h) - $this->derivative($function, $point - $h)) / (2 * $h);
    }

    /**
     * Mean Value Theorem
     * @param callable $f Function
     * @param float $a Lower bound
     * @param float $b Upper bound
     * @return float|string Average rate of change or error message
     */
    public function meanValueTheorem($f, $a, $b) {
        if ($a == $b) {
            return "Error: Invalid interval";
        }
        return ($f($b) - $f($a)) / ($b - $a);
    }

    // Trigonometric Functions
    /**
     * Sine function (degrees)
     * @param float $angle Angle in degrees
     * @return float Sine value
     */
    public function sin($angle) {
        return sin(deg2rad($angle));
    }

    /**
     * Cosine function (degrees)
     * @param float $angle Angle in degrees
     * @return float Cosine value
     */
    public function cos($angle) {
        return cos(deg2rad($angle));
    }

    /**
     * Tangent function (degrees)
     * @param float $angle Angle in degrees
     * @return float|string Tangent value or error message
     */
    public function tan($angle) {
        $tan = tan(deg2rad($angle));
        if (is_infinite($tan)) {
            return "Error: Tangent is undefined at this angle";
        }
        return $tan;
    }

    /**
     * Secant function (degrees)
     * @param float $angle Angle in degrees
     * @return float|string Secant value or error message
     */
    public function sec($angle) {
        $cos = $this->cos($angle);
        if ($cos == 0) {
            return "Error: Secant is undefined at this angle";
        }
        return 1 / $cos;
    }

    /**
     * Cosecant function (degrees)
     * @param float $angle Angle in degrees
     * @return float|string Cosecant value or error message
     */
    public function cosec($angle) {
        $sin = $this->sin($angle);
        if ($sin == 0) {
            return "Error: Cosecant is undefined at this angle";
        }
        return 1 / $sin;
    }

    /**
     * Cotangent function (degrees)
     * @param float $angle Angle in degrees
     * @return float|string Cotangent value or error message
     */
    public function cot($angle) {
        $tan = $this->tan($angle);
        if ($tan === "Error: Tangent is undefined at this angle" || $tan == 0) {
            return "Error: Cotangent is undefined at this angle";
        }
        return 1 / $tan;
    }

    /**
     * Arcsine function (to degrees)
     * @param float $value Value
     * @return float|string Angle in degrees or error message
     */
    public function arcsin($value) {
        if ($value < -1 || $value > 1) {
            return "Error: Value must be between -1 and 1";
        }
        return rad2deg(asin($value));
    }

    /**
     * Arccosine function (to degrees)
     * @param float $value Value
     * @return float|string Angle in degrees or error message
     */
    public function arccos($value) {
        if ($value < -1 || $value > 1) {
            return "Error: Value must be between -1 and 1";
        }
        return rad2deg(acos($value));
    }

    /**
     * Arctangent function (to degrees)
     * @param float $value Value
     * @return float Angle in degrees
     */
    public function arctan($value) {
        return rad2deg(atan($value));
    }

    // Exponential and Logarithmic Functions
    /**
     * Exponential function (e^x)
     * @param float $x Exponent
     * @return float Exponential value
     */
    public function exponential($x) {
        return exp($x);
    }

    /**
     * Logarithm with custom base
     * @param float $x Number
     * @param float $base Base (default: e)
     * @return float|string Logarithm value or error message
     */
    public function logarithm($x, $base = M_E) {
        if ($x <= 0) {
            return "Error: Logarithm of zero or negative number is undefined";
        }
        if ($base <= 0 || $base == 1) {
            return "Error: Base must be positive and not equal to 1";
        }
        return log($x, $base);
    }

    /**
     * Natural logarithm (ln)
     * @param float $x Number
     * @return float|string Natural logarithm value or error message
     */
    public function naturalLog($x) {
        if ($x <= 0) {
            return "Error: Natural logarithm of zero or negative number is undefined";
        }
        return log($x);
    }

    /**
     * Base-10 logarithm
     * @param float $x Number
     * @return float|string Base-10 logarithm value or error message
     */
    public function logBase10($x) {
        if ($x <= 0) {
            return "Error: Base-10 logarithm of zero or negative number is undefined";
        }
        return log10($x);
    }

    // Series and Sequences
    /**
     * Arithmetic sequence
     * @param float $firstTerm First term
     * @param float $commonDifference Common difference
     * @param int $n Term number
     * @return float|string Nth term or error message
     */
    public function arithmeticSequence($firstTerm, $commonDifference, $n) {
        if ($n < 1) return "Error: 'n' must be positive";
        return $firstTerm + ($n - 1) * $commonDifference;
    }

    /**
     * Geometric sequence
     * @param float $firstTerm First term
     * @param float $commonRatio Common ratio
     * @param int $n Term number
     * @return float|string Nth term or error message
     */
    public function geometricSequence($firstTerm, $commonRatio, $n) {
        if ($n < 1) return "Error: 'n' must be positive";
        return $firstTerm * pow($commonRatio, $n - 1);
    }

    /**
     * Fibonacci sequence
     * @param int $n Term number
     * @return int|string Nth term or error message
     */
    public function fibonacci($n) {
        if ($n < 0) return "Error: 'n' must be non-negative";
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
     * @return float|string Approximation or error message
     */
    public function taylorSeriesExponential($x, $n) {
        if ($n < 0) return "Error: 'n' must be non-negative";
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
     * @return float|string Approximation or error message
     */
    public function taylorSeriesSin($x, $n) {
        if ($n < 0) return "Error: 'n' must be non-negative";
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
     * @return float|string Approximation or error message
     */
    public function taylorSeriesCos($x, $n) {
        if ($n < 0) return "Error: 'n' must be non-negative";
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += ($this->power(-1, $i) * $this->power($x, 2 * $i)) / $this->factorial(2 * $i);
        }
        return $sum;
    }

    /**
     * Factorial of a number
     * @param int $n Number
     * @return int|string Factorial or error message
     */
    public function factorial($n) {
        if (!is_int($n) || $n < 0) return "Error: 'n' must be a non-negative integer";
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
     * @return array|string Result matrix or error message
     */
    public function matrixAddition($matrixA, $matrixB) {
        if (count($matrixA) != count($matrixB) || count($matrixA[0]) != count($matrixB[0])) {
            return "Error: Matrix dimensions must match";
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
     * @return array|string Result matrix or error message
     */
    public function matrixMultiplication($matrixA, $matrixB) {
        if (count($matrixA[0]) != count($matrixB)) {
            return "Error: Number of columns in first matrix must equal number of rows in second matrix";
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
    public function transpose($matrix) {
        $result = [];
        for ($i = 0; $i < count($matrix[0]); $i++) {
            for ($j = 0; $j < count($matrix); $j++) {
                $result[$i][$j] = $matrix[$j][$i];
            }
        }
        return $result;
    }

    // Statistical Functions
    /**
     * Combination (nCr)
     * @param int $n Total items
     * @param int $r Items to choose
     * @return float|string Combination value or error message
     */
    public function combination($n, $r) {
        if ($r > $n || $n < 0 || $r < 0) {
            return "Error: Invalid inputs";
        }
        return $this->factorial($n) / ($this->factorial($r) * $this->factorial($n - $r));
    }

    /**
     * Permutation (nPr)
     * @param int $n Total items
     * @param int $r Items to arrange
     * @return float|string Permutation value or error message
     */
    public function permutation($n, $r) {
        if ($r > $n || $n < 0 || $r < 0) {
            return "Error: Invalid inputs";
        }
        return $this->factorial($n) / $this->factorial($n - $r);
    }

    /**
     * Mean of numbers
     * @param array $numbers Array of numbers
     * @return float|string Mean or error message
     */
    public function mean($numbers) {
        if (empty($numbers)) return "Error: Array is empty";
        return array_sum($numbers) / count($numbers);
    }

    /**
     * Sample variance
     * @param array $numbers Array of numbers
     * @return float|string Variance or error message
     */
    public function varianceSample($numbers) {
        if (count($numbers) < 2) return "Error: At least two values are required";
        $mean = $this->mean($numbers);
        $squaredDiffs = array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $numbers);
        return array_sum($squaredDiffs) / (count($numbers) - 1);
    }

    /**
     * Sample standard deviation
     * @param array $numbers Array of numbers
     * @return float|string Standard deviation or error message
     */
    public function standardDeviation($numbers) {
        $variance = $this->varianceSample($numbers);
        return is_string($variance) ? $variance : sqrt($variance);
    }

    /**
     * Median of numbers
     * @param array $numbers Array of numbers
     * @return float|string Median or error message
     */
    public function median($numbers) {
        if (empty($numbers)) return "Error: Array is empty";
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
     * @return mixed|string Mode or error message
     */
    public function mode($numbers) {
        if (empty($numbers)) return "Error: Array is empty";
        $values = array_count_values($numbers);
        return array_search(max($values), $values);
    }

    /**
     * Range of numbers
     * @param array $numbers Array of numbers
     * @return float|string Range or error message
     */
    public function range($numbers) {
        if (empty($numbers)) return "Error: Array is empty";
        return max($numbers) - min($numbers);
    }

    /**
     * Matrix determinant
     * @param array $matrix Square matrix
     * @return float Determinant
     * @throws Exception If matrix is invalid
     */
    public function determinant($matrix) {
        if (!is_array($matrix) || empty($matrix)) {
            throw new Exception("Error: Matrix is empty or invalid");
        }
        $rows = count($matrix);
        if ($rows != count($matrix[0])) {
            throw new Exception("Error: Matrix must be square");
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
    private function minor($matrix, $row, $col) {
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
     * @return array|string|null Inverse matrix or error message
     */
    public function inverse($matrix) {
        $det = $this->determinant($matrix);
        if (is_string($det)) return $det;
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
    private function adjoint($matrix) {
        $adjoint = [];
        for ($i = 0; $i < count($matrix); $i++) {
            for ($j = 0; $j < count($matrix); $j++) {
                $adjoint[$j][$i] = ($i + $j) % 2 == 0 ? $this->determinant($this->minor($matrix, $i, $j)) : -$this->determinant($this->minor($matrix, $i, $j));
            }
        }
        return $adjoint;
    }

    // Statistical Distributions
    /**
     * Poisson distribution
     * @param int $k Number of occurrences
     * @param float $lambda Average rate
     * @return float|string Probability or error message
     */
    public function poissonDistribution($k, $lambda) {
        if ($k < 0 || $lambda <= 0) {
            return "Error: Invalid inputs";
        }
        return ($this->power($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * Standard normal distribution
     * @param float $z Z-score
     * @return float Probability density
     */
    public function standardNormalDistribution($z) {
        return (1 / sqrt(2 * M_PI)) * exp(-0.5 * pow($z, 2));
    }

    /**
     * Cumulative normal distribution
     * @param float $z Z-score
     * @return float Cumulative probability
     */
    public function cumulativeNormalDistribution($z) {
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
     * @return float|string CDF value or error message
     */
    public function chiSquareCDF($x, $k) {
        if ($x < 0 || $k < 1) return "Error: Invalid inputs";
        if ($x == 0) return 0.0;
        return $this->gammainc($x / 2, $k / 2);
    }

    /**
     * Incomplete gamma function
     * @param float $x Value
     * @param float $a Shape parameter
     * @return float Incomplete gamma value
     */
    public function gammainc($x, $a) {
        $g = $this->gamma($a);
        return $this->lowerGamma($x, $a) / $g;
    }

    /**
     * Gamma function approximation
     * @param float $z Value
     * @return float Gamma value
     */
    public function gamma($z) {
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
    public function lowerGamma($x, $a) {
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
    public function integralByParts($u, $dv, $a, $b) {
        $v = function($x) use ($dv, $a) { return $this->integral($dv, $a, $x); };
        $du = function($x) use ($u) { return $this->derivative($u, $x); };
        return ($u($b) * $v($b) - $u($a) * $v($a)) - $this->integral(function($x) use ($du, $v) {
            return $du($x) * $v($x);
        }, $a, $b);
    }

    /**
     * Skewness
     * @param array $numbers Array of numbers
     * @return float|string Skewness or error message
     */
    public function skewness($numbers) {
        if (count($numbers) < 2) return "Error: At least two values are required";
        $mean = $this->mean($numbers);
        $n = count($numbers);
        $m3 = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 3);
        }, $numbers)) / $n;
        $stdDev = $this->standardDeviation($numbers);
        if ($stdDev == 0) return "Error: Standard deviation is zero";
        return $n * $m3 / pow($stdDev, 3);
    }

    /**
     * Excess kurtosis
     * @param array $numbers Array of numbers
     * @return float|string Kurtosis or error message
     */
    public function kurtosis($numbers) {
        if (count($numbers) < 2) return "Error: At least two values are required";
        $mean = $this->mean($numbers);
        $n = count($numbers);
        $m4 = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 4);
        }, $numbers)) / $n;
        $stdDev = $this->standardDeviation($numbers);
        if ($stdDev == 0) return "Error: Standard deviation is zero";
        return $n * $m4 / pow($stdDev, 4) - 3;
    }

    /**
     * Interquartile range
     * @param array $numbers Array of numbers
     * @return float|string IQR or error message
     */
    public function interquartileRange($numbers) {
        if (count($numbers) < 4) return "Error: At least four values are required";
        sort($numbers);
        $q1 = $this->median(array_slice($numbers, 0, floor(count($numbers) / 2)));
        $q3 = $this->median(array_slice($numbers, ceil(count($numbers) / 2)));
        return $q3 - $q1;
    }

    /**
     * Euclidean distance between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|string Distance or error message
     */
    public function euclideanDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
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
     * @return float|string Distance or error message
     */
    public function manhattanDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
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
     * @return float|string Distance or error message
     */
    public function chebyshevDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
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
     * @return float|string Distance or error message
     */
    public function minkowskiDistance($vector1, $vector2, $p = 2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
        if ($p <= 0) return "Error: 'p' must be positive";
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
     * @return float|string Cosine distance (1 - cosine similarity) or error message
     */
    public function cosineDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
        $similarity = $this->cosineSimilarity($vector1, $vector2);
        if (is_string($similarity)) return $similarity;
        return 1 - $similarity;
    }

    // Similarity Functions
    /**
     * Cosine similarity between two vectors
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|string Cosine similarity (0 to 1) or error message
     */
    public function cosineSimilarity($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
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
        if ($norm1 == 0 || $norm2 == 0) return "Error: Zero vector cannot be computed";
        return $dotProduct / ($norm1 * $norm2);
    }

    /**
     * Jaccard similarity between two sets
     * @param array $set1 First set
     * @param array $set2 Second set
     * @return float|string Jaccard similarity (0 to 1) or error message
     */
    public function jaccardSimilarity($set1, $set2) {
        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));
        if ($union == 0) return "Error: Sets are empty";
        return $intersection / $union;
    }

    /**
     * Pearson similarity (linear correlation)
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|string Pearson correlation coefficient (-1 to 1) or error message
     */
    public function pearsonSimilarity($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
        $n = count($vector1);
        if ($n == 0) return "Error: Vectors are empty";

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
        if ($denominator == 0) return "Error: Variance is zero";
        return $numerator / $denominator;
    }

    /**
     * Dot product similarity
     * @param array $vector1 First vector
     * @param array $vector2 Second vector
     * @return float|string Dot product or error message
     */
    public function dotProductSimilarity($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "Error: Vector lengths must match";
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
     * @return array|string Coefficients [slope, intercept] or error message
     */
    public function linearRegression($x, $y) {
        if (count($x) != count($y) || empty($x)) return "Error: Invalid data";
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
     * @return mixed|string Predicted label or error message
     */
    public function knnClassify($data, $point, $k = 3) {
        if (empty($data) || $k < 1 || count($point) != count($data[0][0])) return "Error: Invalid data";
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
     * @return int|string Label (1 or -1) or error message
     */
    public function svmClassify($data, $point) {
        if (empty($data) || count($point) != count($data[0][0])) return "Error: Invalid data";
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
     * @return array|string Clusters or error message
     */
    public function dbscan($data, $eps, $minPts) {
        if (empty($data)) return "Error: Data is empty";
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

    private function findNeighbors($data, $index, $eps) {
        $neighbors = [];
        for ($i = 0; $i < count($data); $i++) {
            if ($i != $index && $this->euclideanDistance($data[$index], $data[$i]) <= $eps) {
                $neighbors[] = $i;
            }
        }
        return $neighbors;
    }

    private function expandCluster($data, $neighbors, $index, $clusterLabel, $eps, $minPts, &$visited, &$clusters) {
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
     * @return array|string Clusters or error message
     */
    public function kMeans($data, $k, $maxIterations = 100) {
        if (empty($data) || $k < 1 || $k > count($data)) return "Error: Invalid data or 'k'";
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
     * @return array|string Coefficients [slope, intercept] or error message
     */
    public function leastSquares($x, $y) {
        return $this->linearRegression($x, $y);
    }

    // Support Vector Regression (SVR)
    /**
     * Predict using simple linear SVR
     * @param array $data Training data ([features, value])
     * @param array $point New point
     * @param float $epsilon Error margin
     * @return float|string Predicted value or error message
     */
    public function svrPredict($data, $point, $epsilon = 0.1) {
        if (empty($data) || count($point) != count($data[0][0])) return "Error: Invalid data";
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
     * @return string|int Predicted label or error message
     */
    public function naiveBayesClassify($data, $point) {
        if (empty($data) || count($point) != count($data[0][0])) return "Error: Invalid data";
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
    public function outerProduct($vector1, $vector2) {
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
     * @return array|string Identity matrix or error message
     */
    public function identityMatrix($size) {
        if ($size < 1) return "Error: Size must be positive";
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
    public function diagonalMatrix($diagonalValues) {
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
     * @return array|string Upper triangular matrix or error message
     */
    public function upperTriangularMatrix($matrix) {
        if (!$this->isSquareMatrix($matrix)) return "Error: Matrix must be square";
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
     * @return array|string Lower triangular matrix or error message
     */
    public function lowerTriangularMatrix($matrix) {
        if (!$this->isSquareMatrix($matrix)) return "Error: Matrix must be square";
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
     * @return array|string Ones matrix or error message
     */
    public function onesMatrix($rows, $cols) {
        if ($rows < 1 || $cols < 1) return "Error: Dimensions must be positive";
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
     * @return array|string Hermitian matrix or error message
     */
    public function hermitianMatrix($matrix) {
        if (!$this->isSquareMatrix($matrix)) return "Error: Matrix must be square";
        return $this->transpose($matrix); // For real numbers, Hermitian is transpose
    }

    /**
     * Check if two matrices are equivalent
     * @param array $matrix1 First matrix
     * @param array $matrix2 Second matrix
     * @return bool True if equivalent, false otherwise
     */
    public function areEquivalentMatrices($matrix1, $matrix2) {
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
    public function adjointMatrix($matrix) {
        return $this->adjoint($matrix);
    }

    /**
     * Create row matrix
     * @param array $vector Input vector
     * @return array Row matrix
     */
    public function rowMatrix($vector) {
        return [$vector];
    }

    /**
     * Create column matrix
     * @param array $vector Input vector
     * @return array Column matrix
     */
    public function columnMatrix($vector) {
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
    public function isSquareMatrix($matrix) {
        if (empty($matrix) || !is_array($matrix)) return false;
        $rows = count($matrix);
        return $rows == count($matrix[0]);
    }

    /**
     * Create zero matrix
     * @param int $rows Number of rows
     * @param int $cols Number of columns
     * @return array|string Zero matrix or error message
     */
    public function zeroMatrix($rows, $cols) {
        if ($rows < 1 || $cols < 1) return "Error: Dimensions must be positive";
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
    public function isSymmetricMatrix($matrix) {
        if (!$this->isSquareMatrix($matrix)) return false;
        $transpose = $this->transpose($matrix);
        return $this->areEquivalentMatrices($matrix, $transpose);
    }

    /**
     * Check if matrix is orthogonal (A * A^T = I)
     * @param array $matrix Input matrix
     * @return bool True if orthogonal, false otherwise
     */
    public function isOrthogonalMatrix($matrix) {
        if (!$this->isSquareMatrix($matrix)) return false;
        $transpose = $this->transpose($matrix);
        $product = $this->matrixMultiplication($matrix, $transpose);
        return $this->areEquivalentMatrices($product, $this->identityMatrix(count($matrix)));
    }

    // Graph Operations
    /**
     * Check if the graph is connected
     * @param array $adjacencyList Adjacency list of the graph
     * @return bool True if connected, false otherwise
     */
    public function isConnectedGraph($adjacencyList) {
        if (empty($adjacencyList)) return true;
        $visited = array_fill_keys(array_keys($adjacencyList), false);
        $this->dfsGraph(current(array_keys($adjacencyList)), $adjacencyList, $visited);
        return !in_array(false, $visited, true);
    }

    /**
     * Check if the graph is disconnected
     * @param array $adjacencyList Adjacency list of the graph
     * @return bool True if disconnected, false otherwise
     */
    public function isDisconnectedGraph($adjacencyList) {
        return !$this->isConnectedGraph($adjacencyList);
    }

    /**
     * Depth-First Search (DFS) for graph traversal
     * @param int $vertex Starting vertex
     * @param array $adjacencyList Adjacency list
     * @param array &$visited Visited nodes array
     * @return void
     */
    private function dfsGraph($vertex, $adjacencyList, &$visited) {
        $visited[$vertex] = true;
        foreach ($adjacencyList[$vertex] ?? [] as $neighbor) {
            if (!$visited[$neighbor]) $this->dfsGraph($neighbor, $adjacencyList, $visited);
        }
    }

    /**
     * Breadth-First Search (BFS) for graph traversal
     * @param int $start Starting vertex
     * @param array $adjacencyList Adjacency list
     * @return array Order of visited vertices
     */
    public function bfsGraph($start, $adjacencyList) {
        $visited = array_fill_keys(array_keys($adjacencyList), false);
        $queue = [$start];
        $result = [];
        $visited[$start] = true;
        while (!empty($queue)) {
            $vertex = array_shift($queue);
            $result[] = $vertex;
            foreach ($adjacencyList[$vertex] ?? [] as $neighbor) {
                if (!$visited[$neighbor]) {
                    $visited[$neighbor] = true;
                    $queue[] = $neighbor;
                }
            }
        }
        return $result;
    }

    /**
     * Find a Hamiltonian Path in the graph
     * @param array $adjacencyList Adjacency list
     * @return array|string Hamiltonian path or error message
     */
    public function hamiltonianPath($adjacencyList) {
        $vertices = array_keys($adjacencyList);
        $path = [$vertices[0]];
        $visited = array_fill_keys($vertices, false);
        $visited[$vertices[0]] = true;
        if ($this->findHamiltonianPath($adjacencyList, $path, $visited, count($vertices))) {
            return $path;
        }
        return "Error: No Hamiltonian path exists";
    }

    private function findHamiltonianPath($adjacencyList, &$path, &$visited, $totalVertices) {
        if (count($path) == $totalVertices) return true;
        $current = end($path);
        foreach ($adjacencyList[$current] ?? [] as $next) {
            if (!$visited[$next]) {
                $path[] = $next;
                $visited[$next] = true;
                if ($this->findHamiltonianPath($adjacencyList, $path, $visited, $totalVertices)) {
                    return true;
                }
                array_pop($path);
                $visited[$next] = false;
            }
        }
        return false;
    }

    /**
     * Find an Eulerian Circuit in the graph
     * @param array $adjacencyList Adjacency list
     * @return array|string Eulerian circuit or error message
     */
    public function eulerianCircuit($adjacencyList) {
        foreach ($adjacencyList as $vertex => $neighbors) {
            if (count($neighbors) % 2 != 0) return "Error: Graph has no Eulerian circuit";
        }
        $circuit = [];
        $tempList = $adjacencyList;
        $this->findEulerianCircuit($tempList, array_keys($adjacencyList)[0], $circuit);
        return array_reverse($circuit);
    }

    private function findEulerianCircuit(&$adjacencyList, $current, &$circuit) {
        while (!empty($adjacencyList[$current])) {
            $next = array_shift($adjacencyList[$current]);
            unset($adjacencyList[$next][array_search($current, $adjacencyList[$next])]);
            $this->findEulerianCircuit($adjacencyList, $next, $circuit);
        }
        $circuit[] = $current;
    }

    /**
     * Check if the graph is a tree
     * @param array $adjacencyList Adjacency list
     * @return bool True if tree, false otherwise
     */
    public function isTree($adjacencyList) {
        $visited = array_fill_keys(array_keys($adjacencyList), false);
        $hasCycle = $this->detectCycleDFS(array_keys($adjacencyList)[0], $adjacencyList, $visited, -1);
        return !$hasCycle && !in_array(false, $visited, true);
    }

    private function detectCycleDFS($vertex, $adjacencyList, &$visited, $parent) {
        $visited[$vertex] = true;
        foreach ($adjacencyList[$vertex] ?? [] as $neighbor) {
            if (!$visited[$neighbor]) {
                if ($this->detectCycleDFS($neighbor, $adjacencyList, $visited, $vertex)) return true;
            } elseif ($neighbor != $parent) {
                return true;
            }
        }
        return false;
    }

    /**
     * Find shortest paths using Dijkstra's algorithm
     * @param array $graph Weighted adjacency matrix
     * @param int $start Starting vertex
     * @return array Shortest distances from start
     */
    public function dijkstra($graph, $start) {
        $distances = array_fill(0, count($graph), INF);
        $distances[$start] = 0;
        $visited = array_fill(0, count($graph), false);
        for ($i = 0; $i < count($graph); $i++) {
            $u = $this->minDistance($distances, $visited);
            if ($u === null) break;
            $visited[$u] = true;
            for ($v = 0; $v < count($graph); $v++) {
                if (!$visited[$v] && $graph[$u][$v] != 0 && $distances[$u] != INF && $distances[$u] + $graph[$u][$v] < $distances[$v]) {
                    $distances[$v] = $distances[$u] + $graph[$u][$v];
                }
            }
        }
        return $distances;
    }

    private function minDistance($distances, $visited) {
        $min = INF;
        $minIndex = null;
        for ($v = 0; $v < count($distances); $v++) {
            if (!$visited[$v] && $distances[$v] <= $min) {
                $min = $distances[$v];
                $minIndex = $v;
            }
        }
        return $minIndex;
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing MathCalculations:\n";
        echo "----------------------------------------\n";

        // Group 1: Basic Operations
        echo "Group 1: Basic Operations\n";
        echo "-------------------------\n";
        echo "// Test addition of 5 and 3\n";
        echo "add(5, 3): " . $this->add(5, 3) . "\n"; // Expected: 8
        echo "// Test subtraction of 10 minus 4\n";
        echo "subtract(10, 4): " . $this->subtract(10, 4) . "\n"; // Expected: 6
        echo "// Test multiplication of 6 by 2\n";
        echo "multiply(6, 2): " . $this->multiply(6, 2) . "\n"; // Expected: 12
        echo "// Test division of 15 by 3\n";
        echo "divide(15, 3): " . $this->divide(15, 3) . "\n"; // Expected: 5
        echo "// Test division by zero (error case)\n";
        echo "divide(10, 0): " . $this->divide(10, 0) . "\n"; // Expected: Error message

        // Group 2: Algebra
        echo "\nGroup 2: Algebra\n";
        echo "-------------------------\n";
        echo "// Test quadratic formula for x^2 - 3x + 2 = 0\n";
        echo "quadraticFormula(1, -3, 2): " . json_encode($this->quadraticFormula(1, -3, 2)) . "\n"; // Expected: [2, 1]
        echo "// Test absolute value of -5\n";
        echo "absoluteValue(-5): " . $this->absoluteValue(-5) . "\n"; // Expected: 5
        echo "// Test 2 raised to power 3\n";
        echo "power(2, 3): " . $this->power(2, 3) . "\n"; // Expected: 8
        echo "// Test square root of 16\n";
        echo "squareRoot(16): " . $this->squareRoot(16) . "\n"; // Expected: 4
        echo "// Test cubic formula for x^3 - 6x^2 + 11x - 6 = 0\n";
        echo "cubicFormula(1, -6, 11, -6): " . json_encode($this->cubicFormula(1, -6, 11, -6)) . "\n"; // Expected: [1, 2, 3]
        echo "// Test LCM of 12 and 18\n";
        echo "lcm(12, 18): " . $this->lcm(12, 18) . "\n"; // Expected: 36
        echo "// Test GCD of 48 and 18\n";
        echo "gcd(48, 18): " . $this->gcd(48, 18) . "\n"; // Expected: 6

        // Group 3: Calculus
        echo "\nGroup 3: Calculus\n";
        echo "-------------------------\n";
        $f = function($x) { return $x * $x; };
        echo "// Test derivative of x^2 at x = 2\n";
        echo "derivative(x^2, 2): " . $this->derivative($f, 2) . "\n"; // Expected: ~4
        echo "// Test integral of x^2 from 0 to 2\n";
        echo "integral(x^2, 0, 2): " . $this->integral($f, 0, 2) . "\n"; // Expected: ~2.67
        echo "// Test limit of x^2 as x approaches 1\n";
        echo "limit(x^2, 1): " . $this->limit($f, 1) . "\n"; // Expected: ~1
        echo "// Test second derivative of x^2 at x = 2\n";
        echo "secondDerivative(x^2, 2): " . $this->secondDerivative($f, 2) . "\n"; // Expected: ~2
        echo "// Test mean value theorem for x^2 from 0 to 2\n";
        echo "meanValueTheorem(x^2, 0, 2): " . $this->meanValueTheorem($f, 0, 2) . "\n"; // Expected: 2

        // Group 4: Trigonometric Functions
        echo "\nGroup 4: Trigonometric Functions\n";
        echo "-------------------------\n";
        echo "// Test sine of 30 degrees\n";
        echo "sin(30): " . $this->sin(30) . "\n"; // Expected: 0.5
        echo "// Test cosine of 60 degrees\n";
        echo "cos(60): " . $this->cos(60) . "\n"; // Expected: 0.5
        echo "// Test tangent of 45 degrees\n";
        echo "tan(45): " . $this->tan(45) . "\n"; // Expected: ~1
        echo "// Test secant of 0 degrees\n";
        echo "sec(0): " . $this->sec(0) . "\n"; // Expected: 1
        echo "// Test cosecant of 90 degrees\n";
        echo "cosec(90): " . $this->cosec(90) . "\n"; // Expected: 1
        echo "// Test cotangent of 45 degrees\n";
        echo "cot(45): " . $this->cot(45) . "\n"; // Expected: ~1
        echo "// Test arcsine of 0.5\n";
        echo "arcsin(0.5): " . $this->arcsin(0.5) . "\n"; // Expected: 30
        echo "// Test arccosine of 0.5\n";
        echo "arccos(0.5): " . $this->arccos(0.5) . "\n"; // Expected: 60
        echo "// Test arctangent of 1\n";
        echo "arctan(1): " . $this->arctan(1) . "\n"; // Expected: 45

        // Group 5: Exponential and Logarithmic Functions
        echo "\nGroup 5: Exponential and Logarithmic Functions\n";
        echo "-------------------------\n";
        echo "// Test e^1\n";
        echo "exponential(1): " . $this->exponential(1) . "\n"; // Expected: ~2.718
        echo "// Test log base 10 of 100\n";
        echo "logarithm(100, 10): " . $this->logarithm(100, 10) . "\n"; // Expected: 2
        echo "// Test natural log of e\n";
        echo "naturalLog(2.718): " . $this->naturalLog(2.718) . "\n"; // Expected: ~1
        echo "// Test log base 10 of 1000\n";
        echo "logBase10(1000): " . $this->logBase10(1000) . "\n"; // Expected: 3

        // Group 6: Series and Sequences
        echo "\nGroup 6: Series and Sequences\n";
        echo "-------------------------\n";
        echo "// Test 5th term of arithmetic sequence starting at 1 with difference 2\n";
        echo "arithmeticSequence(1, 2, 5): " . $this->arithmeticSequence(1, 2, 5) . "\n"; // Expected: 9
        echo "// Test 4th term of geometric sequence starting at 2 with ratio 3\n";
        echo "geometricSequence(2, 3, 4): " . $this->geometricSequence(2, 3, 4) . "\n"; // Expected: 54
        echo "// Test 6th Fibonacci number\n";
        echo "fibonacci(6): " . $this->fibonacci(6) . "\n"; // Expected: 8
        echo "// Test Taylor series for e^1 with 5 terms\n";
        echo "taylorSeriesExponential(1, 5): " . $this->taylorSeriesExponential(1, 5) . "\n"; // Expected: ~2.708
        echo "// Test Taylor series for sin(30°) with 5 terms\n";
        echo "taylorSeriesSin(30, 5): " . $this->taylorSeriesSin(deg2rad(30), 5) . "\n"; // Expected: ~0.5
        echo "// Test Taylor series for cos(60°) with 5 terms\n";
        echo "taylorSeriesCos(60, 5): " . $this->taylorSeriesCos(deg2rad(60), 5) . "\n"; // Expected: ~0.5
        echo "// Test factorial of 5\n";
        echo "factorial(5): " . $this->factorial(5) . "\n"; // Expected: 120

        // Group 7: Matrix Operations
        echo "\nGroup 7: Matrix Operations\n";
        echo "-------------------------\n";
        $matrixA = [[1, 2], [3, 4]];
        $matrixB = [[5, 6], [7, 8]];
        echo "// Test addition of matrices [[1,2],[3,4]] and [[5,6],[7,8]]\n";
        echo "matrixAddition([[1,2],[3,4]], [[5,6],[7,8]]): " . json_encode($this->matrixAddition($matrixA, $matrixB)) . "\n"; // Expected: [[6,8],[10,12]]
        echo "// Test multiplication of matrices [[1,2],[3,4]] and [[5,6],[7,8]]\n";
        echo "matrixMultiplication([[1,2],[3,4]], [[5,6],[7,8]]): " . json_encode($this->matrixMultiplication($matrixA, $matrixB)) . "\n"; // Expected: [[19,22],[43,50]]
        echo "// Test transpose of matrix [[1,2],[3,4]]\n";
        echo "transpose([[1,2],[3,4]]): " . json_encode($this->transpose($matrixA)) . "\n"; // Expected: [[1,3],[2,4]]
        echo "// Test determinant of matrix [[1,2],[3,4]]\n";
        echo "determinant([[1,2],[3,4]]): " . $this->determinant($matrixA) . "\n"; // Expected: -2
        echo "// Test inverse of matrix [[1,2],[3,4]]\n";
        echo "inverse([[1,2],[3,4]]): " . json_encode($this->inverse($matrixA)) . "\n"; // Expected: [[-2,1],[1.5,-0.5]]
        echo "// Test outer product of vectors [1,2] and [3,4]\n";
        echo "outerProduct([1,2], [3,4]): " . json_encode($this->outerProduct([1, 2], [3, 4])) . "\n"; // Expected: [[3,4],[6,8]]
        echo "// Test identity matrix of size 3\n";
        echo "identityMatrix(3): " . json_encode($this->identityMatrix(3)) . "\n"; // Expected: [[1,0,0],[0,1,0],[0,0,1]]
        echo "// Test diagonal matrix with values [1,2,3]\n";
        echo "diagonalMatrix([1,2,3]): " . json_encode($this->diagonalMatrix([1, 2, 3])) . "\n"; // Expected: [[1,0,0],[0,2,0],[0,0,3]]
        echo "// Test upper triangular matrix of [[1,2],[3,4]]\n";
        echo "upperTriangularMatrix([[1,2],[3,4]]): " . json_encode($this->upperTriangularMatrix([[1, 2], [3, 4]])) . "\n"; // Expected: [[1,2],[0,4]]
        echo "// Test lower triangular matrix of [[1,2],[3,4]]\n";
        echo "lowerTriangularMatrix([[1,2],[3,4]]): " . json_encode($this->lowerTriangularMatrix([[1, 2], [3, 4]])) . "\n"; // Expected: [[1,0],[3,4]]
        echo "// Test ones matrix of size 2x3\n";
        echo "onesMatrix(2, 3): " . json_encode($this->onesMatrix(2, 3)) . "\n"; // Expected: [[1,1,1],[1,1,1]]
        echo "// Test Hermitian matrix of [[1,2],[3,4]] (real case)\n";
        echo "hermitianMatrix([[1,2],[3,4]]): " . json_encode($this->hermitianMatrix([[1, 2], [3, 4]])) . "\n"; // Expected: [[1,3],[2,4]]
        echo "// Test equivalence of [[1,2],[3,4]] with itself\n";
        echo "areEquivalentMatrices([[1,2],[3,4]], [[1,2],[3,4]]): " . ($this->areEquivalentMatrices([[1, 2], [3, 4]], [[1, 2], [3, 4]]) ? "true" : "false") . "\n"; // Expected: true
        echo "// Test adjoint matrix of [[1,2],[3,4]]\n";
        echo "adjointMatrix([[1,2],[3,4]]): " . json_encode($this->adjointMatrix([[1, 2], [3, 4]])) . "\n"; // Expected: [[4,-2],[-3,1]]
        echo "// Test row matrix from vector [1,2,3]\n";
        echo "rowMatrix([1,2,3]): " . json_encode($this->rowMatrix([1, 2, 3])) . "\n"; // Expected: [[1,2,3]]
        echo "// Test column matrix from vector [1,2,3]\n";
        echo "columnMatrix([1,2,3]): " . json_encode($this->columnMatrix([1, 2, 3])) . "\n"; // Expected: [[1],[2],[3]]
        echo "// Test if [[1,2],[3,4]] is square\n";
        echo "isSquareMatrix([[1,2],[3,4]]): " . ($this->isSquareMatrix([[1, 2], [3, 4]]) ? "true" : "false") . "\n"; // Expected: true
        echo "// Test zero matrix of size 2x3\n";
        echo "zeroMatrix(2, 3): " . json_encode($this->zeroMatrix(2, 3)) . "\n"; // Expected: [[0,0,0],[0,0,0]]
        echo "// Test if [[1,2],[2,1]] is symmetric\n";
        echo "isSymmetricMatrix([[1,2],[2,1]]): " . ($this->isSymmetricMatrix([[1, 2], [2, 1]]) ? "true" : "false") . "\n"; // Expected: true
        echo "// Test if [[0,1],[-1,0]] is orthogonal\n";
        echo "isOrthogonalMatrix([[0,1],[-1,0]]): " . ($this->isOrthogonalMatrix([[0, 1], [-1, 0]]) ? "true" : "false") . "\n"; // Expected: true

        // Group 8: Statistical Functions
        echo "\nGroup 8: Statistical Functions\n";
        echo "-------------------------\n";
        $numbers = [1, 2, 3, 4, 5];
        echo "// Test combination of 5 choose 2\n";
        echo "combination(5, 2): " . $this->combination(5, 2) . "\n"; // Expected: 10
        echo "// Test permutation of 5 permute 2\n";
        echo "permutation(5, 2): " . $this->permutation(5, 2) . "\n"; // Expected: 20
        echo "// Test mean of [1,2,3,4,5]\n";
        echo "mean([1,2,3,4,5]): " . $this->mean($numbers) . "\n"; // Expected: 3
        echo "// Test sample variance of [1,2,3,4,5]\n";
        echo "varianceSample([1,2,3,4,5]): " . $this->varianceSample($numbers) . "\n"; // Expected: 2.5
        echo "// Test standard deviation of [1,2,3,4,5]\n";
        echo "standardDeviation([1,2,3,4,5]): " . $this->standardDeviation($numbers) . "\n"; // Expected: ~1.58
        echo "// Test median of [1,2,3,4,5]\n";
        echo "median([1,2,3,4,5]): " . $this->median($numbers) . "\n"; // Expected: 3
        echo "// Test mode of [1,2,2,3,4]\n";
        echo "mode([1,2,2,3,4]): " . $this->mode([1, 2, 2, 3, 4]) . "\n"; // Expected: 2
        echo "// Test range of [1,2,3,4,5]\n";
        echo "range([1,2,3,4,5]): " . $this->range($numbers) . "\n"; // Expected: 4
        echo "// Test Poisson distribution for k=2, lambda=1.5\n";
        echo "poissonDistribution(2, 1.5): " . $this->poissonDistribution(2, 1.5) . "\n"; // Expected: ~0.251
        echo "// Test standard normal distribution at z=0\n";
        echo "standardNormalDistribution(0): " . $this->standardNormalDistribution(0) . "\n"; // Expected: ~0.399
        echo "// Test cumulative normal distribution at z=1\n";
        echo "cumulativeNormalDistribution(1): " . $this->cumulativeNormalDistribution(1) . "\n"; // Expected: ~0.841
        echo "// Test chi-square CDF for x=2, k=2\n";
        echo "chiSquareCDF(2, 2): " . $this->chiSquareCDF(2, 2) . "\n"; // Expected: ~0.632
        echo "// Test skewness of [1,2,2,3,4]\n";
        echo "skewness([1,2,2,3,4]): " . $this->skewness([1, 2, 2, 3, 4]) . "\n"; // Expected: ~0.261
        echo "// Test kurtosis of [1,2,2,3,4]\n";
        echo "kurtosis([1,2,2,3,4]): " . $this->kurtosis([1, 2, 2, 3, 4]) . "\n"; // Expected: ~-1.3
        echo "// Test interquartile range of [1,2,3,4,5,6,7]\n";
        echo "interquartileRange([1,2,3,4,5,6,7]): " . $this->interquartileRange([1, 2, 3, 4, 5, 6, 7]) . "\n"; // Expected: 3

        // Group 9: Distance and Similarity Measures
        echo "\nGroup 9: Distance and Similarity Measures\n";
        echo "-------------------------\n";
        $v1 = [1, 2, 3];
        $v2 = [4, 5, 6];
        echo "// Test Euclidean distance between [1,2,3] and [4,5,6]\n";
        echo "euclideanDistance([1,2,3], [4,5,6]): " . $this->euclideanDistance($v1, $v2) . "\n"; // Expected: ~5.196
        echo "// Test Manhattan distance between [1,2,3] and [4,5,6]\n";
        echo "manhattanDistance([1,2,3], [4,5,6]): " . $this->manhattanDistance($v1, $v2) . "\n"; // Expected: 9
        echo "// Test Chebyshev distance between [1,2,3] and [4,5,6]\n";
        echo "chebyshevDistance([1,2,3], [4,5,6]): " . $this->chebyshevDistance($v1, $v2) . "\n"; // Expected: 3
        echo "// Test Minkowski distance (p=1) between [1,2,3] and [4,5,6]\n";
        echo "minkowskiDistance([1,2,3], [4,5,6], 1): " . $this->minkowskiDistance($v1, $v2, 1) . "\n"; // Expected: 9
        echo "// Test Minkowski distance (p=2) between [1,2,3] and [4,5,6]\n";
        echo "minkowskiDistance([1,2,3], [4,5,6], 2): " . $this->minkowskiDistance($v1, $v2, 2) . "\n"; // Expected: ~5.196
        echo "// Test cosine distance between [1,2,3] and [4,5,6]\n";
        echo "cosineDistance([1,2,3], [4,5,6]): " . $this->cosineDistance($v1, $v2) . "\n"; // Expected: ~0.025
        echo "// Test cosine similarity between [1,2,3] and [4,5,6]\n";
        echo "cosineSimilarity([1,2,3], [4,5,6]): " . $this->cosineSimilarity($v1, $v2) . "\n"; // Expected: ~0.974
        echo "// Test Jaccard similarity between [1,2,3] and [2,3,4]\n";
        echo "jaccardSimilarity([1,2,3], [2,3,4]): " . $this->jaccardSimilarity([1, 2, 3], [2, 3, 4]) . "\n"; // Expected: 0.5
        echo "// Test Pearson similarity between [1,2,3] and [2,4,6]\n";
        echo "pearsonSimilarity([1,2,3], [2,4,6]): " . $this->pearsonSimilarity([1, 2, 3], [2, 4, 6]) . "\n"; // Expected: 1
        echo "// Test dot product similarity between [1,2,3] and [4,5,6]\n";
        echo "dotProductSimilarity([1,2,3], [4,5,6]): " . $this->dotProductSimilarity($v1, $v2) . "\n"; // Expected: 32

        // Group 10: Machine Learning and Clustering
        echo "\nGroup 10: Machine Learning and Clustering\n";
        echo "-------------------------\n";
        $x = [1, 2, 3, 4, 5];
        $y = [2, 4, 5, 4, 5];
        echo "// Test linear regression for x=[1,2,3,4,5], y=[2,4,5,4,5]\n";
        echo "linearRegression([1,2,3,4,5], [2,4,5,4,5]): " . json_encode($this->linearRegression($x, $y)) . "\n"; // Expected: [m, b]
        $knnData = [[[1, 2], 0], [[2, 3], 0], [[5, 5], 1], [[6, 7], 1]];
        echo "// Test KNN classification for point [3,4] with k=3\n";
        echo "knnClassify(data, [3,4], 3): " . $this->knnClassify($knnData, [3, 4], 3) . "\n"; // Expected: 0 or 1
        $svmData = [[[1, 1], 1], [[2, 2], 1], [[3, 3], -1], [[4, 4], -1]];
        echo "// Test SVM classification for point [2,2]\n";
        echo "svmClassify(data, [2,2]): " . $this->svmClassify($svmData, [2, 2]) . "\n"; // Expected: 1 or -1
        $dbscanData = [[1, 2], [2, 2], [2, 3], [8, 7], [8, 8], [25, 80]];
        echo "// Test DBSCAN clustering with eps=2, minPts=3\n";
        echo "dbscan(data, 2, 3): " . json_encode($this->dbscan($dbscanData, 2, 3)) . "\n";
        $kmeansData = [[1, 2], [1, 4], [1, 0], [10, 2], [10, 4], [10, 0]];
        echo "// Test k-Means clustering with k=2\n";
        echo "kMeans(data, 2): " . json_encode($this->kMeans($kmeansData, 2)) . "\n";
        echo "// Test least squares for x=[1,2,3,4,5], y=[2,4,5,4,5]\n";
        echo "leastSquares([1,2,3,4,5], [2,4,5,4,5]): " . json_encode($this->leastSquares($x, $y)) . "\n";
        $svrData = [[[1, 1], 2], [[2, 2], 4], [[3, 3], 6]];
        echo "// Test SVR prediction for point [2,2]\n";
        echo "svrPredict(data, [2,2]): " . $this->svrPredict($svrData, [2, 2]) . "\n";
        $nbData = [[[1, 2], 'A'], [[2, 3], 'A'], [[5, 5], 'B'], [[6, 7], 'B']];
        echo "// Test Naive Bayes classification for point [3,4]\n";
        echo "naiveBayesClassify(data, [3,4]): " . $this->naiveBayesClassify($nbData, [3, 4]) . "\n";

        // Group 11: Graph Operations
        echo "\nGroup 11: Graph Operations\n";
        echo "-------------------------\n";
        $graph = [
            0 => [1, 2], 1 => [0, 3], 2 => [0, 3], 3 => [1, 2]
        ];
        echo "// Test if graph with vertices [0,1,2,3] is connected\n";
        echo "isConnectedGraph: " . ($this->isConnectedGraph($graph) ? "true" : "false") . "\n"; // Expected: true
        echo "// Test if graph with vertices [0,1,2,3] is disconnected\n";
        echo "isDisconnectedGraph: " . ($this->isDisconnectedGraph($graph) ? "true" : "false") . "\n"; // Expected: false
        echo "// Test BFS starting from vertex 0\n";
        echo "bfsGraph(0): " . json_encode($this->bfsGraph(0, $graph)) . "\n"; // Expected: [0,1,2,3] or permutation
        echo "// Test Hamiltonian path in graph\n";
        echo "hamiltonianPath: " . json_encode($this->hamiltonianPath($graph)) . "\n"; // Expected: A valid path like [0,1,3,2]
        echo "// Test Eulerian circuit in graph\n";
        echo "eulerianCircuit: " . json_encode($this->eulerianCircuit($graph)) . "\n"; // Expected: A valid circuit
        echo "// Test if acyclic graph [0->1, 1->2] is a tree\n";
        echo "isTree: " . ($this->isTree([0 => [1], 1 => [0, 2], 2 => [1]]) ? "true" : "false") . "\n"; // Expected: true
        echo "// Test Dijkstra's algorithm on weighted graph from vertex 0\n";
        echo "dijkstra: " . json_encode($this->dijkstra([[0, 4, 0, 0], [4, 0, 8, 0], [0, 8, 0, 7], [0, 0, 7, 0]], 0)) . "\n"; // Expected: [0,4,12,19]

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

$math = new MathCalculations();
$math->runTests();
?>