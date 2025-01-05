const binarySearch = (array, number) => {
    var low = 0
    var high = array.length - 1;


    // console.log(med);
    while (low <= high) {
        let med = Math.floor((low + high) / 2);
        if (array[med] === number) {
            return med;
        }
        else if (array[med] < number) {
            low = med + 1
        }
        else {
            high = med - 1;
        }
    }
    return -1;
}



const binresult = binarySearch([10, 15, 20, 23, 45, 50], 15);
console.log(binresult);
// 0   1   2   3   4   5   6   7   8   9   10  11  12
// 10, 15, 20, 23, 45, 50, 55, 60, 75, 80, 85, 88, 90

// length = 13

// tagrget = 88

// mid = 6

// array[mid] = 55

// 55< 85  remove Left

// 60,75,80,85,88,90

// mid = 3

// array[mid] = 85


// 88,90
// 1

// 90











