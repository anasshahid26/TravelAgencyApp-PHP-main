<script>
  $(function () {
     slideout();
              $(".icon-picker").iconPicker();
          });

  (function($) {

      $.fn.iconPicker = function( options ) {

          var mouseOver=false;
          var $popup=null;
          var icons=new Array("adjust","align-center","align-justify","align-left","align-right","arrow-down","arrow-left","arrow-right","arrow-up","asterisk","backward","ban-circle","barcode","bell","bold","book","bookmark","briefcase","bullhorn","calendar","camera","certificate","check","chevron-down","chevron-left","chevron-right","chevron-up","circle-arrow-down","circle-arrow-left","circle-arrow-right","circle-arrow-up","cloud","cloud-download","cloud-upload","cog","collapse-down","collapse-up","comment","compressed","copyright-mark","credit-card","cutlery","dashboard","download","download-alt","earphone","edit","eject","envelope","euro","exclamation-sign","expand","export","eye-close","eye-open","facetime-video","fast-backward","fast-forward","file","film","filter","fire","flag","flash","floppy-disk","floppy-open","floppy-remove","floppy-save","floppy-saved","folder-close","folder-open","font","forward","fullscreen","gbp","gift","glass","globe","hand-down","hand-left","hand-right","hand-up","hd-video","hdd","header","headphones","heart","heart-empty","home","import","inbox","indent-left","indent-right","info-sign","italic","leaf","link","list","list-alt","lock","log-in","log-out","magnet","map-marker","minus","minus-sign","move","music","new-window","off","ok","ok-circle","ok-sign","open","paperclip","pause","pencil","phone","phone-alt","picture","plane","play","play-circle","plus","plus-sign","print","pushpin","qrcode","question-sign","random","record","refresh","registration-mark","remove","remove-circle","remove-sign","repeat","resize-full","resize-horizontal","resize-small","resize-vertical","retweet","road","save","saved","screenshot","sd-video","search","send","share","share-alt","shopping-cart","signal","sort","sort-by-alphabet","sort-by-alphabet-alt","sort-by-attributes","sort-by-attributes-alt","sort-by-order","sort-by-order-alt","sound-5-1","sound-6-1","sound-7-1","sound-dolby","sound-stereo","star","star-empty","stats","step-backward","step-forward","stop","subtitles","tag","tags","tasks","text-height","text-width","th","th-large","th-list","thumbs-down","thumbs-up","time","tint","tower","transfer","trash","tree-conifer","tree-deciduous","unchecked","upload","usd","user","volume-down","volume-off","volume-up","warning-sign","wrench","zoom-in","zoom-out");
          var settings = $.extend({

          }, options);
          return this.each( function() {
          	element=this;
              if(!settings.buttonOnly && $(this).data("iconPicker")==undefined ){
              	$this=$(this).addClass("form-control");
              	$wraper=$("<div>",{class:"input-group"});
              	$this.wrap($wraper);

              	$button=$("<span class=\"input-group-addon pointer\"><i class=\"glyphicon  glyphicon-picture\"></i></span>");
              	$this.after($button);
              	(function(ele){
  	            	$button.click(function(){
  			       		createUI(ele);
  			       		showList(ele,icons);
  	            	});
  	            })($this);

              	$(this).data("iconPicker",{attached:true});
              }

  	        function createUI($element){
  	        	$popup=$('<div/>',{
  	        		css: {
  		        		'top':$element.offset().top+$element.outerHeight()+6,
  		        		'left':$element.offset().left
  		        	},
  		        	class:'icon-popup'
  	        	})

  	        	$popup.html('<div class="ip-control"> \
  						          <ul> \
  						            <li><a href="javascript:;" class="btn" data-dir="-1"><span class="glyphicon  glyphicon-fast-backward"></span></a></li> \
  						            <li><input type="text" class="ip-search glyphicon  glyphicon-search" placeholder="Search" /></li> \
  						            <li><a href="javascript:;"  class="btn" data-dir="1"><span class="glyphicon  glyphicon-fast-forward"></span></a></li> \
  						          </ul> \
  						      </div> \
  						     <div class="icon-list"> </div> \
  					         ').appendTo("body");


  	        	$popup.addClass('dropdown-menu').show();
  				$popup.mouseenter(function() {  mouseOver=true;  }).mouseleave(function() { mouseOver=false;  });

  	        	var lastVal="", start_index=0,per_page=30,end_index=start_index+per_page;
  	        	$(".ip-control .btn",$popup).click(function(e){
  	                e.stopPropagation();
  	                var dir=$(this).attr("data-dir");
  	                start_index=start_index+per_page*dir;
  	                start_index=start_index<0?0:start_index;
  	                if(start_index+per_page<=210){
  	                  $.each($(".icon-list>ul li"),function(i){
  	                      if(i>=start_index && i<start_index+per_page){
  	                         $(this).show();
  	                      }else{
  	                        $(this).hide();
  	                      }
  	                  });
  	                }else{
  	                  start_index=180;
  	                }
  	            });

  	        	$('.ip-control .ip-search',$popup).on("keyup",function(e){
  	                if(lastVal!=$(this).val()){
  	                    lastVal=$(this).val();
  	                    if(lastVal==""){
  	                    	showList(icons);
  	                    }else{
  	                    	showList($element, $(icons)
  							        .map(function(i,v){
  								            if(v.toLowerCase().indexOf(lastVal.toLowerCase())!=-1){return v}
  								        }).get());
  						}

  	                }
  	            });
  	        	$(document).mouseup(function (e){
  				    if (!$popup.is(e.target) && $popup.has(e.target).length === 0) {
  				        removeInstance();
  				    }
  				});

  	        }
  	        function removeInstance(){
  	        	$(".icon-popup").remove();
  	        }
  	        function showList($element,arrLis){
  	        	$ul=$("<ul>");

  	        	for (var i in arrLis) {
  	        		$ul.append("<li><a href=\"#\" title="+arrLis[i]+"><span class=\"glyphicon  glyphicon-"+arrLis[i]+"\"></span></a></li>");
  	        	};

  	        	$(".icon-list",$popup).html($ul);
  	        	$(".icon-list li a",$popup).click(function(e){
  	        		e.preventDefault();
  	        		var title=$(this).attr("title");
  	        		$element.val("glyphicon glyphicon-"+title);
  	        		removeInstance();
  	        	});
  	        }

          });
      }

  }(jQuery));


