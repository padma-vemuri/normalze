fields = 1;
function addInput() {
if (fields != 10) {
document.getElementById('domains').innerHTML += "<label>+ Release<input type='text' class ='adddomain' name ='domain"+fields+"' /></label><br />";
fields += 1;
} else {
document.getElementById('domains').innerHTML += "<br />Only 10 upload fields allowed.";
document.form.add.disabled=true;
}
}

function sendform(){

var r=confirm("  Please confirm ");
if (r==true)
  {
  return true;
  }
else
  {
return false;
}
  }
