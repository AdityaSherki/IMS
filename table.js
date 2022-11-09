let arrHead = new Array();
arrHead = ['Item Name', 'Category', 'Quantity', 'Price', 'Action'];

let createTable = () => {
    let empTable = document.createElement('table');
    empTable.setAttribute('id', 'selltable');
    empTable.setAttribute('class', 'table table-bordered table-hover');
    let tr = empTable.insertRow(-1);
    for (let h = 0; h < arrHead.length; h++) {
        let th = document.createElement('th');
        th.innerHTML = arrHead[h];
        tr.appendChild(th);
    }

    let div = document.getElementById('addcon');
    div.appendChild(empTable);
}



function addRow() {
    var itemName = document.getElementById('pro_name').value;
    var cat = document.getElementById('pro_category').value;
    var quantity = document.getElementById('quan').value;
    var price = document.getElementById('pri').value;

    var html = "<tr>";
    html += `<td><input name="s-iname[]" type="text" class="form-control" id="i-name" value="` + itemName + `" readonly>` + `</inputt></td>`;
    html += `<td><input name="s-category[]" class="form-control" id="category" value="` + cat + `" readonly>` + `</input></td>`;
    html += `<td><input id="quan" type="number" name="s-quantity[]" class="form-control"  value="` + quantity + `" readonly></td>`;
    html += `<td><input id="pri" type="number" name="s-price[]" class="form-control"  value="` + price + `"   readonly></td>`;
    html += `<td><button type='button' class="btn btn-danger" onclick='deleteRow(this);'>Delete</button></td>`;
    html += "</tr>";

    var row = document.getElementById("selltable").insertRow();
    row.innerHTML = html;
    clear();
}

function deleteRow(button) {
    button.parentElement.parentElement.remove();
}

function clear() {
    document.getElementById('pro_name').value = "";
    document.getElementById('pro_category').value = "";
    document.getElementById('quan').value = "";
    document.getElementById('pri').value = "";
}



// var sum = 0;
// function add() {

//     var a = document.getElementBy("pri");
//     var q = document.getElementById("quan");

//     sum += (parseInt(a.value) * parseInt(q.value));

//     // console.log(a[1].value);
//     // console.log(b[0].value);
//     // console.log(q[0].value);
//     document.getElementById("total_price").value = sum;
//     console.log(sum);

// }
// var sum = 0;
// function add() {

//     var a = document.getElementsByName("s-price[]");
//     var q = document.getElementsByName("s-quantity[]");
//     console.log(a[0],a[1]);
//     for (let i = 0; i < a.length; i++) {
//         sum += (parseInt(a[i].value) * parseInt(q[i].value));
//     }
//     // console.log(a[1].value);
//     // console.log(b[0].value);
//     // console.log(q[0].value);
//     document.getElementById("total_price").value = sum;
//     console.log(sum);

// }




//to get price 
function GetDetail(str) {
    if (str.length == 0) {
        document.getElementById("item-name").value = "";
        return;
    }
    else {

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {

            if (this.readyState == 4 &&
                this.status == 200) {
                var myObj = JSON.parse(this.responseText);
                document.getElementById
                    ("pri").value = myObj[0];
            }
        };

        // xhttp.open("GET", "filename", true);
        xmlhttp.open("GET", "process.php?item=" + str, true);

        // Sends the request to the server
        xmlhttp.send();
    }
}

function message() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function () { x.className = x.className.replace("show", ""); }, 7000);
}


