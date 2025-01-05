const duplicate = function(arr){
    var newarray = new Array;
    for(var i =0; i<arr.length - 1; i++){
        if(arr[i] !== arr[i+1]){
            newarray.push(arr[i]);
        }
    }
    if(arr[arr.length - 1] !== arr[arr.length - 2]){
        newarray.push(arr[arr.length - 1]);
    }

    return newarray;
}



var result = duplicate([0, 0, 1, 1, 1, 2, 2, 3, 3, 4,5,6,6,7]);
console.log(result)


// 0  = 0
// 0 = 1 1 arr = 0
// 1 =1
// 1=1 
// 1=2 2 arr  = 1
// 2=2
// 2=3 3 arr = 2
// 3=3 
// 3=4 4 arr 3,4
