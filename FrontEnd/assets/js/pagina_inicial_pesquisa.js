var localRetirada= document.getElementById('local-retirada')
var dataRetirada=document.getElementById('data-retirada')
var horaRetirada=document.getElementById('hora-retirada')
var dataDevolucao=document.getElementById('data-devolucao')
var horaDevolucao=document.getElementById('hora-devolucao')



function pesquisaRapida() {
    
   localStorage.setItem("local_retirada",localRetirada.value)
   localStorage.setItem("data_retirada",dataRetirada.value)
   localStorage.setItem("hora_retirada",horaRetirada.value)
   localStorage.setItem("data_devolucao",dataDevolucao.value)
   localStorage.setItem("hora_devolucao",horaDevolucao.value)
   window.location.href = 'BuscaCarros.php';
   
}

function preencherDados(){
   
        var localPicker= document.getElementById('local-retirada')
        var datePicker=document.getElementById('date-picker')
        var timePicker=document.getElementById('time-picker')
        var dateReturn=document.getElementById('date-return')
        var timeReturn=document.getElementById('time-return')
        localPicker.value=localStorage.getItem('local_retirada')
        datePicker.value = new Date(localStorage.getItem('data_retirada')).toISOString().substring(0, 10);
        timePicker.value=localStorage.getItem('hora_retirada')
        dateReturn.value=localStorage.getItem('data_devolucao')
        timeReturn.value=localStorage.getItem('hora_devolucao')

    
    
        

    
}
preencherDados();

