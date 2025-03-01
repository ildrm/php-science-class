<?php

class ComputerScienceCalculations {
    const KB_TO_BYTES = 1024; // 1 KB = 1024 bytes
    const MB_TO_BYTES = 1048576; // 1 MB = 1024² bytes
    const GB_TO_BYTES = 1073741824; // 1 GB = 1024³ bytes

    // Sorting Algorithms
    /**
     * Bubble Sort (O(n²) comparison-based, stable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function bubbleSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $n = count($arr);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($arr[$j] > $arr[$j + 1]) {
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j + 1];
                    $arr[$j + 1] = $temp;
                }
            }
        }
        return $arr;
    }

    /**
     * Selection Sort (O(n²) comparison-based, unstable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function selectionSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $n = count($arr);
        for ($i = 0; $i < $n - 1; $i++) {
            $minIdx = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($arr[$j] < $arr[$minIdx]) {
                    $minIdx = $j;
                }
            }
            if ($minIdx != $i) {
                $temp = $arr[$i];
                $arr[$i] = $arr[$minIdx];
                $arr[$minIdx] = $temp;
            }
        }
        return $arr;
    }

    /**
     * Insertion Sort (O(n²) comparison-based, stable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function insertionSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $n = count($arr);
        for ($i = 1; $i < $n; $i++) {
            $key = $arr[$i];
            $j = $i - 1;
            while ($j >= 0 && $arr[$j] > $key) {
                $arr[$j + 1] = $arr[$j];
                $j--;
            }
            $arr[$j + 1] = $key;
        }
        return $arr;
    }

    /**
     * Merge Sort (O(n log n) comparison-based, stable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function mergeSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        if (count($arr) <= 1) return $arr;
        
        $mid = (int)(count($arr) / 2);
        $left = array_slice($arr, 0, $mid);
        $right = array_slice($arr, $mid);
        
        return $this->merge($this->mergeSort($left), $this->mergeSort($right));
    }

    private function merge($left, $right) {
        $result = [];
        $i = $j = 0;
        
        while ($i < count($left) && $j < count($right)) {
            if ($left[$i] <= $right[$j]) {
                $result[] = $left[$i];
                $i++;
            } else {
                $result[] = $right[$j];
                $j++;
            }
        }
        
        return array_merge($result, array_slice($left, $i), array_slice($right, $j));
    }

    /**
     * Quick Sort (O(n log n) average, O(n²) worst, comparison-based, unstable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function quickSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        if (count($arr) <= 1) return $arr;
        
        $this->quickSortRecursive($arr, 0, count($arr) - 1);
        return $arr;
    }

    private function quickSortRecursive(&$arr, $low, $high) {
        if ($low < $high) {
            $pivotIdx = $this->partition($arr, $low, $high);
            $this->quickSortRecursive($arr, $low, $pivotIdx - 1);
            $this->quickSortRecursive($arr, $pivotIdx + 1, $high);
        }
    }

    private function partition(&$arr, $low, $high) {
        $pivot = $arr[$high];
        $i = $low - 1;
        for ($j = $low; $j < $high; $j++) {
            if ($arr[$j] <= $pivot) {
                $i++;
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
            }
        }
        $temp = $arr[$i + 1];
        $arr[$i + 1] = $arr[$high];
        $arr[$high] = $temp;
        return $i + 1;
    }

    /**
     * Heap Sort (O(n log n) comparison-based, unstable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function heapSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $n = count($arr);
        for ($i = (int)($n / 2) - 1; $i >= 0; $i--) {
            $this->heapify($arr, $n, $i);
        }
        
        for ($i = $n - 1; $i > 0; $i--) {
            $temp = $arr[0];
            $arr[0] = $arr[$i];
            $arr[$i] = $temp;
            $this->heapify($arr, $i, 0);
        }
        return $arr;
    }

    private function heapify(&$arr, $n, $i) {
        $largest = $i;
        $left = 2 * $i + 1;
        $right = 2 * $i + 2;
        
        if ($left < $n && $arr[$left] > $arr[$largest]) $largest = $left;
        if ($right < $n && $arr[$right] > $arr[$largest]) $largest = $right;
        
        if ($largest != $i) {
            $temp = $arr[$i];
            $arr[$i] = $arr[$largest];
            $arr[$largest] = $temp;
            $this->heapify($arr, $n, $largest);
        }
    }

    /**
     * Shell Sort (O(n log n) to O(n²) comparison-based, unstable)
     * @param array $arr Unsorted array
     * @return array|string Sorted array or error message
     */
    public function shellSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $n = count($arr);
        for ($gap = (int)($n / 2); $gap > 0; $gap = (int)($gap / 2)) {
            for ($i = $gap; $i < $n; $i++) {
                $temp = $arr[$i];
                $j = $i;
                while ($j >= $gap && $arr[$j - $gap] > $temp) {
                    $arr[$j] = $arr[$j - $gap];
                    $j -= $gap;
                }
                $arr[$j] = $temp;
            }
        }
        return $arr;
    }

    /**
     * Counting Sort (O(n + k) non-comparison-based, stable)
     * @param array $arr Unsorted array of non-negative integers
     * @return array|string Sorted array or error message
     */
    public function countingSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $max = max($arr);
        $min = min($arr);
        if ($min < 0) return "Error: Array must contain non-negative integers";
        
        $count = array_fill(0, $max + 1, 0);
        $output = array_fill(0, count($arr), 0);
        
        foreach ($arr as $value) {
            $count[$value]++;
        }
        
        for ($i = 1; $i <= $max; $i++) {
            $count[$i] += $count[$i - 1];
        }
        
        for ($i = count($arr) - 1; $i >= 0; $i--) {
            $output[$count[$arr[$i]] - 1] = $arr[$i];
            $count[$arr[$i]]--;
        }
        
        return $output;
    }

    /**
     * Radix Sort (O(nk) non-comparison-based, stable)
     * @param array $arr Unsorted array of non-negative integers
     * @return array|string Sorted array or error message
     */
    public function radixSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        if (min($arr) < 0) return "Error: Array must contain non-negative integers";
        
        $max = max($arr);
        for ($exp = 1; $max / $exp > 0; $exp *= 10) {
            $arr = $this->countingSortByDigit($arr, $exp);
        }
        return $arr;
    }

    private function countingSortByDigit($arr, $exp) {
        $n = count($arr);
        $output = array_fill(0, $n, 0);
        $count = array_fill(0, 10, 0);
        
        foreach ($arr as $value) {
            $digit = (int)(($value / $exp) % 10);
            $count[$digit]++;
        }
        
        for ($i = 1; $i < 10; $i++) {
            $count[$i] += $count[$i - 1];
        }
        
        for ($i = $n - 1; $i >= 0; $i--) {
            $digit = (int)(($arr[$i] / $exp) % 10);
            $output[$count[$digit] - 1] = $arr[$i];
            $count[$digit]--;
        }
        
        return $output;
    }

    /**
     * Bucket Sort (O(n + k) non-comparison-based, stable for small ranges)
     * @param array $arr Unsorted array of floats between 0 and 1
     * @return array|string Sorted array or error message
     */
    public function bucketSort($arr) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        $n = count($arr);
        $buckets = array_fill(0, $n, []);
        
        foreach ($arr as $value) {
            if (!is_numeric($value) || $value < 0 || $value > 1) return "Error: Values must be between 0 and 1";
            $index = (int)($value * $n);
            $buckets[$index][] = $value;
        }
        
        $result = [];
        foreach ($buckets as $bucket) {
            $sortedBucket = $this->insertionSort($bucket);
            $result = array_merge($result, $sortedBucket);
        }
        return $result;
    }

    // Searching Algorithms
    /**
     * Linear Search (O(n))
     * @param array $arr Array to search
     * @param mixed $target Value to find
     * @return int|string Index of target or error message
     */
    public function linearSearch($arr, $target) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        
        foreach ($arr as $i => $value) {
            if ($value === $target) return $i;
        }
        return -1; // Target not found
    }

    /**
     * Binary Search (O(log n), assumes sorted array)
     * @param array $arr Sorted array
     * @param int $target Value to find
     * @return int|string Index of target or error message
     */
    public function binarySearch($arr, $target) {
        if (!is_array($arr) || empty($arr)) return "Error: Array must be non-empty";
        if (!is_int($target)) return "Error: Target must be an integer";
        
        $left = 0;
        $right = count($arr) - 1;
        
        while ($left <= $right) {
            $mid = (int)(($left + $right) / 2);
            if ($arr[$mid] === $target) return $mid;
            elseif ($arr[$mid] < $target) $left = $mid + 1;
            else $right = $mid - 1;
        }
        return -1; // Target not found
    }

    // Graph Algorithms
    /**
     * Depth-First Search (DFS) (O(V + E))
     * @param array $graph Adjacency list representation
     * @param int $start Starting vertex
     * @return array|string Visited nodes or error message
     */
    public function dfs($graph, $start) {
        if (!is_array($graph) || !isset($graph[$start])) return "Error: Invalid graph or start vertex";
        
        $visited = [];
        $this->dfsRecursive($graph, $start, $visited);
        return $visited;
    }

    private function dfsRecursive($graph, $vertex, &$visited) {
        $visited[] = $vertex;
        foreach ($graph[$vertex] as $neighbor) {
            if (!in_array($neighbor, $visited)) {
                $this->dfsRecursive($graph, $neighbor, $visited);
            }
        }
    }

    /**
     * Breadth-First Search (BFS) (O(V + E))
     * @param array $graph Adjacency list representation
     * @param int $start Starting vertex
     * @return array|string Visited nodes or error message
     */
    public function bfs($graph, $start) {
        if (!is_array($graph) || !isset($graph[$start])) return "Error: Invalid graph or start vertex";
        
        $visited = [];
        $queue = [$start];
        $visited[] = $start;
        
        while (!empty($queue)) {
            $vertex = array_shift($queue);
            foreach ($graph[$vertex] as $neighbor) {
                if (!in_array($neighbor, $visited)) {
                    $visited[] = $neighbor;
                    $queue[] = $neighbor;
                }
            }
        }
        return $visited;
    }

    /**
     * Dijkstra’s Algorithm (O((V + E) log V) with binary heap)
     * @param array $graph Weighted adjacency matrix
     * @param int $start Starting vertex
     * @return array|string Shortest distances or error message
     */
    public function dijkstra($graph, $start) {
        if (!is_array($graph) || !isset($graph[$start])) return "Error: Invalid graph or start vertex";
        
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

    // Dynamic Programming
    /**
     * Knapsack Problem (0/1) (O(nW))
     * @param array $values Values of items
     * @param array $weights Weights of items
     * @param int $capacity Maximum weight capacity
     * @return int|string Maximum value or error message
     */
    public function knapsack($values, $weights, $capacity) {
        if (!is_array($values) || !is_array($weights) || count($values) != count($weights) || !is_int($capacity) || $capacity < 0) {
            return "Error: Invalid input arrays or capacity";
        }
        
        $n = count($values);
        $dp = array_fill(0, $n + 1, array_fill(0, $capacity + 1, 0));
        
        for ($i = 1; $i <= $n; $i++) {
            for ($w = 0; $w <= $capacity; $w++) {
                if ($weights[$i - 1] <= $w) {
                    $dp[$i][$w] = max($values[$i - 1] + $dp[$i - 1][$w - $weights[$i - 1]], $dp[$i - 1][$w]);
                } else {
                    $dp[$i][$w] = $dp[$i - 1][$w];
                }
            }
        }
        return $dp[$n][$capacity];
    }

    // String Algorithms
    /**
     * Longest Common Subsequence (LCS) (O(mn))
     * @param string $str1 First string
     * @param string $str2 Second string
     * @return int|string Length of LCS or error message
     */
    public function longestCommonSubsequence($str1, $str2) {
        if (!is_string($str1) || !is_string($str2)) return "Error: Inputs must be strings";
        
        $m = strlen($str1);
        $n = strlen($str2);
        $dp = array_fill(0, $m + 1, array_fill(0, $n + 1, 0));
        
        for ($i = 1; $i <= $m; $i++) {
            for ($j = 1; $j <= $n; $j++) {
                if ($str1[$i - 1] === $str2[$j - 1]) {
                    $dp[$i][$j] = $dp[$i - 1][$j - 1] + 1;
                } else {
                    $dp[$i][$j] = max($dp[$i - 1][$j], $dp[$i][$j - 1]);
                }
            }
        }
        return $dp[$m][$n];
    }

    /**
     * Simple Hash Function (O(n))
     * @param string $input Input string
     * @param int $tableSize Size of hash table
     * @return int|string Hash value or error message
     */
    public function simpleHash($input, $tableSize) {
        if (!is_string($input)) return "Error: Input must be a string";
        if (!is_int($tableSize) || $tableSize <= 0) return "Error: Table size must be a positive integer";
        
        $hash = 0;
        for ($i = 0; $i < strlen($input); $i++) {
            $hash = ($hash * 31 + ord($input[$i])) % $tableSize;
        }
        return $hash;
    }

    // Cryptography
    /**
     * Caesar Cipher Encryption (O(n))
     * @param string $text Plain text
     * @param int $shift Shift value
     * @return string|string Encrypted text or error message
     */
    public function caesarCipherEncrypt($text, $shift) {
        if (!is_string($text)) return "Error: Text must be a string";
        if (!is_int($shift)) return "Error: Shift must be an integer";
        
        $result = "";
        for ($i = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $ascii = ord(ctype_upper($char) ? 'A' : 'a');
                $result .= chr(($ascii + ((ord($char) - $ascii + $shift) % 26)));
            } else {
                $result .= $char;
            }
        }
        return $result;
    }

    // Resource Usage
    /**
     * Calculate time complexity (simplified estimate)
     * @param int $n Input size
     * @param string $algorithm Algorithm type
     * @param string $unitTime Unit for time (default: "s", options: "ms", "µs")
     * @return float|string Estimated time or error message
     */
    public function timeComplexity($n, $algorithm, $unitTime = "s") {
        if (!is_int($n) || $n < 1) return "Error: Input size must be a positive integer";
        
        $baseTime = 1e-9; // Base time per operation in seconds
        switch (strtolower($algorithm)) {
            case "constant": $result = $baseTime; break; // O(1)
            case "linear": $result = $n * $baseTime; break; // O(n)
            case "quadratic": $result = pow($n, 2) * $baseTime; break; // O(n²)
            case "logarithmic": $result = log($n, 2) * $baseTime; break; // O(log n)
            case "nlogn": $result = $n * log($n, 2) * $baseTime; break; // O(n log n)
            default: return "Error: Unsupported algorithm type";
        }
        
        if ($unitTime === "ms") return $result * 1000; // s to ms
        elseif ($unitTime === "µs") return $result * 1e6; // s to µs
        return $result; // Default s
    }

    /**
     * Calculate memory usage for an array
     * @param int $size Number of elements
     * @param int $bytesPerElement Bytes per element
     * @param string $unitMemory Unit for memory (default: "bytes", options: "KB", "MB", "GB")
     * @return float|string Memory usage or error message
     */
    public function memoryUsageArray($size, $bytesPerElement, $unitMemory = "bytes") {
        if (!is_int($size) || $size < 0) return "Error: Size must be a non-negative integer";
        if (!is_int($bytesPerElement) || $bytesPerElement <= 0) return "Error: Bytes per element must be positive";
        
        $result = $size * $bytesPerElement; // Memory in bytes
        
        if ($unitMemory === "KB") return $result / self::KB_TO_BYTES; // bytes to KB
        elseif ($unitMemory === "MB") return $result / self::MB_TO_BYTES; // bytes to MB
        elseif ($unitMemory === "GB") return $result / self::GB_TO_BYTES; // bytes to GB
        return $result; // Default bytes
    }

    /**
     * Run tests for all functions, organized by groups
     * @return void
     */
    public function runTests() {
        echo "Start Testing ComputerScienceCalculations:\n";
        echo "----------------------------------------\n";

        // Sample data for testing
        $testArr = [64, 34, 25, 12, 22, 11, 90];
        $sortedArr = [11, 12, 22, 25, 34, 64, 90];
        $floatArr = [0.78, 0.17, 0.39, 0.26, 0.72, 0.94, 0.21];
        $sortedFloatArr = [0.17, 0.21, 0.26, 0.39, 0.72, 0.78, 0.94];
        $countingRadixArr = [170, 45, 75, 90, 802, 24, 2, 66];
        $sortedCountingRadixArr = [2, 24, 45, 66, 75, 90, 170, 802];
        $graph = [0 => [1, 2], 1 => [0, 3], 2 => [0], 3 => [1]];
        $weightedGraph = [
            [0, 4, 0, 0],
            [4, 0, 8, 0],
            [0, 8, 0, 7],
            [0, 0, 7, 0]
        ];

        // Group 1: Sorting Algorithms - Simple
        echo "Group 1: Sorting Algorithms - Simple\n";
        echo "-------------------------\n";
        echo "// Test Bubble Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "bubbleSort: " . json_encode($this->bubbleSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Selection Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "selectionSort: " . json_encode($this->selectionSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Insertion Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "insertionSort: " . json_encode($this->insertionSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Bubble Sort with empty array\n";
        echo "bubbleSort([]): " . $this->bubbleSort([]) . " (Expected: Error: Array must be non-empty)\n";

        // Group 2: Sorting Algorithms - Advanced
        echo "\nGroup 2: Sorting Algorithms - Advanced\n";
        echo "-------------------------\n";
        echo "// Test Merge Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "mergeSort: " . json_encode($this->mergeSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Quick Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "quickSort: " . json_encode($this->quickSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Heap Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "heapSort: " . json_encode($this->heapSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Shell Sort on [64, 34, 25, 12, 22, 11, 90]\n";
        echo "shellSort: " . json_encode($this->shellSort($testArr)) . " (Expected: " . json_encode($sortedArr) . ")\n";
        echo "// Test Merge Sort with single element array\n";
        echo "mergeSort([5]): " . json_encode($this->mergeSort([5])) . " (Expected: [5])\n";

        // Group 3: Sorting Algorithms - Non-Comparison
        echo "\nGroup 3: Sorting Algorithms - Non-Comparison\n";
        echo "-------------------------\n";
        echo "// Test Counting Sort on [4, 2, 2, 8, 3, 3, 1]\n";
        echo "countingSort: " . json_encode($this->countingSort([4, 2, 2, 8, 3, 3, 1])) . " (Expected: [1, 2, 2, 3, 3, 4, 8])\n";
        echo "// Test Radix Sort on [170, 45, 75, 90, 802, 24, 2, 66]\n";
        echo "radixSort: " . json_encode($this->radixSort($countingRadixArr)) . " (Expected: " . json_encode($sortedCountingRadixArr) . ")\n";
        echo "// Test Bucket Sort on [0.78, 0.17, 0.39, 0.26, 0.72, 0.94, 0.21]\n";
        echo "bucketSort: " . json_encode($this->bucketSort($floatArr)) . " (Expected: " . json_encode($sortedFloatArr) . ")\n";
        echo "// Test Counting Sort with negative numbers\n";
        echo "countingSort([-1, 2, 3]): " . $this->countingSort([-1, 2, 3]) . " (Expected: Error: Array must contain non-negative integers)\n";

        // Group 4: Searching Algorithms
        echo "\nGroup 4: Searching Algorithms\n";
        echo "-------------------------\n";
        echo "// Test Linear Search for 25 in [64, 34, 25, 12, 22]\n";
        echo "linearSearch([64, 34, 25, 12, 22], 25): " . $this->linearSearch([64, 34, 25, 12, 22], 25) . " (Expected: 2)\n";
        echo "// Test Linear Search for 100 in [64, 34, 25, 12, 22]\n";
        echo "linearSearch([64, 34, 25, 12, 22], 100): " . $this->linearSearch([64, 34, 25, 12, 22], 100) . " (Expected: -1)\n";
        echo "// Test Binary Search for 7 in sorted array [1, 3, 5, 7, 9]\n";
        echo "binarySearch([1, 3, 5, 7, 9], 7): " . $this->binarySearch([1, 3, 5, 7, 9], 7) . " (Expected: 3)\n";
        echo "// Test Binary Search for 4 in sorted array [1, 3, 5, 7, 9]\n";
        echo "binarySearch([1, 3, 5, 7, 9], 4): " . $this->binarySearch([1, 3, 5, 7, 9], 4) . " (Expected: -1)\n";
        echo "// Test Linear Search with empty array\n";
        echo "linearSearch([], 5): " . $this->linearSearch([], 5) . " (Expected: Error: Array must be non-empty)\n";

        // Group 5: Graph Algorithms
        echo "\nGroup 5: Graph Algorithms\n";
        echo "-------------------------\n";
        echo "// Test DFS on graph [0 => [1, 2], 1 => [0, 3], 2 => [0], 3 => [1]] starting from 0\n";
        echo "dfs(graph, 0): " . json_encode($this->dfs($graph, 0)) . " (Expected: [0, 1, 3, 2] or similar order)\n";
        echo "// Test BFS on graph [0 => [1, 2], 1 => [0, 3], 2 => [0], 3 => [1]] starting from 0\n";
        echo "bfs(graph, 0): " . json_encode($this->bfs($graph, 0)) . " (Expected: [0, 1, 2, 3])\n";
        echo "// Test Dijkstra’s on weighted graph from vertex 0\n";
        echo "dijkstra(weightedGraph, 0): " . json_encode($this->dijkstra($weightedGraph, 0)) . " (Expected: [0, 4, 12, 19])\n";
        echo "// Test DFS with invalid start vertex\n";
        echo "dfs(graph, 4): " . $this->dfs($graph, 4) . " (Expected: Error: Invalid graph or start vertex)\n";

        // Group 6: Dynamic Programming and String Algorithms
        echo "\nGroup 6: Dynamic Programming and String Algorithms\n";
        echo "-------------------------\n";
        echo "// Test Knapsack with values [60, 100, 120], weights [10, 20, 30], capacity 50\n";
        echo "knapsack([60, 100, 120], [10, 20, 30], 50): " . $this->knapsack([60, 100, 120], [10, 20, 30], 50) . " (Expected: 220)\n";
        echo "// Test LCS for 'ABCDGH' and 'AEDFHR'\n";
        echo "longestCommonSubsequence('ABCDGH', 'AEDFHR'): " . $this->longestCommonSubsequence("ABCDGH", "AEDFHR") . " (Expected: 3)\n";
        echo "// Test simple hash for 'hello' with table size 100\n";
        $hashValue = $this->simpleHash("hello", 100);
        echo "simpleHash('hello', 100): " . $hashValue . " (Expected: A number between 0 and 99)\n";
        echo "// Test Knapsack with invalid capacity\n";
        echo "knapsack([60, 100], [10, 20], -5): " . $this->knapsack([60, 100], [10, 20], -5) . " (Expected: Error: Invalid input arrays or capacity)\n";

        // Group 7: Cryptography and Resource Usage
        echo "\nGroup 7: Cryptography and Resource Usage\n";
        echo "-------------------------\n";
        echo "// Test Caesar Cipher encryption of 'hello' with shift 3\n";
        echo "caesarCipherEncrypt('hello', 3): " . $this->caesarCipherEncrypt("hello", 3) . " (Expected: 'khoor')\n";
        echo "// Test Caesar Cipher encryption of 'xyz' with shift 2\n";
        echo "caesarCipherEncrypt('xyz', 2): " . $this->caesarCipherEncrypt("xyz", 2) . " (Expected: 'zab')\n";
        echo "// Test time complexity for n log n algorithm with n=1000\n";
        echo "timeComplexity(1000, 'nlogn'): " . $this->timeComplexity(1000, "nlogn") . " s (Expected: ~6.9e-6)\n";
        echo "// Test time complexity for linear algorithm with n=100, unitTime='ms'\n";
        echo "timeComplexity(100, 'linear', 'ms'): " . $this->timeComplexity(100, "linear", "ms") . " ms (Expected: 0.0001)\n";
        echo "// Test memory usage for array with 1000 int32 elements\n";
        echo "memoryUsageArray(1000, 4): " . $this->memoryUsageArray(1000, 4) . " bytes (Expected: 4000)\n";
        echo "// Test memory usage for array with 1024 elements, 8 bytes each, unitMemory='KB'\n";
        echo "memoryUsageArray(1024, 8, 'KB'): " . $this->memoryUsageArray(1024, 8, 'KB') . " KB (Expected: 8)\n";
        echo "// Test Caesar Cipher with non-integer shift\n";
        echo "caesarCipherEncrypt('hello', 'a'): " . $this->caesarCipherEncrypt("hello", 'a') . " (Expected: Error: Shift must be an integer)\n";

        echo "----------------------------------------\n";
        echo "End of Tests\n";
    }
}

// Execute tests
$cs = new ComputerScienceCalculations();
$cs->runTests();
?>