// JavaScript Document
function implante(idd)
{
	var idh='d'+idd;
	document.getElementById(idd).src="img/imp.jpg";
	document.getElementById(idh).value="img/imp.jpg";
}
function ventana(ident)
{
	$('#light'+ident).addClass("model").removeClass("modal");
	$('#fade'+ident).addClass("overla").removeClass("overlay");
}
function ventre(ident)
{
	$('#lightr'+ident).addClass("model").removeClass("modal");
	$('#fader'+ident).addClass("overla").removeClass("overlay");
}
function vental(ident)
{
	$('#lighta'+ident).addClass("model").removeClass("modal");
	$('#fadea'+ident).addClass("overla").removeClass("overlay");
}
function caries(ident)
{
	$('#light'+ident).addClass("modal").removeClass("model");
	$('#fade'+ident).addClass("overlay").removeClass("overla");
	img='dc';val=0;
	for(x=0;x<5;x++)
	{
		d=x+1;
		ck='dc'+ident+d;
		check='dc'+ident;
		if(document.getElementsByName(check)[x].checked)
			img=img+document.getElementsByName(check)[x].value;
		else
			val++;
	}
	if(val==5)
		alert('Debe seleccionar un sector');
	else {
	document.getElementById(ident).src="img/carie/"+img+".jpg";
	var idh='d'+ident;
	document.getElementById(idh).value="img/carie/"+img+".jpg";
	}
}
function resina(ident)
{
	$('#lightr'+ident).addClass("modal").removeClass("model");
	$('#fader'+ident).addClass("overlay").removeClass("overla");
	img='res';val=0;
	for(x=0;x<5;x++)
	{
		d=x+1;
		ck='dr'+ident+d;
		check='dr'+ident;
		if(document.getElementsByName(check)[x].checked)
			img=img+document.getElementsByName(check)[x].value;
		else
			val++;
	}
	if(val==5)
		alert('Debe seleccionar un sector');
	else {
	document.getElementById(ident).src="img/resina/"+img+".jpg";
	var idh='d'+ident;
	document.getElementById(idh).value="img/resina/"+img+".jpg";
	}
}
function amalgama(ident)
{
	$('#lighta'+ident).addClass("modal").removeClass("model");
	$('#fadea'+ident).addClass("overlay").removeClass("overla");
	img='ama';val=0;
	for(x=0;x<5;x++)
	{
		d=x+1;
		ck='da'+ident+d;
		check='da'+ident;
		if(document.getElementsByName(check)[x].checked)
			img=img+document.getElementsByName(check)[x].value;
		else
			val++;
	}
	if(val==5)
		alert('Debe seleccionar un sector');
	else {
	document.getElementById(ident).src="img/amal/"+img+".jpg";
	var idh='d'+ident;
	document.getElementById(idh).value="img/amal/"+img+".jpg";
	}
}
function cancela(ident,n)
{
	if(n==1){
	$('#light'+ident).addClass("modal").removeClass("model");
	$('#fade'+ident).addClass("overlay").removeClass("overla");}
	if(n==2){
	$('#lightr'+ident).addClass("modal").removeClass("model");
	$('#fader'+ident).addClass("overlay").removeClass("overla");}
	if(n==3){
	$('#lighta'+ident).addClass("modal").removeClass("model");
	$('#fadea'+ident).addClass("overlay").removeClass("overla");}
}
function exodencia(ident)
{
	document.getElementById(ident).src="img/exod.jpg";
	var idh='d'+ident;
	document.getElementById(idh).value="img/exod.jpg";
}
function ausent(ident)
{
	document.getElementById(ident).src="img/aus.jpg";
	var idh='d'+ident;
	document.getElementById(idh).value="img/aus.jpg";
}
function sellante(ident,e)
{
	if(e==1){
		document.getElementById(ident).src="img/sbe.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/sbe.jpg";}
	if(e==2){
		document.getElementById(ident).src="img/sme.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/sme.jpg";}
}
function conducto(ident,e)
{
	if(e==1){
		document.getElementById(ident).src="img/tcbe.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/tcbe.jpg";}
	if(e==2){
		document.getElementById(ident).src="img/tcme.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/tcme.jpg";}
}
function protF(ident,e)
{
	if(e==1){
		document.getElementById(ident).src="img/pfbe.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/pfbe.jpg";}
	if(e==2){
		document.getElementById(ident).src="img/pfme.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/pfme.jpg";}
}
function protR(ident,e)
{
	if(e==1){
		document.getElementById(ident).src="img/prbe.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/prbe.jpg";}
	if(e==2){
		document.getElementById(ident).src="img/prme.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/prme.jpg";}
}
function aoF(ident,e)
{
	if(e==1){
		document.getElementById(ident).src="img/aofbe.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/aofbe.jpg";}
	if(e==2){
		document.getElementById(ident).src="img/aofme.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/aofme.jpg";}
	if(e==3){
		document.getElementById(ident).src="img/aofaus.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/aofaus.jpg";}
}
function aoR(ident,e)
{
	if(e==1){
		document.getElementById(ident).src="img/aorbe.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/aorbe.jpg";}
	if(e==2){
		document.getElementById(ident).src="img/aorme.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/aorme.jpg";}
}
function cancel(ident)
{
	document.getElementById(ident).src="img/dn.jpg";
		var idh='d'+ident;
		document.getElementById(idh).value="img/dn.jpg";
}