<?php

class ChemistryCalculations {
    // ثابت‌های شیمیایی
    const R = 8.314462618; // ثابت گازها (J/mol·K)
    const NA = 6.02214076e23; // عدد آووگادرو (1/mol)
    const KB = 1.380649e-23; // ثابت بولتزمان (J/K)
    const H = 6.62607015e-34; // ثابت پلانک (J·s)
    const C = 299792458; // سرعت نور (m/s)
    const F = 96485.33212; // ثابت فارادی (C/mol)
    const ATM_TO_PA = 101325; // تبدیل اتمسفر به پاسکال (Pa)
    const CAL_TO_J = 4.184; // تبدیل کالری به ژول (J)
    const KW = 1e-14; // ثابت تفکیک آب در 25°C

    // جدول تناوبی (اطلاعات پایه برای چند عنصر، قابل گسترش)
    private $periodicTable = [
        1 => ['symbol' => 'H', 'name' => 'Hydrogen', 'atomicMass' => 1.00794, 'electronegativity' => 2.20],
        2 => ['symbol' => 'He', 'name' => 'Helium', 'atomicMass' => 4.00260, 'electronegativity' => null],
        3 => ['symbol' => 'Li', 'name' => 'Lithium', 'atomicMass' => 6.941, 'electronegativity' => 0.98],
        4 => ['symbol' => 'Be', 'name' => 'Beryllium', 'atomicMass' => 9.01218, 'electronegativity' => 1.57],
        5 => ['symbol' => 'B', 'name' => 'Boron', 'atomicMass' => 10.811, 'electronegativity' => 2.04],
        6 => ['symbol' => 'C', 'name' => 'Carbon', 'atomicMass' => 12.0107, 'electronegativity' => 2.55],
        7 => ['symbol' => 'N', 'name' => 'Nitrogen', 'atomicMass' => 14.0067, 'electronegativity' => 3.04],
        8 => ['symbol' => 'O', 'name' => 'Oxygen', 'atomicMass' => 15.9994, 'electronegativity' => 3.44],
        // ... سایر عناصر تا 118 قابل اضافه شدن هستند
        118 => ['symbol' => 'Og', 'name' => 'Oganesson', 'atomicMass' => 294, 'electronegativity' => null],
    ];

    // دسترسی به جدول تناوبی
    /**
     * دریافت جرم مولی یک عنصر
     * @param int|string $identifier شماره اتمی یا نماد عنصر
     * @return float|string جرم مولی (g/mol) یا خطا
     */
    public function getAtomicMass($identifier) {
        if (is_numeric($identifier)) {
            $atomicNumber = (int)$identifier;
            if (isset($this->periodicTable[$atomicNumber])) {
                return $this->periodicTable[$atomicNumber]['atomicMass'];
            }
        } elseif (is_string($identifier)) {
            foreach ($this->periodicTable as $data) {
                if ($data['symbol'] === $identifier) {
                    return $data['atomicMass'];
                }
            }
        }
        return "خطا: عنصر یافت نشد";
    }

    /**
     * دریافت الکترونگاتیویته یک عنصر
     * @param int|string $identifier شماره اتمی یا نماد عنصر
     * @return float|null|string الکترونگاتیویته یا خطا
     */
    public function getElectronegativity($identifier) {
        if (is_numeric($identifier)) {
            $atomicNumber = (int)$identifier;
            if (isset($this->periodicTable[$atomicNumber])) {
                return $this->periodicTable[$atomicNumber]['electronegativity'];
            }
        } elseif (is_string($identifier)) {
            foreach ($this->periodicTable as $data) {
                if ($data['symbol'] === $identifier) {
                    return $data['electronegativity'];
                }
            }
        }
        return "خطا: عنصر یافت نشد";
    }

    // شیمی عمومی
    /**
     * محاسبه جرم مولی (m = n * M)
     * @param float $n تعداد مول (mol)
     * @param float $molarMass جرم مولی (g/mol)
     * @return float جرم (g)
     */
    public function molarMassToMass($n, $molarMass) {
        if ($n < 0 || $molarMass < 0) return "خطا: مقادیر باید نامنفی باشند";
        return $n * $molarMass;
    }

