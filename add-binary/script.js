const addBinary = function (n) {
    var rem = new Array();
    while (n) {
        rem.push(n % 2);
        // console.log(n + " num ")
        n = Math.floor(n / 2);

        // console.log(rem + " rem ")
    }
    // console.log(rem.reverse());
    return rem.reverse();
}


const binarytoDecimal = function (n) {
    var decimal = 0;

    var length = n.length;
    for (var i = 0; i < length; i++) {
        var digit = n[i] === '1' ? 1 : 0;
        decimal = decimal * 2 + digit;
    }
    return decimal;
}


var resultb = binarytoDecimal("11");
var resulta = binarytoDecimal("1");

// console.log(resulta + " a " + " b " + resultb)

var result = addBinary(resulta + resultb);
var finalresult = '';
for (var j = 0; j<result.length; j++) {
finalresult += result[j];
}

console.log(finalresult)


