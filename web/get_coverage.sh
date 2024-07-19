#!/bin/bash

# 全体の行数とカバレッジされた行数を取得
total_statements=$(grep -o 'statements="[^"]*"' coverage.xml | awk -F'"' '{sum += $2} END {print sum}')
covered_statements=$(grep -o 'coveredstatements="[^"]*"' coverage.xml | awk -F'"' '{sum += $2} END {print sum}')

# デバッグ: 変数の値を表示
echo "Total statements: $total_statements"
echo "Covered statements: $covered_statements"

# カバレッジ率を計算
if [ "$total_statements" -gt 0 ]; then
  coverage=$(awk -v covered=$covered_statements -v total=$total_statements 'BEGIN {printf "%.2f", (covered / total) * 100}')
else
  coverage=0
fi

# 結果を表示
echo "Overall Coverage: $coverage%"
