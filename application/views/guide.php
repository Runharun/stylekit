  <script type="text/javascript" src="/jquery-ui.min.js"></script>
  <script>
    
    var inQueue = false;
    function updateElement(element) {
      if(element) {
        elementContainer = $("#item-" + element);
        outputHTML = elementContainer.children(".markup").val();
        outputCSS = elementContainer.children(".css").val();
        outputTitle = elementContainer.children(".title").val();
        outputGlobal = $(".global-styles").val();
        elementContainer.children("#element_" + element).contents().find(".global-style").html(outputGlobal);
        elementContainer.children("#element_" + element).contents().find(".output").html(outputHTML);
        elementContainer.children("#element_" + element).contents().find(".style").html(outputCSS);
        var dataString = 'title=' + outputTitle + '&markup=' + outputHTML + '&css=' + outputCSS;
        $.ajax({
          type: 'POST',
          url: '/element/updateelement/' + element,
          data: dataString,
          success: function() {  }
        });
      } else {
        $(".element-container").each(function() {
          outputHTML = $(this).children(".markup").val();
          outputCSS = $(this).children(".css").val();
          outputGlobal = $(".global-styles").val();
          $(this).children(".output").contents().find(".global-style").html(outputGlobal);
          $(this).children(".output").contents().find(".output").html(outputHTML);
          $(this).children(".output").contents().find(".style").html(outputCSS);
          $(this).children(".output").fadeIn();
        });
      }
    };
    $(function() {
      $(".markup").live('keyup',function() {
        markupElementId = $(this).attr("id").replace("markup_","");
        updateElement(markupElementId);
      });
      $(".title").live('keyup',function(){
        titleElementId = $(this).attr("id").replace("title_","");
        updateElement(titleElementId);
      });
      $(".css").live('keyup',function() {
        cssElementId = $(this).attr("id").replace("css_","");
        updateElement(cssElementId);
      });

      $(".global-styles").live('keyup',function() {
        style_output = $(this).val();
        guide_id = $(this).attr("id").replace("guide_","");
        var dataString = 'global_styles=' + style_output;
        $.ajax({
          type: 'POST',
          url: '/home/update_global_styles/' + guide_id,
          data: dataString,
          success: function() {  }
        });
        $(".output").each(function() {
          $(this).contents().find(".global-style").html(style_output);
        });
      });

      $(".delete").live("click", function(e) {
        e.preventDefault();
        $(this).html("Confirm Delete");
      });
      $(".delete-element").live("click", function(e) {
        e.preventDefault();
        if($(this).hasClass("confirm-delete-element")) {
          deleteElement($(this).attr("href"));
        } else {
          $(this).addClass("confirm-delete-element");
        }
      });
      $(".delete-guide").click(function(e) {
        e.preventDefault();
        if($(this).hasClass("confirm-delete-guide")) {
          window.location = $(this).attr("href");
        } else {
          $(this).addClass("confirm-delete-guide");
        }
      });

      $('#element-list').sortable({
        opacity: '0.5',
        cursor: 'move', 
        data:$(this).sortable("serialize"),
        tolerance: 'pointer', 
        revert: true, 
        placeholder: 'state',
        update: function(e, ui){
          newOrder = $(this).sortable("serialize");
            $.ajax({
              url: "/element/reorder",
              type: "POST",
              data: newOrder,
              success: function(feedback){
                updateElement();
              }
            });
          }
        });
      if('<?=$loggedin?>' == '') {
        $("textarea").attr("disabled", "disabled");
        $("input").attr("disabled", "disabled");
      }
    });
    setTimeout(function(){updateElement()}, 1000);

    function randomString() {
    	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    	var string_length = 60;
    	var randomstring = '';
    	for (var i=0; i<string_length; i++) {
    		var rnum = Math.floor(Math.random() * chars.length);
    		randomstring += chars.substring(rnum,rnum+1);
    	}
    	return randomstring;
    }

    function newElement(guideId) {
      uniqueId = randomString();
      $("#ajaxContainer").load("/element/newelement/" + guideId + "/u" + uniqueId);

      $("#element-list").append('<li class="element-container" id="item-u' + uniqueId + '"> \
                                <input type="text" id="title_u' + uniqueId + '" class="title" value="New Element" /> \
                                <textarea class="markup" id="markup_u' + uniqueId + '"></textarea> \
                                <textarea class="css" id="css_u' + uniqueId + '"></textarea> \
                                <iframe class="output" style="display: inline" src="/output.html" id="element_u' + uniqueId + '"></iframe> \
                                <a class="delete delete-element" href="u' + uniqueId + '">Delete</a> \
                                </li>');
      outputGlobal = $(".global-styles").val();
      
      setTimeout(function(){ $("#item-u" + uniqueId).children(".output").contents().find(".global-style").html(outputGlobal); }, 200);
    }
    function deleteElement(uniqueId) {
      $("#ajaxContainer").load("/element/removeelement/" + uniqueId);
      $("#item-" + uniqueId).fadeOut().remove();
    };
  </script>
	<style>
    .output { display: none; }
	</style>
<?php foreach ($guide as $guide): ?>
<h1><?=$guide['title']?></h1>
<? if($loggedin) { ?>
<a class="delete delete-guide" href="/home/removeguide/<?=$guide['id']?>">Delete Guide</a>
<? } ?>
<textarea id="guide_<?=$this->uri->segment(2)?>" class="global-styles"><?=$guide['global_styles']?></textarea>
<?php endforeach ?>
<ul id="element-list">
<?php foreach ($elements as $element): ?>
  <li class="element-container" id="item-<?=$element['unique_id']?>">
    <input type="text" class="title" id="title_<?=$element['unique_id']?>" name="title" value="<?=$element['title'] ?>" />
    <textarea class="markup" name="markup" id="markup_<?=$element['unique_id']?>"><?=htmlentities($element['markup'])?></textarea>
    <textarea class="css" name="css" id="css_<?=$element['unique_id']?>"><?=$element['css']?></textarea>
    <iframe class="output" src="/output.html" id="element_<?=$element['unique_id']?>"></iframe>
    <? if($loggedin) { ?>
      <a class="delete delete-element" href="<?=$element['unique_id']?>">Delete</a>
    <? } ?>
    <hr />
  </li>
<?php endforeach ?>
</ul>
<? if($loggedin) { ?>
  <a href="javascript:newElement('<?=$guide['id']?>')">New Element</a>
<? } ?>
<div id="ajaxContainer"></div>
