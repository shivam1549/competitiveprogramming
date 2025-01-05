const findMissing = function(array){
    var n = array.length + 1;
    var sum = 0;
    var summation = 0;
    for(var i = 0 ;i<n-1; i++){
        // console.log(array[i])
        sum = sum + array[i];
    }

    summation = (n*(n+1))/2;

    // console.log(summation + "  " + sum)

    return summation - sum;

    

}
var result = findMissing([1,3,4,5]);
console.log(result)