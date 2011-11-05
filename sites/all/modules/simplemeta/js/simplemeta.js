(function(){
  var running = 0;
  function init(){
    if (running) return;
    
    
    var
    button = $("#admin-menu li > a[href=" + Drupal.settings.simplemeta.admin_menu + "]"),
    drupal_settings = Drupal.settings,
    settings = drupal_settings.simplemeta,
    url = settings.url,
    ajax_url = drupal_settings.basePath + "simplemeta/ajax",
    form = $("<div id='simplemeta-ajax-form' />").appendTo("body").hide(),
    item,
    title,description,keywords,
    save,cancel,del;
    
    if (button.length)
    running = 1;
    
    function createElem(type, id, val) {
    
    if (item.type === "text")
      return "<input id=" + id + " type='text' value='" + val + "' />";
      
    if (item.type === "textarea")
      return "<textarea id=" + id + ">" + val + "</textarea>";
    
    if (item.type === "checkbox")
      return "<input id=" + id + " type='checkbox' " + (val ? "checked='checked'" : "") + " />";
    
    if (item.type === "button")
      return "<button id=" + id + "></button>";
    
    return "";
    }
    
    for (var i=0,len = settings.form_items.length;i<len;i++) {
    item = settings.form_items[i];
    item.id = item.id ? "'" + item.id + "'" : "";
    form.append([
      "<label for=", item.id, " class=", item.id, ">",
      item.before ? item.before  + ":<br/>": "",
      item.type && createElem(item.type || "", item.id , item.val || ""),
      item.after ? "<br/>" + item.after + ":": "",
      "</label>",
      item.type === "button" ? "" : "<br/>"
    ].join(""));
    }
    
    $(window).resize(function() {
    form.css({
      top: $(window).height() - form.outerHeight(true)
    });
    }).resize().click(function() {
    if (!form.hasClass("opened")) return;
    getMetaTags();
    });
    
    
    
    title = form.find("#simplemeta-form-title");
    keywords = form.find("#simplemeta-form-keywords");
    description = form.find("#simplemeta-form-description");
    
    form.status = $("<div id='simplemeta-form-description' />").appendTo(form);
    $("<div style='clear:both' />").appendTo(form);
    form.locked = 0;
    form.lock = function() {
    if (form.locked) return 1;
    form.locked = 1;
    }
    
    form.unlock = function() {
    form.locked = 0;
    }
    
    
    save = form.find("#simplemeta-form-save").click(function(E) {
    
    E.preventDefault();    
    if (form.lock()) return;
    
    ajax({
      t: title.val(),
      k: keywords.val(),
      d: description.val(),
      u: url
    },function(data) {
      
      form.status.html( data.r ? settings.saved : settings.saved_error).fadeIn(300);
      $(window).resize();
      
      setTimeout(function(){
      form.status.fadeOut(300, function(){
        $(window).resize();
        form.toggle(300, function() {
        form.unlock();            
        });          
      });
      },500);
    });
    });
    
    cancel = form.find("#simplemeta-form-cancel").click(function(E) {
    E.preventDefault();    
    if (form.lock()) return;
    
    form.toggle(300, function() {
      form.unlock();
    });
    });
    
    del = form.find("#simplemeta-form-delete").click(function(E) {
    
    E.preventDefault();    
    if (form.lock()) return;
    
    ajax({
      u: url
    },function(data) {
      
      form.status.html( data.r ? settings.deleted : settings.deleted_error).fadeIn(300);
      if (data.r) {
      title.val("");
      keywords.val("");
      description("");
      }
      $(window).resize();
      setTimeout(function(){
      form.status.fadeOut(300,function(){
        $(window).resize();
        form.toggle(300,function() {
        form.unlock();
        });          
      });
      },500);
    });
    });
    
    function ajax(data, callback) {
    $.ajax({
      url: ajax_url,
      type: "POST",
      dataType: "json",
      data: data,
      success: callback
    });
    }
    
    function getMetaTags() {
    if (form.lock()) return;
    form.toggleClass("opened").toggle(300 , function() {
      form.unlock();
    });
    }
    
    button.click(function(E) {
    E.preventDefault();
    
    getMetaTags();
    });
    
    form.click(function(){ 
    return false;
    });
  }

  Drupal.behaviors.simplemeta = init;
  
  Drupal.admin = Drupal.admin || {};
  Drupal.admin.behaviors = Drupal.admin.behaviors || {};
  Drupal.admin.behaviors.simplemeta = init;
  
})();