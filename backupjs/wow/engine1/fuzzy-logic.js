// longest common sequence
// var lcs = function (string1, string2) {
//   var m, n, i, j,
//   l = [];
//   if (!string1 || string1.length === 0 || !string2 || string2.length === 0) {
//     return 0;
//   } else {
//     m = string1.length;
//     n = string2.length;
//     for(i = 0; i <= m; i+=1) {
//         l[i] = [];
//         for(j = 0; j <= n; j+=1) {
//             l[i][j] = '';
//         }
//     }
//     for (i = 0; i <= m; i++) {
//       for (j = 0; j <= n; j++) {
//         if (i === 0 || j === 0) {
//           l[i][j] = 0;
//         }
//         else if (string1[i-1] == string2[j-1]) {
//           l[i][j] = l[i-1][j-1] + 1;
//         }
//         else {
//           l[i][j] = Math.max(l[i-1][j], l[i][j-1]);
//         }
//       }
//     }
//     return l[m][n];
//   }
// };

var fuzzyLengthUpperLimit = 64,
  matchThreshold = 6,
  minThreshold = 0.7,
  ldThreshold = 2;

// levenshtein distance
var ld = function(source, target, options) {

  var sourceLength, targetLength, distanceMatrix,
    row, column,
    costToInsert, costToDelete,
    sourceElement, targetElement,
    costToSubstitute;

  options = options || {};
  options.insertion_cost = options.insertion_cost || 1;
  options.deletion_cost = options.deletion_cost || 1;
  options.substitution_cost = options.substitution_cost || 1;

  sourceLength = source.length;
  targetLength = target.length;
  distanceMatrix = [[0]];

  for (row =  1; row <= sourceLength; row++) {
    distanceMatrix[row] = [];
    distanceMatrix[row][0] = distanceMatrix[row-1][0] + options.deletion_cost;
  }

  for (column = 1; column <= targetLength; column++) {
    distanceMatrix[0][column] = distanceMatrix[0][column-1] + options.insertion_cost;
  }

  for (row = 1; row <= sourceLength; row++) {
    for (column = 1; column <= targetLength; column++) {
      costToInsert = distanceMatrix[row][column-1] + options.insertion_cost;
      costToDelete = distanceMatrix[row-1][column] + options.deletion_cost;

      sourceElement = source.charAt(row-1);
      targetElement = target.charAt(column-1);
      costToSubstitute = distanceMatrix[row-1][column-1];
      if (sourceElement !== targetElement) {
        costToSubstitute = costToSubstitute + options.substitution_cost;
      }
      distanceMatrix[row][column] = Math.min(costToInsert, costToDelete, costToSubstitute);
    }
  }
  return distanceMatrix[sourceLength][targetLength];
};

// longest common substring
var lcs = function (string1, string2) {
  var longestCommonSubstring, table, i, j;
  if (!string1 || string1.length === 0 || !string2 || string2.length === 0) {
    return 0;
  }
  // init max value
  longestCommonSubstring = 0;
  // init 2D array with 0
  table = Array(string1.length);
  for(a = 0; a <= string1.length; a++){
    table[a] = Array(string2.length);
    for(b = 0; b <= string2.length; b++){
      table[a][b] = 0;
    }
  }
  // fill table
  for(i = 0; i < string1.length; i++){
    for(j = 0; j < string2.length; j++){
      if(string1.charAt(i)==string2.charAt(j)) {
        if(table[i][j] === 0) {
          table[i+1][j+1] = 1;
        } else {
          table[i+1][j+1] = table[i][j] + 1;
        }
        if(table[i+1][j+1] > longestCommonSubstring){
          longestCommonSubstring = table[i+1][j+1];
        }
      } else {
        table[i+1][j+1] = 0;
      }
    }
  }
  return longestCommonSubstring;
};

var isSimmilarLD = function(source, target) {
  var score;
  if(target.length >= fuzzyLengthUpperLimit) {
    return 1; //passed
  }
  score = ld(source, target);
  if( score <= ldThreshold ) {
    return 0; // failed
  } else {
    return 1; //passed
  }
};

var isSimmilarLd = function(source, target) {
  var score;
  if(target.length >= fuzzyLengthUpperLimit) {
    return 0; //passed
  }
  score = ld(source, target);
  if( score <= ldThreshold ) {
    return 1; // failed
  } else {
    return 0; //passed
  }
};

var isSimmilar = function(source1, source2, target) {
  var lcs1, lcs2,
    targetLength = target.length,
    source1Length = source1.length,
    source2Length = source2.length,
    sum = 0;

  if(targetLength > 7 && targetLength < fuzzyLengthUpperLimit) {
    lcs1 = lcs(source1, target);
    lcs2 = lcs(source2, target);

    if ( lcs1 >= matchThreshold ||
      lcs2 >= matchThreshold ||
      (lcs1 >= 3 && lcs1/source1Length > minThreshold) ||
      (lcs2 >= 3 && lcs2/source2Length > minThreshold) ||
      ((lcs1 + lcs2) / targetLength) > minThreshold ) {
      return 1;
    }
    return 0;
  }
  return 0;
};