<?php

class PhysicsCalculations {
    // ثابت‌های فیزیکی
    const G = 9.81; // شتاب گرانش (m/s²)
    const G_CONST = 6.67430e-11; // ثابت گرانش جهانی (m³/kg·s²)
    const C = 299792458; // سرعت نور در خلا (m/s)
    const K = 8.9875517923e9; // ثابت کولن (N·m²/C²)
    const MU_0 = 1.25663706212e-6; // نفوذپذیری مغناطیسی خلا (H/m)
    const EPSILON_0 = 8.8541878128e-12; // گذردهی الکتریکی خلا (F/m)
    const H = 6.62607015e-34; // ثابت پلانک (J·s)
    const KB = 1.380649e-23; // ثابت بولتزمان (J/K)
    const R = 8.314462618; // ثابت گازها (J/mol·K)
    const NA = 6.02214076e23; // عدد آووگادرو (1/mol)
    const SIGMA = 5.670374419e-8; // ثابت استفان-بولتزمان (W/m²·K⁴)
    const RY = 1.097373156e7; // ثابت ریدبرگ (1/m)
    const ALPHA = 7.2973525693e-3; // ثابت ساختار ریز
    const ME = 9.1093837015e-31; // جرم الکترون (kg)
    const MP = 1.67262192369e-27; // جرم پروتون (kg)

    // مکانیک - سینماتیک
    /**
     * محاسبه سرعت نهایی (v = u + at)
     * @param float $u سرعت اولیه (m/s)
     * @param float $a شتاب (m/s²)
     * @param float $t زمان (s)
     * @return float سرعت نهایی (m/s)
     */
    public function finalVelocity($u, $a, $t) {
        if ($t < 0) return "خطا: زمان نمی‌تواند منفی باشد";
        return $u + $a * $t;
    }

    /**
     * محاسبه مسافت طی‌شده (s = ut + 0.5at²)
     * @param float $u سرعت اولیه (m/s)
     * @param float $a شتاب (m/s²)
     * @param float $t زمان (s)
     * @return float مسافت (m)
     */
    public function distance($u, $a, $t) {
        if ($t < 0) return "خطا: زمان نمی‌تواند منفی باشد";
        return $u * $t + 0.5 * $a * pow($t, 2);
    }

    /**
     * محاسبه سرعت نهایی با مسافت (v² = u² + 2as)
     * @param float $u سرعت اولیه (m/s)
     * @param float $a شتاب (m/s²)
     * @param float $s مسافت (m)
     * @return float سرعت نهایی (m/s)
     */
    public function finalVelocityWithDistance($u, $a, $s) {
        $v2 = pow($u, 2) + 2 * $a * $s;
        if ($v2 < 0) return "خطا: مقدار زیر ریشه منفی است";
        return sqrt($v2);
    }

    /**
     * محاسبه زمان با استفاده از مسافت و سرعت اولیه (t = (v - u) / a)
     * @param float $u سرعت اولیه (m/s)
     * @param float $v سرعت نهایی (m/s)
     * @param float $a شتاب (m/s²)
     * @return float زمان (s)
     */
    public function timeFromVelocity($u, $v, $a) {
        if ($a == 0) return "خطا: شتاب نمی‌تواند صفر باشد";
        return ($v - $u) / $a;
    }

    /**
     * محاسبه مکان در حرکت دورانی (θ = θ₀ + ωt + 0.5αt²)
     * @param float $theta0 زاویه اولیه (rad)
     * @param float $omega سرعت زاویه‌ای اولیه (rad/s)
     * @param float $alpha شتاب زاویه‌ای (rad/s²)
     * @param float $t زمان (s)
     * @return float زاویه (rad)
     */
    public function angularPosition($theta0, $omega, $alpha, $t) {
        if ($t < 0) return "خطا: زمان نمی‌تواند منفی باشد";
        return $theta0 + $omega * $t + 0.5 * $alpha * pow($t, 2);
    }

    /**
     * محاسبه سرعت زاویه‌ای (ω = ω₀ + αt)
     * @param float $omega0 سرعت زاویه‌ای اولیه (rad/s)
     * @param float $alpha شتاب زاویه‌ای (rad/s²)
     * @param float $t زمان (s)
     * @return float سرعت زاویه‌ای (rad/s)
     */
    public function angularVelocity($omega0, $alpha, $t) {
        if ($t < 0) return "خطا: زمان نمی‌تواند منفی باشد";
        return $omega0 + $alpha * $t;
    }