    /**
     * محاسبه تعداد مول (n = m / M)
     * @param float $mass جرم (g)
     * @param float $molarMass جرم مولی (g/mol)
     * @return float تعداد مول (mol)
     */
    public function massToMoles($mass, $molarMass) {
        if ($mass < 0 || $molarMass <= 0) return "خطا: مقادیر باید معتبر باشند";
        return $mass / $molarMass;
    }

    /**
     * محاسبه تعداد ذرات (N = n * NA)
     * @param float $n تعداد مول (mol)
     * @return float تعداد ذرات
     */
    public function molesToParticles($n) {
        if ($n < 0) return "خطا: تعداد مول باید نامنفی باشد";
        return $n * self::NA;
    }

    /**
     * غلظت مولی (C = n / V)
     * @param float $n تعداد مول (mol)
     * @param float $v حجم (L)
     * @return float غلظت (mol/L)
     */
    public function molarConcentration($n, $v) {
        if ($n < 0 || $v <= 0) return "خطا: مقادیر باید معتبر باشند";
        return $n / $v;
    }

    /**
     * استوکیومتری: محاسبه مقدار ماده بر اساس ضرایب موازنه
     * @param float $knownMoles مول ماده معلوم (mol)
     * @param int $coeffKnown ضریب ماده معلوم
     * @param int $coeffUnknown ضریب ماده مجهول
     * @return float مول ماده مجهول (mol)
     */
    public function stoichiometry($knownMoles, $coeffKnown, $coeffUnknown) {
        if ($knownMoles < 0 || $coeffKnown <= 0 || $coeffUnknown <= 0) return "خطا: مقادیر باید معتبر باشند";
        return $knownMoles * ($coeffUnknown / $coeffKnown);
    }

    /**
     * حجم گاز ایده‌آل (V = nRT / P)
     * @param float $n تعداد مول (mol)
     * @param float $t دما (K)
     * @param float $p فشار (Pa)
     * @return float حجم (m³)
     */
    public function idealGasVolume($n, $t, $p) {
        if ($n < 0 || $t <= 0 || $p <= 0) return "خطا: مقادیر باید معتبر باشند";
        return ($n * self::R * $t) / $p;
    }

    // ترمودینامیک شیمیایی
    /**
     * تغییر آنتالپی واکنش (ΔH = ΣH_products - ΣH_reactants)
     * @param array $products آنتالپی محصولات (J/mol)
     * @param array $reactants آنتالپی واکنش‌دهنده‌ها (J/mol)
     * @return float تغییر آنتالپی (J/mol)
     */
    public function enthalpyChange($products, $reactants) {
        if (empty($products) || empty($reactants)) return "خطا: داده‌ها خالی هستند";
        return array_sum($products) - array_sum($reactants);
    }

    /**
     * تغییر آنتروپی واکنش (ΔS = ΣS_products - ΣS_reactants)
     * @param array $products آنتروپی محصولات (J/mol·K)
     * @param array $reactants آنتروپی واکنش‌دهنده‌ها (J/mol·K)
     * @return float تغییر آنتروپی (J/mol·K)
     */
    public function entropyChange($products, $reactants) {
        if (empty($products) || empty($reactants)) return "خطا: داده‌ها خالی هستند";
        return array_sum($products) - array_sum($reactants);
    }

    /**
     * انرژی آزاد گیبس (ΔG = ΔH - TΔS)
     * @param float $deltaH تغییر آنتالپی (J/mol)
     * @param float $t دما (K)
     * @param float $deltaS تغییر آنتروپی (J/mol·K)
     * @return float انرژی آزاد (J/mol)
     */
    public function gibbsFreeEnergy($deltaH, $t, $deltaS) {
        if ($t < 0) return "خطا: دما باید نامنفی باشد";
        return $deltaH - $t * $deltaS;
    }

    /**
     * ثابت تعادل از انرژی گیبس (K = e^(-ΔG/RT))
     * @param float $deltaG انرژی آزاد گیبس (J/mol)
     * @param float $t دما (K)
     * @return float ثابت تعادل
     */
    public function equilibriumConstantFromGibbs($deltaG, $t) {
        if ($t <= 0) return "خطا: دما باید مثبت باشد";
        return exp(-$deltaG / (self::R * $t));
    }

