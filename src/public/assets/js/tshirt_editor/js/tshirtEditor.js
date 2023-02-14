var canvas = [];
var IMAGE_NAME = "crew";
var tshirts = new Array(); //prototype: [{style:'x',color:'white',front:'a',back:'b',price:{tshirt:'12.95',frontPrint:'4.99',backPrint:'4.99',total:'22.47'}}]
var a;
var b;
var line1;
var line2;
var line3;
var line4;
 	$(document).ready(function() {

		var counter = 0;
		var product_files = JSON.parse($(".product_files").val());
		console.log( product_files );
		product_files.forEach( element => {
			if( element.type!="mockup" && element.type!="embroidery_chest_left" && element.type!="embroidery_chest_center" )
			{
				index = counter;
				counter++;
				console.log( index );
				console.log( element.type );

				//window.canvas_+element.type = "";
			//setup front side canvas 
			canvas[index] = new fabric.Canvas('tcanvas_'+element.type, {
				hoverCursor: 'pointer',
				selection: true,
				selectionBorderColor:'blue'
			  });
	  
			   canvas[index].on({
				   'object:moving': function(e) {		  	
					  e.target.opacity = 0.5;
					},
					'object:modified': function(e) {		  	
					  e.target.opacity = 1;
					},
				   'object:selected':onObjectSelected,
				   'selection:cleared':onSelectedCleared
			   });
			  // piggyback on `canvas[index].findTarget`, to fire "object:over" and "object:out" events
			   canvas[index].findTarget = (function(originalFn) {
				return function() {
				  var target = originalFn.apply(this, arguments);
				  if (target) {
					if (this._hoveredTarget !== target) {
						canvas[index].fire('object:over', { target: target });
					  if (this._hoveredTarget) {
						  canvas[index].fire('object:out', { target: this._hoveredTarget });
					  }
					  this._hoveredTarget = target;
					}
				  }
				  else if (this._hoveredTarget) {
					  canvas[index].fire('object:out', { target: this._hoveredTarget });
					this._hoveredTarget = null;
				  }
				  return target;
				};
			  })(canvas[index].findTarget);
	  
			   canvas[index].on('object:over', function(e) {		
				//e.target.setFill('red');
				//canvas[index].renderAll();
			  });
			  
			   canvas[index].on('object:out', function(e) {		
				//e.target.setFill('green');
				//canvas[index].renderAll();
			  });
			}
		});

		$(document).on("click",'.add-text', function() {
			var text = $(".text-string:visible").val();
			var textSample = new fabric.Text(text, {
			  left: fabric.util.getRandomInt(40, 100),
			  top: fabric.util.getRandomInt(0, 100),
			  fontFamily: 'helvetica',
			  angle: 0,
			  fill: '#000000',
			  scaleX: 0.5,
			  scaleY: 0.5,
			  fontWeight: '',
				hasRotatingPoint:true
			});		    
			canvas[$(".design_layout:visible").index()-1].add(textSample);	
			canvas[$(".design_layout:visible").index()-1].item(canvas[$(".design_layout:visible").index()-1].item.length-1).hasRotatingPoint = true;    
			$("#texteditor").css('display', 'block');
			$("#imageeditor").css('display', 'block');
		  });
		  $(".text-string:visible").keyup(function(){	  		
			  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
			  if (activeObject && activeObject.type === 'text') {
				  activeObject.text = this.value;
				  canvas[$(".design_layout:visible").index()-1].renderAll();
			  }
		  });
		  //$(".img-polaroid").on('click',function(e){
		$('body').on('click', '.img-polaroid', function (e){
			  //alert("OK");
			  var el = e.target;
			  /*temp code*/
			  var offset = 50;
			var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
			var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
			var angle = fabric.util.getRandomInt(-20, 40);
			var width = fabric.util.getRandomInt(30, 50);
			var opacity = (function(min, max){ return Math.random() * (max - min) + min; })(0.5, 1);

			  fabric.Image.fromURL(el.src, function(image) {
				  image.set({
					left: left,
					top: top,
					angle: 0,
					padding: 10,
					cornersize: 10,
						hasRotatingPoint:true
				  });
				  //image.scale(getRandomNum(0.1, 0.25)).setCoords();
				  canvas[$(".design_layout:visible").index()-1].add(image);
				});
			$("#galleryModal").modal("hide");
		  });
		  
	  $(document).on("click",".remove-selected", function(event){
		var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject(),
				activeGroup = canvas[$(".design_layout:visible").index()-1].getActiveGroup();
			if (activeObject) {
			  canvas[$(".design_layout:visible").index()-1].remove(activeObject);
			  $(".text-string:visible").val("");
			}
			else if (activeGroup) {
			  var objectsInGroup = activeGroup.getObjects();
			  canvas[$(".design_layout:visible").index()-1].discardActiveGroup();
			  objectsInGroup.forEach(function(object) {
				canvas[$(".design_layout:visible").index()-1].remove(object);
			  });
			}
	  });
	//   document.getElementById('remove-selected').onclick = function() {		  
	// 		var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject(),
	// 			activeGroup = canvas[$(".design_layout:visible").index()-1].getActiveGroup();
	// 		if (activeObject) {
	// 		  canvas[$(".design_layout:visible").index()-1].remove(activeObject);
	// 		  $(".text-string:visible").val("");
	// 		}
	// 		else if (activeGroup) {
	// 		  var objectsInGroup = activeGroup.getObjects();
	// 		  canvas[$(".design_layout:visible").index()-1].discardActiveGroup();
	// 		  objectsInGroup.forEach(function(object) {
	// 			canvas[$(".design_layout:visible").index()-1].remove(object);
	// 		  });
	// 		}
	//   };
	  document.getElementById('bring-to-front').onclick = function() {		  
			var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject(),
				activeGroup = canvas[$(".design_layout:visible").index()-1].getActiveGroup();
			if (activeObject) {
			  activeObject.bringToFront();
			}
			else if (activeGroup) {
			  var objectsInGroup = activeGroup.getObjects();
			  canvas[$(".design_layout:visible").index()-1].discardActiveGroup();
			  objectsInGroup.forEach(function(object) {
				object.bringToFront();
			  });
			}
	  };
	  document.getElementById('send-to-back').onclick = function() {		  
			var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject(),
				activeGroup = canvas[$(".design_layout:visible").index()-1].getActiveGroup();
			if (activeObject) {
			  activeObject.sendToBack();
			}
			else if (activeGroup) {
			  var objectsInGroup = activeGroup.getObjects();
			  canvas[$(".design_layout:visible").index()-1].discardActiveGroup();
			  objectsInGroup.forEach(function(object) {
				object.sendToBack();
			  });
			}
	  };		  
	  $("#text-bold").click(function() {		  
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');		    
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});
	  $("#text-italic").click(function() {		 
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			  activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');		    
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});
	  $("#text-strike").click(function() {		  
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			  activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});
	  $("#text-underline").click(function() {		  
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			  activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});
	  $("#text-left").click(function() {		  
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			  activeObject.textAlign = 'left';
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});
	  $("#text-center").click(function() {		  
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			  activeObject.textAlign = 'center';		    
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});
	  $("#text-right").click(function() {		  
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			  activeObject.textAlign = 'right';		    
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});	  
	  $("#font-family").change(function() {
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			activeObject.fontFamily = this.value;
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
		});	  
		$('#text-bgcolor').miniColors({
			change: function(hex, rgb) {
			  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
			  if (activeObject && activeObject.type === 'text') {
				  activeObject.backgroundColor = this.value;
				canvas[$(".design_layout:visible").index()-1].renderAll();
			  }
			},
			open: function(hex, rgb) {
				//
			},
			close: function(hex, rgb) {
				//
			}
		});		
		$('.text-fontcolor').miniColors({
			change: function(hex, rgb) {
			  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
			  if (activeObject && activeObject.type === 'text') {
				  activeObject.fill = this.value;
				  canvas[$(".design_layout:visible").index()-1].renderAll();
			  }
			},
			open: function(hex, rgb) {
				//
			},
			close: function(hex, rgb) {
				//
			}
		});
		
		$('.text-strokecolor').miniColors({
			change: function(hex, rgb) {
			  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
			  if (activeObject && activeObject.type === 'text') {
				  activeObject.strokeStyle = this.value;
				  canvas[$(".design_layout:visible").index()-1].renderAll();
			  }
			},
			open: function(hex, rgb) {
				//
			},
			close: function(hex, rgb) {
				//
			}
		});
	
		//canvas[$(".design_layout:visible").index()-1].add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:false,selectable:false,type:'rect'}));
	//    $(".drawingArea:visible").hover(
	// 		function() { 	        	
	// 			 canvas[$(".design_layout:visible").index()-1].add(line1);
	// 			 canvas[$(".design_layout:visible").index()-1].add(line2);
	// 			 canvas[$(".design_layout:visible").index()-1].add(line3);
	// 			 canvas[$(".design_layout:visible").index()-1].add(line4); 
	// 			 canvas[$(".design_layout:visible").index()-1].renderAll();
	// 		},
	// 		function() {	        	
	// 			 canvas[$(".design_layout:visible").index()-1].remove(line1);
	// 			 canvas[$(".design_layout:visible").index()-1].remove(line2);
	// 			 canvas[$(".design_layout:visible").index()-1].remove(line3);
	// 			 canvas[$(".design_layout:visible").index()-1].remove(line4);
	// 			 canvas[$(".design_layout:visible").index()-1].renderAll();
	// 		}
	// 	);
	   
	   $('.color-preview').click(function(){
		   var color = $(this).css("background-color");
		   document.getElementById("shirtDiv").style.backgroundColor = color;		   
	   });
	   $('.nav input.checkbox-round').click(function(){
			var color = $(this).css("background-color");
			$(".shirtDiv").css("background-color", color);
			//document.getElementByClass("shirtDiv").style.backgroundColor = color;		   
		});
	   
	  // $('#flip').click(
		$('body').on('click', '#flip', function (e){
		   //function() {
				   if ($(this).attr("data-original-title") == "Show Back View") {
					   $(this).attr('data-original-title', 'Show Front View');
					$("#tshirtFacing").attr("src","img/t-shirts/"+IMAGE_NAME+"_back.png");
					a = JSON.stringify(canvas[$(".design_layout:visible").index()-1]);
					canvas[$(".design_layout:visible").index()-1].clear();
					try
					{
					   var json = JSON.parse(b);
					   canvas[$(".design_layout:visible").index()-1].loadFromJSON(b);
					}
					catch(e)
					{}

				} else {
					$(this).attr('data-original-title', 'Show Back View');
					$("#tshirtFacing").attr("src","img/t-shirts/"+IMAGE_NAME+"_front.png");
					b = JSON.stringify(canvas[$(".design_layout:visible").index()-1]);
					canvas[$(".design_layout:visible").index()-1].clear();
					try
					{
					   var json = JSON.parse(a);
					   canvas[$(".design_layout:visible").index()-1].loadFromJSON(a);
					}
					catch(e)
					{}
				}
				   canvas[$(".design_layout:visible").index()-1].renderAll();
				   setTimeout(function() {
					   canvas[$(".design_layout:visible").index()-1].calcOffset();
				},200);
		});
	   $(".clearfix button,a").tooltip();
	   line1 = new fabric.Line([0,0,200,0], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	   line2 = new fabric.Line([199,0,200,399], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	   line3 = new fabric.Line([0,0,0,400], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	   line4 = new fabric.Line([0,400,200,399], {"stroke":"#000000", "strokeWidth":1,hasBorders:false,hasControls:false,hasRotatingPoint:false,selectable:false});
	 });//doc ready
	 
	 
	 function getRandomNum(min, max) {
		return Math.random() * (max - min) + min;
	 }
	 
	 function onObjectSelected(e) {	 
		var selectedObject = e.target;
		$(".text-string:visible").val("");
		selectedObject.hasRotatingPoint = true
		if (selectedObject && selectedObject.type === 'text') {
			//display text editor	    	
			//$("#texteditor").css('display', 'block');
			$(".text-string:visible").val(selectedObject.getText());	    	
			// $('#text-fontcolor').miniColors('value',selectedObject.fill);
			// $('#text-strokecolor').miniColors('value',selectedObject.strokeStyle);	
			// $("#imageeditor").css('display', 'block');

			$(".shirtDiv:visible").prev().find(".texteditor").css('display', 'block');
			$(".shirtDiv:visible").prev().find('.text-fontcolor').miniColors('value',selectedObject.fill);
			$(".shirtDiv:visible").prev().find('.text-strokecolor').miniColors('value',selectedObject.strokeStyle);	
			$(".shirtDiv:visible").prev().find(".imageeditor").css('display', 'block');
		}
		else if (selectedObject && selectedObject.type === 'image'){
			//display image editor
			// $("#texteditor").css('display', 'none');	
			// $("#imageeditor").css('display', 'block');

			$(".shirtDiv:visible").prev().find(".texteditor").css('display', 'none');
			$(".shirtDiv:visible").prev().find(".imageeditor").css('display', 'block');
		}
	  }
	 function onSelectedCleared(e){
		 //$("#texteditor").css('display', 'none');
		 $(".text-string:visible").val("");
		 //$("#imageeditor").css('display', 'none');

		 $(".shirtDiv:visible").prev().find(".texteditor").css('display', 'none');
		$(".shirtDiv:visible").prev().find(".imageeditor").css('display', 'none');
	 }
	 function setFont(font){
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'text') {
			activeObject.fontFamily = font;
			canvas[$(".design_layout:visible").index()-1].renderAll();
		  }
	  }
	 function removeWhite(){
		  var activeObject = canvas[$(".design_layout:visible").index()-1].getActiveObject();
		  if (activeObject && activeObject.type === 'image') {			  
			  activeObject.filters[2] =  new fabric.Image.filters.RemoveWhite({hreshold: 100, distance: 10});//0-255, 0-255
			  activeObject.applyFilters(canvas[$(".design_layout:visible").index()-1].renderAll.bind(canvas[$(".design_layout:visible").index()-1]));
		  }	        
	 }