    // مکانیک - دینامیک
    /**
     * محاسبه نیرو (F = ma)
     * @param float $m جرم (kg)
     * @param float $a شتاب (m/s²)
     * @return float نیرو (N)
     */
    public function force($m, $a) {
        if ($m < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        return $m * $a;
    }

    /**
     * محاسبه وزن (W = mg)
     * @param float $m جرم (kg)
     * @param float $g شتاب گرانش (m/s²) پیش‌فرض 9.81
     * @return float وزن (N)
     */
    public function weight($m, $g = self::G) {
        if ($m < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        return $m * $g;
    }

    /**
     * محاسبه نیروی گرانش بین دو جسم (F = G * m1 * m2 / r²)
     * @param float $m1 جرم جسم اول (kg)
     * @param float $m2 جرم جسم دوم (kg)
     * @param float $r فاصله بین دو جسم (m)
     * @return float نیرو (N)
     */
    public function gravitationalForce($m1, $m2, $r) {
        if ($m1 < 0 || $m2 < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return self::G_CONST * $m1 * $m2 / pow($r, 2);
    }

    /**
     * محاسبه تکانه (p = mv)
     * @param float $m جرم (kg)
     * @param float $v سرعت (m/s)
     * @return float تکانه (kg·m/s)
     */
    public function momentum($m, $v) {
        if ($m < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        return $m * $v;
    }

    /**
     * محاسبه تکانه زاویه‌ای (L = Iω)
     * @param float $i گشتاور لختی (kg·m²)
     * @param float $omega سرعت زاویه‌ای (rad/s)
     * @return float تکانه زاویه‌ای (kg·m²/s)
     */
    public function angularMomentum($i, $omega) {
        if ($i < 0) return "خطا: گشتاور لختی نمی‌تواند منفی باشد";
        return $i * $omega;
    }

    /**
     * محاسبه گشتاور (τ = F * r * sinθ)
     * @param float $f نیرو (N)
     * @param float $r فاصله از محور (m)
     * @param float $theta زاویه (درجه)
     * @return float گشتاور (N·m)
     */
    public function torque($f, $r, $theta) {
        if ($f < 0 || $r < 0) return "خطا: نیرو و فاصله باید نامنفی باشند";
        return $f * $r * sin(deg2rad($theta));
    }

    /**
     * نیروی اصطکاک (F = μN)
     * @param float $mu ضریب اصطکاک
     * @param float $n نیروی عمودی (N)
     * @return float نیروی اصطکاک (N)
     */
    public function frictionForce($mu, $n) {
        if ($mu < 0 || $n < 0) return "خطا: ضریب اصطکاک و نیروی عمودی باید نامنفی باشند";
        return $mu * $n;
    }

    /**
     * فشار سیال (P = ρgh)
     * @param float $rho چگالی سیال (kg/m³)
     * @param float $h عمق (m)
     * @param float $g شتاب گرانش (m/s²) پیش‌فرض 9.81
     * @return float فشار (Pa)
     */
    public function fluidPressure($rho, $h, $g = self::G) {
        if ($rho < 0 || $h < 0) return "خطا: چگالی و عمق باید نامنفی باشند";
        return $rho * $g * $h;
    }

    /**
     * نیروی شناوری (F = ρVg)
     * @param float $rho چگالی سیال (kg/m³)
     * @param float $v حجم جسم غوطه‌ور (m³)
     * @param float $g شتاب گرانش (m/s²) پیش‌فرض 9.81
     * @return float نیروی شناوری (N)
     */
    public function buoyantForce($rho, $v, $g = self::G) {
        if ($rho < 0 || $v < 0) return "خطا: چگالی و حجم باید نامنفی باشند";
        return $rho * $v * $g;
    }

    // کار و انرژی
    /**
     * محاسبه کار (W = F * d * cosθ)
     * @param float $f نیرو (N)
     * @param float $d جابجایی (m)
     * @param float $theta زاویه (درجه)
     * @return float کار (J)
     */
    public function work($f, $d, $theta) {
        if ($f < 0 || $d < 0) return "خطا: نیرو و جابجایی باید نامنفی باشند";
        return $f * $d * cos(deg2rad($theta));
    }

    /**
     * محاسبه انرژی جنبشی (KE = 0.5mv²)
     * @param float $m جرم (kg)
     * @param float $v سرعت (m/s)
     * @return float انرژی جنبشی (J)
     */
    public function kineticEnergy($m, $v) {
        if ($m < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        return 0.5 * $m * pow($v, 2);
    }

    /**
     * محاسبه انرژی پتانسیل گرانشی (PE = mgh)
     * @param float $m جرم (kg)
     * @param float $h ارتفاع (m)
     * @param float $g شتاب گرانش (m/s²) پیش‌فرض 9.81
     * @return float انرژی پتانسیل (J)
     */
    public function potentialEnergy($m, $h, $g = self::G) {
        if ($m < 0 || $h < 0) return "خطا: جرم و ارتفاع باید نامنفی باشند";
        return $m * $g * $h;
    }

    /**
     * محاسبه انرژی پتانسیل فنر (PE = 0.5kx²)
     * @param float $k ثابت فنر (N/m)
     * @param float $x جابجایی از تعادل (m)
     * @return float انرژی پتانسیل (J)
     */
    public function springPotentialEnergy($k, $x) {
        if ($k < 0) return "خطا: ثابت فنر نمی‌تواند منفی باشد";
        return 0.5 * $k * pow($x, 2);
    }

    /**
     * محاسبه توان (P = W / t)
     * @param float $w کار (J)
     * @param float $t زمان (s)
     * @return float توان (W)
     */
    public function power($w, $t) {
        if ($t <= 0) return "خطا: زمان باید مثبت باشد";
        return $w / $t;
    }

    /**
     * فرکانس نوسان فنر (f = (1/2π) * sqrt(k/m))
     * @param float $k ثابت فنر (N/m)
     * @param float $m جرم (kg)
     * @return float فرکانس (Hz)
     */
    public function springFrequency($k, $m) {
        if ($k <= 0 || $m <= 0) return "خطا: ثابت فنر و جرم باید مثبت باشند";
        return (1 / (2 * M_PI)) * sqrt($k / $m);
    }

    /**
     * فرکانس آونگ ساده (f = (1/2π) * sqrt(g/L))
     * @param float $l طول آونگ (m)
     * @param float $g شتاب گرانش (m/s²) پیش‌فرض 9.81
     * @return float فرکانس (Hz)
     */
    public function pendulumFrequency($l, $g = self::G) {
        if ($l <= 0) return "خطا: طول باید مثبت باشد";
        return (1 / (2 * M_PI)) * sqrt($g / $l);
    }

    // ترمودینامیک
    /**
     * محاسبه گرمای ویژه (Q = mcΔT)
     * @param float $m جرم (kg)
     * @param float $c گرمای ویژه (J/kg·K)
     * @param float $deltaT تغییر دما (K)
     * @return float گرما (J)
     */
    public function heat($m, $c, $deltaT) {
        if ($m < 0 || $c < 0) return "خطا: جرم و گرمای ویژه باید نامنفی باشند";
        return $m * $c * $deltaT;
    }

    /**
     * قانون اول ترمودینامیک (ΔU = Q - W)
     * @param float $q گرمای وارد شده (J)
     * @param float $w کار انجام‌شده (J)
     * @return float تغییر انرژی داخلی (J)
     */
    public function firstLawOfThermodynamics($q, $w) {
        return $q - $w;
    }

    /**
     * فشار در گاز ایده‌آل (P = nRT / V)
     * @param float $n تعداد مول‌ها (mol)
     * @param float $t دما (K)
     * @param float $v حجم (m³)
     * @return float فشار (Pa)
     */
    public function idealGasPressure($n, $t, $v) {
        if ($n < 0 || $t < 0 || $v <= 0) return "خطا: ورودی‌ها باید معتبر باشند";
        return $n * self::R * $t / $v;
    }

    /**
     * کار در فرآیند هم‌فشار (W = PΔV)
     * @param float $p فشار (Pa)
     * @param float $deltaV تغییر حجم (m³)
     * @return float کار (J)
     */
    public function workIsobaric($p, $deltaV) {
        if ($p < 0) return "خطا: فشار نمی‌تواند منفی باشد";
        return $p * $deltaV;
    }

    /**
     * کار در فرآیند هم‌دما (W = nRT ln(V₂/V₁))
     * @param float $n تعداد مول‌ها (mol)
     * @param float $t دما (K)
     * @param float $v1 حجم اولیه (m³)
     * @param float $v2 حجم نهایی (m³)
     * @return float کار (J)
     */
    public function workIsothermal($n, $t, $v1, $v2) {
        if ($n < 0 || $t < 0 || $v1 <= 0 || $v2 <= 0) return "خطا: ورودی‌ها باید معتبر باشند";
        return $n * self::R * $t * log($v2 / $v1);
    }

    /**
     * آنتروپی (S = Q / T)
     * @param float $q گرما (J)
     * @param float $t دما (K)
     * @return float آنتروپی (J/K)
     */
    public function entropy($q, $t) {
        if ($t <= 0) return "خطا: دما باید مثبت باشد";
        return $q / $t;
    }

    /**
     * بازده چرخه کارنو (η = 1 - T_cold / T_hot)
     * @param float $tHot دمای منبع گرم (K)
     * @param float $tCold دمای منبع سرد (K)
     * @return float بازده (بین 0 و 1)
     */
    public function carnotEfficiency($tHot, $tCold) {
        if ($tHot <= $tCold || $tHot <= 0 || $tCold <= 0) return "خطا: دماها باید معتبر باشند";
        return 1 - $tCold / $tHot;
    }

    /**
     * قانون دوم ترمودینامیک - آنتروپی کل (ΔS_total = ΔS_system + ΔS_surroundings)
     * @param float $deltaS_system تغییر آنتروپی سیستم (J/K)
     * @param float $deltaS_surroundings تغییر آنتروپی محیط (J/K)
     * @return float آنتروپی کل (J/K)
     */
    public function secondLawEntropy($deltaS_system, $deltaS_surroundings) {
        return $deltaS_system + $deltaS_surroundings;
    }

    // الکتریسیته و مغناطیس
    /**
     * محاسبه نیروی کولن (F = k * |q1 * q2| / r²)
     * @param float $q1 بار الکتریکی اول (C)
     * @param float $q2 بار الکتریکی دوم (C)
     * @param float $r فاصله (m)
     * @return float نیرو (N)
     */
    public function coulombForce($q1, $q2, $r) {
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return self::K * abs($q1 * $q2) / pow($r, 2);
    }

    /**
     * محاسبه میدان الکتریکی (E = k * q / r²)
     * @param float $q بار (C)
     * @param float $r فاصله (m)
     * @return float میدان الکتریکی (N/C)
     */
    public function electricField($q, $r) {
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return self::K * $q / pow($r, 2);
    }

    /**
     * محاسبه پتانسیل الکتریکی (V = k * q / r)
     * @param float $q بار الکتریکی (C)
     * @param float $r فاصله (m)
     * @return float پتانسیل (V)
     */
    public function electricPotential($q, $r) {
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return self::K * $q / $r;
    }

    /**
     * محاسبه ظرفیت خازن (C = Q / V)
     * @param float $q بار (C)
     * @param float $v ولتاژ (V)
     * @return float ظرفیت (F)
     */
    public function capacitance($q, $v) {
        if ($v == 0) return "خطا: ولتاژ نمی‌تواند صفر باشد";
        return $q / $v;
    }

    /**
     * محاسبه انرژی خازن (U = 0.5CV²)
     * @param float $c ظرفیت (F)
     * @param float $v ولتاژ (V)
     * @return float انرژی (J)
     */
    public function capacitorEnergy($c, $v) {
        if ($c < 0) return "خطا: ظرفیت نمی‌تواند منفی باشد";
        return 0.5 * $c * pow($v, 2);
    }

    /**
     * قانون اهم (V = IR)
     * @param float $i جریان (A)
     * @param float $r مقاومت (Ω)
     * @return float ولتاژ (V)
     */
    public function ohmsLaw($i, $r) {
        if ($r < 0) return "خطا: مقاومت نمی‌تواند منفی باشد";
        return $i * $r;
    }

    /**
     * توان الکتریکی (P = VI)
     * @param float $v ولتاژ (V)
     * @param float $i جریان (A)
     * @return float توان (W)
     */
    public function electricPower($v, $i) {
        return $v * $i;
    }

    /**
     * نیروی لورنتس (F = qvBsinθ)
     * @param float $q بار (C)
     * @param float $v سرعت (m/s)
     * @param float $b میدان مغناطیسی (T)
     * @param float $theta زاویه (درجه)
     * @return float نیرو (N)
     */
    public function lorentzForce($q, $v, $b, $theta) {
        if ($v < 0 || $b < 0) return "خطا: سرعت و میدان باید نامنفی باشند";
        return $q * $v * $b * sin(deg2rad($theta));
    }

    /**
     * میدان مغناطیسی ناشی از جریان (B = μ₀I / 2πr)
     * @param float $i جریان (A)
     * @param float $r فاصله (m)
     * @return float میدان مغناطیسی (T)
     */
    public function magneticFieldFromWire($i, $r) {
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return self::MU_0 * $i / (2 * M_PI * $r);
    }

    /**
     * نیروی مغناطیسی بین دو سیم (F/L = μ₀I₁I₂ / 2πr)
     * @param float $i1 جریان سیم اول (A)
     * @param float $i2 جریان سیم دوم (A)
     * @param float $r فاصله (m)
     * @return float نیرو بر واحد طول (N/m)
     */
    public function magneticForceBetweenWires($i1, $i2, $r) {
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return self::MU_0 * $i1 * $i2 / (2 * M_PI * $r);
    }

    /**
     * قانون گاوس برای میدان الکتریکی (Φ_E = Q / ε₀)
     * @param float $q بار محصور (C)
     * @return float شار الکتریکی (N·m²/C)
     */
    public function gaussLawElectric($q) {
        return $q / self::EPSILON_0;
    }

    /**
     * قانون گاوس برای میدان مغناطیسی (Φ_B = 0)
     * @return float شار مغناطیسی (Wb)
     */
    public function gaussLawMagnetic() {
        return 0; // همیشه صفر است (بدون تک‌قطبی مغناطیسی)
    }

    /**
     * القای فارادی (ε = -dΦ_B/dt)
     * @param float $deltaPhiB تغییر شار مغناطیسی (Wb)
     * @param float $deltaT تغییر زمان (s)
     * @return float نیروی محرکه الکتریکی (V)
     */
    public function faradayLaw($deltaPhiB, $deltaT) {
        if ($deltaT <= 0) return "خطا: زمان باید مثبت باشد";
        return -$deltaPhiB / $deltaT;
    }

    /**
     * انرژی میدان الکتریکی (U = 0.5ε₀E²V)
     * @param float $e شدت میدان الکتریکی (N/C)
     * @param float $v حجم (m³)
     * @return float انرژی (J)
     */
    public function electricFieldEnergy($e, $v) {
        if ($v < 0) return "خطا: حجم نمی‌تواند منفی باشد";
        return 0.5 * self::EPSILON_0 * pow($e, 2) * $v;
    }

    // امواج و اپتیک
    /**
     * محاسبه فرکانس (f = 1 / T)
     * @param float $t دوره تناوب (s)
     * @return float فرکانس (Hz)
     */
    public function frequency($t) {
        if ($t <= 0) return "خطا: دوره باید مثبت باشد";
        return 1 / $t;
    }

    /**
     * محاسبه طول موج (λ = v / f)
     * @param float $v سرعت موج (m/s)
     * @param float $f فرکانس (Hz)
     * @return float طول موج (m)
     */
    public function wavelength($v, $f) {
        if ($f <= 0) return "خطا: فرکانس باید مثبت باشد";
        return $v / $f;
    }

    /**
     * اثر دوپلر برای فرکانس (f' = f * (v ± vd) / (v ± vs))
     * @param float $f فرکانس منبع (Hz)
     * @param float $v سرعت موج (m/s)
     * @param float $vd سرعت ناظر (m/s) (مثبت اگر به سمت منبع)
     * @param float $vs سرعت منبع (m/s) (مثبت اگر به سمت ناظر)
     * @return float فرکانس مشاهده‌شده (Hz)
     */
    public function dopplerEffect($f, $v, $vd, $vs) {
        if ($v - $vs == 0) return "خطا: مخرج صفر است";
        return $f * ($v + $vd) / ($v - $vs);
    }

    /**
     * قانون بازتاب (θᵢ = θᵣ)
     * @param float $thetaI زاویه تابش (درجه)
     * @return float زاویه بازتاب (درجه)
     */
    public function lawOfReflection($thetaI) {
        return $thetaI;
    }

    /**
     * قانون شکست اسنل (n₁sinθ₁ = n₂sinθ₂)
     * @param float $n1 ضریب شکست محیط اول
     * @param float $theta1 زاویه تابش (درجه)
     * @param float $n2 ضریب شکست محیط دوم
     * @return float زاویه شکست (درجه)
     */
    public function snellsLaw($n1, $theta1, $n2) {
        if ($n1 <= 0 || $n2 <= 0) return "خطا: ضرایب شکست باید مثبت باشند";
        $sinTheta2 = $n1 * sin(deg2rad($theta1)) / $n2;
        if ($sinTheta2 > 1 || $sinTheta2 < -1) return "خطا: زاویه شکست ممکن نیست (بازتاب کامل)";
        return rad2deg(asin($sinTheta2));
    }

    /**
     * فاصله کانونی آینه کروی (1/f = 1/do + 1/di)
     * @param float $do فاصله جسم (m)
     * @param float $di فاصله تصویر (m)
     * @return float فاصله کانونی (m)
     */
    public function mirrorFocalLength($do, $di) {
        if ($do == 0 || $di == 0) return "خطا: فاصله‌ها نمی‌توانند صفر باشند";
        return 1 / (1 / $do + 1 / $di);
    }

    /**
     * بزرگ‌نمایی آینه یا عدسی (M = -di / do)
     * @param float $di فاصله تصویر (m)
     * @param float $do فاصله جسم (m)
     * @return float بزرگ‌نمایی
     */
    public function magnification($di, $do) {
        if ($do == 0) return "خطا: فاصله جسم نمی‌تواند صفر باشد";
        return -$di / $do;
    }

    /**
     * شدت صوت (I = P / 4πr²)
     * @param float $p توان صوتی (W)
     * @param float $r فاصله (m)
     * @return float شدت صوت (W/m²)
     */
    public function soundIntensity($p, $r) {
        if ($r <= 0) return "خطا: فاصله باید مثبت باشد";
        return $p / (4 * M_PI * pow($r, 2));
    }

    /**
     * سطح شدت صوت (β = 10 * log10(I / I₀))
     * @param float $i شدت صوت (W/m²)
     * @param float $i0 شدت مرجع (W/m²) پیش‌فرض 1e-12
     * @return float سطح شدت (dB)
     */
    public function soundLevel($i, $i0 = 1e-12) {
        if ($i < 0 || $i0 <= 0) return "خطا: شدت‌ها باید معتبر باشند";
        return 10 * log10($i / $i0);
    }

    /**
     * پراش تک‌شکاف (sinθ = λ / w)
     * @param float $lambda طول موج (m)
     * @param float $w عرض شکاف (m)
     * @return float زاویه اولین کمینه (درجه)
     */
    public function singleSlitDiffraction($lambda, $w) {
        if ($w <= 0) return "خطا: عرض شکاف باید مثبت باشد";
        return rad2deg(asin($lambda / $w));
    }

    // نسبیت
    /**
     * انقباض طول (L = L₀ * sqrt(1 - v²/c²))
     * @param float $l0 طول اولیه (m)
     * @param float $v سرعت (m/s)
     * @return float طول انقباض‌یافته (m)
     */
    public function lengthContraction($l0, $v) {
        if ($v >= self::C) return "خطا: سرعت نمی‌تواند بیشتر یا برابر سرعت نور باشد";
        if ($l0 < 0) return "خطا: طول نمی‌تواند منفی باشد";
        return $l0 * sqrt(1 - pow($v, 2) / pow(self::C, 2));
    }

    /**
     * اتساع زمان (Δt = Δt₀ / sqrt(1 - v²/c²))
     * @param float $t0 زمان اولیه (s)
     * @param float $v سرعت (m/s)
     * @return float زمان اتساع‌یافته (s)
     */
    public function timeDilation($t0, $v) {
        if ($v >= self::C) return "خطا: سرعت نمی‌تواند بیشتر یا برابر سرعت نور باشد";
        if ($t0 < 0) return "خطا: زمان نمی‌تواند منفی باشد";
        return $t0 / sqrt(1 - pow($v, 2) / pow(self::C, 2));
    }

    /**
     * انرژی نسبیتی (E = mc²)
     * @param float $m جرم (kg)
     * @return float انرژی (J)
     */
    public function relativisticEnergy($m) {
        if ($m < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        return $m * pow(self::C, 2);
    }

    /**
     * جرم نسبیتی (m = m₀ / sqrt(1 - v²/c²))
     * @param float $m0 جرم سکون (kg)
     * @param float $v سرعت (m/s)
     * @return float جرم نسبیتی (kg)
     */
    public function relativisticMass($m0, $v) {
        if ($v >= self::C) return "خطا: سرعت نمی‌تواند بیشتر یا برابر سرعت نور باشد";
        if ($m0 < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        return $m0 / sqrt(1 - pow($v, 2) / pow(self::C, 2));
    }

    /**
     * تکانه نسبیتی (p = γmv)
     * @param float $m جرم سکون (kg)
     * @param float $v سرعت (m/s)
     * @return float تکانه (kg·m/s)
     */
    public function relativisticMomentum($m, $v) {
        if ($v >= self::C) return "خطا: سرعت نمی‌تواند بیشتر یا برابر سرعت نور باشد";
        if ($m < 0) return "خطا: جرم نمی‌تواند منفی باشد";
        $gamma = 1 / sqrt(1 - pow($v, 2) / pow(self::C, 2));
        return $gamma * $m * $v;
    }

    /**
     * جمع سرعت‌ها در نسبیت (u' = (u + v) / (1 + uv/c²))
     * @param float $u سرعت اول (m/s)
     * @param float $v سرعت دوم (m/s)
     * @return float سرعت کل (m/s)
     */
    public function relativisticVelocityAddition($u, $v) {
        if (abs($u) >= self::C || abs($v) >= self::C) return "خطا: سرعت‌ها نمی‌توانند بیشتر یا برابر سرعت نور باشند";
        return ($u + $v) / (1 + ($u * $v) / pow(self::C, 2));
    }

    // مکانیک کوانتومی
    /**
     * انرژی فوتون (E = hf)
     * @param float $f فرکانس (Hz)
     * @return float انرژی (J)
     */
    public function photonEnergy($f) {
        if ($f < 0) return "خطا: فرکانس نمی‌تواند منفی باشد";
        return self::H * $f;
    }

    /**
     * طول موج دوبروی (λ = h / p)
     * @param float $p تکانه (kg·m/s)
     * @return float طول موج (m)
     */
    public function deBroglieWavelength($p) {
        if ($p <= 0) return "خطا: تکانه باید مثبت باشد";
        return self::H / $p;
    }

    /**
     * انرژی جنبشی در جعبه کوانتومی (E = n²h² / 8mL²)
     * @param int $n سطح کوانتومی
     * @param float $m جرم (kg)
     * @param float $l طول جعبه (m)
     * @return float انرژی (J)
     */
    public function quantumEnergyLevel($n, $m, $l) {
        if ($n < 1 || $m <= 0 || $l <= 0) return "خطا: ورودی‌ها باید معتبر باشند";
        return pow($n, 2) * pow(self::H, 2) / (8 * $m * pow($l, 2));
    }

    /**
     * احتمال حضور ذره در بازه (P = ∫|ψ|²dx، تقریبی ساده)
     * @param callable $psi تابع موج
     * @param float $a حد پایین (m)
     * @param float $b حد بالا (m)
     * @param int $n تعداد نقاط تقریب
     * @return float احتمال (بین 0 و 1)
     */
    public function quantumProbability($psi, $a, $b, $n = 1000) {
        if ($a >= $b) return "خطا: بازه نامعتبر است";
        $h = ($b - $a) / $n;
        $sum = 0;
        for ($i = 0; $i < $n; $i++) {
            $x = $a + $i * $h;
            $sum += pow(abs($psi($x)), 2) * $h;
        }
        return $sum;
    }

    // فیزیک هسته‌ای
    /**
     * نیمه‌عمر (N = N₀ * e^(-λt))
     * @param float $n0 مقدار اولیه (kg یا تعداد ذرات)
     * @param float $lambda ثابت واپاشی (1/s)
     * @param float $t زمان (s)
     * @return float مقدار باقی‌مانده
     */
    public function radioactiveDecay($n0, $lambda, $t) {
        if ($n0 < 0 || $lambda < 0 || $t < 0) return "خطا: ورودی‌ها باید نامنفی باشند";
        return $n0 * exp(-$lambda * $t);
    }

    /**
     * انرژی بستگی هسته (E = Δm * c²)
     * @param float $deltaM کسری جرم (kg)
     * @return float انرژی (J)
     */
    public function nuclearBindingEnergy($deltaM) {
        if ($deltaM < 0) return "خطا: کسری جرم باید نامنفی باشد";
        return $deltaM * pow(self::C, 2);
    }

    // تست کلاس
    /**
     * اجرای تست برای توابع کلاس
     * @return void
     */
    public function runTests() {
        echo "آغاز تست توابع کلاس PhysicsCalculations:\n";
        echo "----------------------------------------\n";

        // مکانیک - سینماتیک
        echo "finalVelocity(2, 3, 4): " . $this->finalVelocity(2, 3, 4) . "\n";
        echo "distance(2, 3, 4): " . $this->distance(2, 3, 4) . "\n";
        echo "finalVelocityWithDistance(2, 3, 5): " . $this->finalVelocityWithDistance(2, 3, 5) . "\n";
        echo "timeFromVelocity(2, 8, 3): " . $this->timeFromVelocity(2, 8, 3) . "\n";
        echo "angularPosition(0, 2, 1, 2): " . $this->angularPosition(0, 2, 1, 2) . "\n";
        echo "angularVelocity(2, 1, 2): " . $this->angularVelocity(2, 1, 2) . "\n";

        // مکانیک - دینامیک
        echo "force(5, 2): " . $this->force(5, 2) . "\n";
        echo "weight(10): " . $this->weight(10) . "\n";
        echo "gravitationalForce(5, 10, 2): " . $this->gravitationalForce(5, 10, 2) . "\n";
        echo "momentum(2, 3): " . $this->momentum(2, 3) . "\n";
        echo "angularMomentum(1.5, 2): " . $this->angularMomentum(1.5, 2) . "\n";
        echo "torque(10, 2, 90): " . $this->torque(10, 2, 90) . "\n";
        echo "frictionForce(0.3, 98.1): " . $this->frictionForce(0.3, 98.1) . "\n";
        echo "fluidPressure(1000, 10): " . $this->fluidPressure(1000, 10) . "\n";
        echo "buoyantForce(1000, 0.01): " . $this->buoyantForce(1000, 0.01) . "\n";

        // کار و انرژی
        echo "work(10, 2, 0): " . $this->work(10, 2, 0) . "\n";
        echo "kineticEnergy(2, 3): " . $this->kineticEnergy(2, 3) . "\n";
        echo "potentialEnergy(2, 10): " . $this->potentialEnergy(2, 10) . "\n";
        echo "springPotentialEnergy(100, 0.1): " . $this->springPotentialEnergy(100, 0.1) . "\n";
        echo "power(20, 4): " . $this->power(20, 4) . "\n";
        echo "springFrequency(100, 1): " . $this->springFrequency(100, 1) . "\n";
        echo "pendulumFrequency(1): " . $this->pendulumFrequency(1) . "\n";

        // ترمودینامیک
        echo "heat(1, 4186, 10): " . $this->heat(1, 4186, 10) . "\n";
        echo "firstLawOfThermodynamics(100, 40): " . $this->firstLawOfThermodynamics(100, 40) . "\n";
        echo "idealGasPressure(1, 300, 0.025): " . $this->idealGasPressure(1, 300, 0.025) . "\n";
        echo "workIsobaric(100000, 0.01): " . $this->workIsobaric(100000, 0.01) . "\n";
        echo "workIsothermal(1, 300, 0.025, 0.05): " . $this->workIsothermal(1, 300, 0.025, 0.05) . "\n";
        echo "entropy(1000, 300): " . $this->entropy(1000, 300) . "\n";
        echo "carnotEfficiency(400, 300): " . $this->carnotEfficiency(400, 300) . "\n";
        echo "secondLawEntropy(2, 1): " . $this->secondLawEntropy(2, 1) . "\n";

        // الکتریسیته و مغناطیس
        echo "coulombForce(1e-6, 2e-6, 0.1): " . $this->coulombForce(1e-6, 2e-6, 0.1) . "\n";
        echo "electricField(1e-6, 0.1): " . $this->electricField(1e-6, 0.1) . "\n";
        echo "electricPotential(1e-6, 0.1): " . $this->electricPotential(1e-6, 0.1) . "\n";
        echo "capacitance(1e-6, 2): " . $this->capacitance(1e-6, 2) . "\n";
        echo "capacitorEnergy(1e-6, 10): " . $this->capacitorEnergy(1e-6, 10) . "\n";
        echo "ohmsLaw(2, 5): " . $this->ohmsLaw(2, 5) . "\n";
        echo "electricPower(10, 2): " . $this->electricPower(10, 2) . "\n";
        echo "lorentzForce(1e-6, 2, 0.5, 90): " . $this->lorentzForce(1e-6, 2, 0.5, 90) . "\n";
        echo "magneticFieldFromWire(2, 0.1): " . $this->magneticFieldFromWire(2, 0.1) . "\n";
        echo "magneticForceBetweenWires(2, 3, 0.1): " . $this->magneticForceBetweenWires(2, 3, 0.1) . "\n";
        echo "gaussLawElectric(1e-6): " . $this->gaussLawElectric(1e-6) . "\n";
        echo "gaussLawMagnetic(): " . $this->gaussLawMagnetic() . "\n";
        echo "faradayLaw(0.01, 0.1): " . $this->faradayLaw(0.01, 0.1) . "\n";
        echo "electricFieldEnergy(1000, 0.001): " . $this->electricFieldEnergy(1000, 0.001) . "\n";

        // امواج و اپتیک
        echo "frequency(0.5): " . $this->frequency(0.5) . "\n";
        echo "wavelength(340, 170): " . $this->wavelength(340, 170) . "\n";
        echo "dopplerEffect(100, 340, 0, 34): " . $this->dopplerEffect(100, 340, 0, 34) . "\n";
        echo "lawOfReflection(45): " . $this->lawOfReflection(45) . "\n";
        echo "snellsLaw(1, 30, 1.5): " . $this->snellsLaw(1, 30, 1.5) . "\n";
        echo "mirrorFocalLength(10, 5): " . $this->mirrorFocalLength(10, 5) . "\n";
        echo "magnification(5, 10): " . $this->magnification(5, 10) . "\n";
        echo "soundIntensity(10, 1): " . $this->soundIntensity(10, 1) . "\n";
        echo "soundLevel(1e-6): " . $this->soundLevel(1e-6) . "\n";
        echo "singleSlitDiffraction(5e-7, 1e-6): " . $this->singleSlitDiffraction(5e-7, 1e-6) . "\n";

        // نسبیت
        echo "lengthContraction(10, 1.5e8): " . $this->lengthContraction(10, 1.5e8) . "\n";
        echo "timeDilation(1, 1.5e8): " . $this->timeDilation(1, 1.5e8) . "\n";
        echo "relativisticEnergy(0.001): " . $this->relativisticEnergy(0.001) . "\n";
        echo "relativisticMass(0.001, 1.5e8): " . $this->relativisticMass(0.001, 1.5e8) . "\n";
        echo "relativisticMomentum(0.001, 1.5e8): " . $this->relativisticMomentum(0.001, 1.5e8) . "\n";
        echo "relativisticVelocityAddition(1e8, 1e8): " . $this->relativisticVelocityAddition(1e8, 1e8) . "\n";

        // مکانیک کوانتومی
        echo "photonEnergy(5e14): " . $this->photonEnergy(5e14) . "\n";
        echo "deBroglieWavelength(1e-34): " . $this->deBroglieWavelength(1e-34) . "\n";
        echo "quantumEnergyLevel(1, 9.11e-31, 1e-9): " . $this->quantumEnergyLevel(1, 9.11e-31, 1e-9) . "\n";
        $psi = function($x) { return sin($x); };
        echo "quantumProbability(sin(x), 0, pi): " . $this->quantumProbability($psi, 0, M_PI) . "\n";

        // فیزیک هسته‌ای
        echo "radioactiveDecay(1, 0.1, 5): " . $this->radioactiveDecay(1, 0.1, 5) . "\n";
        echo "nuclearBindingEnergy(1e-27): " . $this->nuclearBindingEnergy(1e-27) . "\n";

        echo "----------------------------------------\n";
        echo "پایان تست‌ها\n";
    }
}

// اجرای تست
$physics = new PhysicsCalculations();
$physics->runTests();
?>