<? if($loggedin) { ?>
<style>
.CodeMirror-focused pre.CodeMirror-cursor {
  visibility: visible !important;
}
</style>
<? } ?>
  <script type="text/javascript" src="/jquery-ui.min.js"></script>
  <script>
    
    //Resize Some UI Elements
    function resizeUIElements() {
      docH = $(document).height();
      docW = $(document).width();
      winH = $(window).height();
      winW = $(window).width();
      globalStylesW = $("#global-styles-container").width();
      $(".CodeMirror").height(winH - 110);
      $(".CodeMirror-gutter").height(winH - 110);
      $(".markup-container textarea, .css-container textarea").width($(".markup-container").width() - 50);
      $(".output-container iframe").width($(".output-container").width() - 15);
      $(".title").width($(".title-container").width() - 35);
    }

    var inQueue = false;
    function updateElement(element) {
      if(element) {
        elementContainer = $("#item-" + element);
        outputHTML = elementContainer.find(".markup").val();
        outputCSS = elementContainer.find(".css").val();
        outputTitle = elementContainer.find(".title").val();
        outputGlobal = $(".global-styles").val();
        elementContainer.find("#element_" + element).contents().find(".global-style").html(outputGlobal);
        elementContainer.find("#element_" + element).contents().find(".output").html(outputHTML);
        elementContainer.find("#element_" + element).contents().find(".style").html(outputCSS);
        var dataString = 'title=' + outputTitle + '&markup=' + outputHTML + '&css=' + outputCSS;
        $.ajax({
          type: 'POST',
          url: '/element/updateelement/' + element,
          data: dataString,
          success: function() {  }
        });
      } else {
        $(".element-container").each(function() {
          elementID = $(this).attr("id").replace("item-","");
          outputHTML = $(this).find(".markup").val();
          outputCSS = $(this).find(".css").val();
          outputGlobal = $(".global-styles").val();
          $(this).find(".output").contents().find(".global-style").html(outputGlobal);
          $(this).find(".output").contents().find(".output").html(outputHTML);
          $(this).find(".output").contents().find(".style").html(outputCSS);
          $(this).find(".output").fadeIn();
        });
      }
      
    };
    $(function() {
      $(".element-container").each(function() {
        elementID = $(this).attr("id").replace("item-u","");
        initEditor(elementID, "markup");
        initEditor(elementID, "css");
      });
      $(".title").live('keyup',function(){
        titleElementId = $(this).attr("id").replace("title_","");
        updateElement(titleElementId);
      });

      $(".delete").live("click", function(e) {
        e.preventDefault();
        $(this).html("Really Delete");
      });
      $(".delete-element").live("click", function(e) {
        e.preventDefault();
        $(this).after('<a class="cancel-delete-element" href="">Cancel</a>');
        if($(this).hasClass("confirm-delete-element")) {
          deleteElement($(this).attr("href"));
        } else {
          $(this).addClass("confirm-delete-element");
        }
      });
      $(".delete-guide").click(function(e) {
        e.preventDefault();
        $(this).after('<a class="cancel-delete-guide" href="">Cancel</a>');
        if($(this).hasClass("confirm-delete-guide")) {
          window.location = $(this).attr("href");
        } else {
          $(this).addClass("confirm-delete-guide");
        }
      });
      $(".cancel-delete-element").live("click", function(e) {
        e.preventDefault();
        $(this).remove();
        $(".delete-element").html("Delete").removeClass("confirm-delete-element");
      });
      $(".cancel-delete-guide").live("click", function(e) {
        e.preventDefault();
        $(this).remove();
        $(".delete-guide").html("Delete Guide").removeClass("confirm-delete-guide");
      });


      <? if($loggedin) { ?>
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
<? } ?>
      if('<?=$loggedin?>' == '') {
        $("textarea").attr("disabled", "disabled");
        $("input").attr("disabled", "disabled");
      }


      $(window).resize(function() {
        resizeUIElements();
      });

      resizeUIElements();

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
                                <div class="title-container"><label>Name</label> \
                                <input type="text" class="title" id="title_u' + uniqueId + '" name="title" value="New Element" /> \
                                <a class="delete delete-element" href="u' + uniqueId + '">Delete</a> \
                                </div> \
                                <div class="markup-container"><label>Markup</label> \
                                <textarea class="markup" id="markup_u' + uniqueId + '"></textarea> \
                                </div> \
                                <div class="css-container"><label>CSS</label> \
                                <textarea class="css" id="css_u' + uniqueId + '"></textarea> \
                                </div> \
                                <div class="output-container"><label>Output</label> \
                                <iframe class="output" style="display: inline" src="/output.html" id="element_u' + uniqueId + '"></iframe> \
                                </div> \
                                </li>');
      outputGlobal = $(".global-styles").val();
      
      setTimeout(function(){ $("#item-u" + uniqueId).find(".output").contents().find(".global-style").html(outputGlobal); }, 200);
      resizeUIElements();
      initEditor(uniqueId, "markup");
      initEditor(uniqueId, "css");
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
<h1 class="guide-title"><?=$guide['title']?> Style Guide</h1>
<div id="guide-options">
<? if($loggedin) { ?>
<a class="button delete delete-guide" href="/home/removeguide/<?=$guide['id']?>">Delete Guide</a>
<a class="button all-guides" href="/">Back to Library</a>
<? } ?>
</div>
<div id="global-styles-container">
  <h2>Global CSS</h2>
  <textarea id="guide_<?=$this->uri->segment(2)?>" class="global-styles-field global-styles"><?=$guide['global_styles']?></textarea>
</div>
<?php endforeach ?>
<div id="element-list-container">
  <h2>Elements</h2>
<ul id="element-list">
<?php foreach ($elements as $element): ?>
  <li class="element-container" id="item-<?=$element['unique_id']?>">
    <div class="title-container"><label>Name</label>
      <input type="text" class="title" id="title_<?=$element['unique_id']?>" name="title" value="<?=$element['title'] ?>" />
      <? if($loggedin) { ?>
        <a class="delete delete-element" href="<?=$element['unique_id']?>">Delete</a>
      <? } ?>
    </div>
    <div class="markup-container"><label>Markup</label>
      <textarea class="markup" name="markup" id="markup_<?=$element['unique_id']?>"><?=htmlentities($element['markup'])?></textarea>
    </div>
    <div class="css-container"><label>CSS</label>
      <textarea class="css" name="css" id="css_<?=$element['unique_id']?>"><?=$element['css']?></textarea>
    </div>
    <div class="output-container"><label>Output</label>
      <iframe class="output" src="/output.html" id="element_<?=$element['unique_id']?>"></iframe>
    </div>
  </li>
<?php endforeach ?>
</ul>
<? if($loggedin) { ?>
  <a class="button new-element-button" href="javascript:newElement('<?=$guide['id']?>')">New Element</a>
<? } ?>
</div>
<div id="ajaxContainer"></div>
<script>
var globalEditor = CodeMirror.fromTextArea(document.getElementById("guide_<?=$this->uri->segment(2)?>"), {
  mode: "text/css",
  lineNumbers: true,
  lineWrapping: false,
  tabSize: 2,
  onCursorActivity: function() {
    guide_id = "<?=$this->uri->segment(2)?>";
    var dataString = 'global_styles=' + globalEditor.getValue();
    $.ajax({
      type: 'POST',
      url: '/home/update_global_styles/' + guide_id,
      data: dataString,
      success: function() {  }
    });
    $(".output").each(function() {
      $(this).contents().find(".global-style").html(globalEditor.getValue());
    });
  }
});
    function initEditor(elementID, field) {
      console.log(field + "_u" + elementID);
      if(field == "markup") {
        modeis = "text/html";
      } else {
        modeis = "text/css";
      }
      var editor = CodeMirror.fromTextArea(document.getElementById(field + '_u' + elementID), {
        mode: "text/css",
        lineNumbers: true,
        lineWrapping: false,
        tabSize: 2,
        onCursorActivity: function() {
          $("#" + field + "_u" + elementID).html(editor.getValue());
          updateElement("u" + elementID);
        }
      });
    }

</script>
