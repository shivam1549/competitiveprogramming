const sortArray = (array) =>{
    var n = array.length;
    let swapped;
    for(var i=0; i<n-1 ;i++){
        for(var j=0; j<n-1;j++){
            if(array[j]>array[j+1]){
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
var result = sortArray([11,67,20,2,0,12,6]);
console.log(result)

// i=0 j<6

// 34,64, 25, 12, 22, 11, 90 j =0
// 34,25,64, 12, 22, 11, 90 j=1
// 34,25,12, 64, 22, 11, 90 j =2
// 34,25,12, 22, 64, 11, 90 j =3
// 34,25,12, 22, 11, 64, 90  j=4
// 34,25,12, 22, 11, 64, 90  j =5

// i = 1 j < 5
// 25,34,12, 22, 11, 64, 90 j = 0;
// 25,12,34, 22, 11, 64, 90 j = 1;
// 25,12,22, 34, 11, 64, 90 j = 2;
// 25,12,22, 11, 34, 64, 90 j = 3;
// 25,12,22, 11, 34, 64, 90 j = 4;

// i = 2 j<4

// 25,12,22, 11, 34, 64, 90









