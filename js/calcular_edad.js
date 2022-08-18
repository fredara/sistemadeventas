function ResetForm(obj) {
  // Get the Date and set default
  var the_date  = new Date();
  var the_month = the_date.getMonth() + 1;
  var the_day   = the_date.getDate();
  var the_year  = the_date.getFullYear();
  var ToDate    = the_month + "/" + the_day + "/" + the_year;

  obj.DoB.value = "";
  obj.DoC.value = ToDate;
  obj.AgeYears.value = " ";
  obj.AgeRmdr.value = " ";
  obj.AgeMonth.value = " ";
  obj.AgeWeeks.value = " ";
  obj.AgeDays.value = " ";
}

function CalcAge() {
  var the_date  = new Date();
  var the_month = the_date.getMonth() + 1;
  var the_day   = the_date.getDate();
  var the_year  = the_date.getFullYear();
  var ToDate    = the_month + "/" + the_day + "/" + the_year;
  var ToNac     = <?php echo $mes?> + "/" + <?php echo $dia?> + "/" + <?php echo $anio?>;  
  var DoB    = Date.parse(ToNac);
  var DoC    = Date.parse(ToDate);
  var AOkay  = true;

  // Check dates for validity
  if ((DoB==null)||(isNaN(DoB))) {
    alert("Fecha de nacimiento invalida.");
    AOkay = false;
  }
  if ((DoC==null)||(isNaN(DoC))) {
    alert("Escriba una fecha correcta.");
    AOkay = false;
  }

//if the year is not Y2K compliant
  var ToDate   = new Date();
  var ToDateYr = ToDate.getFullYear();
  var DateofB  = new Date(DoB);
  var DoBYr    = DateofB.getFullYear();
  var DoBMo    = DateofB.getMonth();
  var DoBDy    = DateofB.getDate();
  if (ToDateYr - DoBYr > 99) {
    DoBYr      = DoBYr + 100;
    DoB        = Date.parse(" "+ (DoBMo+1) +"/"+ DoBDy +"/"+ DoBYr);
    if (DoB > ToDate) {
      DoBYr    = DoBYr - 100;
      DoB        = Date.parse(" "+ (DoBMo+1) +"/"+ DoBDy +"/"+ DoBYr);
    }
    alert("Se asume que tu fecha de nacimiento\n         es" +(DoBMo+1)+ "/" +DoBDy+ "/" +DoBYr);
  }

  var DateofC  = new Date(DoC);
  var DoCYr    = DateofC.getFullYear();
  var DoCMo    = DateofC.getMonth();
  var DoCDy    = DateofC.getDate();
  if (ToDateYr - DoCYr > 99) {
    DoCYr      = DoCYr + 100;
    alert("Se asume que tu fecha de nacimiento\n         es"  +(DoCMo+1)+ "/" +DoCDy+ "/" +DoCYr);
    DoC        = Date.parse(" "+ (DoCMo+1) +"/"+ DoCDy +"/"+ DoCYr);
  }

  if (DoB > DoC) {
    alert("la fecha de naciemto es mayor que la actual.");
    AOkay = false;
  }

  if (DoC > ToDate) {
    alert("la fecha de naciemto es mayor que la actual.\n           Continuando.");
  }

  if (AOkay) {
    var AgeDays  = 0;
    var AgeWeeks = 0;
    var AgeMonth = 0;
    var AgeYears = 0;
    var AgeRmdr  = 0;

    mSecDiff   = DoC - DoB;
    AgeDays  = mSecDiff / 86400000;
    AgeWeeks = AgeDays / 7;
    AgeMonth = AgeDays / 30.4375;
    AgeYears = AgeDays / 365.24;    
    AgeYears = Math.floor(AgeYears);
    AgeRmdr  = (AgeDays - AgeYears * 365.24) / 30.4375;

    AgeDays  = Math.round(AgeDays * 10) / 10;
    AgeWeeks = Math.round(AgeWeeks * 10) / 10;
    AgeMonth = Math.round(AgeMonth * 10) / 10;
    AgeRmdr  = Math.round(AgeRmdr * 10) / 10;
	document.getElementById('edad').innerHTML= AgeYears +","+ parseInt(AgeRmdr);
	document.getElementById('edad_1').innerHTML= AgeYears +","+ parseInt(AgeRmdr);
	document.getElementById('edad_2').innerHTML= AgeYears +","+ parseInt(AgeRmdr);
  }
}

// END Hiding Script 
// -->