    /**
     * فشار تعادل برای گازها (Kp = Kc * (RT)^Δn)
     * @param float $kc ثابت تعادل غلظتی
     * @param float $t دما (K)
     * @param int $deltaN تغییر تعداد مول گازها
     * @return float ثابت تعادل فشاری
     */
    public function equilibriumPressureConstant($kc, $t, $deltaN) {
        if ($t <= 0) return "خطا: دما باید مثبت باشد";
        return $kc * pow(self::R * $t, $deltaN);
    }

    // شیمی فیزیکی
    /**
     * فشار بخار با معادله کلازیوس-کلاپیرون (ln(P₂/P₁) = -ΔH_vap/R * (1/T₂ - 1/T₁))
     * @param float $p1 فشار بخار اولیه (Pa)
     * @param float $t1 دمای اولیه (K)
     * @param float $t2 دمای نهایی (K)
     * @param float $deltaHvap آنتالپی تبخیر (J/mol)
     * @return float فشار بخار نهایی (Pa)
     */
    public function clausiusClapeyron($p1, $t1, $t2, $deltaHvap) {
        if ($p1 <= 0 || $t1 <= 0 || $t2 <= 0 || $deltaHvap < 0) return "خطا: مقادیر باید معتبر باشند";
        $term = -$deltaHvap / self::R * (1 / $t2 - 1 / $t1);
        return $p1 * exp($term);
    }

    /**
     * سرعت واکنش (v = k[A]^m[B]^n)
     * @param float $k ثابت سرعت (واحد وابسته به مرتبه)
     * @param float $concA غلظت A (mol/L)
     * @param float $m مرتبه نسبت به A
     * @param float $concB غلظت B (mol/L)
     * @param float $n مرتبه نسبت به B
     * @return float سرعت (mol/L·s)
     */
    public function reactionRate($k, $concA, $m, $concB, $n) {
        if ($k < 0 || $concA < 0 || $concB < 0) return "خطا: مقادیر باید نامنفی باشند";
        return $k * pow($concA, $m) * pow($concB, $n);
    }

    /**
     * انرژی فعال‌سازی با معادله آرنیوس (k = A * e^(-Ea/RT))
     * @param float $a فاکتور پیش‌فرکانس
     * @param float $ea انرژی فعال‌سازی (J/mol)
     * @param float $t دما (K)
     * @return float ثابت سرعت (s^-1 یا وابسته به واحدها)
     */
    public function arrheniusRateConstant($a, $ea, $t) {
        if ($a <= 0 || $t <= 0) return "خطا: مقادیر باید مثبت باشند";
        return $a * exp(-$ea / (self::R * $t));
    }

    /**
     * معادله وان‌در‌والس برای فشار گاز واقعی (P = nRT/(V-nb) - a(n/V)²)
     * @param float $n تعداد مول (mol)
     * @param float $t دما (K)
     * @param float $v حجم (m³)
     * @param float $a ثابت وان‌در‌والس (Pa·m⁶/mol²)
     * @param float $b ثابت وان‌در‌والس (m³/mol)
     * @return float فشار (Pa)
     */
    public function vanDerWaalsPressure($n, $t, $v, $a, $b) {
        if ($n < 0 || $t <= 0 || $v <= $n * $b) return "خطا: مقادیر باید معتبر باشند";
        return ($n * self::R * $t) / ($v - $n * $b) - $a * pow($n / $v, 2);
    }

    // شیمی تجزیه
    /**
     * pH محلول (pH = -log10[H⁺])
     * @param float $hConcentration غلظت H⁺ (mol/L)
     * @return float pH
     */
    public function pH($hConcentration) {
        if ($hConcentration <= 0) return "خطا: غلظت باید مثبت باشد";
        return -log10($hConcentration);
    }

