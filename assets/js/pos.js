function showTime(elId){
    const element = document.getElementById(elId);
    const today = new Date();
    let hour = today.getHours();
    let minutes = today.getMinutes();
    let seconds = today.getSeconds();
    minutes = checkTime(minutes);
    seconds = checkTime(seconds);

    document.getElementById("time").innerHTML = hour + ":" + minutes + ":" + seconds;
    const t = setTimeout(function(){showTime(elId)}, 500);
}

function checkTime(i){
    if(i < 10){
        i = "0" + i;
    }
    return i;
}

document.addEventListener("DOMContentLoaded", function(){
    showTime("time");
});

function checkCash() {
    let paycashInput = document.getElementById('paycash_input');
    let paycashValue = parseFloat(paycashInput.value);
    let netElement = document.getElementById('net');
    let netValue = parseFloat(netElement.innerText);

    if (paycashValue >= netValue) {
        document.getElementById('paycash_btn').disabled = false   
        document.getElementById('paycash_btn').addEventListener('click',() => {
            let myModalEl = document.getElementById('paycashModal')
            let modal = bootstrap.Modal.getInstance(myModalEl)
            modal.hide()
            document.getElementById('receive').innerHTML = paycashValue;
            document.getElementById('change').innerHTML = Math.ceil(paycashValue - netValue);
            document.getElementById('pay').style.display = 'none';
            document.getElementById('pay_final').style.display = 'block';
        })
    } else {
        document.getElementById('paycash_btn').disabled = true
    }
}


let list = [];
function addList(id,name,price){
    let index = list.findIndex((item) => item.id == id);
    if(index == -1){
        list.push({id:id,name:name,price:price,amount:1});
    }
    else{
        list[index].amount++;
    }
    showList();
}

function showList(){
    let content = '';
    let total = 0;
    list.forEach((item) => {
        content += '<div class="row border-bottom py-2"><div class="col-6">'+item.name+'</div><div class="col-3">จำนวน '+item.amount+'</div><div class="col-3">ราคา '+item.price+' บาท</div></div>';
        total += item.price * item.amount;
    });
    content += '<div class="row border-bottom py-2"><div class="col-6">รวม</div><div class="col-3"></div><div class="col-3">'+total+' บาท</div></div>';
    document.getElementById('list').innerHTML = content;
}

function pay(){
    let total = 0;
    let val = 0;
    let net = 0;
    list.forEach((item) => {
        total += item.price * item.amount;
    });
    val = (total * 0.07).toFixed(2);
    total = Number(total);
    val = Number(val);
    net = total + val;
    document.getElementById('total').innerHTML = total+' บาท';
    document.getElementById('val').innerHTML = val +' บาท';
    document.getElementById('net').innerHTML = net +' บาท';
    document.getElementById('paycash').disabled = false;
}

function cancel(){
    list = [];
    document.getElementById('list').innerHTML = '';
    document.getElementById('total').innerHTML = '';
    document.getElementById('val').innerHTML = '';
    document.getElementById('net').innerHTML = '';
    document.getElementById('receive').innerHTML = '';
    document.getElementById('change').innerHTML = '';
    document.getElementById('paycash').disabled = true;
    document.querySelectorAll('#product').forEach((item) => {
        item.disabled = false;
    });
    document.getElementById('pay').disabled = false;
    document.getElementById('pay_final').style.display = 'none';
    document.getElementById('pay').style.display = 'block';
    document.getElementById('cancel').disabled = true;
    document.getElementById('cancel').disabled = true;
}


document.querySelectorAll('#product').forEach((item) => {
    item.addEventListener('click',() => {
        addList(item.dataset.id,item.dataset.name,item.dataset.price);
    });
});
document.getElementById('pay').addEventListener('click',() => {
    if(list.length != 0){
        document.querySelectorAll('#product').forEach((item) => {
            item.disabled = true;
        });

        document.getElementById('pay').disabled = true;
        document.getElementById('cancel').disabled = false;
        pay();
    }
    else{
        alert('กรุณาเลือกสินค้า');
    }
});
document.getElementById('cancel').addEventListener('click',() => {
    list = [];
    document.getElementById('list').innerHTML = '';
    document.getElementById('total').innerHTML = '';
    document.getElementById('val').innerHTML = '';
    document.getElementById('net').innerHTML = '';
    document.getElementById('paycash').disabled = true;
    document.querySelectorAll('#product').forEach((item) => {
        item.disabled = false;
    });
    document.getElementById('pay').disabled = false;
    document.getElementById('cancel').disabled = true;
});

$('#pay_final').click(function() {
    console.log(list);
    $.ajax({
        url: '../global/pos/pos.php',
        type: 'post',
        data: {list: list},
        beforeSend: function(){
            $('#pay_final').attr('disabled',true);
        },
        success: function(response, status, xhr){
            $('#pay_final').attr('disabled',false);
            if(xhr.status == 200){
                console.log(response);
                alert('success');
                cancel();
            }
        },
        error: function(xhr, status, error){
            $('#pay_final').attr('disabled',false);
            if(xhr.status == 400){
                console.log(xhr.responseText);
                alert('error');
            }
        }
    });
});