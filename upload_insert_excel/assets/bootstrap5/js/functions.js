//Function Tday-Yday
function TdayYday(Tday,Yday) {
    var result;

    //Condition Value
    if(Tday == 0) {
        result = 0;
    } else if (Yday == 0) {
        result = Tday
    }  else if (Yday > 0) {
        //Rumus
        result = ((Tday/Yday)-1) * 100;
        //Pembulatan
        result = parseFloat(result).toFixed(0);

        //Condition If Value TydaYday - NaN
        if(isNaN(result)) {
            result = 0;
        } else {
            result = result;
        }
    }

    return result;
}

//Function Image ACH
function ImageACH(Tday, Yday) {
    var result;

    value = TdayYday(Tday, Yday)

    if(value < 0) {
        result = 'arrow-down.png'
    } else if (value > 0) {
        result = 'arrow-up.png'
    } else {
        result = 'equal-stabil.png'
    }

    return result;
}

//Function Color Last PM
function ColorLastPM(DataLastPM) {
    var result;
    
    if(DataLastPM == null) {
        result = 'text-red';
    } else {
        result = 'text-light';
    }

    return result;
}


//Function Data Last PM
function DataLastPM(DataLastPM) {
    var result;

    if(DataLastPM == null) {
        result = 'N/A';
    } else {
        result = DataLastPM;
    }

    return result;
}

//Function convert Y-m-d to d-M (Indonesia)
function convertDateToDayMonth(date) {
    var result;

    var d = new Date(date);

    //Array Nama Bulan
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    //Tanggal
    Tanggal = d.getDate();
    //Bulan
    Bulan = monthNames[d.getMonth()]

    //Result Data Tanggal-Bulan
    result = Tanggal + "-" + Bulan;

    return result
}

 //Function color return if null
function returnColorDataTypeAndName(data) {
    var result;

    if (data == "Truck") {
        result = "#a8ff9e"; //Green
    } else if (data == "Shovel") {
        result = "#b1aaff"; //Blue
    } else if (data == "Jigsaw") {
        result = "#fbffc2"; //Yellow
    } else if (data == "Jenis Unit") {
        result = "#ffc4f9"; //Pink
    }

    return result;
}