var isPalindrome = function(s){
    var newString = s.replace(/[^A-Z0-9]/ig, "").toLowerCase();
    var l = newString.length;
    for(var i=0; i< Math.floor(l/2); i++){
        if(newString[i] !== newString[l - i - 1]){
            return false;
        }

    }
  
    if(i == Math.floor(l/2)){
        return true;
    }
   
}
var getpalindrome = isPalindrome("A man, a plan, a canal: Panama");
console.log(getpalindrome);
