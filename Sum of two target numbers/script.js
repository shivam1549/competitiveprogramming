const twoTargetsum = function(arr, sum){
    var length = arr.length;
    var match = false;
    for(i=0;i<length-1;i++){
        for(j=0;j<length;j++){
            if(arr[i] + arr[j] === sum){
                console.log(i + "," + j);
                return;
            }
        }
    }
}
var sum = twoTargetsum([4,3,2,1,8,16],10);