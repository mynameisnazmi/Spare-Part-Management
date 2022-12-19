function edit(hisid){
    $(function(){
var x = document.getElementById('edit'+hisid);
if(x.innerHTML == "Edit"){
    x.innerHTML = "Cancel";
}
else{
    x.innerHTML = "Edit";
}
        $("#e_mod_by"+hisid).toggle();
        $("#e_date"+hisid).toggle();
        $("#e_title"+hisid).toggle();
        $("#e_bef"+hisid).toggle();
        $("#e_af"+hisid).toggle();
        $("#e_rem"+hisid).toggle();
        $("#send"+hisid).toggle();

        $("#mod_by"+hisid).toggle();
        $("#date_his"+hisid).toggle();
        $("#title"+hisid).toggle();
        $("#bef"+hisid).toggle();
        $("#af"+hisid).toggle();
        $("#rem"+hisid).toggle();
        $("#del"+hisid).toggle();
    });
}
function del(hist_id){
    var conf = confirm('Do you want to delete this data ?');
    if(conf){
    const xhr = new XMLHttpRequest();
    xhr.onload = () => {
        let responseObject = null;
        try{
            responseObject = JSON.parse(xhr.responseText);
        }
        catch(e){
            console.error('Couldnt update');
        }
        if(responseObject){
            handlerespo(responseObject);
        }
    
    };

    const mydata = 
    `idf_del=${hist_id}`;

xhr.open('post', 'his_del.php');
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.send(mydata);

function handlerespo (responseObject){
if (responseObject.status){
    alert('Data berhasil dihapus');
    $("#content").html('');
    $("#content").load('his_my.php');

}
else{
    
    alert('GAGAL UPDATE');
         }
    }
}

}

function send(hist_id){
const form = {
    clause : hist_id,
    e_mod_by : document.getElementById('e_mod_by'+hist_id),
    e_date : document.getElementById('e_date'+hist_id),
    e_title : document.getElementById('e_title'+hist_id),
    e_bef: document.getElementById('e_bef'+hist_id),
    e_af: document.getElementById('e_af'+hist_id),
    e_rem: document.getElementById('e_rem'+hist_id)
};

//console.log(form.password.value);
const xhr = new XMLHttpRequest();
xhr.onload = () => {
    let responseObject = null;
    try{
        responseObject = JSON.parse(xhr.responseText);
    }
    catch(e){
        console.error('Couldnt update');
    }
    if(responseObject){
        handlerespo(responseObject);
    }

};
//accses value
const mydata = 
`e_mod_by=${form.e_mod_by.value}
&e_date=${form.e_date.value}
&e_title=${form.e_title.value}
&e_bef=${form.e_bef.value}
&e_af=${form.e_af.value}
&e_rem=${form.e_rem.value}
&clause=${form.clause}`;
//response
console.log (mydata);    

xhr.open('post', 'his_edit.php');
xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
xhr.send(mydata);

function handlerespo (responseObject){
if (responseObject.status){
    alert('Data berhasil di update');
    $("#content").html('');
    $("#content").load('his_my.php');

}
else{
    
    alert('GAGAL UPDATE');
}
}
}
