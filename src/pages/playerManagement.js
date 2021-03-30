var data;
var tr;
async function add() {
    let frm = new FormData();
    frm.set('firstName',$('#addFirstName').val());
    frm.set('lastName',$('#addLastName').val());
    frm.set('position',$('#addPosition').val());
    frm.set('points',$('#addPoints').val());
    frm.set('plusMinus',$('#addPlusMinus').val());
    frm.set('number',$('#addId').val());
    var empty= (    
        frm.get('firstName') === "" ||
        frm.get('lastName')==="" ||
        frm.get('position')==="" ||
        frm.get('points')==="" ||
        frm.get('plusMinus')==="" ||
        frm.get('number')===""
        );
    console.log(empty);
    if (!empty){
        await fetch("pages/addPlayer.php", {
            method: 'POST',
            body: frm
        })
        .then(function(response) {
            let text;
            try {
               text= response.text();
            }
            catch(e){
               text=e.message;;
            }
            return text;
        })
        .then(function(text){
            if (text==1){
                $('#players').DataTable().row.add(
                    [    
                    frm.get('firstName'),
                    frm.get('lastName'),
                    frm.get('number'),
                    frm.get('position'),
                    frm.get('points'),
                    frm.get('plusMinus'),
                    "<button onClick='deletePlayer(" + frm.get('number') + ")'>Delete</button><button onClick='editModal(" + frm.get('number') + ")'>Edit</button>"
                    ]
                    ).draw();
                $('#addStatus').text("Updated Successfully");
            } else {
                $('#addStatus').text("Player Number Exists");
            }
        });
    } else{
        $('#addStatus').text("Fill All Blanks");
    }
}
function addModal(){
    myAddModal.style.display = "block";
}
function editModal(id){
    $('#updateBtn').prop('disabled',false);
    modal.style.display = "block";
    var td = event.target.parentNode;
    tr = td.parentNode; // the row to be removed
    data =$('#players').DataTable().row(tr).data();
    $('#firstName').val(data[0]);
    $('#lastName').val(data[1]);
    $('#position').val(data[3]);
    $('#points').val(data[4]);
    $('#plusMinus').val(data[5]);
    $('#row').val(tr);
    $('#id').val(id);
}
async function edit() {
    //TODO Finish EditPLayer.php
    //TODO FINISH AddPlayer.php

    let frm = new FormData();
    frm.set('firstName',$('#addFirstName').val());
    frm.set('lastName',$('#addLastName').val());
    frm.set('position',$('#addPosition').val());
    frm.set('points',$('#addPoints').val());
    frm.set('plusMinus',$('#addPlusMinus').val());
    frm.set('number',$('#addId').val());
    var same= (    
    frm.get('firstName') === data[0] &&
    frm.get('lastName')===data[1] &&
    frm.get('position')===data[3] &&
    frm.get('points')===data[4] &&
    frm.get('plusMinus')===data[5]);
    if (!same){
        $('#updateBtn').prop('disabled',true);
        $('#players').DataTable().row().remove(tr).draw();
         $('#players').DataTable().row.add(
        [    
        frm.get('firstName'),
        frm.get('lastName'),
        frm.get('number'),
        frm.get('position'),
        frm.get('points'),
        frm.get('plusMinus'),
        "<button onClick='deletePlayer(" + frm.get('number') + ")'>Delete</button><button onClick='editModal(" + frm.get('number') + ")'>Edit</button>"
        ]
        ).draw();

        await fetch("pages/editPlayer.php", {
            method: 'POST',
            body: frm
        })
        .then(function(response) {
            let text;
            try {
               text= response.text();
            }
            catch(e){
               text=e.message;;
            }
            return text;
        })
        .then(function(text){
            if (text==1){
                $('#status').text("Updated Successfully");
            } else {
                $('#status').text(text);
            }
        });
        
    } 
    else{
        $('#status').text("No Changes to Save");
    }
}

async function deletePlayer(id) {
    var td = event.target.parentNode;
    var tr = td.parentNode; // the row to be removed
    $('#players').DataTable().row(tr).remove().draw();
    const frmID = new FormData();
    frmID.set('id', id);
    await fetch("pages/deletePlayer.php", {
            method: 'POST',
            body: frmID
        })
        .then(function(response) {
            console.log(response.text());
        });
}


// Get the modal
var modal = document.getElementById("myModal");
var myAddModal = document.getElementById("myAddModal");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
span2.onclick = function() {
    myAddModal.style.display = "none";
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  } 

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == myAddModal) {
    myAddModal.style.display = "none";
  }
} 