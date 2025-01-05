const anagram = function(s1,s2){
    var sorts1 = sortString(s1);
    var sorts2 = sortString(s2);
    // console.log(sortString(s1));
    if(sorts1.length !== sorts2.length){
        console.log("not anagram");
        return;
    }

    console.log(sorts1 + "  " + sorts2)

    if(sorts1 === sorts2){
        console.log("Anagram");
    }
    else{
        console.log("No")
    }
    

}

function sortString(str){
    // alert("hey")
    var temp = '';
    let arr = str.split('');
    // console.log(str)
    for(var i = 0; i<str.length - 1; i++){
        for(var j = i+1 ;j<str.length; j++){
            // console.log(first)
            // console.log(str[i], str[j])
            if(arr[i] > arr[j]){
                // alert("hey")
                temp = arr[i];
                // console.log(arr[i], arr[j])
                arr[i] = arr[j];
                arr[j] = temp;
            }
        }
    }
    console.log(str)
    return arr.join('');
} 

var result = anagram("heay", "yeph")