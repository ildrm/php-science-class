# PHP ComputerScienceCalculations Library

This library provides a collection of functions commonly used in computer science, including sorting algorithms, searching algorithms, graph algorithms, dynamic programming, string algorithms, cryptography basics, and resource usage estimations.  The library aims to provide clear and concise implementations of these algorithms, along with comprehensive testing to ensure correctness.

## Function Reference

| Function Name | Function Description | Function Scientific Description (Time Complexity) |
|---|---|---|
| `bubbleSort(arr)` | Bubble Sort | O(n²) comparison-based sorting |
| `selectionSort(arr)` | Selection Sort | O(n²) comparison-based sorting |
| `insertionSort(arr)` | Insertion Sort | O(n²) comparison-based sorting |
| `mergeSort(arr)` | Merge Sort | O(n log n) comparison-based sorting |
| `quickSort(arr)` | Quick Sort | O(n log n) average, O(n²) worst-case comparison-based sorting |
| `heapSort(arr)` | Heap Sort | O(n log n) comparison-based sorting |
| `shellSort(arr)` | Shell Sort | O(n log n) to O(n²) comparison-based sorting |
| `countingSort(arr)` | Counting Sort | O(n + k) non-comparison-based sorting |
| `radixSort(arr)` | Radix Sort | O(nk) non-comparison-based sorting |
| `bucketSort(arr)` | Bucket Sort |  O(n + k) non-comparison-based sorting |
| `linearSearch(arr, target)` | Linear Search | O(n) search |
| `binarySearch(arr, target)` | Binary Search (requires sorted array) | O(log n) search |
| `dfs(graph, start)` | Depth-First Search (graph traversal) | O(V + E) graph traversal |
| `bfs(graph, start)` | Breadth-First Search (graph traversal) | O(V + E) graph traversal |
| `dijkstra(graph, start)` | Dijkstra's Algorithm (shortest paths in weighted graph) | O((V + E) log V) with binary heap |
| `knapsack(values, weights, capacity)` | 0/1 Knapsack Problem (dynamic programming) | O(nW) dynamic programming |
| `longestCommonSubsequence(str1, str2)` | Longest Common Subsequence (dynamic programming) | O(mn) dynamic programming |
| `simpleHash(input, tableSize)` | Simple Hash Function | O(n) hashing |
| `caesarCipherEncrypt(text, shift)` | Caesar Cipher Encryption | O(n) encryption |
| `timeComplexity(n, algorithm)` | Estimate time complexity | Provides a simplified estimate of time complexity based on algorithm type and input size. |
| `memoryUsageArray(size, bytesPerElement)` | Calculate array memory usage |  Calculates the memory used by an array based on its size and element size. |

## Test Function

The `runTests()` function comprehensively tests all the functions in the library.  It's organized into groups based on algorithm categories (sorting, searching, graph algorithms, etc.).  Each test case calls a function with specific inputs and prints the returned result alongside the expected output for easy verification. The tests also include edge cases and error handling checks to demonstrate the robustness of the functions.  For example, sorting algorithms are tested with empty arrays, searching algorithms with non-existent targets, and graph algorithms with invalid vertices. This rigorous testing methodology helps to ensure the correctness and reliability of the library's implementations.