var findSubarraysum = function(arr,n,sum){
let start = 0;
let currentsum =0;
for(let end = 0; end<n ; end++){
    currentsum += arr[end];
    while(currentsum>sum && start<=end){
        currentsum -= arr[start]
        start++;
    }
    if(currentsum=== sum){
        return[start+1, end+1]
    }
}
return -1;
}
var k = findSubarraysum([1,2,3,4,5,6,7,8,9,10], 10, 15);
console.log(k);