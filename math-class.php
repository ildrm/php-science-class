<?php

class MathCalculations {
    // عملیات‌های پایه
    /**
     * جمع دو عدد
     * @param float $a
     * @param float $b
     * @return float
     */
    public function add($a, $b) {
        return $a + $b;
    }

    /**
     * تفریق دو عدد
     * @param float $a
     * @param float $b
     * @return float
     */
    public function subtract($a, $b) {
        return $a - $b;
    }

    /**
     * ضرب دو عدد
     * @param float $a
     * @param float $b
     * @return float
     */
    public function multiply($a, $b) {
        return $a * $b;
    }

    /**
     * تقسیم دو عدد
     * @param float $a
     * @param float $b
     * @return float|string
     */
    public function divide($a, $b) {
        if ($b == 0) {
            return "خطا: تقسیم بر صفر ممکن نیست";
        }
        return $a / $b;
    }

    // Algebra
    /**
     * حل معادله درجه دوم ax^2 + bx + c = 0
     * @param float $a
     * @param float $b
     * @param float $c
     * @return array|string|null
     */
    public function quadraticFormula($a, $b, $c) {
        if ($a == 0) {
            return "خطا: ضریب a نمی‌تواند صفر باشد";
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
     * قدر مطلق یک عدد
     * @param float $x
     * @return float
     */
    public function absoluteValue($x) {
        return abs($x);
    }

    /**
     * توان (x به توان y)
     * @param float $base
     * @param float $exponent
     * @return float
     */
    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

    /**
     * ریشه دوم یک عدد
     * @param float $x
     * @return float|string
     */
    public function squareRoot($x) {
        if ($x < 0) {
            return "خطا: ریشه دوم عدد منفی ممکن نیست";
        }
        return sqrt($x);
    }

    /**
     * حل معادله درجه سوم ax^3 + bx^2 + cx + d = 0
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @return array
     */
    public function cubicFormula($a, $b, $c, $d) {
        if ($a == 0) {
            return $this->quadraticFormula($b, $c, $d) ?? [$this->divide(-$d, $c)]; // اگر b هم صفر باشد
        }
        $f = ((3 * $c / $a) - ($b * $b / ($a * $a))) / 3;
        $g = ((2 * $b * $b * $b / ($a * $a * $a)) - (9 * $b * $c / ($a * $a)) + (27 * $d / $a)) / 27;
        $h = ($g * $g / 4) + ($f * $f * $f / 27);

        if ($h > 0) {
            $R = -$g / 2 + sqrt($h);
            $S = ($R < 0) ? -pow(-$R, 1/3) : pow($R, 1/3); // مدیریت اعداد منفی
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
     * پیدا کردن ریشه‌های چندجمله‌ای
     * @param array $coefficients
     * @return array|null
     */
    public function polynomialRoots($coefficients) {
        $degree = count($coefficients) - 1;
        if ($degree == 2) {
            return $this->quadraticFormula($coefficients[0], $coefficients[1], $coefficients[2]);
        } elseif ($degree == 3) {
            return $this->cubicFormula($coefficients[0], $coefficients[1], $coefficients[2], $coefficients[3]);
        }
        return null; // برای درجه‌های بالاتر پیاده‌سازی نشده
    }

    /**
     * کوچک‌ترین مضرب مشترک
     * @param int $a
     * @param int $b
     * @return int
     */
    public function lcm($a, $b) {
        return abs($a * $b) / $this->gcd($a, $b);
    }

    /**
     * بزرگ‌ترین مقسوم‌علیه مشترک
     * @param int $a
     * @param int $b
     * @return int
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
     * مشتق عددی یک تابع
     * @param callable $function
     * @param float $point
     * @param float $h
     * @return float
     */
    public function derivative($function, $point, $h = 1e-5) {
        return ($function($point + $h) - $function($point - $h)) / (2 * $h);
    }

    /**
     * انتگرال معین یک تابع
     * @param callable $function
     * @param float $lowerBound
     * @param float $upperBound
     * @param int $n
     * @return float
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
     * حد یک تابع
     * @param callable $function
     * @param float $point
     * @param float $h
     * @return float
     */
    public function limit($function, $point, $h = 1e-5) {
        return $function($point + $h);
    }

    /**
     * مشتق دوم عددی یک تابع
     * @param callable $function
     * @param float $point
     * @param float $h
     * @return float
     */
    public function secondDerivative($function, $point, $h = 1e-5) {
        return ($this->derivative($function, $point + $h) - $this->derivative($function, $point - $h)) / (2 * $h);
    }

    /**
     * قضیه مقدار میانگین
     * @param callable $f
     * @param float $a
     * @param float $b
     * @return float|string
     */
    public function meanValueTheorem($f, $a, $b) {
        if ($a == $b) {
            return "خطا: بازه نامعتبر است";
        }
        return ($f($b) - $f($a)) / ($b - $a);
    }

    //== توابع مثلثاتی =====================
        // Trigonometric Functions
    /**
     * سینوس (درجه)
     * @param float $angle
     * @return float
     */
    public function sin($angle) {
        return sin(deg2rad($angle));
    }

    /**
     * کسینوس (درجه)
     * @param float $angle
     * @return float
     */
    public function cos($angle) {
        return cos(deg2rad($angle));
    }

    /**
     * تانژانت (درجه)
     * @param float $angle
     * @return float|string
     */
    public function tan($angle) {
        $tan = tan(deg2rad($angle));
        if (is_infinite($tan)) {
            return "خطا: تانژانت در این زاویه تعریف نشده است";
        }
        return $tan;
    }

    /**
     * سکند (درجه)
     * @param float $angle
     * @return float|string
     */
    public function sec($angle) {
        $cos = $this->cos($angle);
        if ($cos == 0) {
            return "خطا: سکند در این زاویه تعریف نشده است";
        }
        return 1 / $cos;
    }

    /**
     * کوسکنت (درجه)
     * @param float $angle
     * @return float|string
     */
    public function cosec($angle) {
        $sin = $this->sin($angle);
        if ($sin == 0) {
            return "خطا: کوسکنت در این زاویه تعریف نشده است";
        }
        return 1 / $sin;
    }

    /**
     * کوتانژانت (درجه)
     * @param float $angle
     * @return float|string
     */
    public function cot($angle) {
        $tan = $this->tan($angle);
        if ($tan === "خطا: تانژانت در این زاویه تعریف نشده است" || $tan == 0) {
            return "خطا: کوتانژانت در این زاویه تعریف نشده است";
        }
        return 1 / $tan;
    }

    /**
     * آرک‌سینوس (به درجه)
     * @param float $value
     * @return float|string
     */
    public function arcsin($value) {
        if ($value < -1 || $value > 1) {
            return "خطا: مقدار باید بین -1 و 1 باشد";
        }
        return rad2deg(asin($value));
    }

    /**
     * آرک‌کسینوس (به درجه)
     * @param float $value
     * @return float|string
     */
    public function arccos($value) {
        if ($value < -1 || $value > 1) {
            return "خطا: مقدار باید بین -1 و 1 باشد";
        }
        return rad2deg(acos($value));
    }

    /**
     * آرک‌تانژانت (به درجه)
     * @param float $value
     * @return float
     */
    public function arctan($value) {
        return rad2deg(atan($value));
    }

    // Exponential and Logarithmic Functions
    /**
     * تابع نمایی (e^x)
     * @param float $x
     * @return float
     */
    public function exponential($x) {
        return exp($x);
    }

    /**
     * لگاریتم با پایه دلخواه
     * @param float $x
     * @param float $base
     * @return float|string
     */
    public function logarithm($x, $base = M_E) {
        if ($x <= 0) {
            return "خطا: لگاریتم از عدد صفر یا منفی تعریف نشده است";
        }
        if ($base <= 0 || $base == 1) {
            return "خطا: پایه لگاریتم باید مثبت و غیر از 1 باشد";
        }
        return log($x, $base);
    }

    /**
     * لگاریتم طبیعی (ln)
     * @param float $x
     * @return float|string
     */
    public function naturalLog($x) {
        if ($x <= 0) {
            return "خطا: لگاریتم طبیعی از عدد صفر یا منفی تعریف نشده است";
        }
        return log($x);
    }

    /**
     * لگاریتم پایه 10
     * @param float $x
     * @return float|string
     */
    public function logBase10($x) {
        if ($x <= 0) {
            return "خطا: لگاریتم پایه 10 از عدد صفر یا منفی تعریف نشده است";
        }
        return log10($x);
    }

    // Series and Sequences
    /**
     * دنباله حسابی
     * @param float $firstTerm
     * @param float $commonDifference
     * @param int $n
     * @return float
     */
    public function arithmeticSequence($firstTerm, $commonDifference, $n) {
        if ($n < 1) return "خطا: n باید مثبت باشد";
        return $firstTerm + ($n - 1) * $commonDifference;
    }

    /**
     * دنباله هندسی
     * @param float $firstTerm
     * @param float $commonRatio
     * @param int $n
     * @return float
     */
    public function geometricSequence($firstTerm, $commonRatio, $n) {
        if ($n < 1) return "خطا: n باید مثبت باشد";
        return $firstTerm * pow($commonRatio, $n - 1);
    }

    /**
     * دنباله فیبوناچی
     * @param int $n
     * @return int
     */
    public function fibonacci($n) {
        if ($n < 0) return "خطا: n باید نامنفی باشد";
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
     * سری تیلور برای e^x
     * @param float $x
     * @param int $n
     * @return float
     */
    public function taylorSeriesExponential($x, $n) {
        if ($n < 0) return "خطا: n باید نامنفی باشد";
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += $this->power($x, $i) / $this->factorial($i);
        }
        return $sum;
    }

    /**
     * سری تیلور برای sin(x)
     * @param float $x
     * @param int $n
     * @return float
     */
    public function taylorSeriesSin($x, $n) {
        if ($n < 0) return "خطا: n باید نامنفی باشد";
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += ($this->power(-1, $i) * $this->power($x, 2 * $i + 1)) / $this->factorial(2 * $i + 1);
        }
        return $sum;
    }

    /**
     * سری تیلور برای cos(x)
     * @param float $x
     * @param int $n
     * @return float
     */
    public function taylorSeriesCos($x, $n) {
        if ($n < 0) return "خطا: n باید نامنفی باشد";
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum += ($this->power(-1, $i) * $this->power($x, 2 * $i)) / $this->factorial(2 * $i);
        }
        return $sum;
    }

    /**
     * فاکتوریل یک عدد
     * @param int $n
     * @return int|string
     */
    public function factorial($n) {
        if (!is_int($n) || $n < 0) return "خطا: n باید یک عدد صحیح نامنفی باشد";
        if ($n === 0) return 1;
        $result = 1;
        for ($i = 1; $i <= $n; $i++) {
            $result *= $i;
        }
        return $result;
    }

    // Matrix Operations
    /**
     * جمع دو ماتریس
     * @param array $matrixA
     * @param array $matrixB
     * @return array|string
     */
    public function matrixAddition($matrixA, $matrixB) {
        if (count($matrixA) != count($matrixB) || count($matrixA[0]) != count($matrixB[0])) {
            return "خطا: ابعاد ماتریس‌ها باید یکسان باشد";
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
     * ضرب دو ماتریس
     * @param array $matrixA
     * @param array $matrixB
     * @return array|string
     */
    public function matrixMultiplication($matrixA, $matrixB) {
        if (count($matrixA[0]) != count($matrixB)) {
            return "خطا: تعداد ستون‌های ماتریس اول باید برابر تعداد ردیف‌های ماتریس دوم باشد";
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
     * ترانهاده ماتریس
     * @param array $matrix
     * @return array
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

    //== توابع آماری ============================================================
        // Additional Functions
    /**
     * ترکیب (nCr)
     * @param int $n
     * @param int $r
     * @return float|string
     */
    public function combination($n, $r) {
        if ($r > $n || $n < 0 || $r < 0) {
            return "خطا: ورودی‌ها نامعتبر هستند";
        }
        return $this->factorial($n) / ($this->factorial($r) * $this->factorial($n - $r));
    }

    /**
     * جایگشت (nPr)
     * @param int $n
     * @param int $r
     * @return float|string
     */
    public function permutation($n, $r) {
        if ($r > $n || $n < 0 || $r < 0) {
            return "خطا: ورودی‌ها نامعتبر هستند";
        }
        return $this->factorial($n) / $this->factorial($n - $r);
    }

    /**
     * میانگین اعداد
     * @param array $numbers
     * @return float|string
     */
    public function mean($numbers) {
        if (empty($numbers)) return "خطا: آرایه خالی است";
        return array_sum($numbers) / count($numbers);
    }

    /**
     * واریانس نمونه‌ای
     * @param array $numbers
     * @return float|string
     */
    public function varianceSample($numbers) {
        if (count($numbers) < 2) return "خطا: حداقل دو مقدار لازم است";
        $mean = $this->mean($numbers);
        $squaredDiffs = array_map(function($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $numbers);
        return array_sum($squaredDiffs) / (count($numbers) - 1);
    }

    /**
     * انحراف معیار نمونه‌ای
     * @param array $numbers
     * @return float|string
     */
    public function standardDeviation($numbers) {
        $variance = $this->varianceSample($numbers);
        return is_string($variance) ? $variance : sqrt($variance);
    }

    /**
     * میانه اعداد
     * @param array $numbers
     * @return float|string
     */
    public function median($numbers) {
        if (empty($numbers)) return "خطا: آرایه خالی است";
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
     * مد اعداد
     * @param array $numbers
     * @return mixed|string
     */
    public function mode($numbers) {
        if (empty($numbers)) return "خطا: آرایه خالی است";
        $values = array_count_values($numbers);
        return array_search(max($values), $values);
    }

    /**
     * دامنه اعداد
     * @param array $numbers
     * @return float|string
     */
    public function range($numbers) {
        if (empty($numbers)) return "خطا: آرایه خالی است";
        return max($numbers) - min($numbers);
    }

    /**
     * دترمینان ماتریس
     * @param array $matrix ماتریس مربعی
     * @return float دترمینان
     * @throws Exception در صورت نامعتبر بودن ماتریس
     */
    public function determinant($matrix) {
        if (!is_array($matrix) || empty($matrix)) {
            throw new Exception("خطا: ماتریس خالی یا نامعتبر است");
        }
        $rows = count($matrix);
        if ($rows != count($matrix[0])) {
            throw new Exception("خطا: ماتریس باید مربعی باشد");
        }
        
        if ($rows == 1) {
            return $matrix[0][0]; // ماتریس 1x1
        }
        if ($rows == 2) {
            return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0]; // ماتریس 2x2
        }

        $det = 0;
        for ($i = 0; $i < $rows; $i++) {
            $det += ($i % 2 == 0 ? 1 : -1) * $matrix[0][$i] * $this->determinant($this->minor($matrix, 0, $i));
        }
        return $det;
    }

    /**
     * مینور ماتریس
     * @param array $matrix
     * @param int $row
     * @param int $row
     * @return array
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
     * معکوس ماتریس
     * @param array $matrix
     * @return array|string|null
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
     * ماتریس الحاقی
     * @param array $matrix
     * @return array
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
     * توزیع پواسون
     * @param int $k
     * @param float $lambda
     * @return float|string
     */
    public function poissonDistribution($k, $lambda) {
        if ($k < 0 || $lambda <= 0) {
            return "خطا: ورودی‌ها نامعتبر هستند";
        }
        return ($this->power($lambda, $k) * exp(-$lambda)) / $this->factorial($k);
    }

    /**
     * توزیع نرمال استاندارد
     * @param float $z
     * @return float
     */
    public function standardNormalDistribution($z) {
        return (1 / sqrt(2 * M_PI)) * exp(-0.5 * pow($z, 2));
    }

    /**
     * تابع توزیع تجمعی نرمال
     * @param float $z
     * @return float
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
     * تابع توزیع کای‌دو (CDF)
     * @param float $x
     * @param int $k
     * @return float|string
     */
    public function chiSquareCDF($x, $k) {
        if ($x < 0 || $k < 1) return "خطا: ورودی‌ها نامعتبر هستند";
        if ($x == 0) return 0.0;
        return $this->gammainc($x / 2, $k / 2);
    }

    /**
     * تابع گامای ناقص
     * @param float $x
     * @param float $a
     * @return float
     */
    public function gammainc($x, $a) {
        $g = $this->gamma($a);
        return $this->lowerGamma($x, $a) / $g;
    }

    /**
     * تقریب تابع گاما
     * @param float $z
     * @return float
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
     * تابع گامای ناقص پایین
     * @param float $x
     * @param float $a
     * @return float
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
     * انتگرال به روش جزءبه‌جزء
     * @param callable $u
     * @param callable $dv
     * @param float $a
     * @param float $b
     * @return float
     */
    public function integralByParts($u, $dv, $a, $b) {
        $v = function($x) use ($dv, $a) { return $this->integral($dv, $a, $x); };
        $du = function($x) use ($u) { return $this->derivative($u, $x); };
        return ($u($b) * $v($b) - $u($a) * $v($a)) - $this->integral(function($x) use ($du, $v) {
            return $du($x) * $v($x);
        }, $a, $b);
    }
    
    /**
     * چولگی
     * @param array $numbers
     * @return float|string
     */
    public function skewness($numbers) {
        if (count($numbers) < 2) return "خطا: حداقل دو مقدار لازم است";
        $mean = $this->mean($numbers);
        $n = count($numbers);
        $m3 = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 3);
        }, $numbers)) / $n;
        $stdDev = $this->standardDeviation($numbers);
        if ($stdDev == 0) return "خطا: انحراف معیار صفر است";
        return $n * $m3 / pow($stdDev, 3);
    }

    /**
     * کشیدگی (Excess Kurtosis)
     * @param array $numbers
     * @return float|string
     */
    public function kurtosis($numbers) {
        if (count($numbers) < 2) return "خطا: حداقل دو مقدار لازم است";
        $mean = $this->mean($numbers);
        $n = count($numbers);
        $m4 = array_sum(array_map(function($x) use ($mean) {
            return pow($x - $mean, 4);
        }, $numbers)) / $n;
        $stdDev = $this->standardDeviation($numbers);
        if ($stdDev == 0) return "خطا: انحراف معیار صفر است";
        return $n * $m4 / pow($stdDev, 4) - 3; // Excess kurtosis
    }

    /**
     * دامنه بین‌چارکی
     * @param array $numbers
     * @return float|string
     */
    public function interquartileRange($numbers) {
        if (count($numbers) < 4) return "خطا: حداقل چهار مقدار لازم است";
        sort($numbers);
        $q1 = $this->median(array_slice($numbers, 0, floor(count($numbers) / 2)));
        $q3 = $this->median(array_slice($numbers, ceil(count($numbers) / 2)));
        return $q3 - $q1;
    }

    /**
     * فاصله اقلیدسی بین دو بردار
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string فاصله اقلیدسی
     */
    public function euclideanDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += pow($vector1[$i] - $vector2[$i], 2);
        }
        return sqrt($sum);
    }

    /**
     * فاصله منهتن بین دو بردار
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string فاصله منهتن
     */
    public function manhattanDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += abs($vector1[$i] - $vector2[$i]);
        }
        return $sum;
    }

    /**
     * فاصله چبیشف بین دو بردار
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string فاصله چبیشف
     */
    public function chebyshevDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        $maxDiff = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $diff = abs($vector1[$i] - $vector2[$i]);
            $maxDiff = max($maxDiff, $diff);
        }
        return $maxDiff;
    }

    /**
     * فاصله مینکوفسکی بین دو بردار
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @param int $p مرتبه (مثلاً 1 برای منهتن، 2 برای اقلیدسی)
     * @return float|string فاصله مینکوفسکی
     */
    public function minkowskiDistance($vector1, $vector2, $p = 2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        if ($p <= 0) return "خطا: p باید مثبت باشد";
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += pow(abs($vector1[$i] - $vector2[$i]), $p);
        }
        return pow($sum, 1 / $p);
    }

    /**
     * فاصله کسینوسی بین دو بردار
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string فاصله کسینوسی (1 - شباهت کسینوسی)
     */
    public function cosineDistance($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        $similarity = $this->cosineSimilarity($vector1, $vector2);
        if (is_string($similarity)) return $similarity;
        return 1 - $similarity;
    }

    // توابع شباهت (Similarity Functions)
    /**
     * شباهت کسینوسی بین دو بردار
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string شباهت کسینوسی (بین 0 و 1)
     */
    public function cosineSimilarity($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
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
        if ($norm1 == 0 || $norm2 == 0) return "خطا: بردار صفر قابل محاسبه نیست";
        return $dotProduct / ($norm1 * $norm2);
    }

    /**
     * شباهت جاکارد بین دو مجموعه
     * @param array $set1 مجموعه اول
     * @param array $set2 مجموعه دوم
     * @return float|string شباهت جاکارد (بین 0 و 1)
     */
    public function jaccardSimilarity($set1, $set2) {
        $intersection = count(array_intersect($set1, $set2));
        $union = count(array_unique(array_merge($set1, $set2)));
        if ($union == 0) return "خطا: مجموعه‌ها خالی هستند";
        return $intersection / $union;
    }

    /**
     * شباهت پیرسون (همبستگی خطی)
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string ضریب همبستگی پیرسون (بین -1 و 1)
     */
    public function pearsonSimilarity($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        $n = count($vector1);
        if ($n == 0) return "خطا: بردارها خالی هستند";

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
        if ($denominator == 0) return "خطا: واریانس صفر است";
        return $numerator / $denominator;
    }

    /**
     * شباهت نقطه‌ای (حاصل‌ضرب داخلی)
     * @param array $vector1 بردار اول
     * @param array $vector2 بردار دوم
     * @return float|string حاصل‌ضرب داخلی
     */
    public function dotProductSimilarity($vector1, $vector2) {
        if (count($vector1) != count($vector2)) return "خطا: طول بردارها باید برابر باشد";
        $sum = 0;
        for ($i = 0; $i < count($vector1); $i++) {
            $sum += $vector1[$i] * $vector2[$i];
        }
        return $sum;
    }