</script>

  <?php if($this->session->flashdata('flashmsgs')){ echo NOTIFY; } ?>
  <form action="" method="POST">
    <div class="panel panel-default">

    <div class="panel-heading">
      <span class="panel-title pull-left">Dohop Flights Settings</span>
      <div class="clearfix"></div>
    </div>

      <div class="panel-body">
        <div class="spacer20px">

            <div class="panel-body">


             <div class="form-horizontal  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                      <div class="form-group">
                      <table class="table table-striped">
                      <tbody>
                      <tr>
                      <td>Main Icon</td>
                      <td style="width:380px">
                        <input type="text" name="page_icon" class="icon-picker" placeholder="Select icon" value="<?php echo $settings[0]->front_icon;?>" >
                      </td>
                      <td>Select icon to show on front-end</td>
                      </tr>

                      <tr>
                      <td>Menu Target</td>
                      <td>
                      <select  class="form-control" name="target">
                        <option  value="_self" <?php if($settings[0]->linktarget == "_self"){ echo "selected";} ?>   >Self</option>
                        <option  value="_blank"  <?php if($settings[0]->linktarget == "_blank"){ echo "selected";} ?>  >Blank</option>
                      </select>
                      </td>
                      <td>Select page target option for front-end</td>
                      </tr>

                      <tr>
                      <td>Show Header/Footer</td>
                      <td>
                      <select  class="form-control" name="showheaderfooter">
                        <option  value="1" <?php if($settings[0]->load_headerfooter == "1"){ echo "selected";} ?>   >Enable</option>
                        <option  value="0"  <?php if($settings[0]->load_headerfooter == "0"){ echo "selected";} ?>  >Disable</option>
                      </select>
                      </td>
                      <td>Enable/Disable to load header/footer </td>
                      </tr>

                      <tr>
                       <td>Dohop Username</td>
                      <td>
                      <input type="" class="form-control" name="username" placeholder="whitelabel username" value="<?php echo $settings[0]->cid;?>" />
                      </td>
                      <td>Input your whitelabel username here</td>
                      </tr>

                      <tr>
                       <td>Header title</td>
                      <td>
                      <input type="text" name="headertitle" class="form-control" placeholder="title" value="<?php echo $settings[0]->header_title;?>" />
                      </td>
                      <td>Write your listing page header title here</td>
                      </tr>


                      </tbody>
                      </table>

                      </div>
                    </div>

                  </div>




        </div>
      </div>
    </div>


    <div class="panel-footer">
        <input type="hidden" name="updatesettings" value="1" />
    <input type="hidden" name="updatefor" value="flightsdohop" />

    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
    </div>


 </form>