    /**
     * pOH محلول (pOH = -log10[OH⁻])
     * @param float $ohConcentration غلظت OH⁻ (mol/L)
     * @return float pOH
     */
    public function pOH($ohConcentration) {
        if ($ohConcentration <= 0) return "خطا: غلظت باید مثبت باشد";
        return -log10($ohConcentration);
    }

    /**
     * ثابت تعادل اسید (Ka = [H⁺][A⁻]/[HA])
     * @param float $hConcentration غلظت H⁺ (mol/L)
     * @param float $aConcentration غلظت A⁻ (mol/L)
     * @param float $haConcentration غلظت HA (mol/L)
     * @return float ثابت تعادل اسید
     */
    public function acidDissociationConstant($hConcentration, $aConcentration, $haConcentration) {
        if ($hConcentration < 0 || $aConcentration < 0 || $haConcentration <= 0) return "خطا: مقادیر باید معتبر باشند";
        return ($hConcentration * $aConcentration) / $haConcentration;
    }

    /**
     * تیتراسیون: حجم معادل برای اسید و باز (V_eq = n * M_base * V_base / M_acid)
     * @param float $n تعداد معادل‌ها
     * @param float $mBase غلظت باز (mol/L)
     * @param float $vBase حجم باز (L)
     * @param float $mAcid غلظت اسید (mol/L)
     * @return float حجم معادل (L)
     */
    public function titrationEquivalentVolume($n, $mBase, $vBase, $mAcid) {
        if ($n <= 0 || $mBase <= 0 || $vBase < 0 || $mAcid <= 0) return "خطا: مقادیر باید معتبر باشند";
        return $n * $mBase * $vBase / $mAcid;
    }

    /**
     * پتانسیل سلول (E_cell = E_cathode - E_anode)
     * @param float $eCathode پتانسیل کاتد (V)
     * @param float $eAnode پتانسیل آند (V)
     * @return float پتانسیل سلول (V)
     */
    public function cellPotential($eCathode, $eAnode) {
        return $eCathode - $eAnode;
    }

    /**
     * معادله نرنست (E = E° - (RT/nF) * ln(Q))
     * @param float $eStandard پتانسیل استاندارد (V)
     * @param float $t دما (K)
     * @param int $n تعداد الکترون‌ها
     * @param float $q ثابته واکنش
     * @return float پتانسیل سلول (V)
     */
    public function nernstEquation($eStandard, $t, $n, $q) {
        if ($t <= 0 || $n <= 0 || $q <= 0) return "خطا: مقادیر باید معتبر باشند";
        return $eStandard - (self::R * $t / ($n * self::F)) * log($q);
    }

    /**
     * طول موج جذبی (λ = hc/E)
     * @param float $energy انرژی (J)
     * @return float طول موج (m)
     */
    public function absorptionWavelength($energy) {
        if ($energy <= 0) return "خطا: انرژی باید مثبت باشد";
        return (self::H * self::C) / $energy;
    }

    // شیمی آلی
    /**
     * محاسبه درصد جرم یک عنصر در ترکیب (mass% = (mass_element / mass_compound) * 100)
     * @param float $massElement جرم عنصر (g)
     * @param float $massCompound جرم کل ترکیب (g)
     * @return float درصد جرم (%)
     */
    public function massPercent($massElement, $massCompound) {
        if ($massElement < 0 || $massCompound <= 0) return "خطا: مقادیر باید معتبر باشند";
        return ($massElement / $massCompound) * 100;
    }

    /**
     * تعداد اتم‌های هیدروژن در هیدروکربن (H = 2C + 2 - 2R - X + N)
     * @param int $c تعداد کربن‌ها
     * @param int $r تعداد حلقه‌ها
     * @param int $x تعداد هالوژن‌ها
     * @param int $n تعداد نیتروژن‌ها
     * @return int تعداد هیدروژن‌ها
     */
    public function hydrocarbonHydrogenCount($c, $r, $x = 0, $n = 0) {
        if ($c < 1 || $r < 0 || $x < 0 || $n < 0) return "خطا: مقادیر باید معتبر باشند";
        return 2 * $c + 2 - 2 * $r - $x + $n;
    }

