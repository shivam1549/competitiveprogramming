const fibonaccii = function(n){
var n1=0;
var n2=1;
var n3;
var array = new Array;
array.push(n1);
array.push(n2);
for(var i =0 ; i< n - 2;i++){
n3 = n1 + n2;
n1 = n2;
n2 = n3;

array.push(n3)
}
return array;
}
var result = fibonaccii(10);
console.log(result);

