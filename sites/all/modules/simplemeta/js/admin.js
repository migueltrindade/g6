$(function(){
  var
    context = $("#simplemeta-admin-settings"),
    $new = context.find("#simplemeta-admin-settings-right-menu-new"),
    $save = context.find("#simplemeta-admin-settings-right-menu-save"),
    $delete = context.find("#simplemeta-admin-settings-right-menu-delete")
    $field = context.find("#simplemeta-admin-settings-left-search-field"),
    $results$container = context.find("#simplemeta-admin-settings-left-results-container"),
    $results$up = context.find("#simplemeta-admin-settings-left-results-up"),
    $results$down = context.find("#simplemeta-admin-settings-left-results-down"),
    form = context.find("#simplemeta-admin-settings-right-form"),
  formParent = form.parent(),
  formHeight = 365,
    page = 0,
    total = 0;
  
  form.path = form.find(".simplemeta-path");
  form.title = form.find(".simplemeta-title");
  form.keywords = form.find(".simplemeta-keywords");
  form.description = form.find(".simplemeta-description");
  form.id = form.find(".simplemeta-id");
  form.status = context.find("#simplemeta-admin-settings-right-status");
  
  $field
  .focus(function(){
    if ($field.val() == $field.attr("alt"))
      $field.removeClass("gray").val("");
  }).blur(function(){
    if ($field.val() == "")
      $field.val($field.attr("alt")).addClass("gray");
  });
  
  $new.mousedown(function() {    
    !$new.hasClass('disabled') && $new.addClass('pushed');
  });
  
  $save.mousedown(function() {    
    !$save.hasClass('disabled') && $save.addClass('pushed');
  });
  
  $delete.mousedown(function() {    
    !$delete.hasClass('disabled') && $delete.addClass('pushed');
  });
  
  $(window).mouseup(function() {
    $new.removeClass('pushed');
    $save.removeClass('pushed');
    $delete.removeClass('pushed');
  });
  
  $field.keyup(function() {
    $field.search && clearTimeout($field.search);
    $field.search = setTimeout(function(){
      loadItems(page=0);
    },300);
  });
    
  function loadItems(fieldval) {
  var perpage = 13;
  
    $results$container.html("").addClass("loading");
    fieldval = $field.val();
    fieldval = $field.attr("alt") == fieldval ? "" : fieldval;
    
  $field.attr("disabled" , "disabled");
  
    $.post(
    Drupal.settings.basePath + "simplemeta/search" , 
    {s: fieldval , i: perpage, p: page },
    function(data) {
      data = Drupal.parseJson(data);
        
      var html = [], i, t=0, k=0;
    
      total = Math.ceil(data.length / perpage)-1;
    
    
    
      data.length = undefined;
      
      for (i in data)
        if (data[i])
        {
          k++;
          t = html.length
          html[t++] = "<div><a rel='";
          html[t++] = i;
          html[t++] = "' href='javascript:void(0)'>";
          html[t++] = data[i];
          html[t] = "</a></div>";
        }
    
      if ((k == 0) && page > 0) {
        page--;
        loadItems();
        return;
      }
    
      $results$container.html( html.join("") ).removeClass("loading");
      $results$up[(page > 0) ? "removeClass" : "addClass"]("disabled");
      
    var approx = $results$container.find("div:first").outerHeight(true) * (k);
      
    approx = approx > 24 ? approx: 24;
    
    $results$container.animate({height : approx});
    
      $results$down[(page >= total) ? "addClass" : "removeClass"]("disabled");
      $field.attr("disabled" , "").focus();
      attachContainer();
    }
    );
  }
  
  loadItems();
  
  function attachContainer() {
    
    $results$container.find("a").click(function(E) {
      E.preventDefault();
      loadItem($(this).attr("rel") - 0);
    });
    
  }
  
  $results$up.click(function(){    
    if ($results$up.hasClass("disabled")) return;
      
    if (--page <= 0) $results$up.addClass("disabled");
    if (page < total) $results$down.removeClass("disabled");
    loadItems();
  });
  
  $results$down.click(function(){
    if ($results$down.hasClass("disabled")) return;
      
    if (++page >= total) $results$down.addClass("disabled");
    
    if (page > 0) $results$up.removeClass("disabled");
    loadItems();
  });
  
  function loadItem(id) {
    if (loadItem.lock()) return;
    $save.addClass("disabled");
    $delete.addClass("disabled");
    formParent.animate({height: 0},function(){
    
      $.post(Drupal.settings.basePath + "simplemeta/item/ajax", {i: id}, function(data){
        data = Drupal.parseJson(data);
        if (data) {
          form.path.val(data.path);
          form.title.val(data.title);
          form.keywords.val(data.keywords);
          form.description.val(data.description);
          form.id = id;
          $save.removeClass("disabled");
          $delete.removeClass("disabled");
          formParent.animate({height: formHeight}, function(){
            loadItem.lock(1);
          });
        }
        
        
      });
    });
    
  }
  
  (function(){
    var lock = 0;
    loadItem.lock = function(x) {
      if (x) return lock =0;
      
      if (lock) return 1;
      lock = 1;
    }
  })();
  
  $save.click(function(){
    if ($save.hasClass("disabled")) return;
    if (loadItem.lock()) return;
    
    $.post(Drupal.settings.basePath + "simplemeta/save/item/ajax", {i:form.id, p: form.path.val(), t: form.title.val(), k: form.keywords.val(), d: form.description.val() }, function(data) {
      data =  Drupal.parseJson(data);
      if (data.r) {
        formParent.animate({height: 0},function(){ 
      $save.addClass("disabled");
          loadItem.lock(1);
        });
        loadItems();
      } else
        form.setError(Drupal.settings.simplemeta.saving_error);
    });  
    
  });
  
  $delete.click(function(){
    if ($delete.hasClass("disabled")) return;
    if (loadItem.lock()) return;
    
    if ( confirm( Drupal.settings.simplemeta.confirmation ) )
      $.post(Drupal.settings.basePath + "simplemeta/save/item/ajax", { i:form.id }, function(data) {
        data = Drupal.parseJson(data);
        if (data.r) {
          formParent.animate({height: 0},function(){ 
          
            loadItem.lock(1);
            
          });
          loadItems();
        } else
          form.setError(Drupal.settings.simplemeta.deletion_error);
      });  
    else
      loadItem.lock(1);
  });  
  
  $new.click(function(){
    if (loadItem.lock()) return;
    
    formParent.animate({height: 0}, function(fieldval){ 
      fieldval = $field.val();
      form.path.val(fieldval == $field.attr("alt") ? "" : fieldval);
      form.title.val("");
      form.keywords.val("");
      form.description.val("");
      form.id = -1;
      
      $save.removeClass("disabled");
      $delete.addClass("disabled");
      
      formParent.animate({height: formHeight}, function() {
        loadItem.lock(1);
      });
      
    });
    
  });
  
  form.setError = function (msg) {
    loadItem.lock(1);
    if (form.status.hasClass("locked")) {
      return setTimeout(function() {
        form.setError(msg);
      },300);
    }
    form.status.html(msg).addClass("locked").fadeIn(100,function() {
      setTimeout(function() {
        form.status.fadeOut(100, function() {
          form.status.removeClass("locked");
        });
      }, 500);
    });
    
  }
});