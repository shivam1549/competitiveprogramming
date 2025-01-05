var counttriplets = function (arr) {
    let sum = 0;
    let count = 0;
    let n = arr.length;
    // console.log(n)
    for (let k = 0; k < n; k++) {
        // console.log(arr[end]);
        for(let j = k + 1; j<n; j++){
            // console.log(arr[end] +" + " + arr[j]);
            sum = arr[k] + arr[j];
            for(let i = 0; i< n; i++){
                if(sum === arr[i]){
                    // console.log("yeh")
                    count++;
                }
            }
         
        }

       
       

        // return count;
    }
    return count;
}
var k = counttriplets([1, 6, 5, 7, 2]);
console.log(k);