// رگرسیون خطی ساده (Linear Regression)
    /**
     * محاسبه ضرایب رگرسیون خطی (y = mx + b)
     * @param array $x آرایه مقادیر مستقل
     * @param array $y آرایه مقادیر وابسته
     * @return array|string ضرایب [m, b] یا خطا
     */
    public function linearRegression($x, $y) {
        if (count($x) != count($y) || empty($x)) return "خطا: داده‌ها نامعتبر هستند";
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

    // K-Nearest Neighbors (KNN) برای دسته‌بندی
    /**
     * پیش‌بینی دسته با استفاده از KNN
     * @param array $data داده‌های آموزشی (آرایه‌ای از [ویژگی‌ها, برچسب])
     * @param array $point نقطه جدید برای پیش‌بینی (ویژگی‌ها)
     * @param int $k تعداد همسایگان
     * @return mixed|string برچسب پیش‌بینی‌شده یا خطا
     */
    public function knnClassify($data, $point, $k = 3) {
        if (empty($data) || $k < 1 || count($point) != count($data[0][0])) return "خطا: داده‌ها نامعتبر هستند";
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
        return key($votes); // برچسب با بیشترین رای
    }

    // SVM ساده (Linear SVM)
    /**
     * دسته‌بندی خطی با SVM (فرض جداپذیری خطی)
     * @param array $data داده‌های آموزشی ([ویژگی‌ها, برچسب])
     * @param array $point نقطه جدید
     * @return int|string برچسب (1 یا -1) یا خطا
     */
    public function svmClassify($data, $point) {
        if (empty($data) || count($point) != count($data[0][0])) return "خطا: داده‌ها نامعتبر هستند";
        $w = array_fill(0, count($point), 0); // وزن‌ها
        $b = 0; // بایاس
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
     * خوشه‌بندی با DBSCAN
     * @param array $data داده‌ها (آرایه‌ای از بردارها)
     * @param float $eps حداکثر فاصله
     * @param int $minPts حداقل نقاط برای هسته
     * @return array|string خوشه‌ها یا خطا
     */
    public function dbscan($data, $eps, $minPts) {
        if (empty($data)) return "خطا: داده‌ها خالی هستند";
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
     * خوشه‌بندی با k-Means
     * @param array $data داده‌ها (آرایه‌ای از بردارها)
     * @param int $k تعداد خوشه‌ها
     * @param int $maxIterations حداکثر تکرارها
     * @return array|string خوشه‌ها یا خطا
     */
    public function kMeans($data, $k, $maxIterations = 100) {
        if (empty($data) || $k < 1 || $k > count($data)) return "خطا: داده‌ها یا k نامعتبر هستند";
        $centroids = array_slice($data, 0, $k); // شروع تصادفی
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

    // Least Squares (حداقل مربعات)
    /**
     * حل حداقل مربعات برای رگرسیون خطی
     * @param array $x آرایه مقادیر مستقل
     * @param array $y آرایه مقادیر وابسته
     * @return array|string ضرایب [m, b] یا خطا
     */
    public function leastSquares($x, $y) {
        return $this->linearRegression($x, $y); // مشابه رگرسیون خطی ساده
    }

    // Support Vector Regression (SVR) - ساده‌شده
    /**
     * رگرسیون با SVR (خطی ساده)
     * @param array $data داده‌های آموزشی ([ویژگی‌ها, مقدار])
     * @param array $point نقطه جدید
     * @param float $epsilon حاشیه خطا
     * @return float|string مقدار پیش‌بینی‌شده یا خطا
     */
    public function svrPredict($data, $point, $epsilon = 0.1) {
        if (empty($data) || count($point) != count($data[0][0])) return "خطا: داده‌ها نامعتبر هستند";
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
     * دسته‌بندی با Naive Bayes (با فرض توزیع نرمال)
     * @param array $data داده‌های آموزشی ([ویژگی‌ها, برچسب])
     * @param array $point نقطه جدید
     * @return string|int برچسب پیش‌بینی‌شده یا خطا
     */
    public function naiveBayesClassify($data, $point) {
        if (empty($data) || count($point) != count($data[0][0])) return "خطا: داده‌ها نامعتبر هستند";
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
                if ($var == 0) $var = 1e-6; // جلوگیری از تقسیم بر صفر
                $prob += -0.5 * log(2 * M_PI * $var) - pow($point[$i] - $mean, 2) / (2 * $var);
            }
            $probs[$class] = $prob;
        }
        arsort($probs);
        return key($probs);
    }

    /**
     * اجرای تست برای تمامی توابع کلاس
     * @return void
     */
    public function runTests() {
        echo "آغاز تست توابع کلاس MathCalculations:\n";
        echo "----------------------------------------\n";

        // عملیات‌های پایه
        echo "add(5, 3): " . $this->add(5, 3) . "\n"; // انتظار: 8
        echo "subtract(10, 4): " . $this->subtract(10, 4) . "\n"; // انتظار: 6
        echo "multiply(6, 2): " . $this->multiply(6, 2) . "\n"; // انتظار: 12
        echo "divide(15, 3): " . $this->divide(15, 3) . "\n"; // انتظار: 5
        echo "divide(10, 0): " . $this->divide(10, 0) . "\n"; // انتظار: خطا

        // Algebra
        echo "quadraticFormula(1, -3, 2): " . json_encode($this->quadraticFormula(1, -3, 2)) . "\n"; // انتظار: [2, 1]
        echo "quadraticFormula(1, 0, 1): " . json_encode($this->quadraticFormula(1, 0, 1)) . "\n"; // انتظار: null
        echo "absoluteValue(-5): " . $this->absoluteValue(-5) . "\n"; // انتظار: 5
        echo "power(2, 3): " . $this->power(2, 3) . "\n"; // انتظار: 8
        echo "squareRoot(16): " . $this->squareRoot(16) . "\n"; // انتظار: 4
        echo "squareRoot(-4): " . $this->squareRoot(-4) . "\n"; // انتظار: خطا
        echo "cubicFormula(1, -6, 11, -6): " . json_encode($this->cubicFormula(1, -6, 11, -6)) . "\n"; // انتظار: [1, 2, 3]
        echo "polynomialRoots([1, -3, 2]): " . json_encode($this->polynomialRoots([1, -3, 2])) . "\n"; // انتظار: [2, 1]
        echo "lcm(12, 18): " . $this->lcm(12, 18) . "\n"; // انتظار: 36
        echo "gcd(48, 18): " . $this->gcd(48, 18) . "\n"; // انتظار: 6

        // Calculus
        $f = function($x) { return $x * $x; }; // تابع نمونه: x^2
        echo "derivative(x^2, 2): " . $this->derivative($f, 2) . "\n"; // انتظار: ~4
        echo "integral(x^2, 0, 2): " . $this->integral($f, 0, 2) . "\n"; // انتظار: ~2.67
        echo "limit(x^2, 1): " . $this->limit($f, 1) . "\n"; // انتظار: ~1
        echo "secondDerivative(x^2, 2): " . $this->secondDerivative($f, 2) . "\n"; // انتظار: ~2
        echo "meanValueTheorem(x^2, 0, 2): " . $this->meanValueTheorem($f, 0, 2) . "\n"; // انتظار: 2

        // Trigonometric Functions
        echo "sin(30): " . $this->sin(30) . "\n"; // انتظار: 0.5
        echo "cos(60): " . $this->cos(60) . "\n"; // انتظار: 0.5
        echo "tan(45): " . $this->tan(45) . "\n"; // انتظار: ~1
        echo "sec(0): " . $this->sec(0) . "\n"; // انتظار: 1
        echo "cosec(90): " . $this->cosec(90) . "\n"; // انتظار: 1
        echo "cot(45): " . $this->cot(45) . "\n"; // انتظار: ~1
        echo "arcsin(0.5): " . $this->arcsin(0.5) . "\n"; // انتظار: 30
        echo "arccos(0.5): " . $this->arccos(0.5) . "\n"; // انتظار: 60
        echo "arctan(1): " . $this->arctan(1) . "\n"; // انتظار: 45

        // Exponential and Logarithmic Functions
        echo "exponential(1): " . $this->exponential(1) . "\n"; // انتظار: ~2.718
        echo "logarithm(100, 10): " . $this->logarithm(100, 10) . "\n"; // انتظار: 2
        echo "naturalLog(2.718): " . $this->naturalLog(2.718) . "\n"; // انتظار: ~1
        echo "logBase10(1000): " . $this->logBase10(1000) . "\n"; // انتظار: 3

        // Series and Sequences
        echo "arithmeticSequence(1, 2, 5): " . $this->arithmeticSequence(1, 2, 5) . "\n"; // انتظار: 9
        echo "geometricSequence(2, 3, 4): " . $this->geometricSequence(2, 3, 4) . "\n"; // انتظار: 54
        echo "fibonacci(6): " . $this->fibonacci(6) . "\n"; // انتظار: 8
        echo "taylorSeriesExponential(1, 5): " . $this->taylorSeriesExponential(1, 5) . "\n"; // انتظار: ~2.708
        echo "taylorSeriesSin(30, 5): " . $this->taylorSeriesSin(deg2rad(30), 5) . "\n"; // انتظار: ~0.5
        echo "taylorSeriesCos(60, 5): " . $this->taylorSeriesCos(deg2rad(60), 5) . "\n"; // انتظار: ~0.5
        echo "factorial(5): " . $this->factorial(5) . "\n"; // انتظار: 120

        // Matrix Operations
        $matrixA = [[1, 2], [3, 4]];
        $matrixB = [[5, 6], [7, 8]];
        echo "matrixAddition([[1,2],[3,4]], [[5,6],[7,8]]): " . json_encode($this->matrixAddition($matrixA, $matrixB)) . "\n"; // انتظار: [[6,8],[10,12]]
        echo "matrixMultiplication([[1,2],[3,4]], [[5,6],[7,8]]): " . json_encode($this->matrixMultiplication($matrixA, $matrixB)) . "\n"; // انتظار: [[19,22],[43,50]]
        echo "transpose([[1,2],[3,4]]): " . json_encode($this->transpose($matrixA)) . "\n"; // انتظار: [[1,3],[2,4]]

        // Additional Functions
        echo "combination(5, 2): " . $this->combination(5, 2) . "\n"; // انتظار: 10
        echo "permutation(5, 2): " . $this->permutation(5, 2) . "\n"; // انتظار: 20
        $numbers = [1, 2, 3, 4, 5];
        echo "mean([1,2,3,4,5]): " . $this->mean($numbers) . "\n"; // انتظار: 3
        echo "varianceSample([1,2,3,4,5]): " . $this->varianceSample($numbers) . "\n"; // انتظار: 2.5
        echo "standardDeviation([1,2,3,4,5]): " . $this->standardDeviation($numbers) . "\n"; // انتظار: ~1.58
        echo "median([1,2,3,4,5]): " . $this->median($numbers) . "\n"; // انتظار: 3
        echo "mode([1,2,2,3,4]): " . $this->mode([1, 2, 2, 3, 4]) . "\n"; // انتظار: 2
        echo "range([1,2,3,4,5]): " . $this->range($numbers) . "\n"; // انتظار: 4
        echo "determinant([[1,2],[3,4]]): " . $this->determinant($matrixA) . "\n"; // انتظار: -2
        echo "inverse([[1,2],[3,4]]): " . json_encode($this->inverse($matrixA)) . "\n"; // انتظار: [[-2,1],[1.5,-0.5]]

        // Statistical Distributions
        echo "poissonDistribution(2, 1.5): " . $this->poissonDistribution(2, 1.5) . "\n"; // انتظار: ~0.251
        echo "standardNormalDistribution(0): " . $this->standardNormalDistribution(0) . "\n"; // انتظار: ~0.399
        echo "cumulativeNormalDistribution(1): " . $this->cumulativeNormalDistribution(1) . "\n"; // انتظار: ~0.841
        echo "chiSquareCDF(2, 2): " . $this->chiSquareCDF(2, 2) . "\n"; // انتظار: ~0.632

        // Additional Calculus Functions
        $u = function($x) { return $x; };
        $dv = function($x) { return $x; };
        echo "integralByParts(x, x, 0, 1): " . $this->integralByParts($u, $dv, 0, 1) . "\n"; // انتظار: ~0.333

        // Additional Statistical Functions
        echo "skewness([1,2,2,3,4]): " . $this->skewness([1, 2, 2, 3, 4]) . "\n"; // انتظار: ~0.261
        echo "kurtosis([1,2,2,3,4]): " . $this->kurtosis([1, 2, 2, 3, 4]) . "\n"; // انتظار: ~-1.3
        echo "interquartileRange([1,2,3,4,5,6,7]): " . $this->interquartileRange([1, 2, 3, 4, 5, 6, 7]) . "\n"; // انتظار: 3

        $x = [1, 2, 3, 4, 5];
        $y = [2, 4, 5, 4, 5];
        echo "linearRegression([1,2,3,4,5], [2,4,5,4,5]): " . json_encode($this->linearRegression($x, $y)) . "\n"; // [m, b]

        $knnData = [[[1, 2], 0], [[2, 3], 0], [[5, 5], 1], [[6, 7], 1]];
        echo "knnClassify(data, [3, 4], 3): " . $this->knnClassify($knnData, [3, 4], 3) . "\n"; // 0 یا 1

        $svmData = [[[1, 1], 1], [[2, 2], 1], [[3, 3], -1], [[4, 4], -1]];
        echo "svmClassify(data, [2, 2]): " . $this->svmClassify($svmData, [2, 2]) . "\n"; // 1 یا -1

        $dbscanData = [[1, 2], [2, 2], [2, 3], [8, 7], [8, 8], [25, 80]];
        echo "dbscan(data, 2, 3): " . json_encode($this->dbscan($dbscanData, 2, 3)) . "\n";

        $kmeansData = [[1, 2], [1, 4], [1, 0], [10, 2], [10, 4], [10, 0]];
        echo "kMeans(data, 2): " . json_encode($this->kMeans($kmeansData, 2)) . "\n";

        echo "leastSquares([1,2,3,4,5], [2,4,5,4,5]): " . json_encode($this->leastSquares($x, $y)) . "\n";

        $svrData = [[[1, 1], 2], [[2, 2], 4], [[3, 3], 6]];
        echo "svrPredict(data, [2, 2]): " . $this->svrPredict($svrData, [2, 2]) . "\n";

        $nbData = [[[1, 2], 'A'], [[2, 3], 'A'], [[5, 5], 'B'], [[6, 7], 'B']];
        echo "naiveBayesClassify(data, [3, 4]): " . $this->naiveBayesClassify($nbData, [3, 4]) . "\n";

        // تست توابع فاصله
        $v1 = [1, 2, 3];
        $v2 = [4, 5, 6];
        echo "euclideanDistance([1,2,3], [4,5,6]): " . $this->euclideanDistance($v1, $v2) . "\n"; // ~5.196
        echo "manhattanDistance([1,2,3], [4,5,6]): " . $this->manhattanDistance($v1, $v2) . "\n"; // 9
        echo "chebyshevDistance([1,2,3], [4,5,6]): " . $this->chebyshevDistance($v1, $v2) . "\n"; // 3
        echo "minkowskiDistance([1,2,3], [4,5,6], 1): " . $this->minkowskiDistance($v1, $v2, 1) . "\n"; // 9
        echo "minkowskiDistance([1,2,3], [4,5,6], 2): " . $this->minkowskiDistance($v1, $v2, 2) . "\n"; // ~5.196
        echo "cosineDistance([1,2,3], [4,5,6]): " . $this->cosineDistance($v1, $v2) . "\n"; // ~0.025

        // تست توابع شباهت
        echo "cosineSimilarity([1,2,3], [4,5,6]): " . $this->cosineSimilarity($v1, $v2) . "\n"; // ~0.974
        echo "jaccardSimilarity([1,2,3], [2,3,4]): " . $this->jaccardSimilarity([1, 2, 3], [2, 3, 4]) . "\n"; // 0.5
        echo "pearsonSimilarity([1,2,3], [2,4,6]): " . $this->pearsonSimilarity([1, 2, 3], [2, 4, 6]) . "\n"; // 1
        echo "dotProductSimilarity([1,2,3], [4,5,6]): " . $this->dotProductSimilarity($v1, $v2) . "\n"; // 32

        echo "----------------------------------------\n";
        echo "پایان تست‌ها\n";
    }
}

$math = new MathCalculations();
$math->runTests();
?>