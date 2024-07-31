var sortanArray = function(array){
    var n = array.length;
    var swapped;

    for(var i =0 ; i<n-1; i++){
        swapped = false;

        for(var j=0; j<n-1-i;j++){
            if(array[j]> array[j+1]){
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
var sortedarray = sortanArray([64, 34, 25, 12, 22, 11, 90]);
console.log(sortedarray);