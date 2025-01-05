const findmaxnumber = function (array) {
    var max = array[0];
    for (var i = 1; i < array.length; i++) {
        if(max<array[i]){
            max = array[i];
        }
    }
    return max;
}
var result = findmaxnumber([1, 500000, 2, 56, 3, 10057]);
console.log(result);

