// xMenu6 r5, Copyright 2006-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xMenu6(sUlId, sMainUlClass, sSubUlClass, sLblLiClass, sItmLiClass, sLblAClass, sItmAClass, sPlusImg, sMinusImg, sImgClass, sItmPadLeft, bLblIsItm, sActiveItmId) // Object Prototype
{
  var me = this;
  xMenu6.instances[sUlId] = this;
  // Public Properties
  this.ul = xGetElementById(sUlId);
  this.pImg = sPlusImg;
  this.mImg = sMinusImg;
  // Private Event Listener
  function click(e)
  {
    if (this.xmChildUL) { // 'this' points to the A element clicked
      var s, uls = this.xmChildUL.style;
      if (uls.display != 'block') {
        s = sMinusImg;
        uls.display = 'block';
        xWalkUL(this.xmParentUL, this.xmChildUL,
          function(p,li,c,d) {
            if (c && c != d && c.style.display != 'none') {
              if (sPlusImg) {
                var a = xFirstChild(li,'a');
                xFirstChild(a,'img').src = sPlusImg;
              }
              c.style.display = 'none';
            }
            return true;
          }
        );
      }
      else {
        s = sPlusImg;
        uls.display = 'none';
      }
      if (sPlusImg) {
        xFirstChild(this,'img').src = s;
      }
      if (typeof this.blur() == 'function') {this.blur();}
      e = e || window.event;
      var t = e.target || e.srcElement;
      if (t.nodeName.toLowerCase() != 'img' && bLblIsItm) {
        return true; // click was on a label and bLblIsItm is true
      }
      return false; // click was on a label and bLblIsItm is false
    }
    return true; // click was on an item
  }
  // Constructor Code
  this.ul.className = sMainUlClass;
  xWalkUL(this.ul, null,
    function(p,li,c) {
      var liCls = sItmLiClass;
      var aCls = sItmAClass;
      var a = xFirstChild(li,'a');
      if (a) {
        var m = 'Click to toggle sub-menu';
        if (c) { // this LI is a label which precedes the submenu c
          if (sPlusImg) {
            // insert the image as the firstChild of the A element
            var i = document.createElement('img');
            i.title = m;
            a.insertBefore(i, a.firstChild);
            i.src = sPlusImg;
            i.className = sImgClass;
          }
          aCls = sLblAClass;
          liCls = sLblLiClass;
          c.className = sSubUlClass;
          c.style.display = 'none';
          a.title = bLblIsItm ? 'Click to follow link' : m;
          a.xmParentUL = p;
          a.xmChildUL = c;
          a.onclick = click;
        }
        else if (sPlusImg) { // this LI is not a label but is an item
          // if we are inserting images in label As then give A items some left padding
          a.style.paddingLeft = sItmPadLeft;
        }
        a.className = aCls;
      }
      li.className = liCls;
      return true;
    }
  );
  if (sActiveItmId) {
    this.open(sActiveItmId);
  }
  this.ul.style.visibility = 'visible';
  xAddEventListener(window, 'unload',
    function(){
      xWalkUL(me.ul, null,
        function(p,li,c) {
          var a = xFirstChild(li,'a');
          if (a && c) { a.xmParentUL = a.xmChildUL = a.onclick = null; }
          return true;
        }
      );
    }, false
  );
} // end xMenu6 prototype

// xMenu6 Public Methods
xMenu6.prototype.open = function (id)
{
  var img, ul, li, a = xGetElementById(id);
  while (a && ul != this.ul) {
    ul = a.xmChildUL;
    if (ul) {
      ul.style.display = 'block';
      if (this.pImg) {
        img = xFirstChild(a, 'img');
        if (img) {img.src = this.mImg;}
      }
    }
    li = a.parentNode; // LI
    ul = li.parentNode; // UL
    li = ul.parentNode; // LI
    a = xFirstChild(li, 'a');
  }
};

xMenu6.instances = {}; // static property


// xAddEventListener r8, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xAddEventListener(e,eT,eL,cap)
{
  if(!(e=xGetElementById(e)))return;
  eT=eT.toLowerCase();
  if(e.addEventListener)e.addEventListener(eT,eL,cap||false);
  else if(e.attachEvent)e.attachEvent('on'+eT,eL);
  else {
    var o=e['on'+eT];
    e['on'+eT]=typeof o=='function' ? function(v){o(v);eL(v);} : eL;
  }
}

// xGetElementById r2, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xGetElementById(e)
{
  if(typeof(e)=='string') {
    if(document.getElementById) e=document.getElementById(e);
    else if(document.all) e=document.all[e];
    else e=null;
  }
  return e;
}

// xWalkUL r3, Copyright 2006-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xWalkUL(pu,d,f,lv)
{
  var r,cu,li=xFirstChild(pu);
  if (!lv){lv=0;}
  while(li){
    cu=xFirstChild(li,'ul');
    r=f(pu,li,cu,d,lv);
    if(cu){if(!r||!xWalkUL(cu,d,f,lv+1)){return 0;};}
    li=xNextSib(li);
  }
  return 1;
}

// xFirstChild r4, Copyright 2004-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xFirstChild(e,t)
{
  e = xGetElementById(e);
  var c = e ? e.firstChild : null;
  while (c) {
    if (c.nodeType == 1 && (!t || c.nodeName.toLowerCase() == t.toLowerCase())){break;}
    c = c.nextSibling;
  }
  return c;
}

// xNextSib r4, Copyright 2005-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xNextSib(e,t)
{
  e = xGetElementById(e);
  var s = e ? e.nextSibling : null;
  while (s) {
    if (s.nodeType == 1 && (!t || s.nodeName.toLowerCase() == t.toLowerCase())){break;}
    s = s.nextSibling;
  }
  return s;
}

// xGetComputedStyle r7, Copyright 2002-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xGetComputedStyle(e, p, i)
{
  if(!(e=xGetElementById(e))) return null;
  var s, v = 'undefined', dv = document.defaultView;
  if(dv && dv.getComputedStyle){
    s = dv.getComputedStyle(e,'');
    if (s) v = s.getPropertyValue(p);
  }
  else if(e.currentStyle) {
    v = e.currentStyle[xCamelize(p)];
  }
  else return null;
  return i ? (parseInt(v) || 0) : v;
}

