
function somenteNumeros(e) {
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace   
    // charCode 9 = tab
    if (charCode != 8 && charCode != 9) {
        // charCode 48 equivale a 0   
        // charCode 57 equivale a 9
        if (charCode < 48 || charCode > 57) {
            return false;
        }
    }
}

function DataAtual()
{
const data=new Date();
const dia=String(data.getDate()).padStart(2,'0');
const mes=String(data.getMonth()+1).padStart(2,'0');
const ano=data.getFullYear();
var dataatual=ano+'-'+mes+'-'+dia;
return dataatual;
}

function diferencaData(data)
{
const d1  = DataAtual();
const d2  = data;
const diffInMs   = new Date(d2) - new Date(d1)
const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
return diffInDays; // 38

}




function changeValue(event) {
event.value = addCommas(event.value.replace(/\D/g, ''));
calculate();
}

function addCommas(value) {
    return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
