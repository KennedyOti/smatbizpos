function removeCommas(amount) {
    // amount = amount.toString()

    // if (amount.match(/\.\d{2}$/)) {
    //     unformated = amount.replace(/,(?=.*\.\d+)/g, '');
    //     return unformated
    // }

    // return amount
    let numberWithoutCommas = amount.replace(/,/g, '');

    return numberWithoutCommas;
}

function numberWithCommas(number) {
    // removeCommas(number);
    // number = number.toString().replace(",", "");

    // Convert the number to a string
    let numStr = number.toString().replace(",", "");

    //
    if (numStr.length > 6) {
        numStr = numStr.replace(",", "");
    }

    if (numStr.length > 11) {
        numStr = numStr.replace(",", "");
    }

    if (numStr.length > 14) {
        numStr = numStr.replace(",", "");
    }

    if (numStr.length > 17) {
        numStr = numStr.replace(",", "");
    }
    //
    // Split the string into integer and decimal parts
    let parts = numStr.split('.');
    let integerPart = parts[0];
    let decimalPart = parts.length > 1 ? '.' + parts[1] : '';

    // Add commas as thousand separators to the integer part
    integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    // Combine the integer and decimal parts
    let formattedNumber = integerPart + decimalPart;

    return formattedNumber;
}

function showServerSideValidationErrors(errors) {
    // Validation errors
    for (let key in errors) {
        if (errors.hasOwnProperty(key)) {
            toastr.error(errors[key][0]);
        }
    }
}

function printDivContent(id) {
    var printContents = document.getElementById(id).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