    /**
     * محاسبه جرم مولی ترکیب آلی از فرمول شیمیایی
     * @param string $formula فرمول شیمیایی (مثل "C6H12O6")
     * @return float|string جرم مولی (g/mol) یا خطا
     */
    public function organicMolarMass($formula) {
        $atoms = $this->parseChemicalFormula($formula);
        if ($atoms === false) return "خطا: فرمول نامعتبر است";
        $molarMass = 0;
        foreach ($atoms as $symbol => $count) {
            $atomicMass = $this->getAtomicMass($symbol);
            if (is_string($atomicMass)) return $atomicMass;
            $molarMass += $atomicMass * $count;
        }
        return $molarMass;
    }

    private function parseChemicalFormula($formula) {
        $pattern = '/([A-Z][a-z]?)(\d*)/';
        preg_match_all($pattern, $formula, $matches);
        if (empty($matches[0])) return false;
        $atoms = [];
        for ($i = 0; $i < count($matches[1]); $i++) {
            $symbol = $matches[1][$i];
            $count = $matches[2][$i] === '' ? 1 : (int)$matches[2][$i];
            $atoms[$symbol] = $count;
        }
        return $atoms;
    }

    // شیمی کوانتومی
    /**
     * انرژی اوربیتال هیدروژن‌مانند (E = -13.6 * Z² / n²)
     * @param int $z عدد اتمی
     * @param int $n شماره کوانتومی اصلی
     * @return float انرژی (eV)
     */
    public function hydrogenOrbitalEnergy($z, $n) {
        if ($z < 1 || $n < 1) return "خطا: مقادیر باید مثبت باشند";
        return -13.6 * pow($z, 2) / pow($n, 2);
    }

    /**
     * شعاع اوربیتال بور (r = n² * a₀ / Z)
     * @param int $n شماره کوانتومی اصلی
     * @param int $z عدد اتمی
     * @return float شعاع (m)
     */
    public function bohrOrbitalRadius($n, $z) {
        if ($n < 1 || $z < 1) return "خطا: مقادیر باید مثبت باشند";
        $a0 = 5.29177210903e-11; // شعاع بور (m)
        return pow($n, 2) * $a0 / $z;
    }

    // شیمی هسته‌ای
    /**
     * نیمه‌عمر (N = N₀ * e^(-λt))
     * @param float $n0 مقدار اولیه (kg یا تعداد ذرات)
     * @param float $lambda ثابت واپاشی (1/s)
     * @param float $t زمان (s)
     * @return float مقدار باقی‌مانده
     */
    public function radioactiveDecay($n0, $lambda, $t) {
        if ($n0 < 0 || $lambda < 0 || $t < 0) return "خطا: مقادیر باید نامنفی باشند";
        return $n0 * exp(-$lambda * $t);
    }

    /**
     * انرژی واپاشی (E = Δm * c²)
     * @param float $deltaM کسری جرم (kg)
     * @return float انرژی (J)
     */
    public function nuclearDecayEnergy($deltaM) {
        if ($deltaM < 0) return "خطا: کسری جرم باید نامنفی باشد";
        return $deltaM * pow(self::C, 2);
    }

    // شیمی محیط زیست
    /**
     * pH آب خالص در دمای خاص (pH = -log10(sqrt(Kw)))
     * @param float $t دما (K)
     * @return float pH
     */
    public function waterPH($t) {
        if ($t <= 0) return "خطا: دما باید مثبت باشد";
        // تقریبی برای Kw در دماهای مختلف
        $kw = self::KW * exp(-self::R * (1 / $t - 1 / 298) / 1000);
        return -log10(sqrt($kw));
    }

