 function sliceSize(dataNum, dataTotal) {
  return (dataNum / dataTotal) * 360;
}
function addSlice(sliceSize, pieElement, offset, sliceID, color) {
  $(pieElement).append("<div class='slice "+sliceID+"'><span></span></div>");
  var offset = offset - 1;
  var sizeRotation = -179 + sliceSize;
  $("."+sliceID).css({
    "transform": "rotate("+offset+"deg) translate3d(0,0,0)"
  });
  $("."+sliceID+" span").css({
    "transform"       : "rotate("+sizeRotation+"deg) translate3d(0,0,0)",
    "background-color": color
  });
}
function iterateSlices(sliceSize, pieElement, offset, dataCount, sliceCount, color,item) {
  var sliceID = "s"+item+dataCount+"-"+sliceCount;
  var maxSize = 179;
  if(sliceSize<=maxSize) {
    addSlice(sliceSize, pieElement, offset, sliceID, color);
  } else {
    addSlice(maxSize, pieElement, offset, sliceID, color);
    iterateSlices(sliceSize-maxSize, pieElement, offset+maxSize, dataCount, sliceCount+1, color,item);
  }
}
function createPie(dataElement, pieElement,item) {
  var listData = [];
  $(dataElement+" span").each(function() {
    listData.push(Number($(this).html()));
  });
  var listTotal = 0;
  for(var i=0; i<listData.length; i++) {
    listTotal += listData[i];
  }
  var offset = 0;
  var color = [];
  color[0] = [
    "#6d8bd5", 
    "#b07fcf", 
    "#63bdc0", 
    "#44c6e6"
  ];
  color[1] = [
    "#6a69d5", 
    "#9458b9", 
    "#00bd9c", 
    "#2c97dd", 
  ];
  for(var i=0; i<listData.length; i++) {
    var size = sliceSize(listData[i], listTotal);
    iterateSlices(size, pieElement, offset, i, 0, color[item][i],item);
    $(dataElement+" li:nth-child("+(i+1)+")").css("color", color[item][i]);
    offset += size;
  }
}
// createPie(".pieID.legend", ".pieID.pie",'0');

// createPie(".pieID2.legend", ".pieID2.pie",'1');

    