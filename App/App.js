var InputQty = document.querySelector('input[id="ipn"]');

let Qty = InputQty.value;
let Price  = document.querySelector('input[id="pr"]').value;
let Total = Qty * Price;
//Display total
document.getElementById('rt').textContent = Total;

//listening event onChange input Qty
InputQty.onchange = (e) => {
    //get data
    let Qty = e.target.value;
    let Price  = document.querySelector('input[id="pr"]').value;
    let Total = Qty * Price;
    //Display total
    document.getElementById('rt').textContent = Total;
}