    // تست کلاس
    /**
     * اجرای تست برای توابع کلاس
     * @return void
     */
    public function runTests() {
        echo "آغاز تست توابع کلاس ChemistryCalculations:\n";
        echo "----------------------------------------\n";

        // جدول تناوبی
        echo "getAtomicMass('H'): " . $this->getAtomicMass('H') . "\n";
        echo "getElectronegativity(6): " . $this->getElectronegativity(6) . "\n";

        // شیمی عمومی
        echo "molarMassToMass(2, 18): " . $this->molarMassToMass(2, 18) . "\n";
        echo "massToMoles(36, 18): " . $this->massToMoles(36, 18) . "\n";
        echo "molesToParticles(1): " . $this->molesToParticles(1) . "\n";
        echo "molarConcentration(0.5, 1): " . $this->molarConcentration(0.5, 1) . "\n";
        echo "stoichiometry(2, 1, 2): " . $this->stoichiometry(2, 1, 2) . "\n";
        echo "idealGasVolume(1, 298, 101325): " . $this->idealGasVolume(1, 298, 101325) . "\n";

        // ترمودینامیک شیمیایی
        echo "enthalpyChange([100, 50], [80, 30]): " . $this->enthalpyChange([100, 50], [80, 30]) . "\n";
        echo "entropyChange([50, 30], [40, 20]): " . $this->entropyChange([50, 30], [40, 20]) . "\n";
        echo "gibbsFreeEnergy(40000, 298, 20): " . $this->gibbsFreeEnergy(40000, 298, 20) . "\n";
        echo "equilibriumConstantFromGibbs(-10000, 298): " . $this->equilibriumConstantFromGibbs(-10000, 298) . "\n";
        echo "equilibriumPressureConstant(0.1, 298, 1): " . $this->equilibriumPressureConstant(0.1, 298, 1) . "\n";

        // شیمی فیزیکی
        echo "clausiusClapeyron(100000, 373, 353, 40670): " . $this->clausiusClapeyron(100000, 373, 353, 40670) . "\n";
        echo "reactionRate(0.1, 0.2, 1, 0.3, 2): " . $this->reactionRate(0.1, 0.2, 1, 0.3, 2) . "\n";
        echo "arrheniusRateConstant(1e10, 50000, 298): " . $this->arrheniusRateConstant(1e10, 50000, 298) . "\n";
        echo "vanDerWaalsPressure(1, 298, 0.024, 0.139, 3.91e-5): " . $this->vanDerWaalsPressure(1, 298, 0.024, 0.139, 3.91e-5) . "\n";

        // شیمی تجزیه
        echo "pH(0.001): " . $this->pH(0.001) . "\n";
        echo "pOH(0.0001): " . $this->pOH(0.0001) . "\n";
        echo "acidDissociationConstant(0.001, 0.001, 0.1): " . $this->acidDissociationConstant(0.001, 0.001, 0.1) . "\n";
        echo "titrationEquivalentVolume(1, 0.1, 0.05, 0.2): " . $this->titrationEquivalentVolume(1, 0.1, 0.05, 0.2) . "\n";
        echo "cellPotential(0.76, -0.13): " . $this->cellPotential(0.76, -0.13) . "\n";
        echo "nernstEquation(0.89, 298, 2, 0.1): " . $this->nernstEquation(0.89, 298, 2, 0.1) . "\n";
        echo "absorptionWavelength(3e-19): " . $this->absorptionWavelength(3e-19) . "\n";

        // شیمی آلی
        echo "massPercent(12, 44): " . $this->massPercent(12, 44) . "\n";
        echo "hydrocarbonHydrogenCount(6, 1): " . $this->hydrocarbonHydrogenCount(6, 1) . "\n";
        echo "organicMolarMass('C6H12O6'): " . $this->organicMolarMass('C6H12O6') . "\n";

        // شیمی کوانتومی
        echo "hydrogenOrbitalEnergy(1, 2): " . $this->hydrogenOrbitalEnergy(1, 2) . "\n";
        echo "bohrOrbitalRadius(2, 1): " . $this->bohrOrbitalRadius(2, 1) . "\n";

        // شیمی هسته‌ای
        echo "radioactiveDecay(1, 0.1, 5): " . $this->radioactiveDecay(1, 0.1, 5) . "\n";
        echo "nuclearDecayEnergy(1e-27): " . $this->nuclearDecayEnergy(1e-27) . "\n";

        // شیمی محیط زیست
        echo "waterPH(298): " . $this->waterPH(298) . "\n";

        echo "----------------------------------------\n";
        echo "پایان تست‌ها\n";
    }
}

// اجرای تست
$chem = new ChemistryCalculations();
$chem->runTests();
?>