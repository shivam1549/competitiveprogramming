// const factorial = function(n){
// let multiply = n;
// for(var i=n-1; i>0; i--){
// multiply = multiply*i
// }
// return multiply;
// }
// const result = factorial(20);
// console.log(result);


// const fibonacii = function(n){
//     var n1 = 0;
//     var n2 = 1;
//     var array = new Array();
//     array.push(n1)
//     array.push(n2);
//     for(var i =0; i<n-2; i++){
//         n3 = n1+n2;
//         n1 = n2;
//         n2 = n3;
//         array.push(n3);
//     }
//     return array;
// }


// const result = fibonacii(16);
// console.log(result)

// const findMaxnumber= function(array){
// var maxnumber = array[0];
// for(var i = 1; i<array.length; i++){
//     if(maxnumber < array[i]){
//         maxnumber = array[i];
//     }
// }
// return maxnumber;
// }

// const result = findMaxnumber([1000,300,10,7383838,900,87,657,1200])
// console.log(result);

// const isPalindrome = function(s){
//     var string = s.replace(/[^A-Z0-9]/ig, "").toLowerCase();
//     var length = string.length;
//     // return Math.floor(length/2);
//     for(var i = 0; i < Math.floor(length/2); i++){
//         if(string[i] != string[length-i-1]){
//             return "Not a palindrome";
//             break;   
//         }
//     }

//     if(i ==  Math.floor(length/2)){
//         return "Plaindrome";
//     }
// }

// var getpalindrome = isPalindrome("MALAYALAM");
// console.log(getpalindrome);

// const stringReverse = function(str){
//     var newstr = '';
//     for(var i = str.length - 1; i>=0 ; i--){
//         newstr += str[i];
//     }
//     return newstr;
// }

// const reverse = stringReverse("olleH dlroW eyB eyB 321 321");
// console.log(reverse);

// var sumarraySum = function(array,n,s){
//     var start = 0;
//     var end = 0;
//     var currentsum = 0;
//     for( var end = 0; end< n; end++){
//         currentsum += array[end];
//         while(currentsum > s && start<=end){
//             currentsum -= array[end];
//             start++;
//         }
//         if(currentsum == s){
//             return[start+1, end+1];
//         }
//     }
//     return -1;
// }

// var result = sumarraySum([1,2,3,4,5,6,7,8,9,10],10,15);
// console.log(result);

const sortanArray = function (array) {
    var swapped = ''
    var n = array.length;
    for (var i = 0; i < n - 1; i++) {
        swapped = false;
        for (var j = 0; j < n - 1 - i; j++) {
            if(array[j] > array[j+1]){
                console.log("hey")
                var temp = array[j];
                array[j] = array[j+1];
                array[j+1] = temp;
                swapped = true;
            }
            
        }
        if(!swapped){
            break;
        }
    }
    return array;
}



const result = sortanArray([1, 45, 10, 7, 120, 543, 8, 83, 101]);
console.log(result);









