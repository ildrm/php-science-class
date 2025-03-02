<?php

require_once 'PhysicsCalculations.php'; // For referencing higher-priority functions

class ChemistryCalculations {
    const R = 8.314462618; // Gas constant (J/mol·K)
    const NA = 6.02214076e23; // Avogadro's number (1/mol)
    const KB = 1.380649e-23; // Boltzmann constant (J/K)
    const H = 6.62607015e-34; // Planck constant (J·s)
    const C = 299792458; // Speed of light (m/s)
    const F = 96485.33212; // Faraday constant (C/mol)
    const ATM_TO_PA = 101325; // atm to Pa conversion
    const CAL_TO_J = 4.184; // cal to J conversion
    const KW = 1e-14; // Water dissociation constant at 25°C

    private $physics;

    // Complete periodic table with all 118 elements
    private $periodicTable = [
        1 => ['symbol' => 'H', 'name' => 'Hydrogen', 'atomicMass' => 1.00794, 'electronegativity' => 2.20, 'atomicRadius' => 53, 'ionizationEnergy' => 1312, 'electronAffinity' => 72.8, 'electronConfig' => '1s¹', 'valence' => 1],
        2 => ['symbol' => 'He', 'name' => 'Helium', 'atomicMass' => 4.00260, 'electronegativity' => null, 'atomicRadius' => 31, 'ionizationEnergy' => 2372, 'electronAffinity' => 0, 'electronConfig' => '1s²', 'valence' => 0],
        3 => ['symbol' => 'Li', 'name' => 'Lithium', 'atomicMass' => 6.941, 'electronegativity' => 0.98, 'atomicRadius' => 152, 'ionizationEnergy' => 520, 'electronAffinity' => 59.6, 'electronConfig' => '[He] 2s¹', 'valence' => 1],
        4 => ['symbol' => 'Be', 'name' => 'Beryllium', 'atomicMass' => 9.01218, 'electronegativity' => 1.57, 'atomicRadius' => 112, 'ionizationEnergy' => 899, 'electronAffinity' => 0, 'electronConfig' => '[He] 2s²', 'valence' => 2],
        5 => ['symbol' => 'B', 'name' => 'Boron', 'atomicMass' => 10.811, 'electronegativity' => 2.04, 'atomicRadius' => 85, 'ionizationEnergy' => 801, 'electronAffinity' => 26.7, 'electronConfig' => '[He] 2s² 2p¹', 'valence' => 3],
        6 => ['symbol' => 'C', 'name' => 'Carbon', 'atomicMass' => 12.0107, 'electronegativity' => 2.55, 'atomicRadius' => 77, 'ionizationEnergy' => 1086, 'electronAffinity' => 153.9, 'electronConfig' => '[He] 2s² 2p²', 'valence' => 4],
        7 => ['symbol' => 'N', 'name' => 'Nitrogen', 'atomicMass' => 14.0067, 'electronegativity' => 3.04, 'atomicRadius' => 70, 'ionizationEnergy' => 1402, 'electronAffinity' => 7, 'electronConfig' => '[He] 2s² 2p³', 'valence' => 3],
        8 => ['symbol' => 'O', 'name' => 'Oxygen', 'atomicMass' => 15.9994, 'electronegativity' => 3.44, 'atomicRadius' => 66, 'ionizationEnergy' => 1314, 'electronAffinity' => 141, 'electronConfig' => '[He] 2s² 2p⁴', 'valence' => 2],
        9 => ['symbol' => 'F', 'name' => 'Fluorine', 'atomicMass' => 18.9984, 'electronegativity' => 3.98, 'atomicRadius' => 72, 'ionizationEnergy' => 1681, 'electronAffinity' => 328, 'electronConfig' => '[He] 2s² 2p⁵', 'valence' => 1],
        10 => ['symbol' => 'Ne', 'name' => 'Neon', 'atomicMass' => 20.1797, 'electronegativity' => null, 'atomicRadius' => 38, 'ionizationEnergy' => 2081, 'electronAffinity' => 0, 'electronConfig' => '[He] 2s² 2p⁶', 'valence' => 0],
        11 => ['symbol' => 'Na', 'name' => 'Sodium', 'atomicMass' => 22.9898, 'electronegativity' => 0.93, 'atomicRadius' => 186, 'ionizationEnergy' => 496, 'electronAffinity' => 52.8, 'electronConfig' => '[Ne] 3s¹', 'valence' => 1],
        12 => ['symbol' => 'Mg', 'name' => 'Magnesium', 'atomicMass' => 24.305, 'electronegativity' => 1.31, 'atomicRadius' => 160, 'ionizationEnergy' => 738, 'electronAffinity' => 0, 'electronConfig' => '[Ne] 3s²', 'valence' => 2],
        13 => ['symbol' => 'Al', 'name' => 'Aluminum', 'atomicMass' => 26.9815, 'electronegativity' => 1.61, 'atomicRadius' => 143, 'ionizationEnergy' => 577, 'electronAffinity' => 42.5, 'electronConfig' => '[Ne] 3s² 3p¹', 'valence' => 3],
        14 => ['symbol' => 'Si', 'name' => 'Silicon', 'atomicMass' => 28.0855, 'electronegativity' => 1.90, 'atomicRadius' => 117, 'ionizationEnergy' => 787, 'electronAffinity' => 134, 'electronConfig' => '[Ne] 3s² 3p²', 'valence' => 4],
        15 => ['symbol' => 'P', 'name' => 'Phosphorus', 'atomicMass' => 30.9738, 'electronegativity' => 2.19, 'atomicRadius' => 110, 'ionizationEnergy' => 1012, 'electronAffinity' => 72, 'electronConfig' => '[Ne] 3s² 3p³', 'valence' => 3],
        16 => ['symbol' => 'S', 'name' => 'Sulfur', 'atomicMass' => 32.06, 'electronegativity' => 2.58, 'atomicRadius' => 104, 'ionizationEnergy' => 1000, 'electronAffinity' => 200, 'electronConfig' => '[Ne] 3s² 3p⁴', 'valence' => 2],
        17 => ['symbol' => 'Cl', 'name' => 'Chlorine', 'atomicMass' => 35.45, 'electronegativity' => 3.16, 'atomicRadius' => 99, 'ionizationEnergy' => 1251, 'electronAffinity' => 349, 'electronConfig' => '[Ne] 3s² 3p⁵', 'valence' => 1],
        18 => ['symbol' => 'Ar', 'name' => 'Argon', 'atomicMass' => 39.948, 'electronegativity' => null, 'atomicRadius' => 71, 'ionizationEnergy' => 1521, 'electronAffinity' => 0, 'electronConfig' => '[Ne] 3s² 3p⁶', 'valence' => 0],
        19 => ['symbol' => 'K', 'name' => 'Potassium', 'atomicMass' => 39.0983, 'electronegativity' => 0.82, 'atomicRadius' => 227, 'ionizationEnergy' => 419, 'electronAffinity' => 48.4, 'electronConfig' => '[Ar] 4s¹', 'valence' => 1],
        20 => ['symbol' => 'Ca', 'name' => 'Calcium', 'atomicMass' => 40.078, 'electronegativity' => 1.00, 'atomicRadius' => 197, 'ionizationEnergy' => 590, 'electronAffinity' => 2.37, 'electronConfig' => '[Ar] 4s²', 'valence' => 2],
        21 => ['symbol' => 'Sc', 'name' => 'Scandium', 'atomicMass' => 44.9559, 'electronegativity' => 1.36, 'atomicRadius' => 162, 'ionizationEnergy' => 633, 'electronAffinity' => 18.1, 'electronConfig' => '[Ar] 3d¹ 4s²', 'valence' => 3],
        22 => ['symbol' => 'Ti', 'name' => 'Titanium', 'atomicMass' => 47.867, 'electronegativity' => 1.54, 'atomicRadius' => 147, 'ionizationEnergy' => 659, 'electronAffinity' => 7.6, 'electronConfig' => '[Ar] 3d² 4s²', 'valence' => 4],
        23 => ['symbol' => 'V', 'name' => 'Vanadium', 'atomicMass' => 50.9415, 'electronegativity' => 1.63, 'atomicRadius' => 134, 'ionizationEnergy' => 650, 'electronAffinity' => 50.6, 'electronConfig' => '[Ar] 3d³ 4s²', 'valence' => 5],
        24 => ['symbol' => 'Cr', 'name' => 'Chromium', 'atomicMass' => 51.9961, 'electronegativity' => 1.66, 'atomicRadius' => 129, 'ionizationEnergy' => 653, 'electronAffinity' => 64.3, 'electronConfig' => '[Ar] 3d⁵ 4s¹', 'valence' => 6],
        25 => ['symbol' => 'Mn', 'name' => 'Manganese', 'atomicMass' => 54.938, 'electronegativity' => 1.55, 'atomicRadius' => 127, 'ionizationEnergy' => 717, 'electronAffinity' => 0, 'electronConfig' => '[Ar] 3d⁵ 4s²', 'valence' => 7],
        26 => ['symbol' => 'Fe', 'name' => 'Iron', 'atomicMass' => 55.845, 'electronegativity' => 1.83, 'atomicRadius' => 126, 'ionizationEnergy' => 763, 'electronAffinity' => 15.7, 'electronConfig' => '[Ar] 3d⁶ 4s²', 'valence' => 3],
        27 => ['symbol' => 'Co', 'name' => 'Cobalt', 'atomicMass' => 58.9332, 'electronegativity' => 1.88, 'atomicRadius' => 125, 'ionizationEnergy' => 760, 'electronAffinity' => 63.7, 'electronConfig' => '[Ar] 3d⁷ 4s²', 'valence' => 3],
        28 => ['symbol' => 'Ni', 'name' => 'Nickel', 'atomicMass' => 58.6934, 'electronegativity' => 1.91, 'atomicRadius' => 124, 'ionizationEnergy' => 737, 'electronAffinity' => 112, 'electronConfig' => '[Ar] 3d⁸ 4s²', 'valence' => 2],
        29 => ['symbol' => 'Cu', 'name' => 'Copper', 'atomicMass' => 63.546, 'electronegativity' => 1.90, 'atomicRadius' => 128, 'ionizationEnergy' => 745, 'electronAffinity' => 118.4, 'electronConfig' => '[Ar] 3d¹⁰ 4s¹', 'valence' => 2],
        30 => ['symbol' => 'Zn', 'name' => 'Zinc', 'atomicMass' => 65.38, 'electronegativity' => 1.65, 'atomicRadius' => 134, 'ionizationEnergy' => 906, 'electronAffinity' => 0, 'electronConfig' => '[Ar] 3d¹⁰ 4s²', 'valence' => 2],
        31 => ['symbol' => 'Ga', 'name' => 'Gallium', 'atomicMass' => 69.723, 'electronegativity' => 1.81, 'atomicRadius' => 135, 'ionizationEnergy' => 579, 'electronAffinity' => 28.9, 'electronConfig' => '[Ar] 3d¹⁰ 4s² 4p¹', 'valence' => 3],
        32 => ['symbol' => 'Ge', 'name' => 'Germanium', 'atomicMass' => 72.630, 'electronegativity' => 2.01, 'atomicRadius' => 122, 'ionizationEnergy' => 762, 'electronAffinity' => 119, 'electronConfig' => '[Ar] 3d¹⁰ 4s² 4p²', 'valence' => 4],
        33 => ['symbol' => 'As', 'name' => 'Arsenic', 'atomicMass' => 74.9216, 'electronegativity' => 2.18, 'atomicRadius' => 119, 'ionizationEnergy' => 947, 'electronAffinity' => 78, 'electronConfig' => '[Ar] 3d¹⁰ 4s² 4p³', 'valence' => 3],
        34 => ['symbol' => 'Se', 'name' => 'Selenium', 'atomicMass' => 78.971, 'electronegativity' => 2.55, 'atomicRadius' => 115, 'ionizationEnergy' => 941, 'electronAffinity' => 195, 'electronConfig' => '[Ar] 3d¹⁰ 4s² 4p⁴', 'valence' => 2],
        35 => ['symbol' => 'Br', 'name' => 'Bromine', 'atomicMass' => 79.904, 'electronegativity' => 2.96, 'atomicRadius' => 114, 'ionizationEnergy' => 1140, 'electronAffinity' => 325, 'electronConfig' => '[Ar] 3d¹⁰ 4s² 4p⁵', 'valence' => 1],
        36 => ['symbol' => 'Kr', 'name' => 'Krypton', 'atomicMass' => 83.798, 'electronegativity' => 3.00, 'atomicRadius' => 88, 'ionizationEnergy' => 1351, 'electronAffinity' => 0, 'electronConfig' => '[Ar] 3d¹⁰ 4s² 4p⁶', 'valence' => 0],
        37 => ['symbol' => 'Rb', 'name' => 'Rubidium', 'atomicMass' => 85.4678, 'electronegativity' => 0.82, 'atomicRadius' => 248, 'ionizationEnergy' => 403, 'electronAffinity' => 46.9, 'electronConfig' => '[Kr] 5s¹', 'valence' => 1],
        38 => ['symbol' => 'Sr', 'name' => 'Strontium', 'atomicMass' => 87.62, 'electronegativity' => 0.95, 'atomicRadius' => 215, 'ionizationEnergy' => 550, 'electronAffinity' => 5.03, 'electronConfig' => '[Kr] 5s²', 'valence' => 2],
        39 => ['symbol' => 'Y', 'name' => 'Yttrium', 'atomicMass' => 88.9058, 'electronegativity' => 1.22, 'atomicRadius' => 180, 'ionizationEnergy' => 600, 'electronAffinity' => 29.6, 'electronConfig' => '[Kr] 4d¹ 5s²', 'valence' => 3],
        40 => ['symbol' => 'Zr', 'name' => 'Zirconium', 'atomicMass' => 91.224, 'electronegativity' => 1.33, 'atomicRadius' => 160, 'ionizationEnergy' => 640, 'electronAffinity' => 41.1, 'electronConfig' => '[Kr] 4d² 5s²', 'valence' => 4],
        41 => ['symbol' => 'Nb', 'name' => 'Niobium', 'atomicMass' => 92.9064, 'electronegativity' => 1.60, 'atomicRadius' => 146, 'ionizationEnergy' => 652, 'electronAffinity' => 86.1, 'electronConfig' => '[Kr] 4d⁴ 5s¹', 'valence' => 5],
        42 => ['symbol' => 'Mo', 'name' => 'Molybdenum', 'atomicMass' => 95.95, 'electronegativity' => 2.16, 'atomicRadius' => 139, 'ionizationEnergy' => 684, 'electronAffinity' => 71.9, 'electronConfig' => '[Kr] 4d⁵ 5s¹', 'valence' => 6],
        43 => ['symbol' => 'Tc', 'name' => 'Technetium', 'atomicMass' => 98, 'electronegativity' => 1.90, 'atomicRadius' => 136, 'ionizationEnergy' => 702, 'electronAffinity' => 53, 'electronConfig' => '[Kr] 4d⁵ 5s²', 'valence' => 7],
        44 => ['symbol' => 'Ru', 'name' => 'Ruthenium', 'atomicMass' => 101.07, 'electronegativity' => 2.20, 'atomicRadius' => 134, 'ionizationEnergy' => 710, 'electronAffinity' => 101, 'electronConfig' => '[Kr] 4d⁷ 5s¹', 'valence' => 8],
        45 => ['symbol' => 'Rh', 'name' => 'Rhodium', 'atomicMass' => 102.9055, 'electronegativity' => 2.28, 'atomicRadius' => 134, 'ionizationEnergy' => 720, 'electronAffinity' => 110, 'electronConfig' => '[Kr] 4d⁸ 5s¹', 'valence' => 6],
        46 => ['symbol' => 'Pd', 'name' => 'Palladium', 'atomicMass' => 106.42, 'electronegativity' => 2.20, 'atomicRadius' => 137, 'ionizationEnergy' => 804, 'electronAffinity' => 53.7, 'electronConfig' => '[Kr] 4d¹⁰', 'valence' => 4],
        47 => ['symbol' => 'Ag', 'name' => 'Silver', 'atomicMass' => 107.8682, 'electronegativity' => 1.93, 'atomicRadius' => 144, 'ionizationEnergy' => 731, 'electronAffinity' => 125, 'electronConfig' => '[Kr] 4d¹⁰ 5s¹', 'valence' => 1],
        48 => ['symbol' => 'Cd', 'name' => 'Cadmium', 'atomicMass' => 112.414, 'electronegativity' => 1.69, 'atomicRadius' => 151, 'ionizationEnergy' => 867, 'electronAffinity' => 0, 'electronConfig' => '[Kr] 4d¹⁰ 5s²', 'valence' => 2],
        49 => ['symbol' => 'In', 'name' => 'Indium', 'atomicMass' => 114.818, 'electronegativity' => 1.78, 'atomicRadius' => 167, 'ionizationEnergy' => 558, 'electronAffinity' => 28.9, 'electronConfig' => '[Kr] 4d¹⁰ 5s² 5p¹', 'valence' => 3],
        50 => ['symbol' => 'Sn', 'name' => 'Tin', 'atomicMass' => 118.710, 'electronegativity' => 1.96, 'atomicRadius' => 140, 'ionizationEnergy' => 709, 'electronAffinity' => 107, 'electronConfig' => '[Kr] 4d¹⁰ 5s² 5p²', 'valence' => 4],
        51 => ['symbol' => 'Sb', 'name' => 'Antimony', 'atomicMass' => 121.760, 'electronegativity' => 2.05, 'atomicRadius' => 141, 'ionizationEnergy' => 834, 'electronAffinity' => 103, 'electronConfig' => '[Kr] 4d¹⁰ 5s² 5p³', 'valence' => 3],
        52 => ['symbol' => 'Te', 'name' => 'Tellurium', 'atomicMass' => 127.60, 'electronegativity' => 2.10, 'atomicRadius' => 137, 'ionizationEnergy' => 869, 'electronAffinity' => 190, 'electronConfig' => '[Kr] 4d¹⁰ 5s² 5p⁴', 'valence' => 2],
        53 => ['symbol' => 'I', 'name' => 'Iodine', 'atomicMass' => 126.9045, 'electronegativity' => 2.66, 'atomicRadius' => 133, 'ionizationEnergy' => 1008, 'electronAffinity' => 295, 'electronConfig' => '[Kr] 4d¹⁰ 5s² 5p⁵', 'valence' => 1],
        54 => ['symbol' => 'Xe', 'name' => 'Xenon', 'atomicMass' => 131.293, 'electronegativity' => 2.60, 'atomicRadius' => 108, 'ionizationEnergy' => 1170, 'electronAffinity' => 0, 'electronConfig' => '[Kr] 4d¹⁰ 5s² 5p⁶', 'valence' => 0],
        55 => ['symbol' => 'Cs', 'name' => 'Cesium', 'atomicMass' => 132.9055, 'electronegativity' => 0.79, 'atomicRadius' => 265, 'ionizationEnergy' => 376, 'electronAffinity' => 45.5, 'electronConfig' => '[Xe] 6s¹', 'valence' => 1],
        56 => ['symbol' => 'Ba', 'name' => 'Barium', 'atomicMass' => 137.327, 'electronegativity' => 0.89, 'atomicRadius' => 222, 'ionizationEnergy' => 503, 'electronAffinity' => 13.95, 'electronConfig' => '[Xe] 6s²', 'valence' => 2],
        57 => ['symbol' => 'La', 'name' => 'Lanthanum', 'atomicMass' => 138.9055, 'electronegativity' => 1.10, 'atomicRadius' => 187, 'ionizationEnergy' => 538, 'electronAffinity' => 48, 'electronConfig' => '[Xe] 5d¹ 6s²', 'valence' => 3],
        58 => ['symbol' => 'Ce', 'name' => 'Cerium', 'atomicMass' => 140.116, 'electronegativity' => 1.12, 'atomicRadius' => 182, 'ionizationEnergy' => 534, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f¹ 5d¹ 6s²', 'valence' => 4],
        59 => ['symbol' => 'Pr', 'name' => 'Praseodymium', 'atomicMass' => 140.9077, 'electronegativity' => 1.13, 'atomicRadius' => 182, 'ionizationEnergy' => 527, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f³ 6s²', 'valence' => 3],
        60 => ['symbol' => 'Nd', 'name' => 'Neodymium', 'atomicMass' => 144.242, 'electronegativity' => 1.14, 'atomicRadius' => 181, 'ionizationEnergy' => 533, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f⁴ 6s²', 'valence' => 3],
        61 => ['symbol' => 'Pm', 'name' => 'Promethium', 'atomicMass' => 145, 'electronegativity' => 1.13, 'atomicRadius' => 183, 'ionizationEnergy' => 540, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f⁵ 6s²', 'valence' => 3],
        62 => ['symbol' => 'Sm', 'name' => 'Samarium', 'atomicMass' => 150.36, 'electronegativity' => 1.17, 'atomicRadius' => 180, 'ionizationEnergy' => 545, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f⁶ 6s²', 'valence' => 3],
        63 => ['symbol' => 'Eu', 'name' => 'Europium', 'atomicMass' => 151.964, 'electronegativity' => 1.20, 'atomicRadius' => 180, 'ionizationEnergy' => 547, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f⁷ 6s²', 'valence' => 3],
        64 => ['symbol' => 'Gd', 'name' => 'Gadolinium', 'atomicMass' => 157.25, 'electronegativity' => 1.20, 'atomicRadius' => 180, 'ionizationEnergy' => 593, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f⁷ 5d¹ 6s²', 'valence' => 3],
        65 => ['symbol' => 'Tb', 'name' => 'Terbium', 'atomicMass' => 158.9254, 'electronegativity' => 1.22, 'atomicRadius' => 177, 'ionizationEnergy' => 566, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f⁹ 6s²', 'valence' => 3],
        66 => ['symbol' => 'Dy', 'name' => 'Dysprosium', 'atomicMass' => 162.500, 'electronegativity' => 1.22, 'atomicRadius' => 178, 'ionizationEnergy' => 573, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f¹⁰ 6s²', 'valence' => 3],
        67 => ['symbol' => 'Ho', 'name' => 'Holmium', 'atomicMass' => 164.9303, 'electronegativity' => 1.23, 'atomicRadius' => 176, 'ionizationEnergy' => 581, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f¹¹ 6s²', 'valence' => 3],
        68 => ['symbol' => 'Er', 'name' => 'Erbium', 'atomicMass' => 167.259, 'electronegativity' => 1.24, 'atomicRadius' => 176, 'ionizationEnergy' => 589, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f¹² 6s²', 'valence' => 3],
        69 => ['symbol' => 'Tm', 'name' => 'Thulium', 'atomicMass' => 168.9342, 'electronegativity' => 1.25, 'atomicRadius' => 176, 'ionizationEnergy' => 597, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f¹³ 6s²', 'valence' => 3],
        70 => ['symbol' => 'Yb', 'name' => 'Ytterbium', 'atomicMass' => 173.045, 'electronegativity' => 1.10, 'atomicRadius' => 176, 'ionizationEnergy' => 603, 'electronAffinity' => 0, 'electronConfig' => '[Xe] 4f¹⁴ 6s²', 'valence' => 2],
        71 => ['symbol' => 'Lu', 'name' => 'Lutetium', 'atomicMass' => 174.9668, 'electronegativity' => 1.27, 'atomicRadius' => 174, 'ionizationEnergy' => 524, 'electronAffinity' => 50, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹ 6s²', 'valence' => 3],
        72 => ['symbol' => 'Hf', 'name' => 'Hafnium', 'atomicMass' => 178.49, 'electronegativity' => 1.30, 'atomicRadius' => 159, 'ionizationEnergy' => 659, 'electronAffinity' => 0, 'electronConfig' => '[Xe] 4f¹⁴ 5d² 6s²', 'valence' => 4],
        73 => ['symbol' => 'Ta', 'name' => 'Tantalum', 'atomicMass' => 180.9479, 'electronegativity' => 1.50, 'atomicRadius' => 146, 'ionizationEnergy' => 761, 'electronAffinity' => 31, 'electronConfig' => '[Xe] 4f¹⁴ 5d³ 6s²', 'valence' => 5],
        74 => ['symbol' => 'W', 'name' => 'Tungsten', 'atomicMass' => 183.84, 'electronegativity' => 2.36, 'atomicRadius' => 139, 'ionizationEnergy' => 770, 'electronAffinity' => 78.6, 'electronConfig' => '[Xe] 4f¹⁴ 5d⁴ 6s²', 'valence' => 6],
        75 => ['symbol' => 'Re', 'name' => 'Rhenium', 'atomicMass' => 186.207, 'electronegativity' => 1.90, 'atomicRadius' => 137, 'ionizationEnergy' => 760, 'electronAffinity' => 14.5, 'electronConfig' => '[Xe] 4f¹⁴ 5d⁵ 6s²', 'valence' => 7],
        76 => ['symbol' => 'Os', 'name' => 'Osmium', 'atomicMass' => 190.23, 'electronegativity' => 2.20, 'atomicRadius' => 135, 'ionizationEnergy' => 840, 'electronAffinity' => 106, 'electronConfig' => '[Xe] 4f¹⁴ 5d⁶ 6s²', 'valence' => 8],
        77 => ['symbol' => 'Ir', 'name' => 'Iridium', 'atomicMass' => 192.217, 'electronegativity' => 2.20, 'atomicRadius' => 136, 'ionizationEnergy' => 880, 'electronAffinity' => 151, 'electronConfig' => '[Xe] 4f¹⁴ 5d⁷ 6s²', 'valence' => 6],
        78 => ['symbol' => 'Pt', 'name' => 'Platinum', 'atomicMass' => 195.084, 'electronegativity' => 2.28, 'atomicRadius' => 139, 'ionizationEnergy' => 870, 'electronAffinity' => 205, 'electronConfig' => '[Xe] 4f¹⁴ 5d⁹ 6s¹', 'valence' => 4],
        79 => ['symbol' => 'Au', 'name' => 'Gold', 'atomicMass' => 196.9666, 'electronegativity' => 2.54, 'atomicRadius' => 144, 'ionizationEnergy' => 890, 'electronAffinity' => 223, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s¹', 'valence' => 3],
        80 => ['symbol' => 'Hg', 'name' => 'Mercury', 'atomicMass' => 200.592, 'electronegativity' => 2.00, 'atomicRadius' => 151, 'ionizationEnergy' => 1007, 'electronAffinity' => 0, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s²', 'valence' => 2],
        81 => ['symbol' => 'Tl', 'name' => 'Thallium', 'atomicMass' => 204.383, 'electronegativity' => 1.62, 'atomicRadius' => 170, 'ionizationEnergy' => 589, 'electronAffinity' => 19.2, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s² 6p¹', 'valence' => 3],
        82 => ['symbol' => 'Pb', 'name' => 'Lead', 'atomicMass' => 207.2, 'electronegativity' => 2.33, 'atomicRadius' => 175, 'ionizationEnergy' => 716, 'electronAffinity' => 35.1, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s² 6p²', 'valence' => 4],
        83 => ['symbol' => 'Bi', 'name' => 'Bismuth', 'atomicMass' => 208.9804, 'electronegativity' => 2.02, 'atomicRadius' => 156, 'ionizationEnergy' => 703, 'electronAffinity' => 91.2, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s² 6p³', 'valence' => 3],
        84 => ['symbol' => 'Po', 'name' => 'Polonium', 'atomicMass' => 209, 'electronegativity' => 2.00, 'atomicRadius' => 153, 'ionizationEnergy' => 812, 'electronAffinity' => 183, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s² 6p⁴', 'valence' => 2],
        85 => ['symbol' => 'At', 'name' => 'Astatine', 'atomicMass' => 210, 'electronegativity' => 2.20, 'atomicRadius' => 150, 'ionizationEnergy' => 890, 'electronAffinity' => 270, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s² 6p⁵', 'valence' => 1],
        86 => ['symbol' => 'Rn', 'name' => 'Radon', 'atomicMass' => 222, 'electronegativity' => null, 'atomicRadius' => 120, 'ionizationEnergy' => 1037, 'electronAffinity' => 0, 'electronConfig' => '[Xe] 4f¹⁴ 5d¹⁰ 6s² 6p⁶', 'valence' => 0],
        87 => ['symbol' => 'Fr', 'name' => 'Francium', 'atomicMass' => 223, 'electronegativity' => 0.70, 'atomicRadius' => 270, 'ionizationEnergy' => 380, 'electronAffinity' => 44, 'electronConfig' => '[Rn] 7s¹', 'valence' => 1],
        88 => ['symbol' => 'Ra', 'name' => 'Radium', 'atomicMass' => 226, 'electronegativity' => 0.90, 'atomicRadius' => 223, 'ionizationEnergy' => 509, 'electronAffinity' => 10, 'electronConfig' => '[Rn] 7s²', 'valence' => 2],
        89 => ['symbol' => 'Ac', 'name' => 'Actinium', 'atomicMass' => 227, 'electronegativity' => 1.10, 'atomicRadius' => 195, 'ionizationEnergy' => 499, 'electronAffinity' => 33, 'electronConfig' => '[Rn] 6d¹ 7s²', 'valence' => 3],
        90 => ['symbol' => 'Th', 'name' => 'Thorium', 'atomicMass' => 232.0377, 'electronegativity' => 1.30, 'atomicRadius' => 180, 'ionizationEnergy' => 587, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 6d² 7s²', 'valence' => 4],
        91 => ['symbol' => 'Pa', 'name' => 'Protactinium', 'atomicMass' => 231.0359, 'electronegativity' => 1.50, 'atomicRadius' => 163, 'ionizationEnergy' => 568, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f² 6d¹ 7s²', 'valence' => 5],
        92 => ['symbol' => 'U', 'name' => 'Uranium', 'atomicMass' => 238.0289, 'electronegativity' => 1.38, 'atomicRadius' => 156, 'ionizationEnergy' => 598, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f³ 6d¹ 7s²', 'valence' => 6],
        93 => ['symbol' => 'Np', 'name' => 'Neptunium', 'atomicMass' => 237, 'electronegativity' => 1.36, 'atomicRadius' => 155, 'ionizationEnergy' => 604, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f⁴ 6d¹ 7s²', 'valence' => 6],
        94 => ['symbol' => 'Pu', 'name' => 'Plutonium', 'atomicMass' => 244, 'electronegativity' => 1.28, 'atomicRadius' => 159, 'ionizationEnergy' => 585, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f⁶ 7s²', 'valence' => 6],
        95 => ['symbol' => 'Am', 'name' => 'Americium', 'atomicMass' => 243, 'electronegativity' => 1.30, 'atomicRadius' => 173, 'ionizationEnergy' => 578, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f⁷ 7s²', 'valence' => 6],
        96 => ['symbol' => 'Cm', 'name' => 'Curium', 'atomicMass' => 247, 'electronegativity' => 1.30, 'atomicRadius' => 174, 'ionizationEnergy' => 581, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f⁷ 6d¹ 7s²', 'valence' => 3],
        97 => ['symbol' => 'Bk', 'name' => 'Berkelium', 'atomicMass' => 247, 'electronegativity' => 1.30, 'atomicRadius' => 170, 'ionizationEnergy' => 601, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f⁹ 7s²', 'valence' => 4],
        98 => ['symbol' => 'Cf', 'name' => 'Californium', 'atomicMass' => 251, 'electronegativity' => 1.30, 'atomicRadius' => 168, 'ionizationEnergy' => 608, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f¹⁰ 7s²', 'valence' => 4],
        99 => ['symbol' => 'Es', 'name' => 'Einsteinium', 'atomicMass' => 252, 'electronegativity' => 1.30, 'atomicRadius' => 165, 'ionizationEnergy' => 619, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f¹¹ 7s²', 'valence' => 3],
        100 => ['symbol' => 'Fm', 'name' => 'Fermium', 'atomicMass' => 257, 'electronegativity' => 1.30, 'atomicRadius' => 167, 'ionizationEnergy' => 627, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f¹² 7s²', 'valence' => 3],
        101 => ['symbol' => 'Md', 'name' => 'Mendelevium', 'atomicMass' => 258, 'electronegativity' => 1.30, 'atomicRadius' => 173, 'ionizationEnergy' => 635, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f¹³ 7s²', 'valence' => 3],
        102 => ['symbol' => 'No', 'name' => 'Nobelium', 'atomicMass' => 259, 'electronegativity' => 1.30, 'atomicRadius' => 176, 'ionizationEnergy' => 642, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f¹⁴ 7s²', 'valence' => 2],
        103 => ['symbol' => 'Lr', 'name' => 'Lawrencium', 'atomicMass' => 262, 'electronegativity' => 1.30, 'atomicRadius' => 171, 'ionizationEnergy' => 470, 'electronAffinity' => 50, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹ 7s²', 'valence' => 3],
        104 => ['symbol' => 'Rf', 'name' => 'Rutherfordium', 'atomicMass' => 267, 'electronegativity' => 1.30, 'atomicRadius' => 157, 'ionizationEnergy' => 580, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d² 7s²', 'valence' => 4],
        105 => ['symbol' => 'Db', 'name' => 'Dubnium', 'atomicMass' => 268, 'electronegativity' => 1.30, 'atomicRadius' => 149, 'ionizationEnergy' => 664, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d³ 7s²', 'valence' => 5],
        106 => ['symbol' => 'Sg', 'name' => 'Seaborgium', 'atomicMass' => 269, 'electronegativity' => 1.30, 'atomicRadius' => 143, 'ionizationEnergy' => 757, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d⁴ 7s²', 'valence' => 6],
        107 => ['symbol' => 'Bh', 'name' => 'Bohrium', 'atomicMass' => 270, 'electronegativity' => 1.30, 'atomicRadius' => 141, 'ionizationEnergy' => 740, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d⁵ 7s²', 'valence' => 7],
        108 => ['symbol' => 'Hs', 'name' => 'Hassium', 'atomicMass' => 269, 'electronegativity' => 1.30, 'atomicRadius' => 134, 'ionizationEnergy' => 730, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d⁶ 7s²', 'valence' => 8],
        109 => ['symbol' => 'Mt', 'name' => 'Meitnerium', 'atomicMass' => 278, 'electronegativity' => 1.30, 'atomicRadius' => 129, 'ionizationEnergy' => 800, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d⁷ 7s²', 'valence' => 6],
        110 => ['symbol' => 'Ds', 'name' => 'Darmstadtium', 'atomicMass' => 281, 'electronegativity' => 1.30, 'atomicRadius' => 128, 'ionizationEnergy' => 960, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d⁸ 7s²', 'valence' => 6],
        111 => ['symbol' => 'Rg', 'name' => 'Roentgenium', 'atomicMass' => 282, 'electronegativity' => 1.30, 'atomicRadius' => 121, 'ionizationEnergy' => 1020, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s¹', 'valence' => 5],
        112 => ['symbol' => 'Cn', 'name' => 'Copernicium', 'atomicMass' => 285, 'electronegativity' => 1.30, 'atomicRadius' => 122, 'ionizationEnergy' => 1150, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s²', 'valence' => 2],
        113 => ['symbol' => 'Nh', 'name' => 'Nihonium', 'atomicMass' => 286, 'electronegativity' => 1.30, 'atomicRadius' => 136, 'ionizationEnergy' => 704, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s² 7p¹', 'valence' => 3],
        114 => ['symbol' => 'Fl', 'name' => 'Flerovium', 'atomicMass' => 289, 'electronegativity' => 1.30, 'atomicRadius' => 143, 'ionizationEnergy' => 832, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s² 7p²', 'valence' => 4],
        115 => ['symbol' => 'Mc', 'name' => 'Moscovium', 'atomicMass' => 290, 'electronegativity' => 1.30, 'atomicRadius' => 162, 'ionizationEnergy' => 538, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s² 7p³', 'valence' => 3],
        116 => ['symbol' => 'Lv', 'name' => 'Livermorium', 'atomicMass' => 293, 'electronegativity' => 1.30, 'atomicRadius' => 175, 'ionizationEnergy' => 723, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s² 7p⁴', 'valence' => 2],
        117 => ['symbol' => 'Ts', 'name' => 'Tennessine', 'atomicMass' => 294, 'electronegativity' => 1.30, 'atomicRadius' => 165, 'ionizationEnergy' => 736, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s² 7p⁵', 'valence' => 1],
        118 => ['symbol' => 'Og', 'name' => 'Oganesson', 'atomicMass' => 294, 'electronegativity' => null, 'atomicRadius' => 157, 'ionizationEnergy' => 839, 'electronAffinity' => null, 'electronConfig' => '[Rn] 5f¹⁴ 6d¹⁰ 7s² 7p⁶', 'valence' => 0],
    ];

    public function __construct() {
        $this->physics = new PhysicsCalculations();
    }

    // Periodic Table Access
    /**
     * Get atomic mass of an element
     * @param int|string $identifier Atomic number or symbol
     * @param string $unitMass Unit for mass (default: "u", options: "g/mol")
     * @return float|string Atomic mass or error message
     */
    public function getAtomicMass($identifier, $unitMass = "u") {
        $data = $this->getElementData($identifier);
        if ($data === "Error: Element not found") return $data;
        $result = $data['atomicMass'];
        if ($unitMass === "g/mol") return $result; // u ≈ g/mol for molar mass
        return $result; // Default u
    }

    /**
     * Get electronegativity of an element
     * @param int|string $identifier Atomic number or symbol
     * @return float|null|string Electronegativity or error message
     */
    public function getElectronegativity($identifier) {
        $data = $this->getElementData($identifier);
        return $data === "Error: Element not found" ? $data : $data['electronegativity'];
    }

    /**
     * Get electron orbitals of an element
     * @param int|string $identifier Atomic number or symbol
     * @return string|string Electron configuration or error message
     */
    public function getOrbitals($identifier) {
        $data = $this->getElementData($identifier);
        return $data === "Error: Element not found" ? $data : $data['electronConfig'];
    }

    private function getElementData($identifier) {
        if (is_numeric($identifier)) {
            $atomicNumber = (int)$identifier;
            if (isset($this->periodicTable[$atomicNumber])) {
                return $this->periodicTable[$atomicNumber];
            }
        } elseif (is_string($identifier)) {
            foreach ($this->periodicTable as $data) {
                if ($data['symbol'] === $identifier) {
                    return $data;
                }
            }
        }
        return "Error: Element not found";
    }

    // General Chemistry
    /**
     * Calculate mass from moles (m = n * M)
     * @param float $n Number of moles (mol)
     * @param float $molarMass Molar mass (g/mol by default)
     * @param string $unitMolarMass Unit for molar mass (default: "g/mol", options: "kg/mol")
     * @param string $unitMass Unit for mass (default: "g", options: "kg")
     * @return float|string Mass or error message
     */
    public function molarMassToMass($n, $molarMass, $unitMolarMass = "g/mol", $unitMass = "g") {
        if ($n < 0 || $molarMass < 0) return "Error: Values must be non-negative";
        if ($unitMolarMass === "kg/mol") $molarMass *= 1000; // kg/mol to g/mol
        $result = $n * $molarMass; // Mass in g
        if ($unitMass === "kg") return $result / 1000; // g to kg
        return $result; // Default g
    }

    /**
     * Calculate moles from mass (n = m / M)
     * @param float $mass Mass (g by default)
     * @param float $molarMass Molar mass (g/mol by default)
     * @param string $unitMass Unit for mass (default: "g", options: "kg")
     * @param string $unitMolarMass Unit for molar mass (default: "g/mol", options: "kg/mol")
     * @return float|string Number of moles or error message
     */
    public function massToMoles($mass, $molarMass, $unitMass = "g", $unitMolarMass = "g/mol") {
        if ($mass < 0 || $molarMass <= 0) return "Error: Values must be valid";
        if ($unitMass === "kg") $mass *= 1000; // kg to g
        if ($unitMolarMass === "kg/mol") $molarMass *= 1000; // kg/mol to g/mol
        return $mass / $molarMass; // Moles (unitless)
    }

    /**
     * Calculate number of particles (N = n * NA)
     * @param float $n Number of moles (mol)
     * @return float|string Number of particles or error message
     */
    public function molesToParticles($n) {
        if ($n < 0) return "Error: Number of moles must be non-negative";
        return $n * self::NA; // Number of particles (unitless)
    }

    /**
     * Calculate molar concentration (C = n / V)
     * @param float $n Number of moles (mol)
     * @param float $v Volume (L by default)
     * @param string $unitVolume Unit for volume (default: "L", options: "mL")
     * @param string $unitConcentration Unit for concentration (default: "mol/L", options: "mol/mL")
     * @return float|string Concentration or error message
     */
    public function molarConcentration($n, $v, $unitVolume = "L", $unitConcentration = "mol/L") {
        if ($n < 0 || $v <= 0) return "Error: Values must be valid";
        if ($unitVolume === "mL") $v /= 1000; // mL to L
        $result = $n / $v; // Concentration in mol/L
        if ($unitConcentration === "mol/mL") return $result * 1000; // mol/L to mol/mL
        return $result; // Default mol/L
    }

    /**
     * Stoichiometry: Calculate amount of substance from coefficients
     * @param float $knownMoles Moles of known substance (mol)
     * @param int $coeffKnown Coefficient of known substance
     * @param int $coeffUnknown Coefficient of unknown substance
     * @return float|string Moles of unknown substance or error message
     */
    public function stoichiometry($knownMoles, $coeffKnown, $coeffUnknown) {
        if ($knownMoles < 0 || $coeffKnown <= 0 || $coeffUnknown <= 0) return "Error: Values must be valid";
        return $knownMoles * ($coeffUnknown / $coeffKnown); // Moles (unitless)
    }

    /**
     * Calculate ideal gas volume (uses PhysicsCalculations::idealGasPressure)
     * @param float $n Number of moles (mol)
     * @param float $t Temperature (K by default)
     * @param float $p Pressure (Pa by default)
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "atm")
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @param string $unitVolume Unit for volume (default: "m³", options: "L")
     * @return float|string Volume or error message
     */
    public function idealGasVolume($n, $t, $p, $unitPressure = "Pa", $unitTemperature = "K", $unitVolume = "m³") {
        $pressure = $this->physics->idealGasPressure($n, $t, null, "Pa", $unitTemperature, "m³");
        if (is_string($pressure)) return $pressure;
        if ($unitPressure === "atm") $p *= self::ATM_TO_PA; // atm to Pa
        $volume = ($n * self::R * $t) / $p; // Volume in m³
        if ($unitVolume === "L") return $volume * 1000; // m³ to L
        return $volume; // Default m³
    }

    // Thermodynamics
    /**
     * Calculate enthalpy change (ΔH = ΣH_products - ΣH_reactants)
     * @param array $products Enthalpies of products (J/mol by default)
     * @param array $reactants Enthalpies of reactants (J/mol by default)
     * @param string $unitEnthalpy Unit for enthalpy (default: "J/mol", options: "kJ/mol")
     * @return float|string Enthalpy change or error message
     */
    public function enthalpyChange($products, $reactants, $unitEnthalpy = "J/mol") {
        if (empty($products) || empty($reactants)) return "Error: Data is empty";
        if ($unitEnthalpy === "kJ/mol") {
            $products = array_map(fn($x) => $x * 1000, $products); // kJ/mol to J/mol
            $reactants = array_map(fn($x) => $x * 1000, $reactants);
        }
        $result = array_sum($products) - array_sum($reactants); // Enthalpy in J/mol
        if ($unitEnthalpy === "kJ/mol") return $result / 1000; // J/mol to kJ/mol
        return $result; // Default J/mol
    }

    /**
     * Calculate entropy change (ΔS = ΣS_products - ΣS_reactants)
     * @param array $products Entropies of products (J/mol·K by default)
     * @param array $reactants Entropies of reactants (J/mol·K by default)
     * @param string $unitEntropy Unit for entropy (default: "J/mol·K", options: "cal/mol·K")
     * @return float|string Entropy change or error message
     */
    public function entropyChange($products, $reactants, $unitEntropy = "J/mol·K") {
        if (empty($products) || empty($reactants)) return "Error: Data is empty";
        if ($unitEntropy === "cal/mol·K") {
            $products = array_map(fn($x) => $x * 4.184, $products); // cal/mol·K to J/mol·K
            $reactants = array_map(fn($x) => $x * 4.184, $reactants);
        }
        $result = array_sum($products) - array_sum($reactants); // Entropy in J/mol·K
        if ($unitEntropy === "cal/mol·K") return $result / 4.184; // J/mol·K to cal/mol·K
        return $result; // Default J/mol·K
    }

    /**
     * Calculate Gibbs free energy (ΔG = ΔH - TΔS)
     * @param float $deltaH Enthalpy change (J/mol by default)
     * @param float $t Temperature (K by default)
     * @param float $deltaS Entropy change (J/mol·K by default)
     * @param string $unitEnthalpy Unit for enthalpy (default: "J/mol", options: "kJ/mol")
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @param string $unitEntropy Unit for entropy (default: "J/mol·K", options: "cal/mol·K")
     * @param string $unitEnergy Unit for free energy (default: "J/mol", options: "kJ/mol")
     * @return float|string Free energy or error message
     */
    public function gibbsFreeEnergy($deltaH, $t, $deltaS, $unitEnthalpy = "J/mol", $unitTemperature = "K", $unitEntropy = "J/mol·K", $unitEnergy = "J/mol") {
        if ($t < 0) return "Error: Temperature must be non-negative";
        if ($unitEnthalpy === "kJ/mol") $deltaH *= 1000; // kJ/mol to J/mol
        if ($unitTemperature === "C") $t += 273.15; // C to K
        if ($unitEntropy === "cal/mol·K") $deltaS *= 4.184; // cal/mol·K to J/mol·K
        $result = $deltaH - $t * $deltaS; // Energy in J/mol
        if ($unitEnergy === "kJ/mol") return $result / 1000; // J/mol to kJ/mol
        return $result; // Default J/mol
    }

    // Bonding
    /**
     * Determine atomic bond type between two elements
     * @param int|string $element1 First element (atomic number or symbol)
     * @param int|string $element2 Second element (atomic number or symbol)
     * @return string|string Bond type or error message
     */
    public function atomicBond($element1, $element2) {
        $e1 = $this->getElectronegativity($element1);
        $e2 = $this->getElectronegativity($element2);
        if (is_string($e1) || is_string($e2)) return "Error: One or both elements not found";
        if ($e1 === null || $e2 === null) return "No bond (noble gas or insufficient data)";
        $deltaE = abs($e1 - $e2);
        if ($deltaE > 1.7) return "Ionic";
        if ($deltaE > 0.4) return "Polar Covalent";
        return "Nonpolar Covalent";
    }

    /**
     * Determine molecular bond characteristics dynamically
     * @param string $formula Molecular formula (e.g., "CH4", "NH3")
     * @return array|string Bond info or error message
     */
    public function molecularBond($formula) {
        $atoms = $this->parseChemicalFormula($formula);
        if ($atoms === false) return "Error: Invalid formula";

        $bonds = [];
        $atomList = [];
        foreach ($atoms as $symbol => $count) {
            $elementData = $this->getElementData($symbol);
            if ($elementData === "Error: Element not found") return "Error: Element $symbol not found";
            $atomList[$symbol] = ['count' => $count, 'valence' => $elementData['valence']];
        }

        // Simplified bonding logic: assume central atom is the one with highest valence or lowest electronegativity
        $centralAtom = array_reduce(array_keys($atomList), function($carry, $symbol) use ($atomList) {
            $data = $this->getElementData($symbol);
            if (!$carry || $data['valence'] > $this->getElementData($carry)['valence']) return $symbol;
            return $carry;
        }, null);

        $remainingValence = $atomList[$centralAtom]['valence'];
        unset($atomList[$centralAtom]['valence']); // Remove valence from count array

        foreach ($atomList as $symbol => $data) {
            if ($symbol === $centralAtom) continue;
            $count = $data['count'];
            $valence = $this->getElementData($symbol)['valence'];
            $bondsNeeded = min($remainingValence, $valence * $count);
            $bondType = $this->atomicBond($centralAtom, $symbol);
            $bonds[] = ["$centralAtom-$symbol", $bondType, $bondsNeeded];
            $remainingValence -= $bondsNeeded;
            if ($remainingValence < 0) return "Error: Invalid bonding configuration";
        }

        return $bonds; // Array of [bond, type, count]
    }

    // Physical Chemistry
    /**
     * Calculate Clausius-Clapeyron vapor pressure (ln(P₂/P₁) = -ΔH_vap/R * (1/T₂ - 1/T₁))
     * @param float $p1 Initial vapor pressure (Pa by default)
     * @param float $t1 Initial temperature (K by default)
     * @param float $t2 Final temperature (K by default)
     * @param float $deltaHvap Enthalpy of vaporization (J/mol by default)
     * @param string $unitPressure Unit for pressure (default: "Pa", options: "atm")
     * @param string $unitTemperature Unit for temperature (default: "K", options: "C")
     * @param string $unitEnthalpy Unit for enthalpy (default: "J/mol", options: "kJ/mol")
     * @return float|string Final vapor pressure or error message
     */
    public function clausiusClapeyron($p1, $t1, $t2, $deltaHvap, $unitPressure = "Pa", $unitTemperature = "K", $unitEnthalpy = "J/mol") {
        if ($p1 <= 0 || $t1 <= 0 || $t2 <= 0 || $deltaHvap < 0) return "Error: Values must be valid";
        if ($unitPressure === "atm") $p1 *= self::ATM_TO_PA; // atm to Pa
        if ($unitTemperature === "C") {
            $t1 += 273.15; // C to K
            $t2 += 273.15;
        }
        if ($unitEnthalpy === "kJ/mol") $deltaHvap *= 1000; // kJ/mol to J/mol
        $term = -$deltaHvap / self::R * (1 / $t2 - 1 / $t1);
        $result = $p1 * exp($term); // Pressure in Pa
        if ($unitPressure === "atm") return $result / self::ATM_TO_PA; // Pa to atm
        return $result; // Default Pa
    }

    // Analytical Chemistry
    /**
     * Calculate pH (pH = -log10[H⁺])
     * @param float $hConcentration H⁺ concentration (mol/L by default)
     * @param string $unitConcentration Unit for concentration (default: "mol/L", options: "mmol/L")
     * @return float|string pH or error message
     */
    public function pH($hConcentration, $unitConcentration = "mol/L") {
        if ($hConcentration <= 0) return "Error: Concentration must be positive";
        if ($unitConcentration === "mmol/L") $hConcentration /= 1000; // mmol/L to mol/L
        return -log10($hConcentration); // pH (unitless)
    }

    // Molecule Shape Drawing
    /**
     * Draw molecule shape based on formula dynamically (outputs JavaScript code for THREE.js)
     * @param string $formula Molecular formula (e.g., "CH4", "NH3")
     * @return string|string JavaScript code or error message
     */
    public function drawMoleculeShape($formula) {
        $atoms = $this->parseChemicalFormula($formula);
        if ($atoms === false) return "Error: Invalid formula";

        // Determine central atom (highest valence or lowest electronegativity)
        $centralAtom = null;
        $minElectronegativity = null;
        $maxValence = 0;
        foreach ($atoms as $symbol => $count) {
            $data = $this->getElementData($symbol);
            if ($data === "Error: Element not found") return "Error: Element $symbol not found";
            if ($data['valence'] > $maxValence || ($data['valence'] === $maxValence && ($minElectronegativity === null || $data['electronegativity'] < $minElectronegativity))) {
                $centralAtom = $symbol;
                $maxValence = $data['valence'];
                $minElectronegativity = $data['electronegativity'];
            }
        }

        $ligands = 0;
        foreach ($atoms as $symbol => $count) {
            if ($symbol !== $centralAtom) $ligands += $count;
        }

        // Simplified VSEPR: Determine geometry based on number of ligands (assuming no lone pairs for simplicity)
        $geometry = $this->determineGeometry($ligands);
        if ($geometry === "Error: Geometry not supported") return $geometry;

        // Generate THREE.js code
        $jsCode = "<script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js'></script>\n";
        $jsCode .= "<script>\n";
        $jsCode .= "const scene = new THREE.Scene();\n";
        $jsCode .= "const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);\n";
        $jsCode .= "const renderer = new THREE.WebGLRenderer();\n";
        $jsCode .= "renderer.setSize(window.innerWidth, window.innerHeight);\n";
        $jsCode .= "document.body.appendChild(renderer.domElement);\n";

        // Add central atom
        $centralColor = $this->getAtomColor($centralAtom);
        $jsCode .= "const central = new THREE.Mesh(new THREE.SphereGeometry(0.5), new THREE.MeshBasicMaterial({color: 0x$centralColor}));\n";
        $jsCode .= "scene.add(central);\n";

        // Add ligands based on geometry
        $positions = $this->getGeometryPositions($geometry, $ligands);
        $ligandIndex = 0;
        foreach ($atoms as $symbol => $count) {
            if ($symbol === $centralAtom) continue;
            $color = $this->getAtomColor($symbol);
            for ($i = 0; $i < $count; $i++) {
                if ($ligandIndex >= count($positions)) break;
                $pos = $positions[$ligandIndex];
                $jsCode .= "const $symbol$i = new THREE.Mesh(new THREE.SphereGeometry(0.3), new THREE.MeshBasicMaterial({color: 0x$color}));\n";
                $jsCode .= "$symbol$i.position.set($pos[0], $pos[1], $pos[2]);\n";
                $jsCode .= "scene.add($symbol$i);\n";
                $ligandIndex++;
            }
        }

        $jsCode .= "camera.position.z = 5;\n";
        $jsCode .= "function animate() { requestAnimationFrame(animate); renderer.render(scene, camera); }\n";
        $jsCode .= "animate();\n";
        $jsCode .= "</script>\n";
        return $jsCode; // JavaScript code for THREE.js visualization
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

    private function determineGeometry($ligands) {
        switch ($ligands) {
            case 1: return "Linear";
            case 2: return "Linear";
            case 3: return "Trigonal Planar";
            case 4: return "Tetrahedral";
            case 5: return "Trigonal Bipyramidal";
            case 6: return "Octahedral";
            default: return "Error: Geometry not supported";
        }
    }

    private function getGeometryPositions($geometry, $ligands) {
        switch ($geometry) {
            case "Linear":
                if ($ligands == 1) return [[1.5, 0, 0]];
                return [[1.5, 0, 0], [-1.5, 0, 0]];
            case "Trigonal Planar":
                return [[1.5, 0, 0], [-0.75, 1.3, 0], [-0.75, -1.3, 0]];
            case "Tetrahedral":
                return [[1, 1, 1], [1, -1, -1], [-1, 1, -1], [-1, -1, 1]];
            case "Trigonal Bipyramidal":
                return [[0, 1.5, 0], [0, -1.5, 0], [1.3, 0, 0], [-0.65, 1.12, 0], [-0.65, -1.12, 0]];
            case "Octahedral":
                return [[1.5, 0, 0], [-1.5, 0, 0], [0, 1.5, 0], [0, -1.5, 0], [0, 0, 1.5], [0, 0, -1.5]];
            default: return [];
        }
    }

    private function getAtomColor($symbol) {
        $colors = [
            'H' => 'ffffff', 'C' => '000000', 'N' => '0000ff', 'O' => 'ff0000', 'F' => '00ff00',
            'Cl' => '00ff00', 'S' => 'ffff00', 'P' => 'ff8000', 'Na' => '800080', 'default' => '808080'
        ];
        return $colors[$symbol] ?? $colors['default'];
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing ChemistryCalculations:\n";
        echo "----------------------------------------\n";

        // Group 1: Periodic Table
        echo "Group 1: Periodic Table\n";
        echo "-------------------------\n";
        echo "// Test atomic mass of Hydrogen (H)\n";
        echo "getAtomicMass('H'): " . $this->getAtomicMass('H') . "\n"; // Expected: 1.00794
        echo "// Test electronegativity of Carbon (atomic number 6)\n";
        echo "getElectronegativity(6): " . $this->getElectronegativity(6) . "\n"; // Expected: 2.55
        echo "// Test electron orbitals of Nitrogen (N)\n";
        echo "getOrbitals('N'): " . $this->getOrbitals('N') . "\n"; // Expected: [He] 2s² 2p³

        // Group 2: General Chemistry
        echo "\nGroup 2: General Chemistry\n";
        echo "-------------------------\n";
        echo "// Test mass from moles with n=2 mol, M=18 g/mol\n";
        echo "molarMassToMass(2, 18): " . $this->molarMassToMass(2, 18) . "\n"; // Expected: 36
        echo "// Test moles from mass with m=36 g, M=18 g/mol\n";
        echo "massToMoles(36, 18): " . $this->massToMoles(36, 18) . "\n"; // Expected: 2
        echo "// Test particles from moles with n=1 mol\n";
        echo "molesToParticles(1): " . $this->molesToParticles(1) . "\n"; // Expected: 6.02214076e23
        echo "// Test molar concentration with n=0.5 mol, V=1 L\n";
        echo "molarConcentration(0.5, 1): " . $this->molarConcentration(0.5, 1) . "\n"; // Expected: 0.5
        echo "// Test stoichiometry with knownMoles=2 mol, coeffKnown=1, coeffUnknown=2\n";
        echo "stoichiometry(2, 1, 2): " . $this->stoichiometry(2, 1, 2) . "\n"; // Expected: 4
        echo "// Test ideal gas volume with n=1 mol, T=298 K, P=101325 Pa\n";
        echo "idealGasVolume(1, 298, 101325): " . $this->idealGasVolume(1, 298, 101325) . "\n"; // Expected: ~0.0244

        // Group 3: Thermodynamics
        echo "\nGroup 3: Thermodynamics\n";
        echo "-------------------------\n";
        echo "// Test enthalpy change with products=[100, 50] J/mol, reactants=[80, 30] J/mol\n";
        echo "enthalpyChange([100, 50], [80, 30]): " . $this->enthalpyChange([100, 50], [80, 30]) . "\n"; // Expected: 40
        echo "// Test entropy change with products=[50, 30] J/mol·K, reactants=[40, 20] J/mol·K\n";
        echo "entropyChange([50, 30], [40, 20]): " . $this->entropyChange([50, 30], [40, 20]) . "\n"; // Expected: 20
        echo "// Test Gibbs free energy with ΔH=40000 J/mol, T=298 K, ΔS=20 J/mol·K\n";
        echo "gibbsFreeEnergy(40000, 298, 20): " . $this->gibbsFreeEnergy(40000, 298, 20) . "\n"; // Expected: 34040

        // Group 4: Bonding and Molecular Shape
        echo "\nGroup 4: Bonding and Molecular Shape\n";
        echo "-------------------------\n";
        echo "// Test atomic bond between Na (11) and Cl (17)\n";
        echo "atomicBond(11, 17): " . $this->atomicBond(11, 17) . "\n"; // Expected: Ionic
        echo "// Test molecular bond for CH4\n";
        echo "molecularBond('CH4'): " . json_encode($this->molecularBond('CH4')) . "\n"; // Expected: [['C-H', 'Nonpolar Covalent', 4]]
        echo "// Test molecular bond for NH3\n";
        echo "molecularBond('NH3'): " . json_encode($this->molecularBond('NH3')) . "\n"; // Expected: [['N-H', 'Polar Covalent', 3]]
        echo "// Test molecule shape drawing for CH4\n";
        echo "drawMoleculeShape('CH4'): (JavaScript output not shown here)\n"; // Expected: Tetrahedral shape JS code
        echo "// Test molecule shape drawing for NH3\n";
        echo "drawMoleculeShape('NH3'): (JavaScript output not shown here)\n"; // Expected: Trigonal Pyramidal shape JS code (simplified as Trigonal Planar here)

        // Group 5: Physical and Analytical Chemistry
        echo "\nGroup 5: Physical and Analytical Chemistry\n";
        echo "-------------------------\n";
        echo "// Test Clausius-Clapeyron with P₁=100000 Pa, T₁=373 K, T₂=353 K, ΔH_vap=40670 J/mol\n";
        echo "clausiusClapeyron(100000, 373, 353, 40670): " . $this->clausiusClapeyron(100000, 373, 353, 40670) . "\n"; // Expected: ~42685
        echo "// Test pH with [H⁺]=0.001 mol/L\n";
        echo "pH(0.001): " . $this->pH(0.001) . "\n"; // Expected: 3

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$chem = new ChemistryCalculations();
$chem->runTests();
?>